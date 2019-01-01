<?php

class Auth extends Model
{

    /**
     * login users
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return bool
     */
    public function loginAccount($username, $password, $remember){

        $accounts = new Account();
        $account = $accounts->getByUserName($username);
        $hash = md5($account['salt'].$password);

        if ($account && $hash == $account['password']){
            Session::set('userid', $account['custid']);
            Session::set('username', $account['username']);
            Session::set('email', $account['username']);
            Session::set('access', 2);
            Session::set('type', $account['type']);            
            Session::set('avatar', $account['photo']);
            Session::set('fname', ucwords($user['fname']));
            Session::set('lname', ucwords($user['lname']));

            if ($remember){
                setcookie('userid', $account['custid'], time() + (31556926), "/");
                setcookie('username', $account['username'], time() + (31556926), "/");
                setcookie('email', $account['username'], time() + (31556926), "/");
                setcookie('access', 2, time() + (31556926), "/");
                setcookie('avatar', $user['photo'], time() + (31556926), "/");
                setcookie('fname', ucwords($user['fname']), time() + (31556926), "/");
                setcookie('lname', ucwords($user['lname']), time() + (31556926), "/");
            }
            
            $log = new Log();
            $log->save('Log-in');

            return true;
        }

        return false;
    }

    /**
     * login users
     * @param string $username
     * @param string $password 
     * @param bool $remember
     * @return bool
     */
    public function loginAdmin($username, $password, $remember){
        $users = new User();
        $user = $users->getByUserName($username);
        $hash = md5($user['salt'].$password);

        if ($user && $user['is_active'] && $hash == $user['password']){
            Session::set('userid', $user['userid']);
            Session::set('username', $user['username']);                  
            Session::set('email', $user['email']);  
            Session::set('access', $user['access']);
            Session::set('avatar', $user['photo']);
            Session::set('fname', ucwords($user['fname']));
            Session::set('lname', ucwords($user['lname']));

            if ($remember){
                setcookie('userid', $user['userid'], time() + (31556926), "/");
                setcookie('username', $user['username'], time() + (31556926), "/");
                setcookie('email', $user['email'], time() + (31556926), "/");
                setcookie('access', $user['access'], time() + (31556926), "/");
                setcookie('avatar', $user['photo'], time() + (31556926), "/");
                setcookie('fname', ucwords($user['fname']), time() + (31556926), "/");
                setcookie('lname', ucwords($user['lname']), time() + (31556926), "/");
            }
            
            $log = new Log();
            $log->save('Log-in');

            return true;
        }

        return false;
    }

    public function logout(){
        $log = new Log();
        $log->save( 'Log-out' );

        setcookie("email", "", time()-86400, "/");
        setcookie('userid', "", time()-86400, "/");
        setcookie('username', "", time() + (86400), "/");
        setcookie('email', "", time() + (86400), "/");
        setcookie('access', "", time() + (86400), "/");
        setcookie('avatar', "", time() + (86400), "/");
        setcookie('fname', "", time() + (86400), "/");
        setcookie('lname', "", time() + (86400), "/");

        Session::destroy();        
    }

}