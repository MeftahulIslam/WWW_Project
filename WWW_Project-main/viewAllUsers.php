<?php
    $title = "View All Users";
    require_once "includes/header.php";
    require_once "db/db_config.php";
    
    if(!isset($_SESSION['id'])){
        header("location: index.php");
    }
    else{
        $id = $_SESSION['id'];
        $userPrivilege = $userNew->getUserNameById($id);
        if(!($userPrivilege['privilege'] == 1)){    //only if the user is an admin, give access
            echo "<h1 class=''>Error!</h1>";
        }
        else{
            $result = $crud->getUsers();
            $count = 1;
            if(!$result){
                echo "<h1 class=''>Error!</h1>";
            }
            else{

?>
        <table class="">
            <tr>
                <th>Sl</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>User Name</th>
                <th>Downloads</th>
            </tr>
            <?php while($r = $result->fetch(PDO::FETCH_ASSOC)){?>
            <tr>
                <td><?php echo $count++ ?></td>
                <td><?php echo $r['fullname']?></td>
                <td><?php echo $r['email']?></td>
                <td><?php echo $r['dob']?></td>
                <td><?php echo $r['username']?></td>
                <td><?php echo $r['download_count']?></td>
            </tr>
            <?php }?>
        </table>
        <button onclick="window.print();" class="sign_btn" id="print-btn">Print</button>
<?php 
            }
        }
    }
?>