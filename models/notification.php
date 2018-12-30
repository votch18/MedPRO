<?php

class Notification extends Model
{
    /**
     * @param string $id
     * @return array
     */
    public function getNotificationsByCustomerId($id){
        $id = $this->db->escape($id);

        $sql = "SELECT *
             from t_notifications WHERE custid = '{$id}' ORDER BY date DESC LIMIT 5";

        return $this->db->query($sql);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function save($data){
        $custid = $this->db->escape($data['custid']);
        $message = $this->db->escape($data['message']);

        $sql = "INSERT INTO `t_notifications`
            SET 
            `custid` = '{$custid}',
            `message` = '{$message}',
            `date` = NOW()
        ";

        return $this->db->query($sql);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function mark_as_read($id){
        $id = $this->db->escape($id);

        $sql = "UPDATE t_notifications SET is_read = 1 WHERE custid = '{$id}'";

        return $this->db->query($sql);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete($id){
        $id = $this->db->escape($id);

        $sql = "DELETE t_notifications WHERE id = '{$id}'";

        return $this->db->query($sql);
    }
}