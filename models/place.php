<?php

class Place extends Model
{

    public function getBarangay(){
        $sql = "select * from l_barangay";

        return $this->db->query($sql);
    }

    public function getMunicipality(){
        $sql = "select * from l_municipality";

        return $this->db->query($sql);
    }

    public function getProvince(){
        $sql = "select * from l_province";

        return $this->db->query($sql);
    }

}
