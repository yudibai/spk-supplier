<?php
$konek=new mysqli('127.0.0.1','root','','spk_supplier');
if ($konek->connect_errno){
    "Database Error".$konek->connect_error;
}
?>