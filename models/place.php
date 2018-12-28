<?php

class Place extends Model
{

    public function getAllBarangays(){
        $sql = "SELECT * FROM t_barangays";

        return $this->db->query($sql);
    }

    public function getBarangaysByCity($city){
        $city = $this->db->escape($city);
        $sql = "SELECT barangay FROM t_barangays WHERE city = '{$city}'";

        return $this->db->query($sql);
    }

    public function getCityByProvince($province){
        $province = $this->db->escape($province);
        $sql = "SELECT DISTINCT(city) as city FROM t_barangays WHERE province = '{$province}'";

        return $this->db->query($sql);
    }

    public function getProvince(){
        $sql = "SELECT DISTINCT(province) as province FROM t_barangays";

        return $this->db->query($sql);
    }

}
