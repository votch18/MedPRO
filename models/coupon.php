<?php

class Coupon extends Model
{
    /**
     * get all coupon codes regardless of status
     * @return array
     */
    public function getAllCoupons(){
        $sql = "SELECT * FROM t_coupons";

        return $this->db->query($sql);
    }

    /**
     * get all coupon codes which is not used
     * @return array
     */
    public function getUnUseCoupons(){
        $sql = "SELECT * FROM t_coupons WHERE status = 1";

        return $this->db->query($sql);
    }

    /**
     * get all coupon codes which is used
     * @return array
     */
    public function getUsedCoupons(){
        $sql = "SELECT * FROM t_coupons WHERE status = 2";

        return $this->db->query($sql);
    }
   
    /**
     * Add new coupon code
     * @return bool
     */
    public function addCoupon($data){
        $coupon = $this->db->escape($data['coupon']);
        $discount = $this->db->escape($data['discount']);
        $type = $this->db->escape($data['discount_type']);

        //if coupon exist in database then exit
        if ( self::checkCouponCode($coupon) ) return false;

        $sql = "INSERT INTO `t_coupons` 
            SET 
            `coupon_code`= '{$coupon}',
            `discount`= '{$discount}',
            `discount_type`= '{$type}'
            ";

        return $this->db->query($sql);
    }

    public function checkCouponCode($coupon){

        $sql = "SELECT *
                    FROM t_coupons a
                    WHERE
                    a.coupon_code ='{$coupon}'";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;

    }
}
