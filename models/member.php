<?php

class Member extends Model{

    /**
     * get all Members
     * @return array
     */
    public function getMembers(){

        $sql = "SELECT a.*,
                    (SELECT x.description FROM l_gender x WHERE x.lid=a.gender) as gender
                    FROM t_members a 
                    WHERE a.is_active = 1 
                    order by a.lname, a.fname, a.mname";

        return $this->db->query($sql);
    }

    /**
     * get members by type 
     * @param int $type {supplier: 1, buyer: 2}
     * @return array
     */
    public function getMembersByType($type = 1){

        $sql = "SELECT a.*, b.*
                    FROM t_accounts a 
                    INNER JOIN t_customers b on a.custid = b.custid
                    WHERE a.type = '{$type}'
                    order by a.lname, a.fname";

        return $this->db->query($sql);
    }

    /**
     * @return bool
     */
    public function getDeletedMembers(){

        $sql = "SELECT a.*,
                    (select x.description from l_gender x where x.lid=a.gender) as gender
                    from t_members a 
                    where a.is_active != 1 
                    order by a.lname, a.fname, a.mname";

        return $this->db->query($sql);
    }

    /**
     * @param mixed $name
     * @return array
     */
	public function searchMembers($name){

        $sql = "SELECT 
                    a.member_id, 
                    concat(lname, ' ', fname, ' ', mname) as name
                    FROM t_members a 
                    left join t_loans b on a.member_id = b.member_id 
                    where a.is_active = 1 and concat(lname, ', ', fname, ' ', mname) like '%{$name}%' 
                    limit 0, 4";

        return $this->db->query($sql);
    }
    
     /**
     * @param mixed $name
     * @return array
     */
    public function getMemberswithOutLoan($name){

        $sql = "SELECT 
                    a.member_id, 
                    concat(lname, ' ', fname, ' ', mname) as name
                    FROM t_members a 
                    left join t_loans b on a.member_id = b.member_id 
                    where a.is_active = 1 and ifnull(b.status, 2) > 1 and concat(lname, ', ', fname, ' ', mname) like '%{$name}%' 
                    limit 0, 4";

        return $this->db->query($sql);
    }

    /**
     * @param mixed $name
     * @return array
     */
    public function getMemberswithLoan($name){

        $sql = "SELECT 
                b.loan_id,
                a.member_id, 
                concat(lname, ' ', fname, ' ', mname) as name
                from t_members a 
                left join t_loans b on a.member_id = b.member_id 
                where a.is_active = 1 and ifnull(b.status, 0) = 1 and concat(a.lname, ', ', a.fname, ' ', a.mname) like '%{$name}%' 
                limit 0, 5";

        return $this->db->query($sql);
    }

     /**
     * @param mixed $id
     * @return array
     */
    public function getMemberById($id){
        $id = $this->db->escape($id);
        $sql = "SELECT 
                    a.member_id,
                    a.lname,
                    a.fname,
                    a.mname,
                    a.extn,
                    a.civil_status,
                    a.citizenship,
                    a.source_of_income,
                    a.mobile,
                    a.img,
                    a.spouse_lname,
                    a.spouse_fname,        
                    (select x.description from l_gender x where x.lid = a.gender) as gender,
                    (DATEDIFF(NOW(), a.birthdate)/365.25) as age,
                    concat(
                        purok, ', ',
                        b.barangay, ', ',
                        c.description, ', ',
                        d.province
                    ) as address,
                    concat(a.lname, ', ', a.fname, ' ', a.mname) as name 
                    FROM t_members a
                    LEFT JOIN l_barangay b on b.lid = a.brgy
                    LEFT JOIN l_municipality c on c.lid = a.municipality
                    LEFT JOIN l_province d on d.lid = a.province
                    WHERE a.member_id ='{$id}' 
                    LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function getMemberDataById($id){
        $id = $this->db->escape($id);
        $sql = "SELECT *
                    FROM t_members a
                    WHERE a.member_id ='{$id}' 
                    LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function save($data, $id = null){

        $id = $this->db->escape($id);

        $lname = $this->db->escape($data['lname']);
        $fname = $this->db->escape($data['fname']);
        $mname = $this->db->escape($data['mname']);
        $birthdate = date('Y-m-d', strtotime($data["birthdate"]));
        $gender = $this->db->escape($data['gender']);
        $civil_status = $this->db->escape($data['civil_status']);
        $source_of_income = $this->db->escape($data['source_of_income']);
        $mobile = $this->db->escape($data['mobile']);
        //$address = $this->db->escape($data['address']);
        $purok = $this->db->escape($data['purok']);
        $brgy = $this->db->escape($data['brgy']);
        $municipality = $this->db->escape($data['municipality']);
        $province = $this->db->escape($data['province']);

        $userid = Session::get('userid');

        //spouse information
        $spouse_lname = $this->db->escape($data['spouse_lname']);
        $spouse_fname = $this->db->escape($data['spouse_fname']);

        //t_members
        $member_id =  strtotime("now");

        if (!$id){

            //check member for duplication
            if (self::checkMember($lname, $fname, $mname)) return false;

            /*change file name before uploading to website*/
            $temp = explode(".", $_FILES["file"]["name"]);
            $new_filename = $member_id. '.' . end($temp);

            $filename       = $_FILES['file']['name'];
            $temp_name  = $_FILES['file']['tmp_name'];
            if(isset($filename)){
                if(!empty($filename)){
                    $loc = 'uploads/members/';
                    if(move_uploaded_file($temp_name, $loc.$new_filename)){
                    }
                }
            }  else {
                return false;
            }


            $sql = "INSERT INTO `t_members` SET
                `member_id`='{$member_id}',
                `lname`='{$lname}',
                `fname`='{$fname}',
                `mname`='{$mname}',
                `gender`='{$gender}',
                `birthdate`='{$birthdate}',
                `civil_status`='{$civil_status}',
                `mobile`='{$mobile}',
                `source_of_income`='{$source_of_income}',
                `userid`='{$userid}',
                `spouse_lname`='{$spouse_lname}',
                `spouse_fname`='{$spouse_fname}',
                `purok`='{$purok}',
                `brgy`='{$brgy}',
                `municipality`='{$municipality}',
                `province`='{$province}',
                `img` = '{$new_filename}',
                `is_active` = 1
                ";

            $log = new Log();
            $log->save('Add new member: '.$lname.', '.$fname.' '.$mname );
        }else {
             $sql = "UPDATE `t_members`
                 SET
                `lname`='{$lname}',
                `fname`='{$fname}',
                `mname`='{$mname}',
                `gender`='{$gender}',
                `birthdate`='{$birthdate}',
                `civil_status`='{$civil_status}',
                `mobile`='{$mobile}',
                `source_of_income`='{$source_of_income}',
                `userid`='{$userid}',
                `purok`='{$purok}',
                `brgy`='{$brgy}',
                `municipality`='{$municipality}',
                `province`='{$province}',
                `spouse_lname`='{$spouse_lname}',
                `spouse_fname`='{$spouse_fname}'
                WHERE member_id = '{$id}'
                ";
        }

        return $this->db->query($sql);
    }

    public function checkMember($lname, $fname, $mname){

        $sql = "SELECT *
                    FROM t_members a
                    WHERE
                    a.lname ='{$lname}' AND a.fname = '{$fname}' AND a.mname = '{$mname}'";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function delete($id){

        $id = $this->db->escape($id);

        $sql = "delete from t_members where member_id = '{$id}'";
        return $this->db->query($sql);
    }

    public function deactivate($id){

        $id = $this->db->escape($id);

        $sql = "update t_members set is_active = 0 where member_id = '{$id}'";
        return $this->db->query($sql);
    }

    public function activate($id){

        $id = $this->db->escape($id);

        $sql = "update t_members set is_active = 1 where member_id = '{$id}'";
        return $this->db->query($sql);
    }

     public function getGender(){
        $sql = "select * from l_gender";
        return $this->db->query($sql);
     }


    public function getCitizenship(){
        $sql = "select * from l_citizenship";
        return $this->db->query($sql);
    }

    public function getCivilStatus(){
        $sql = "select * from l_civilstatus";
        return $this->db->query($sql);
    }


    
    public function change_image($id = null){
        $id = $this->db->escape($id);

        if ($id){
            /*change file name before uploading to website*/
            $temp = explode(".", $_FILES["file"]["name"]);
            $new_filename = strtotime("now"). '.' . end($temp);

            $fname       = $_FILES['file']['name'];
            $temp_name  = $_FILES['file']['tmp_name'];
            if(isset($fname)){
                if(!empty($fname)){
                    $loc = 'uploads/members/';
                    if(move_uploaded_file($temp_name, $loc.$new_filename)){
                    }
                }
            }  else {
                return false;
            }

            $sql = "UPDATE `t_members` SET
            `img`='{$new_filename}'
            WHERE id ='{$id}'
            ";

        }
        return $this->db->query($sql);;
    }

}
