<?php
    session_start();

    include 'init.php';
    include $tpl . 'header.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $uploadErr = array();

        $title = $_POST['title'];
        $caption = $_POST['caption'];
        $medium = $_POST['optradio'];


        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["upload"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check === false) {
                $uploadErr[] = "File is not an image.";
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadErr[] = "Sorry, file already exists.";
        }
        // Check file size
        if ($_FILES["file"]["size"] > 1000000) {
            $uploadErr[] = "Sorry, your file is too large.";
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $uploadErr[] = "only JPG, JPEG, PNG & GIF files are allowed.";
        }
        if(isset($title)){

            $filteredTitle = filter_var($title, FILTER_SANITIZE_STRING);
            /*
            if((strlen($filteredTitle) < 3) || (strlen($filteredTitle) > 20)){
                $uploadErr[] = "username must be between 3 and 20 characters";
            }
            */
        }
        if(isset($caption)){

            $filteredCaption = filter_var($caption, FILTER_SANITIZE_STRING);
            /*
            if((strlen($filteredTitle) < 3) || (strlen($filteredTitle) > 20)){
                $uploadErr[] = "username must be between 3 and 20 characters";
            }
            */
        }

        // Check if there are NO errors
        if (!empty($uploadErr)) {

            $_SESSION['FormErr'] = $uploadErr;
            $_SESSION['Error'] = "upload";

            header('Location: '.$_SERVER['HTTP_REFERER']);
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("INSERT INTO
                                            posts (title, description, date, image,medium)
                                        VALUES
                                            (?,?, now(),?,?)");
                $stmt->execute([$title, $caption, $target_file,$medium]);
                $_SESSION['Upfile'] = "your file ". basename( $_FILES["file"]["name"]). " uploaded successfuly.";

                header('Location: '.$_SERVER['HTTP_REFERER']);
                exit();

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
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
