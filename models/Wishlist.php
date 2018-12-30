<?php

class Wishlist extends Model
{
    /**
     * get all wishlist
     * @return array
     */
    public function getWishlists(){
        $sql = "SELECT * FROM t_wishlist";

        return $this->db->query($sql);
    }

    /**
     * get wishlist of logged customer
     * @return array
     */
    public function getWishlistByCustomerId(){
        $custid = Session::get('userid');
        $sql = "SELECT * FROM t_wishlist WHERE custid = '{$custid }'";

        return $this->db->query($sql);
    }

    /**
     * save wishlist to database
     * @param $data array
     * @return /-+bool
     */
    public function save($data){

        $prodid = $this->db->escape($data['prodid']);
        $custid = Session::get('userid');

        $sql = "INSERT INTO `t_wishlist` 
            SET 
            `prodid`= '{$prodid}',
            `custid`= '{$custid}',
            `date`= NOW()
            ";

        return $this->db->query($sql);
    }
}