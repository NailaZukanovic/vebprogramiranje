<?php
    session_start();
    $SERVER_NAME = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DATABASE = "hospital";

    $CONNECTION = mysqli_connect($SERVER_NAME, $USERNAME, $PASSWORD, $DATABASE);
?>