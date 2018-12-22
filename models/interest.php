<?php

class Interest extends Model
{

    public function getInterestType(){
        $sql = "select * from l_interest_type";

        return $this->db->query($sql);
    }
	
	public function getInterestTerm(){
        $sql = "select *  from l_interest_term";

        return $this->db->query($sql);
    }


}