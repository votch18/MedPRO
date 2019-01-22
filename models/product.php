<?php

class Product extends Model
{
    /**
     * get all products
     */
    public function getProducts(){
        $sql = "SELECT * FROM t_products ORDER BY date ASC";

        return $this->db->query($sql);
    }

    /**
     * get all approved products and sort by popularity
     * @return array
     */
    public function getApprovedProducts(){
        $sql = "SELECT 
            a.*,
            (COUNT(b.prodid) + 1) as visits
            FROM t_products a
            LEFT JOIN t_visits b ON b.prodid = a.prodid
            WHERE a.status = 2
            GROUP BY a.prodid
            ORDER BY (COUNT(b.prodid) + 1)  DESC
            ";

        return $this->db->query($sql);
    }

    /**
     * get all products by status {1=pending, 2=approved}
     * @param int $status
     * @return array
     */
    public function getProductsByStatus($status = 1){
        $status = $this->db->escape($status);

        $sql = "SELECT 
            a.*
            FROM t_products a
            WHERE status = '{$status}'
            ORDER BY a.date  DESC
            ";

        return $this->db->query($sql);
    }

     /**
     * get all products by category
     * @param int $category
     * @return array
     */
    public function getProductsByCategory($category){
        $category = $this->db->escape($category);
        $categoryid = $this->getProductCategoryByDescription($category);

        $sql = "SELECT 
            a.*,
            (COUNT(b.prodid) + 1) as visits
            FROM t_products a
            LEFT JOIN t_visits b ON b.prodid = a.prodid
            WHERE a.category = '{$categoryid}' AND a.status = 2
            GROUP BY a.prodid
            ORDER BY (COUNT(b.prodid) + 1)  DESC
            ";

        return $this->db->query($sql);
    }

     /**
     * get all products by category
     * @param int $category
     * @return array
     */
    public function getCategorywithProducts($category){
        $category = $this->db->escape($category);
        $categoryid = $this->getProductCategoryByDescription($category);

        $sql = "SELECT 
            a.*,
            
            FROM l_categories a
            LEFT JOIN (SELECT z.category, COUNT(*) as visits FROM t_products z WHERE z.category = a.lid GROUP BY z.category) x ON x.category = a.lid)
            ";

        return $this->db->query($sql);
    }



    /**
     * $param string $category
     * @return int
     */
    public function getProductCategoryByDescription($category){
        $category = $this->db->escape($category);

        $sql = "SELECT * FROM l_product_category WHERE description = '{$category}'";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0]['lid'];
        }
        return false;
    }

    /**
     * get products by customer
     * @param string|null $custid customer id
     * @return array
     */
    public function getProductsByCustomer(  $custid = null ){
       
        $custid = isset($custid) ? $custid : Session::get("userid");

        $sql = "SELECT a.prodid, a.name, a.description, a.sku, a.UoM, a.price,
            SUM(b.qty) as stocks
            FROM t_products a 
            LEFT JOIN t_stocks b on b.prodid = a.prodid
            WHERE a.custid = '{$custid}'
            GROUP BY a.prodid, a.name, a.description, a.sku, a.UoM
            ORDER BY a.name
            ";

        return $this->db->query($sql);
    }

    /**
     * @param string $prodid
     * @return string seller id
     */
    public static function getSellerIdByProduct($prodid){
        $product = new Product();
        $products =$product->getProductById($prodid);
        return $products['custid'];
    }

    /**
     * @return array
     */
    public function getUnitofMeasure(){
        $sql = "select * from l_unit_of_measure";

        return $this->db->query($sql);
    }

    /**
     * @return array
     */
    public function getProductCategory(){
        $sql = "select * from l_product_category";

        return $this->db->query($sql);
    }

    /**
     * @param string $id
     * @return array
     */
    public function getProductById($id){
        $id = $this->db->escape($id);
        $sql = "SELECT a.*, b.*,
                    (b.description) as categories,
                    c.company
                    FROM t_products a
                    LEFT JOIN l_product_category b ON b.lid = a.category
                    LEFT JOIN t_accounts c ON c.custid = a.custid
                    WHERE a.prodid ='{$id}' 
                    LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    /**
     * save product {insert|update}
     * @param array $data
     * @param string $id
     * @return bool
     */
    public function save($data, $id = null){

        $name = $this->db->escape($data['name']);
        $description = $this->db->escape($data['description']);
        $sku = $this->db->escape($data['sku']);
        $category = $this->db->escape($data['category']);
        $price = $this->db->escape($data['price']);
        $UoM = $this->db->escape($data['UoM']);

        $custid = Session::get('userid');
        $main_photo = $this->db->escape($data['main_photo']);
        
        //upload photos
        $images = $_FILES['file']['name'];      
        $prodid = Util::generateRandomCodeCapital(5).strtotime("now");
        $filenames = array();

        //if id = null then insert else update
        if(!$id) {

            //check customer for duplication
            if (self::checkDuplicateProduct($name)) return false;

        
            for ($i = 0; $i < count($images); $i++) {

                $folder = "uploads/products/";            
            
                $allowed = array('jpeg', 'png', 'jpg');
                $filename = $_FILES['file']['name'][$i];            
                
                $ext=strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 
                if (!in_array($ext, $allowed)) {
                    } else {
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $folder.$filename);
                    $filenames[] = $filename;                 
                }                
            }
                   
            //make main photo position at 0
            $images = self::changeImageOrder($filenames, $main_photo);         
        
            $sql = "INSERT INTO `t_products` 
                SET             
                `prodid`= '{$prodid}',
                `name`= '{$name}',
                `description`= '{$description}',
                `sku`= '{$sku}',
                `category`= '{$category}',
                `price`= '{$price}',
                `custid`= '{$custid}',
                `images`='{$images}',
                `date` = NOW(),
                `UoM` = '{$UoM}'";

        }else{
            $sql = "UPDATE `t_products` 
                SET             
                `name`= '{$name}',
                `description`= '{$description}',
                `sku`= '{$sku}',
                `category`= '{$category}',
                `price`= '{$price}',
                `custid`= '{$custid}',
                `UoM` = '{$UoM}'
                WHERE prodid = '{$id}'";
        }
        
        return $this->db->query($sql);

    }

    /**
     * set main image
     * @$filename array
     * @return string separated by comma
     */
    public function changeImageOrder($filenames, $main_photo){

        if (count($filenames) == 1) return implode(",", $filenames);

        $images = implode(",", $filenames);
        $images = str_replace($main_photo, '', $images);
        $images = str_replace(',,', ',', $images);

        return $main_photo.','.$images;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function checkDuplicateProduct($name){

        $sql = "SELECT *
            FROM t_products a
            WHERE
            a.name ='{$name}'";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
        
    
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete($id){
        $sql = "DELETE FROM t_products WHERE prodid = '{$id}'";

        return $this->db->query($sql);
    }

    /**
     * upload a single photo
     * @param string $id
     * @return bool
     */
    public function addPhoto($id){
       
        $folder = "uploads/products/";
        
        $allowed = array('jpeg', 'png', 'jpg');
        $filename = $_FILES['file']['name'];
            
        $ext=strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 
        if (in_array($ext, $allowed)) {

            move_uploaded_file($_FILES['file']['tmp_name'], $folder.$filename);
            $filenames[] = $filename;         
        }
        

        $sql = "UPDATE t_products 
            SET
            images = CONCAT(images, ',', '{$filename}')
            WHERE prodid = '{$id}'";

        return $this->db->query($sql);
    }

     /**
     * delete a single photo
     * @param string $id
     * @return bool
     */
    public function deletePhoto($image, $id){       
        $path = "/uploads/products/";

        if(file_exists($path.$image)){
            unlink(realpath($path.$image));
        }

        $sql = "UPDATE t_products 
            SET
            images =  REPLACE(REPLACE(images, '{$image}', ''), ',,', ',')
            WHERE prodid = '{$id}'";

        return $this->db->query($sql);
    }

     /**
     * change product main photo
     * @param string $image
     * @param string $id
     * @return bool
     */
    public function saveMainPhoto($image, $id){
        $image = $this->db->escape($image);        
        $id = $this->db->escape($id);
       
        $sql = "UPDATE t_products 
            SET
            images =  REPLACE(
                CONCAT('{$image}', ',', 
                    REPLACE(images, '{$image}', '')
                ), 
                ',,', ',')
            WHERE prodid = '{$id}'";

        return $this->db->query($sql);
    }

    /**
     * add stocks to products
     * @param array $data
     * @param string|null $id
     * @return bool
     */
    public function saveStocks($data, $id = null){
        $prodid = $this->db->escape($data['id']);
        $qty = $this->db->escape($data['qty']);
        if (!$id){
            $sql = "INSERT INTO `t_stocks` 
                SET 
                `prodid`= '{$prodid}',
                `qty`= '{$qty}',
                `date`= NOW()
                ";
        } else{
            $sql = "UPDATE `t_stocks` 
                SET              
                `qty`= '{$qty}',
                `date`= NOW()
                WHERE `prodid`= '{$prodid}'";
        }

        return $this->db->query($sql);
    }

    /**
     * save client/visitor data viewing a product
     * @param string $prodid
     * @return array
     */
    public function saveVisits($prodid){
        $prodid = $this->db->escape($prodid);
        $ip = Util::getIpAddress();
        $browser = Util::getBrowserName();

        //check if valid product
        if ( self::getProductById($prodid) ){
            $sql = "INSERT INTO t_visits 
                SET
                prodid = '{$prodid}',
                ip = '{$ip}',
                browser = '{$browser}',
                date = NOW()
                ";
            
            return $this->db->query($sql);
        }      
        return false;
    }

    /**
     * @param string $prodid
     * @return void
     */
    public function approveProduct($prodid){
        $prodid = $this->db->escape($prodid);

        $sql = "UPDATE t_products SET status = 2 WHERE prodid = '{$prodid}'";
        return $this->db->query($sql);
    }
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
