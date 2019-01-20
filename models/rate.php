<?php

class Rate extends Model
{

    /**
     * @return array
     */
    public function getAdminRatings(){
        $sql = "SELECT a.*,
                c.name as product,
                b.company,
                CONCAT(b.fname, ' ', b.lname) as name        
                FROM t_ratings a
                INNER JOIN t_accounts b ON a.custid = b.custid
                INNER JOIN t_products c ON a.prodid = c.prodid
                ";

        return $this->db->query($sql);
    }

    
    /**
     * @param string $id
     * @return array
     */
    public function getRatings($id){
        $sql = "SELECT * FROM t_ratings  WHERE prodid = '{$id}'";

        return $this->db->query($sql);
    }

    /**
     * @param string $id
     * @return array
     */
    public function getRatingsByCustomerByProduct($id){
        $id = $this->db->escape($id);
        $custid = Session::get('userid');

        $sql = "SELECT 
            COUNT(*) as `count`
            FROM t_ratings 
            WHERE prodid = '{$id}' AND custid = '{$custid}'
            GROUP BY prodid
            ";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }


    /**
     * @param string $id
     * @return array
     */
    public function getRatingsByProductId($id){
        $id = $this->db->escape($id);

        $sql = "SELECT 
            (SUM(ratings) / COUNT(*)) as ratings
            FROM t_ratings 
            WHERE prodid = '{$id}'
            GROUP BY prodid
            ";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    /**
     * @param mixed $data
     * @param mixed|null $id
     * @return mixed
     */
    public function save($data, $id = null){

        $id = $this->db->escape($id);

        $prodid = $this->db->escape($data['prodid']);
        $rating = $this->db->escape($data['rating']);        
        $message = $this->db->escape($data['message']);
        $custid = Session::get('userid');

        if( !$id ){
            $sql = "INSERT INTO t_ratings
                SET
                `prodid` = '{$prodid}',
                `ratings` = '{$rating}',
                `message` = '{$message}',
                `custid` = '{$custid}',
                `date` = NOW(),
                `status` = 1
                ";
        }else{
            $sql = "UPDATE t_ratings
                SET
                `ratings` = '{$rating}',
                `message` = '{$message}'
                WHERE
                `id` = '{$id}'
                ";
        }
      
        return $this->db->query($sql);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id){
        $id = $this->db->escape($id);

        $sql = "DELETE FROM t_ratings WHERE id = '{$id}'";

        return $this->db->query($sql);
    }

}
