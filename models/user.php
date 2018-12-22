<?php

class User extends Model {

    private $action = null;

    public function getUsers(){
        $sql = "select a.*, (select description from l_municipality where lid = a.branch_id) as branch_assignment from t_users a order by a.access asc";

        return $this->db->query($sql);
    }

    public function getByUserName($u){
        $u = $this->db->escape($u);
        $sql = "select * from t_users where username='{$u}' limit 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function getByUserId($id){
        $id = $this->db->escape($id);
        $sql = "select * from t_users a where a.userid='{$id}' limit 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function getSalt($u){
        $u = $this->db->escape($u);
        $sql = "select * from t_users where username='{$u}' limit 1";

        $result = $this->db->query($sql);
        if (isset($result['asin'])){
            return $result['asin'];
        }
        return false;
    }

   public function deleteUser($id){
       $id = $this->db->escape($id);
       $sql = "delete from t_users where userid='{$id}'";


       return $this->db->query($sql);
   }

    public function getLocation($id){
        $sql = "select * from t_users_info where userid='{$id}'";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0]['img'];
        }
    }

    public function save($data, $id = null){
        $id = $this->db->escape($id);
        $userid = self::generateRandomCode(5).uniqid();

        $lname = $this->db->escape($data['lname']);
        $fname = $this->db->escape($data['fname']);
        $mname = $this->db->escape($data['mname']);
        $birthdate = date('Y-m-d', strtotime($data["birthdate"]));
        $gender = $this->db->escape($data['gender']);
        $address = $this->db->escape($data['address']);
        $position = $this->db->escape($data['position']);
		$branch = $this->db->escape($data['branch']);
		$access = $this->db->escape($data['access']);



        if (!$id){

            //check username for duplicate
            if (self::getByUserName($usr)) return false;

            //check names for duplicate
            if (self::checkFaculty($lname, $fname, $mname)) return false;

            $usr = $this->db->escape($data['username']);
            $pwd = $this->db->escape($data['password']);
            $salt = self::generateRandomCode();
            $hash = md5($salt.$pwd);

            $sql = "insert into t_users
                set
                lname = '{$lname}',
                fname = '{$fname}',
                mname = '{$mname}',
                birthdate = '{$birthdate}',
                gender = '{$gender}',
                address = '{$address}',
                position = '{$position}',
                userid = '{$userid}',
                username = '{$usr}',
                password = '{$hash}',
                access = '{$access}',
                asin = '{$salt}',
				branch_id = '{$branch}',
                is_active = 1
            ";


        }else {
            $sql = "update t_users
                 set
                 lname = '{$lname}',
                 fname = '{$fname}',
                 mname = '{$mname}',
                 birthdate = '{$birthdate}',
                 gender = '{$gender}',
                 address = '{$address}',
                 position = '{$position}',
				 branch_id = '{$branch}'
                 where userid = '{$id}'
            ";


        }
        return $this->db->query($sql);;
    }

    public function change_password($data, $id){
            $id = $this->db->escape($id);
            $usn = $this->db->escape($data['usn']);
            $pwd = $this->db->escape($data['pwd']);
            $confirm = $this->db->escape($data['confirm']);

            if ( $pwd == $confirm){

                $salt = self::generateRandomCode();
                $hash = md5($salt.$pwd);

                $sql = "update t_users
                    set
                    username = '{$usn}',
                    password = '{$hash}',
                    asin = '{$salt}'
                    where userid = '{$id}'
                ";

                return $this->db->query($sql);
            }

            return false;
        }

    public function customer_change_password($data, $id){
        $id = $this->db->escape($id);
		$usn = $this->db->escape($data['usn']);
        $pwd = $this->db->escape($data['pwd']);
        $confirm = $this->db->escape($data['confirm']);

        if ( $pwd == $confirm){

             $salt = self::generateRandomCode();
             $hash = md5($salt.$pwd);

            $sql = "update t_subscribers
                set
				username = '{$usn}',
                password = '{$hash}',
				asin = '{$salt}'
                where idno = '{$id}'
            ";

            return $this->db->query($sql);
        }

        $action = "Updated user_info: userid=".$id;

        $log = new Log();
        $log->save(Session::get('userid'), $action);

        return false;
    }

    public function change_picture($data, $id){
        $id = $this->db->escape($id);

        /*change file name before uploading to website*/
        $temp = explode(".", $_FILES["file"]["name"]);
        $new_filename = $id. '.' . end($temp);

        $name       = $_FILES['file']['name'];
        $temp_name  = $_FILES['file']['tmp_name'];
        if(isset($name)){
            if(!empty($name)){
                $location = 'uploads/users/';
                if(move_uploaded_file($temp_name, $location.$new_filename)){
                }
            }
        }  else {
            return false;
        }

        $sql = "update t_users_info
            set img = '{$new_filename}'
            where userid = '{$id}'
        ";

        $action = "Change user picture: userid=".$id;

        $log = new Log();
        $log->save(Session::get('userid'), $action);

        return $this->db->query($sql);

    }

    public function checkFaculty($lname, $fname, $mname){
        $sql = "select * from t_users where lname = '{$lname}' and fname = '{$fname}' and mname = '{$mname}'";

      $result = $this->db->query($sql);
      if (isset($result[0])){
          return $result[0];
      }
      return false;
   }

   public function checkSubscribersUserName($username){
        $sql = "select * from t_subscribers where username='{$username}' limit 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function checkNames($lname, $fname){
        $sql = "select * from t_users_info where lname='{$lname}' and fname='{$fname}' limit 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }


	 public function checkBranch($branch){
        $sql = "select * from t_users_info where branch_assignment='{$branch}'limit 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public static function generateRandomCode($length = 50) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}
