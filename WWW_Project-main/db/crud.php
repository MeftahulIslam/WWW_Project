<?php
    //Create,Read,Update,Delete functions for user_info
    class crud{
        private $db;

        function __construct($db_config)
        {
            $this->db = $db_config;
        }

        public function insertClientRequest($fullname, $email, $message,$time){ //insert messages from contacts
            try {
                $sql = "INSERT INTO client_requests(fullname,email,message,time) VALUE(:fullname,:email,:message,:time)";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':fullname',$fullname);   //bind param for safety from sql injection
                $stmnt->bindparam(':email',$email);
                $stmnt->bindparam(':message',$message);
                $stmnt->bindparam(':time',$time);       //save each file according to unique name by time
                $stmnt->execute();

                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();              // getting error message for the purpose of debugging
                
                return false;
            }
        }                                                                       //insert userinfo in user_info table
        public function insertUserInfo($fullname, $email, $userId, $dob, $security1, $security2,$avatar){  
            try {
                $downloads = 0;
                $sql = "INSERT INTO user_info(fullname,email,user_Id,security_question1,security_question2,dob,avatar,download_count) VALUE(:fullname,:email,:userId,:security1,:security2,:dob,:avatar,:downloads)";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':fullname',$fullname);
                $stmnt->bindparam(':email',$email);
                $stmnt->bindparam(':userId',$userId);
                $stmnt->bindparam(':dob',$dob);
                $stmnt->bindparam(':security1',$security1);
                $stmnt->bindparam(':security2',$security2);
                $stmnt->bindparam(':avatar',$avatar);
                $stmnt->bindparam(':downloads',$downloads);
                $stmnt->execute();

                return true;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                
                return false;
            }
        }
                                                                                                //edit info
        public function editUserInfo($fullname, $email, $dob, $security1, $security2, $userId){
            try {
                $sql = "UPDATE `user_info` SET `fullname`=:fullname,`email`=:email,`security_question1`=:security1,`security_question2`=:security2,`dob`=:dob WHERE user_id = :userId";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':userId',$userId);
                $stmnt->bindparam(':fullname',$fullname);
                $stmnt->bindparam(':email',$email);
                $stmnt->bindparam(':dob',$dob);
                $stmnt->bindparam(':security1',$security1);
                $stmnt->bindparam(':security2',$security2);
                $stmnt->execute();

                return true;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                
                return false;
            }
        }                                                                           //a function for handling the image format
        public function editUserInfoAvatar($fullname, $email, $dob, $security1, $security2, $userId,$destination){
            try {
                $sql = "UPDATE `user_info` SET `fullname`=:fullname,`email`=:email,`security_question1`=:security1,`security_question2`=:security2,`dob`=:dob,`avatar`=:destination WHERE user_id = :userId";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam(':userId',$userId);
                $stmnt->bindparam(':fullname',$fullname);
                $stmnt->bindparam(':email',$email);
                $stmnt->bindparam(':dob',$dob);
                $stmnt->bindparam(':security1',$security1);
                $stmnt->bindparam(':security2',$security2);
                $stmnt->bindparam(':destination',$destination);
                $stmnt->execute();

                return true;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                
                return false;
            }
        }
        public function deleteUserById($userId){    //delete the user from table user_info
            try {
                $sql = "DELETE FROM user_info WHERE user_id = :userId";
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
        public function getUsers(){         //get all the users
            try {
                $sql = "SELECT * FROM `user_info` ui inner join user_login  ul on ui.user_id = ul.user_id";
                $result = $this->db->query($sql);
                return $result;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }
        public function getAllComments(){       //get all comments
            try {
                $sql = "SELECT * FROM client_requests";
                $result = $this->db->query($sql);
                return $result;
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        }
        public function incrementDownloadsCount($userId){       //when user downloads a file increment the count
            try{
                $sql = "UPDATE user_info SET `download_count`= `download_count`+1 WHERE user_id = :userId";
                $stmnt = $this->db->prepare($sql);
                $stmnt->bindparam('userId',$userId);
                $stmnt->execute();

                return true;
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>