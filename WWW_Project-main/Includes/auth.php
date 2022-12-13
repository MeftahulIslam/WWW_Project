<?php 
    $flag = false;  //validate login
    $attemptsByExistingUser = false;
    if($_SERVER['REQUEST_METHOD']== "POST"){
        if(!isset($_POST['token']) || !isset($_SESSION['token'])){  //check for CSRF, if any of the tokens sent are not valid, exit
            exit("Token not set!");
        }
        if($_POST['token'] == $_SESSION['token']){      //continue only if the sent tokens match
            if(time() >= $_SESSION['token-expiry']){     //less time for attackers to get the token, before expiry
                exit("Session Expired! Please Login again. Thank you!");    //upon expiry logs out
            }
            unset($_SESSION['token']);      //after checking unset the token
            $username = strip_tags($_POST['username']); //strip tag for XSS protection
            $password = strip_tags($_POST['password']);
            if(!empty($_POST['remember'])){     //if the user wants to set cookie
                $remember = $_POST['remember'];
                if($remember == 1){
                    setcookie('username', $username, time()+60*60*24*10,"/");       //set cookie for 10 days
                    setcookie('password', $password, time()+60*60*24*10,"/");
        
                }
            }
    
            $salt = $userNew->getSalt();    //Check for encrypted form of the password
            $encryptedPass = md5($password.$username.$salt);
            $result = $userNew->getUser($username,$encryptedPass);
            if(!$result){
                $flag = true;
            }
            else{
                $id = $result['user_id'];
                $_SESSION['id'] = $id;
            }
        }

    }


?>