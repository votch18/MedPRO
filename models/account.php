<?php

class Account extends Model
{

    public function getAccounts(){
        $sql = "SELECT * FROM t_accounts";

        return $this->db->query($sql);
    }

    public function register($data){

        $company = $this->db->escape($data['company']);
        $email = $this->db->escape($data['email']);
        $password = $this->db->escape($data['password']);
        $is_supplier = $this->db->escape($data['supplier']);

        $custid = uniqid();

        $salt = Util::generateRandomCode();

        $hash = md5($salt.$password);

        //if 1 then supplier else buyer (2)
        $is_supplier = ($is_supplier == 1) ? 1 : 2;

        $sql = "INSERT INTO t_accounts
            SET
            custid = '{$custid}',
            company = '{$company}',
            username = '{$email}',
            password = '{$hash}',
            salt = '{$salt}',
            type = '{$is_supplier}',
            date = NOW()
            ";

        return $this->db->query($sql);
    }

    public function loginAccount($username, $password){

        $account = self::getByUserName($username);
        $hash = md5($account['salt'].$password);

        if ($account && $hash == $account['password']){
            Session::set('userid', $account['custid']);
            Session::set('username', $account['username']);
            Session::set('access', 2);
            Session::set('type', $account['type']);
            
            $log = new Log();
            $log->save('Log-in');

            return true;
        }

        return false;
    }

    public function getByUserName($username){
        $username = $this->db->escape($username);
        $sql = "SELECT * FROM t_accounts WHERE username='{$username}' LIMIT 1";

        $result = $this->db->query($sql);
        if (isset($result[0])){
            return $result[0];
        }
        return false;
    }
}