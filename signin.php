<?php
    session_start();

    include 'init.php';
    include $tpl . 'header.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['sign'])){
            /*sign in form code*/
            $formErr = array();

            $username = $_POST['user'];
            $password = $_POST['pass'];
            $hashedpass = sha1($password);

            $stmt = $conn->prepare("SELECT userID, username, password, permit FROM users WHERE username = ? AND password = ?");
            $stmt->execute(array($username,$hashedpass));
            $count = $stmt->rowCount();

            if($count > 0){
                $_SESSION['Username'] = $username;
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['UserID'] = $rows['userID'];
                $_SESSION['Permit'] = $rows['permit'];

                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();

            }else{
                $formErr[] = "Incorrect username or password, Please try again";
                $_SESSION['FormErr'] = $formErr;
                $_SESSION['Error'] = "sign";

                header('Location: '.$_SERVER['HTTP_REFERER']);
            }

        }
    }else{
        ?>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="notfound">
                            <h1 data-aos="flip-right">404</h4>
                            <h3 data-aos="fade-up">Page not found</h3>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }

 ?>
