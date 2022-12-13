<?php
    $title = "View All Comments";
    require_once "includes/header.php";
    require_once "db/db_config.php";
    if(!isset($_SESSION['id'])){    //if the user is not a valid session holder, ridirect
        header("location: index.php");
    }
    else{
        $id = $_SESSION['id'];
        $userPrivilege = $userNew->getUserNameById($id);
        if(!($userPrivilege['privilege'] == 1)){        //only if the user is an admin, display the page
            echo "<h1 class=''>Error!</h1>";
        }
        else{
            $result = $crud->getAllComments();
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
                <th>Message</th>
            </tr>
            <?php while($r = $result->fetch(PDO::FETCH_ASSOC)){?>
            <tr>
                <td><?php echo $count++ ?></td>
                <td><?php echo $r['fullname']?></td>
                <td><?php echo $r['email']?></td>
                <td><?php 
                    $file = "messages/".$r['fullname'].$r['time'].'.txt';
                    $readFile = fopen($file, "r") or die("Unable to open file!");   //read the previously saved txt file
                    echo fread($readFile,filesize($file));
                    fclose($readFile);
                ?></td>
            </tr>
            <?php }?>
        </table>
        <button onclick="window.print();" class="sign_btn" id="print-btn">Print</button>
<?php 
            }
        }
    }
?>