<?php

class User extends Model {

    private $action = null;

    public function getUsers(){
        $sql = "SELECT a.* FROM t_users a ORDER BY a.access asc";

        return $this->db->query($sql);
    }

    public function getByUserName($u){
        $u = $this->db->escape($u);
        $sql = "SELECT * FROM t_users WHERE username='{$u}' LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function getByUserId($id){
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM t_users a WHERE a.userid='{$id}' LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function getSalt($u){
        $u = $this->db->escape($u);
        $sql = "SELECT * FROM t_users WHERE username='{$u}' LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result['salt'])){
            return $result['salt'];
        }
        return false;
    }

   public function deleteUser($id){
       $id = $this->db->escape($id);
       $sql = "delete FROM t_users WHERE userid='{$id}'";


       return $this->db->query($sql);
   }

    public function save($data, $id = null){
        $id = $this->db->escape($id);
        $userid = self::generateRandomCode(5).uniqid();

        $lname = $this->db->escape($data['lname']);
        $fname = $this->db->escape($data['fname']);
        $gender = $this->db->escape($data['gender']);
		$access = $this->db->escape($data['access']);



        if (!$id){

            //check username for duplicate
            if (self::getByUserName($usr)) return false;

            $usr = $this->db->escape($data['username']);
            $pwd = $this->db->escape($data['password']);
            $salt = self::generateRandomCode();
            $hash = md5($salt.$pwd);

            $sql = "INSERT INTO t_users
                SET
                lname = '{$lname}',
                fname = '{$fname}',
                gender = '{$gender}',
                userid = '{$userid}',
                username = '{$usr}',
                password = '{$hash}',
                access = '{$access}',
                salt = '{$salt}',
                is_active = 1
            ";


        }else {
            $sql = "UPDATE t_users
                 SET
                 lname = '{$lname}',
                 fname = '{$fname}',
                 gender = '{$gender}',
                 WHERE userid = '{$id}'
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

                $sql = "UPDATE t_users
                    SET
                    username = '{$usn}',
                    password = '{$hash}',
                    salt = '{$salt}'
                    WHERE userid = '{$id}'
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

            $sql = "UPDATE t_subscribers
                SET
				username = '{$usn}',
                password = '{$hash}',
				salt = '{$salt}'
                WHERE idno = '{$id}'
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

        $sql = "UPDATE t_users_info
            SET img = '{$new_filename}'
            WHERE userid = '{$id}'
        ";

        $action = "Change user picture: userid=".$id;

        $log = new Log();
        $log->save(Session::get('userid'), $action);

        return $this->db->query($sql);

    }

    public function checkFaculty($lname, $fname, $mname){
        $sql = "SELECT * FROM t_users WHERE lname = '{$lname}' and fname = '{$fname}' and mname = '{$mname}'";

      $result = $this->db->query($sql);
      if (isset($result[0])){
          return $result[0];
      }
      return false;
   }

   public function checkSubscribersUserName($username){
        $sql = "SELECT * FROM t_subscribers WHERE username='{$username}' LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }

    public function checkNames($lname, $fname){
        $sql = "SELECT * FROM t_users_info WHERE lname='{$lname}' and fname='{$fname}' LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }


	 public function checkBranch($branch){
        $sql = "SELECT * FROM t_users_info WHERE branch_assignment='{$branch}'LIMIT 1";

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
