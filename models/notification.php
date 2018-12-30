<?php

class Notification extends Model
{
    /**
     * @param string $id
     * @return array
     */
    public function getNotificationsByCustomerId($id){
        $id = $this->db->escape($id);

        $sql = "SELECT * from t_notifications WHERE custid = '{$id}' ORDER BY date DESC";

        return $this->db->query($sql);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function save($data){
        $custid = $this->db->escape($data['custid']);
        $message = $this->db->escape($data['message']);

        $sql = "INSERT INTO t_notifications 
            SET 
            custid = '{$custid}',
            message = '{$message}',
            date = NOW()
        ";

        return $this->db->escape($sql);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function is_read($id){
        $id = $this->db->escape($id);

        $sql = "UPDATE t_notifications SET is_read = 2 WHERE custid = '{$id}'";

        return $this->db->escape($sql);
    }
}