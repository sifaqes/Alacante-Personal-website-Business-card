<?php 
    $hostname = 'localhost';
    $database = 'matelaslux';
    $username = 'root';
    $password = '';
    $database = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8",$username,$password);
    ?>