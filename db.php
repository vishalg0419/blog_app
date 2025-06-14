<?php
session_start();

$conn = new mysqli("localhost","root","","blogapp");
if(!$conn){
    echo "<h3>Site Is Down COnnection Could not be established</h3>";
}
?>