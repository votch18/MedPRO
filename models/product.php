<?php

class Product extends Model
{

    public function getProducts(){
        $sql = "SELECT * FROM t_products";

        return $this->db->query($sql);
    }

    public function getProductsByCustomer(){
        $custid = Session::get("userid");
        $sql = "SELECT a.prodid, a.name, a.description, a.sku, a.UoM,
            SUM(b.qty) as stocks
            FROM t_products a 
            LEFT JOIN t_stocks b on b.prodid = a.prodid
            WHERE a.custid = '{$custid}'
            GROUP BY a.prodid, a.name, a.description, a.sku, a.UoM
            ";

        return $this->db->query($sql);
    }

    public function getUnitofMeasure(){
        $sql = "select * from l_unit_of_measure";

        return $this->db->query($sql);
    }

    public function getProductById($id){
        $id = $this->db->escape($id);
        $sql = "SELECT *
                    FROM t_products a
                    WHERE a.prodid ='{$id}' 
                    LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function save($data, $id = null){

        $name = $this->db->escape($data['name']);
        $description = $this->db->escape($data['description']);
        $sku = $this->db->escape($data['sku']);
        $UoM = $this->db->escape($data['UoM']);

        $custid = Session::get('userid');
        $main_photo = $this->db->escape($data['main_photo']);
        
        //upload photos
        $images = $_FILES['file']['name'];
      
        $prodid = Util::generateRandomCodeCapital(5).strtotime("now");

        $filenames = array();

        if(!$id) {

            //check member for duplication
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

            $images = self::changeImageOrder($filenames);         
        
            $sql = "INSERT INTO `t_products` 
                SET             
                `prodid`= '{$prodid}',
                `name`= '{$name}',
                `description`= '{$description}',
                `sku`= '{$sku}',
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
                `custid`= '{$custid}',
                `UoM` = '{$UoM}'
                WHERE prodid = '{$id}'";
        }
        
        return $this->db->query($sql);

    }

    public function changeImageOrder($filename){

        $images = implode(",", $filenames);
        $images = str_replace($main_photo, '', $images);
        $images = str_replace(',,', ',', $images);

        return $main_photo.','.$images;
    }

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

    public function delete($id){
        $sql = "DELETE FROM t_products WHERE prodid = '{$id}'";

        return $this->db->query($sql);
    }

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

    public function saveMainPhoto($image, $id){
       
       
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

    public function saveStocks($data, $id = null){
        $prodid = $data['id'];
        $qty = $data['qty'];
        //$remarks = $data['remarks'];

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
}
