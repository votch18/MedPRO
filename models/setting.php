<?php
class Setting extends Model{


    public function getSettings(){

        $sql = "select * from l_settings";

        return $this->db->query($sql);
    }

    public function getSettingsByKey($key){
        $key = $this->db->escape($key);
        $sql = "select value from l_settings where key_word ='{$key}' limit 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public static function get($key){
        $setting = new Setting();
        $settings = $setting->getSettingsByKey($key);
        return $settings['value'];
    }

    public function save($data){

        $count = count($data['id']);


        for ($x = 0; $x < $count; $x++){
            $id = current($data['id']);
            array_shift($data['id']);

            $value = current($data['value']);
            array_shift($data['value']);

            $sql = "update l_settings
                 set
                 value = '{$value}'
                 where
                 lid = '{$id}'
                 ";
            $this->db->query($sql);
        }

        return true;
    }
}
