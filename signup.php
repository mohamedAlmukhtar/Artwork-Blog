<?php
    session_start();

    include 'init.php';
    include $tpl . 'header.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        /*subscribe form code*/
        $formErr = array();
        $errork = array();

        $userERR = true;
        $emailERR = true;
        $passERR = true;

        $username = $_POST['user'];
        $email = $_POST['email'];
        $password1 = $_POST['pass1'];
        $password2 = $_POST['pass2'];

        if(isset($username)){

            $filteredUser = filter_var($username, FILTER_SANITIZE_STRING);

            if((strlen($filteredUser) < 3) || (strlen($filteredUser) > 20)){
                $formErr[] = "username must be between 3 and 20 characters";
                array_push($errork,1);
            }

        }

        if(isset($password1) && isset($password2)){

            if(empty($password1)){
                $formErr[] = "password can\'t be empty";
                array_push($errork,2);
            }
            if(sha1($password1) !== sha1($password2)){
                $formErr[] = "password fields must match";
                array_push($errork,2);
            }
        }

        if(isset($email)){

            $filteredEmail = filter_var($email, FILTER_SANITIZE_EMAIL);

            if(filter_var($filteredEmail, FILTER_VALIDATE_EMAIL) != true){
                $formErr[] = "please enter a valid email";
                array_push($errork,3);
            }
        }

        if(empty($formErr)){

            $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
            $stmt->execute(array($username));
            $row1 = $stmt->rowCount();

            $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->execute(array($email));
            $row2 = $stmt->rowCount();

            if($row2 > 0){
                $formErr[] = "This email is already registered";
                array_push($errork,3);
            }if ($row1 > 0) {
                $formErr[] = "Username is already taken";
                array_push($errork,1);
            }if(empty($formErr)) {
                $stmt = $conn->prepare("INSERT INTO
                                            users (username, password, email)
                                        VALUES
                                            (?,?,?)");
                $stmt->execute([$username, SHA1($password1), $email]);
                $_SESSION['Username'] = $username;
                $stmt = $conn->prepare("SELECT userID FROM users WHERE username = ?");
                $stmt->execute(array($username));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['UserID'] = $rows['userID'];
                $_SESSION['Permit'] = 0;

                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();
            }

        }if(!empty($formErr)) {

            $_SESSION['FormErr'] = $formErr;
            $_SESSION['Error'] = "sub";
            $_SESSION['Errork'] = $errork;

            header('Location: '.$_SERVER['HTTP_REFERER']);

        }

    }else {
        ?>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="notfound">
                            <h1 >404</h4>
                            <h3>Page not found</h3>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }


 ?>
