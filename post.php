<?php
    session_start();
    /*print_r($_SESSION);*/

    include 'init.php';
    include $tpl . 'header.php';


    $iscomment = false;


    if(isset($_GET['post'])){

        $id = $_GET['post'];
        $_SESSION['post'] = $id;
        $stmt = $conn->prepare("SELECT * FROM posts WHERE ID = ?");
        $stmt->execute(array($id));
        $count = $stmt->rowCount();
        if($count>0){
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            $title = $rows['title'];
            $caption = $rows['description'];
            $date = $rows['date'];
            $image = $rows['image'];
            $medium = $rows['medium'];
            $likes = $rows['likes'];

            if(isset($_SESSION['Username'])){
                $userID = $_SESSION['UserID'];
                $stmt = $conn->prepare("SELECT ID FROM likes WHERE userID = ? AND postID = ?");
                $stmt->execute(array($userID, $id));
                $count = $stmt->rowCount();
                if($count>0){
                    $_SESSION['liked'] = true;
                }else{
                    $_SESSION['liked'] = false;
                }

            }

            /*if(isset($_SESSION['Username'])){
                if(isset($_GET['liked'])){
                    if($_GET['liked'] == 1){
                        $stmt = $conn->prepare("INSERT INTO
                                                    likes (userID, postID)
                                                VALUES
                                                    (?,?)");
                        $stmt->execute([$userID,$id]);
                        $rows['likes'] = $rows['likes'] + 1;
                        $likes = $rows['likes'];
                        $stmt = $conn->prepare("UPDATE posts SET likes = ? WHERE ID = ?");
                        $stmt->execute(array($likes,$id));
                        $_GET['liked'] = 0;
                        unset($_GET['liked']);
                        $liked = true;

                    }else{
                        $stmt = $conn->prepare("DELETE FROM likes WHERE userID = ? AND postID = ?");
                        $stmt->execute(array($userID,$id));
                        $rows['likes'] = $rows['likes'] - 1;
                        $likes = $rows['likes'];
                        $stmt = $conn->prepare("UPDATE posts SET likes = ? WHERE ID = ?");
                        $stmt->execute(array($likes,$id));
                        $liked = false;
                    }

                }
            }else {
                unset($_GET['liked']);
            }*/


        }else{
            if(isset($_SERVER['HTTP_REFERER'])) {
                 header('Location: '.$_SERVER['HTTP_REFERER']);
            } else {
                header('Location: index.php');
            }
        }



    }else{
        if(isset($_SERVER['HTTP_REFERER'])) {
             header('Location: '.$_SERVER['HTTP_REFERER']);
        } else {
            header('Location: index.php');
        }
    }

    /*
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $iscomment = true;
        $comment = $_POST['comment'];
        $commenter = (isset($_SESSION['UserID'])) ? $userID : 0;

        if(!empty($comment)){

            $filteredComment = filter_var($comment, FILTER_SANITIZE_STRING);

            $stmt = $conn->prepare("INSERT INTO
                                        comments (text, date, userID, postID)
                                    VALUES
                                        (?, now(), ?, ?)");
            $stmt->execute([$comment, $commenter, $id]);
            $_SESSION['comment'] = 1;

        }else{

        }

    }*/

    //Handling form Errors
    include $tpl . 'formHandling.php';

    if(isset($_SESSION['Upfile'])){
            ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#uploadsuccessmodal').modal('show');
                    })
                </script>
            <?php

    }


?>

    <!-- Navigation -->
    <?php include $tpl . 'nav.php'; ?>

    <div class="container-fluid post-image-container" id="nel">
        <div class="row">
            <div class="col-lg-2">
                <!--<h3 class="" id="fixed" style="position:fixed;top:300px;">drawing no. 5 drawing no. 5 drawing no. 5</h3>-->
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 post-image">
                <div class="card">
                    <a href="<?php echo $image ?>" target="_blank" data-size="1600x1067">
                        <img class="card-img-top" src="<?php echo $image ?>" alt="Card image cap">
                    </a>
                </div>
            </div>

            <div class="col-lg-2">

            </div>
        </div>
    </div>

    <form class="like-form" name="like-form" action="" method="post">
        <input type="hidden" id="like-post" class="like-post" name="like-post" value="">
        <input type="submit" style="display:none;">
    </form>

    <div class="container-fluid post-title">
        <h3 class="" ><?php echo $title ?></h3>
    </div>
    <div class="container-fluid post-info">
        <?php $logged = false; if(isset($_SESSION['Username'])){$logged = true;} ?>
        <div class="row">

            <?php if($logged){ ?>
                <div class="col-lg-4  heart-container">
                        <?php
                         if($_SESSION['liked']){
                            ?>
                                <div id="like-wrapper">
                                    <a href="javascript:void(0)" class="like-button bloom" var="0" ><i id="like-icon" class="fas fa-heart fa-3x"></i></a>
                                </div>

                            <?php
                        } else{
                            ?>
                                <div id="like-wrapper">
                                    <a href="javascript:void(0)" class="like-button" var="1" ><i  id="like-icon" class="far fa-heart fa-3x"></i></a>
                                </div>

                            <?php
                        }?>
                </div>
            <?php }else {
                ?>
                    <div class="col-lg-4 heart-container">
                        <a href="" data-toggle="modal" data-target="#signinmodal" ><i class="far fa-heart fa-3x"></i></a>
                    </div>
                <?php
            } ?>
            <div class="col-lg-8 post-caption">
                <p class="card-text"><small class="text-muted">posted : <strong><?php echo $date ?></strong> <span><i style="color:red;margin-right:5px;" class="fas fa-heart fa-sm"></i><span id="total-likes" style="margin:0;"><?php echo $rows['likes']; ?></span></span></small></p>
                <p>
                    <?php echo $caption ?>
                </p>

            </div>

        </div>

    </div>

    <div class="container comments" id="comments">

        <div class=" comment-container" style="border:none;">
            <div class="comment">
                <form id="comment-form" onsubmit="return post()" action=""  method="post">
                    <div class="form-group">
                        <textarea id="comment" name="comment" required class="form-control"  rows="4" placeholder="Write a comment"></textarea>
                    </div>
                    <input id="save" type="submit" class="btn color-primary" name="comment-submit" value="Submit">
                </form>

            </div>

        </div>

        <div id="all-comments">
            <?php

                $stmt = $conn->prepare("SELECT * FROM comments WHERE postID = ? ORDER BY ID DESC");
                $stmt->execute([$id]);
                $count = $stmt->rowCount();
                $rows = $stmt->fetchAll();

                if($count > 0){
                    foreach ($rows as $row) {

                        if($row['userID'] != 0){
                            $stmt =  $conn->prepare("SELECT username FROM users WHERE userID = ?");
                            $stmt->execute([$row['userID']]);
                            $rows2 = $stmt->fetch(PDO::FETCH_ASSOC);
                            $commenter = $rows2['username'];
                        }else{
                            $commenter = 'Anonymous';
                        }


                        ?>

                            <div class=" comment-container">
                                <div class="comment">
                                    <span class="comment-small"><img src="images/img_avatar.png" alt="avatar"></span>
                                    <small class="text-muted">Posted by <a><?php echo $commenter; ?></a> on <?php echo $row['date']; ?></small>

                                </div>

                                <p class="comment-text"><?php echo $row['text']; ?></p>

                            </div>
                        <?php
                    }
                }else {
                    ?>
                        <div class="no-comments comment-container" style="text-align:center;">
                            <h3>Be the first to comment on this post</h3>

                        </div>

                    <?php

                }
             ?>
        </div>


    </div>

    <!-- PAGE MODALS AND FAB -->
    <?php include $tpl . 'modals.php' ?>

<?php include $tpl . 'footer.php' ?>
