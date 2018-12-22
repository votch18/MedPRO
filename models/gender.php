<?php

class Gender extends Model
{

    public function getGender(){
        $sql = "select * from l_gender";

        return $this->db->query($sql);
    }


}
