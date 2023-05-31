<?php
class db {
    var $conn; 
    function db() {
        global $config;
        $this->conn = mysqli_connect($config["db_host"], $config["db_user"], $config["db_password"], $config["db_name"]) or die (mysqli_connect_error());
    }
    function finish() {
        mysqli_close($this->conn) or die (mysqli_error($this->conn)); 
    }
    function act($q) {
        mysqli_query($this->conn, $q) or die (mysqli_error($this->conn)); 
    }
    function get($q, &$rs, &$rn) { 
        $rs=NULL;
        $rn=0;
        $rs1 = mysqli_query($this->conn, $q) or die (mysqli_error($this->conn)); 
        $rn = mysqli_num_rows($rs1);
        while ($row=mysqli_fetch_array($rs1)) 
        $rs[] = $row;
    } 
}
?>