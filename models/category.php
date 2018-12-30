<?php

class Category extends Model
{

    public function getCategories(){
        $sql = "SELECT * FROM l_product_category";

        return $this->db->query($sql);
    }

    

}
