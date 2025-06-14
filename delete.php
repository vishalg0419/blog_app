<?php
include 'db.php';

if(!$_SESSION["username"]){
header("Location:login.php");
}

$id = isset($_GET["id"])?$_GET["id"]:'';
$sql = $conn->prepare("delete from blogs where id=?");
echo"$id";
$sql->bind_param("i",$id);
if($sql->execute()){
    header("Location:dashboard.php");
}else{
    header("Location:dashboard.php");
}


?>