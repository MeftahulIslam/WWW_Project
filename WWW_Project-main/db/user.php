<?php
    //Functions for user_login table
    class user{
        private $db;
        private $salt = "SomeSalt";

        function __construct($db_config)
        {
            $this->db = $db_config;
        }

        public function getSalt(){
            $result = $this->salt;
            return $result;
        }

        public function insertUser($username, $password){       //insert user in user_login table
            try {
                $result = $this->userExist($username);  //first check if the user already exists, if it does, don't let another
                if($result['num'] > 0){                 //user with the same username
                    return false;
                }
                else{
                    $encryptedPass = md5($password.$username.$this->getSalt());     //encrypts the password for storing
                    $privilege = 0;
                    $attemptsLeft = 5;
                    $sql = "INSERT INTO user_login(username,password,privilege,attempts_left) VALUE(:username,:password,:privilege,:attemptsLeft)";
                    $stmnt = $this->db->prepare($sql);
                    $stmnt->bindparam(':username',$username);
                    $stmnt->bindparam(':password',$encryptedPass);
                    $stmnt->bindparam(':privilege',$privilege);
                    $stmnt->bindparam(':attemptsLeft',$attemptsLeft);
                    $stmnt->execute();
    
                    return true;
                }
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                
                return false;
            }
        }

        public function userExist($username){       //returns the count of user by the same name in table
            try {                                
                $sql = "SELECT count(*) AS num FROM user_login WHERE username = :username";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':username',$username);

                $stmnt->execute();
                $result = $stmnt->fetch();
                return $result;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                
                return false;
            }
        }

        public function getUserId($username){       //gets the user id with the given username
            try {
                $sql = "SELECT * FROM user_login WHERE username = :username";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':username',$username);
                $stmnt->execute();
                $result = $stmnt->fetch();
                return $result;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function getUserNameById($userId){       //gets the username with the given id
            try {
                $sql = "SELECT * FROM user_login WHERE user_id = :userId";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':userId',$userId);
                $stmnt->execute();
                $result = $stmnt->fetch();
                return $result;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function getUser($username, $password){      //gets the user with the given username and password
            try {
                $result = $this->userExist($username);      //first checks if the user exists
                if($result['num'] > 0){
                    $result = $this->correctCredentials($username,$password);   //then checks if the credentials are right
                    if(!$result){              //if the credentials are not correct, check how many attempts are left for the user
                        $result = $this->getUserAttemptsLeft($username);
                        if($result['attempts_left'] > 0){       //if attempts left. then decrement the attempt for providing wrong credentials
                            $result = $this->updateUserAttempts($username,$result['attempts_left']);
                        }
                        else{
                            return false;           //if no attempts are left, then return false anyway
                        }
                    }
                    else{
                        $attempts = $this->getUserAttemptsLeft($username);  
                        if($attempts['attempts_left']>0){   //if attempts are left
                            return $result;     //return the user info
                        }
                        else{
                            return false;       //if no attempts left, return false anyway
                        }
                    }
                }
                else{
                    return false;
                }
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                
                return false;
            }
        }
        function correctCredentials($username,$password){       //checks if the provided credentials match
            try {
                $sql = "SELECT * FROM user_login WHERE username = :username AND password = :password";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':username',$username);
                $stmnt->bindparam(':password',$password);
                $stmnt->execute();
    
                $result = $stmnt->fetch();
                return $result;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                
                return false;
            }
        }
        public function deleteByUserId($userId){        //deletes the user from user_login table
            try {
                $sql = "DELETE FROM user_login WHERE user_id = :userId";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':userId',$userId);
                $stmnt->execute();

                return true;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function getUserByUserName($username){       //gets the users info from both user_login and user_info
            try {
                $sql = "SELECT * FROM user_login ul INNER JOIN user_info ui on ul.user_id = ui.user_id WHERE username = :username"; 
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':username',$username);
                $stmnt->execute();
    
                $result = $stmnt->fetch();
                return $result;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function getUserAttemptsLeft($username){     //returns how many attempts a user has left
            try {
                $sql = "SELECT attempts_left FROM user_login WHERE username = :username";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':username',$username);
                $stmnt->execute();

                $result = $stmnt->fetch();
                return $result;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function updateUserAttempts($username,$attemptsLeft){        //decrements the users attempts 
            try {
                $decrement = $attemptsLeft - 1;
                $sql = "UPDATE `user_login` SET `attempts_left` = :decrement WHERE username = :username";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':username',$username);
                $stmnt->bindparam(':decrement',$decrement);
                $stmnt->execute();

                return true;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function validateUserSecurityQuestions($username,$security1,$security2){ //validates if provided security questions and username match
            try {
                $result = $this->userExist($username);
                if($result['num'] > 0){
                    $result = $this->validateSecuityQuestions($security1,$security2);
                    if(!$result){
                        return false;
                    }
                    else{
                        return true;
                    }
                }
                else{
                    return false;
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
                
        }
        function validateSecuityQuestions($security1,$security2){      //valideates for only security question. is a private function
            try {
                $sql = "SELECT*FROM user_info WHERE security_question1 = :security1 AND security_question2 = :security2";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':security1',$security1);
                $stmnt->bindparam(':security2',$security2);
                $stmnt->execute();

                $result = $stmnt->fetch();
                if(!empty($result)){
                    return true;
                }
                else{
                    return false;
                }
                
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        public function updatePass($username,$password){        //update password
            try {
                $result = $this->userExist($username);
                if($result['num'] > 0){
                    $attemptsLeft = 5;
                    $encryptedPass = md5($password.$username.$this->getSalt());
                    $sql = "UPDATE `user_login` SET `password` = :encryptedPass, `attempts_left` = :attemptsLeft WHERE username = :username";
                    $stmnt = $this->db->prepare($sql);
                    $stmnt->bindparam(':username',$username);
                    $stmnt->bindparam(':encryptedPass',$encryptedPass);
                    $stmnt->bindparam(':attemptsLeft',$attemptsLeft);
                    $stmnt->execute();

                    return true;
                }
                else{
                    return false;
                }

            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>