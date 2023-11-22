<?php
    require 'config/connectiontable.php';

    if(isset($_GET["Book_ID"])){
        $id = $_GET["Book_ID"];

        $sql = "DELETE from library where Book_ID=$id";
        $result = mysqli_query($data, $sql);
        if($result){
            header("Location: homeadmin.php?error=none");
        }
        else{
            header("Location: homeadmin.php?error=failed");
        }
    }
?>


