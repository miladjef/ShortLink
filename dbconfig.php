<?php
try{
    $conn = new mysqli(MYSQL_HOST , MYSQL_USER , MYSQL_PASSWORD , MYSQL_DATABASE);
}catch(Exception $e){
    echo "Connection failed: " . $e->getMessage();
}
