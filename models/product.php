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

        //upload photos
        $images = $_FILES['file']['name'];
      

        $prodid = Util::generateRandomCodeCapital(5).strtotime("now");

        $filenames = array();

        if(!$id) {

            //check member for duplication
            if (self::checkDuplicateProduct($name)) return false;

            for ($i = 0; $i < count($images); $i++) {

                //photos
                $tmp = $images[$i];
                $folder = "uploads/products/";
            
                $imagenew = $tmp;
            
                $allowed = array('jpeg', 'png', 'jpg');
                $filename = $_FILES['file']['name'][$i];
            
                
                $ext=strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 
                if (!in_array($ext, $allowed)) {
                    } else {
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $folder.$filename);
                    $filenames[] = $imagenew;
                    
                    // //get image size and resize image if its too large
                    // list($width, $height) = getimagesize($path);
                    // $img = new SimpleImage($path);
                    
                    // if ($width > $height){
                    //     if ($width > 1024){
                    //         // Resize the image to 1024px width and the proportional height
                    //         $img->resizeToWidth(1024);
                    //         $img->save($path);
                    //     }
                    // }else {
                    //     if ($height > 1024){
                    //         // Resize the image to 1024px width and the proportional height
                    //         $img->resizeToWidth(1024);
                    //         $img->save($path);
                    //     }
                    // }
                }
                
            }

            $images = implode(",", $filenames);
        
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

        }
        
        return $this->db->query($sql);

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
}
