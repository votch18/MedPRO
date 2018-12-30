<?php

class Message extends Model
{
    /**
     * get all messages regardless of status
     * @return array
     */
    public function getAllMessages(){
        $sql = "SELECT * FROM t_messages";

        return $this->db->query($sql);
    }

    /**
     * get all message thread
     * @return array
     */
    public function getAdminThread(){
        $sql = "SELECT 
            a.id,     
            (c.total) as total_msg,
            (a.receiver) as receiver,
            (a.sender) as sender,
            (SELECT CONCAT(x.fname, ' ', x.lname) FROM t_accounts x WHERE x.custid = a.receiver) as receiver_name,
            (SELECT CONCAT(x.fname, ' ', x.lname) FROM t_accounts x WHERE x.custid = a.sender) as sender_name,
            (SELECT x.photo FROM t_accounts x WHERE x.custid = a.receiver) as receiver_pic,
            (SELECT x.photo FROM t_accounts x WHERE x.custid = a.sender) as sender_pic,
            a.date,
            a.message,
            c.threadid_1,
            c.threadid_2
            FROM t_messages a
            INNER JOIN (SELECT MAX(x.id) as id, (LEAST(x.receiver, x.sender)) as threadid_1, (GREATEST(x.receiver, x.sender)) as threadid_2, count(DISTINCT(x.id)) as total FROM t_messages x GROUP BY threadid_1, threadid_2) c on c.id = a.id
            GROUP BY threadid_1, threadid_2
            ORDER BY a.date DESC";

        return $this->db->query($sql);
    }

    /**
     * get conversation between two customer
     * @return array
     */
    public function getConversation($sender, $receiver){
        $sender = $this->db->escape($sender);
        $receiver = $this->db->escape($receiver);

        $sql = "SELECT 
            a.*,
            (SELECT CONCAT(x.fname, ' ', x.lname) FROM t_accounts x WHERE x.custid = a.receiver) as receiver_name,
            (SELECT CONCAT(x.fname, ' ', x.lname) FROM t_accounts x WHERE x.custid = a.sender) as sender_name,
            FROM messages a
            WHERE a.sender in ($sender, $receiver) AND a.receiver in ($sender, $receiver)
            GROUP BY a.id
            ORDER BY a.date ASC";

        return $this->db->query($sql);
    }

    /**
     * get all message send to the currently logged-in customer
     * @return array
     */
    public function getMessagesByCustomerId($id){
        $id = $this->db->escape($id);

        $sql = "SELECT 
            a.id,
            b.custid,
            b.fname,
            b.lname,
            b.photo,
            (c.total) as total_messages,
            (a.receiver) as receiver,
            (a.sender) as sender,
            a.date,
            a.message,
            c.threadid
            FROM t_messages a
            INNER JOIN (SELECT MAX(x.id) as id, (CASE WHEN x.sender = $id THEN x.receiver ELSE x.sender END) as threadid, count(*) as total FROM t_messages x WHERE x.receiver = $id OR x.sender = $id GROUP BY threadid) c on c.id = a.id
            RIGHT JOIN t_accounts b on b.custid = (CASE WHEN a.sender = $id THEN a.receiver ELSE a.sender END)
            WHERE a.receiver = $id OR a.sender = $id 
            GROUP BY threadid
            ORDER BY a.date DESC";

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
