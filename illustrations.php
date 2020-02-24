<?php
    session_start();
    /*print_r($_SESSION);*/
    include 'init.php';
    include $tpl . 'header.php';

    //Handling form Errors
    include $tpl . 'formHandling.php';

?>

<!-- Navigation -->
<?php include $tpl . 'nav.php'; ?>

<!-- transition between latest and illustrations -->
<div class="container-fluid transition" style="margin-top:30px;">

</div>

<!-- illustrations -->
<div class="container-fluid" >

    <div class="card-columns">

        <?php

            if(isset($_GET['medium']) && $_GET['medium']=="digital"){

                $stmt = $conn->prepare("SELECT ID FROM posts WHERE medium = ?");
                $stmt->execute(array(1));
                $total = $stmt->rowCount();
                /*echo $total;*/
                $limit = 10;
                $total_no_of_pages = ceil($total / $limit);

                if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page']<=$total_no_of_pages){
                    $page_no = $_GET['page'];
                }else{
                    $page_no = 1;
                }

                $offset = ($page_no - 1) * $limit;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";
                $second_last = $total_no_of_pages - 1;


                $stmt = $conn->prepare("SELECT * FROM posts WHERE medium = ? ORDER BY ID DESC LIMIT $limit OFFSET $offset");
                $stmt->execute(array(1));
                $rows = $stmt->fetchAll();

            }elseif (isset($_GET['medium']) && $_GET['medium']=="traditional") {

                $stmt = $conn->prepare("SELECT ID FROM posts WHERE medium = ?");
                $stmt->execute(array(0));
                $total = $stmt->rowCount();
                /*echo $total;*/
                $limit = 10;
                $total_no_of_pages = ceil($total / $limit);

                if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page']<=$total_no_of_pages){
                    $page_no = $_GET['page'];
                }else{
                    $page_no = 1;
                }

                $offset = ($page_no - 1) * $limit;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";
                $second_last = $total_no_of_pages - 1;

                $stmt = $conn->prepare("SELECT * FROM posts WHERE medium = ? ORDER BY ID DESC LIMIT $limit OFFSET $offset");
                $stmt->execute(array(0));
                $rows = $stmt->fetchAll();

            }else {

                $stmt = $conn->prepare("SELECT ID FROM posts");
                $stmt->execute();
                $total = $stmt->rowCount();
                /*echo $total;*/
                $limit = 20;
                $total_no_of_pages = ceil($total / $limit);

                if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page']<=$total_no_of_pages){
                    $page_no = $_GET['page'];
                }else{
                    $page_no = 1;
                }

                $offset = ($page_no - 1) * $limit;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";
                $second_last = $total_no_of_pages - 1;

                $stmt = $conn->prepare("SELECT * FROM posts ORDER BY ID DESC LIMIT $limit OFFSET $offset");
                $stmt->execute();
                $rows = $stmt->fetchAll();

            }

            foreach ($rows as $row) {
                if($row['medium']==0){
                    $medium = " traditional-tag";
                    $medium_text = "TRA";
                }else{
                    $medium = " digital-tag";
                    $medium_text = "DIG";
                }
        ?>
                <a href="post.php?post=<?php echo $row['ID'] ?>">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $row['image'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="card-title"><?php echo $row['title'] ?></h6>
                            <p class="card-text">
                                <small class="text-muted"><?php echo $row['date'] ?>
                                    <span class="<?php echo "card-tag " . $medium; ?>"><?php echo $medium_text; ?></span>

                                    <span class="heart-tag" style="color:black;"><i class="fas fa-heart fa-1x"></i> <?php echo $row['likes'] ?></span>
                                </small>
                            </p>
                        </div>
                    </div>
                </a>

        <?php } ?>

    </div>

</div>

<!-- PAGINATION -->
<div class="container-fluid transition" id="page-links">
    <nav aria-label="Page navigation example" >
        <ul class="pagination pagination-lg justify-content-center">

            <!-- PREVIOUS PAGE -->
            <li class="page-item <?php if($page_no <= 1){ echo "disabled"; } ?>" >
                <a class="page-link" <?php if($page_no > 1){
                    echo "href='?page=$previous_page'";
                } ?>>Previous</a>
            </li>
            <!-- PREVIOUS PAGE -->

            <?php if ($total_no_of_pages <= 10){
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                if ($counter == $page_no) {
                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        }else{
                    echo "<li class='page-item'><a class='page-link' href='?page=$counter'>$counter</a></li>";
                            }
                    }
            }elseif ($total_no_of_pages > 10){
                if($page_no <= 4) {
                 for ($counter = 1; $counter < 8; $counter++){
                    if ($counter == $page_no) {
                       echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                    }else{
                        echo "<li class='page-item'><a class='page-link' href='?page=$counter'>$counter</a></li>";
                    }
                }
                echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page=$second_last'>$second_last</a></li>";
                echo "<li class='page-item'><a class='page-link' href='?page=$total_no_of_pages'>$total_no_of_pages</a></li>";

                }elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                    echo "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page=2'>2</a></li>";
                    echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                    for (
                         $counter = $page_no - $adjacents;
                         $counter <= $page_no + $adjacents;
                         $counter++
                         ) {
                             if ($counter == $page_no) {
                                echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='?page=$counter'>$counter</a></li>";
                        }
                    }
                    echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page=$second_last'>$second_last</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page=$total_no_of_pages'>$total_no_of_pages</a></li>";
                }else {
                    echo "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li>";
                    echo "<li class='page-item'><a class='page-link' href='?page=2'>2</a></li>";
                    echo "<li class='page-item disabled'><a class='page-link'>...</a></li>";
                    for (
                         $counter = $total_no_of_pages - 6;
                         $counter <= $total_no_of_pages;
                         $counter++
                         ) {
                            if ($counter == $page_no) {
                                   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";
                            }else{
                                echo "<li class='page-item'><a class='page-link' href='?page=$counter'>$counter</a></li>";
                            }
                    }
                }
            }


             ?>

            <!-- NEXT PAGE -->
            <li class="page-item  <?php if($page_no >= $total_no_of_pages){
                echo "disabled";
            } ?>">
                <a class="page-link" <?php if($page_no < $total_no_of_pages) {
                    echo "href='?page=$next_page'";
                } ?>>Next</a>
            </li>
            <!-- NEXT PAGE -->

            <!-- lAST PAGE -->
            <?php if($page_no < $total_no_of_pages){
                echo "<li class='page-item'><a class='page-link' href='?page=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
            } ?>
            <!-- lAST PAGE -->

            <!--
            <li class="page-item"><a class="page-link" href="?page=">Previous</a></li>
            <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
            <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
            -->
        </ul>
    </nav>
</div>

<!-- PAGE MODALS AND FAB -->
<?php include $tpl . 'modals.php' ?>


<?php include $tpl . 'footer.php' ?>
