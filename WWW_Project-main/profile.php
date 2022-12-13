<?php 
    $title = "Profile";
    require_once "includes/header.php";
    require_once "db/db_config.php";
    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }
    else{
        if(!isset($_GET['id'])){
            echo "<h1 class=''>Error!</h1>";
        }
        else{
            $id = $_GET['id'];
            $username = $userNew->getUserNameById($id);
            $result = $userNew->getUserByUserName($username['username']);
    
           if(!$result){
                echo "<h1 class=''>Error!</h1>";
            }     
            else{
?>	

			
    <div class="information">
        <hr>	
        <div class="image">
            <img src="<?php if(empty($result['avatar'])){echo "assets/img/2688063.png";}else{ echo $result['avatar'];}?>" style="height:500px;width:500px;">
        </div>

        <div class="profile_form">
        <h1> Profile Information </h1>
        
            <p class="input-box" >Student Name: <?php echo $result['fullname']?></p>
            <p  class="input-box" >Student Email: <?php echo $result['email']?></p>  
            <p  class="input-box" >User Name: <?php echo $result['username']?></p>  
            <p class="input-box">
                Security Questions
                <br>
                What's your favourite hobby? : <?php echo $result['security_question1']?>
                <br>
                Who's your favourite teacher? : <?php echo $result['security_question2']?>        
            </p>
            <p class="input-box" placeholder="Number of Downloads:">Number of downloads from our website: <?php echo $result['download_count']?></p>
            
            <a href="edit.php?id=<?php echo $id?>"><button class="sign_btn">Edit</button></a>
            <a onclick= "return confirm('Are you sure?')" href="delete.php?id=<?php echo $id?>"><button class="sign_btn">Remove Account</button></a>
            <?php if($result['privilege'] == 1){?>
            <a href="viewAllUsers.php"><button class="sign_btn">View All Users</button></a>
            <a href="viewAllComments.php"><button class="sign_btn">View All Comments</button></a>
            <?php }?>

            
        
    </div>

</div>
        

            
<?php 
        }
    }
}
    require_once "includes/footer.php";
?>	