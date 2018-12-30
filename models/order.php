<?php

class Order extends Model
{

    public function getOrders(){
        $sql = "SELECT 
                a.name, 
                a.description, 
                a.sku,
                b.qty,
                b.price,
                c.discount,
                c.discount_type,
                c.criteria,
                c.is_first
                FROM t_products a
                INNER JOIN t_orders b on b.prodid = a.prodid
                INNER JOIN t_coupons c on b.coupon = c.id
                ";

        return $this->db->query($sql);
    }

    public function getOrderCountByCustomer(){

        $custid = Session::get('userid');

        $sql = "SELECT 
                COUNT(*) as count
                FROM t_orders a
                WHERE a.custid = '{$custid}' AND status = 1
                ";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function save($data, $id = null){

        $prodid = $data['prodid'];
        $custid = Session::get('userid');
        $seller = Product::getSellerIdByProduct($data['prodid']);       
        $qty = isset($data['qty']) ? $data['qty'] : '1';
        /*
        $street1 = $data['street1'];
        $street2 = $data['street2'];
        $barangay = $data['barangay'];

        $address = $street1.','.$street2.','.$barangay;
        $price = $data['price'];
        $coupon = $data['coupon'];
        */

        if ( !$id ){
            $sql = "INSERT INTO `t_orders` 
                SET 
                `prodid`= '{$prodid}',
                `qty`= '{$qty}',
                `date`= NOW(),
                `custid`= '{$custid}',
                `seller`= '{$seller}'
                ";
        } else {
            $sql = "UPDATE `t_orders` 
            SET 
            `qty`= '{$qty}',
            `delivery_address`='{$address}',
            `price`= '{$price}',
            `coupon`= '{$coupon}'
            WHERE id = '{$id}'
            ";
        }

        return $this->db->query($sql);

    }


}
