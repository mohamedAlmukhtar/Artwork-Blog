<?php

    $servername = "localhost";
    /*$dsn ='mysql:host=localhost;dbname=artBlogger';//Data source Name*/
    $username ='root';// user to connect
    $password ='';//

    /*
    $options =array(
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET  NAMES utf8',///options
    );
    */
    try {
        $conn = new PDO("mysql:host=$servername;dbname=artBlogger", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /* $query = INSRET  INTO */
        //echo "Connected Succesfully";
        /*$con->exec($query);k*/
    }
    catch(PDOException $e){

        echo "Connection Failed" . $e->getMessage();

    }

 ?>
