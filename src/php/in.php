<?php
    include_once "lib.php"; 
    $db=new db();
    $tmpnum=$_GET['tmpnum']; 
    echo $tmpnum;
    $db->act("insert into log set txt='$tmpnum' ");
    $db->finish();
?>