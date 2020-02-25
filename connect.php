<?php

    $servername = "localhost";
    /*$dsn ='mysql:host=localhost;dbname=artBlogger';//Data source Name*/
    $username ='id12705941_mohamedalmukhtar';// user to connect
    $password ='%pP1MB$UrsN!1O^&Yh^%';//
    $database = "id12705941_artblogger";

    /*
    $options =array(
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET  NAMES utf8',///options
    );
    */
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /* $query = INSRET  INTO */
        //echo "Connected Succesfully";
        /*$con->exec($query);k*/
    }
    catch(PDOException $e){

        echo "Connection Failed" . $e->getMessage();

    }

 ?>
