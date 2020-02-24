<?php


    session_start();


    include 'init.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $iscomment = true;
        $comment = $_POST['comment'];
        $commenter = (isset($_SESSION['UserID'])) ? $_SESSION['UserID'] : 0;

        if(!empty($comment)){

            $filteredComment = filter_var($comment, FILTER_SANITIZE_STRING);

            $stmt = $conn->prepare("INSERT INTO
                                        comments (text, date, userID, postID)
                                    VALUES
                                        (?, now(), ?, ?)");
            $stmt->execute([$comment, $commenter, $_SESSION['post']]);

            $stmt = $conn->prepare("SELECT * FROM comments WHERE text = ?");
            $stmt->execute([$comment]);
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($count > 0){

                    if($row['userID'] != 0){
                        $stmt =  $conn->prepare("SELECT username FROM users WHERE userID = ?");
                        $stmt->execute([$row['userID']]);
                        $rows2 = $stmt->fetch(PDO::FETCH_ASSOC);
                        $commenter = $rows2['username'];
                    }else{
                        $commenter = 'Anonymous';
                    }


                    ?>

                        <div class=" comment-container" data-aos="fade-in">
                            <div class="comment">
                                <span class="comment-small"><img src="images/img_avatar.png" alt="avatar"></span>
                                <small class="text-muted">Posted by <a><?php echo $commenter; ?></a> on <?php echo $row['date']; ?></small>

                            </div>

                            <p class="comment-text"><?php echo $row['text']; ?></p>

                        </div>
                    <?php


        }else{

        }


    }

}

 ?>
