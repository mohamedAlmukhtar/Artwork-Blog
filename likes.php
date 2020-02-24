<?php

    session_start();

    include 'init.php';

    if(isset($_SESSION['Username'])){

        $userID = $_SESSION['UserID'];
        $id = $_SESSION['post'];

        $stmt = $conn->prepare("SELECT likes FROM posts WHERE ID = ?");
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $likes = $row['likes'];


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['like'] == 1){
                $stmt = $conn->prepare("INSERT INTO
                                            likes (userID, postID)
                                        VALUES
                                            (?,?)");
                $stmt->execute([$userID,$id]);

                $likes = $likes + 1;

                $stmt = $conn->prepare("UPDATE posts SET likes = ? WHERE ID = ?");
                $stmt->execute(array($likes,$id));
                $_SESSION['liked'] = true;

                $response = array(
                    'icon' => 'fas fa-heart fa-3x',
                    'total'   => $likes
                );

                echo(json_encode($response));

            }else{
                $stmt = $conn->prepare("DELETE FROM likes WHERE userID = ? AND postID = ?");
                $stmt->execute(array($userID,$id));

                $likes = $likes - 1;

                $stmt = $conn->prepare("UPDATE posts SET likes = ? WHERE ID = ?");
                $stmt->execute(array($likes,$id));
                $_SESSION['liked'] = false;

                $response = array(
                    'icon' => 'far fa-heart fa-3x',
                    'total'   => $likes
                );

                echo(json_encode($response));

            }

        }
    }else {
        unset($_GET['liked']);
    }
 ?>
