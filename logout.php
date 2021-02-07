<?php
session_start();
if(session_destroy()){
    header(header("location:index.php"));
}
?>