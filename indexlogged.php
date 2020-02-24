<?php
    session_start();
    /*print_r($_SESSION);*/

    include 'init.php';
    include $tpl . 'header.php';

    /*unset($_SESSION['Username']);*/
    if (isset($_SESSION['FormErr'])) {

        $uploadErr = $_SESSION['FormErr'];
        unset( $_SESSION['FormErr']);
        unset( $_SESSION['Error']);
            ?>
                <script type="">
                    $(document).ready(function(){
                        $('#uploaderrormodal').modal('show');
                        $('#uploaderrormodal').on('hidden.bs.modal',function(){


                            $('#uploadmodal').modal('show');

                        })
                    })
                </script>
            <?php

    }


    if(isset($_SESSION['Username'])){


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

        <div class="container-fluid topbg" style="background-size: cover;">
            <div class="row">
                <div class="col-lg-2 col-md-1 col-sm-12 col-xs-12"></div>

                <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                    <div class="welcome welcome-logged">
                        <div class="welcome-heading">

                            <h2>Welcome <?php echo $_SESSION['Username'] . ' ' ?></h2>
                            <?php if($_SESSION['Permit'] == 0){ ?>
                                <h4 class="welcome-subheading">Artwork submited regularly, stay tuned.</h4>
                            <?php }else{ ?>
                                <h4 class="welcome-subheading">Master of the Art Blog.</h4>
                            <?php } ?>

                        </div>

                    </div>
                </div>

                <div class="col-lg-2 col-md-1 col-sm-12 col-xs-12"></div>

            </div>

        </div>

        <!-- transition between top background and latest -->
        <div class="container-fluid transition" id="latest">

       </div>

       <!-- latest post -->
       <div class="container-fluid" >
           <?php

               $stmt = $conn->prepare("SELECT * FROM posts ORDER BY ID DESC LIMIT 1");
               $stmt->execute();
               $rows = $stmt->fetch(PDO::FETCH_ASSOC);

            ?>
           <div class="row">

               <div class="col-lg-3">
                   <!-- empty column -->
               </div>

               <div class="col-lg-6">
                   <div class="card-decks" id="latest-post">
                       <a href="post.php?post=<?php echo $rows['ID'] ?>">
                       <div class="card">
                           <div class="card-header">
                               <h5>Latest post</h5>
                           </div>
                           <img class="card-img-top" src="<?php echo $rows['image'] ?>" alt="Card image cap">
                           <div class="card-body">
                               <h5 class="card-title"><?php echo $rows['title'] ?></h5>
                               <p class="card-text" id="illustrations"><small class="text-muted"><?php echo $rows['date'] ?></small></p>
                           </div>
                       </div>
                        </a>
                   </div>
               </div>

               <div class="col-lg-3">
                   <!-- empty column -->
               </div>

           </div>
       </div>

       <!-- transition between latest and illustrations -->
       <div class="container-fluid transition" >
           <h1><strong>Illustrations</strong></h1>
       </div>

       <!-- illustrations -->
       <div class="container-fluid" >
           <div class="card-columns">

               <?php

                   $stmt = $conn->prepare("SELECT ID FROM posts");
                   $stmt->execute();
                   $total = $stmt->rowCount();
                   /*echo $total;*/
                   $limit = 8;
                   $totalpages = ceil($total / $limit);

                   if(isset($_GET['page']) && !empty($_GET['page'])){
                       $page = $_GET['page'];
                   }else{
                       $page = 1;
                   }

                   $offset = ($page - 1) * $limit + 1;


                   $stmt = $conn->prepare("SELECT * FROM posts ORDER BY ID DESC LIMIT $limit OFFSET $offset");
                   $stmt->execute();
                   $rows = $stmt->fetchAll();

                   foreach ($rows as $row) {
               ?>
                        <a href="post.php?post=<?php echo $row['ID'] ?>">
                           <div class="card">
                               <img class="card-img-top" src="<?php echo $row['image'] ?>" alt="Card image cap">
                               <div class="card-body">
                                   <h5 class="card-title"><?php echo $row['title'] . $row['ID']?></h5>
                                   <p class="card-text"><small class="text-muted">posted : <?php echo $row['date'] ?></small></p>
                               </div>
                           </div>
                        </a>
               <?php } ?>

           </div>

       </div>


        <!-- Floating Action Button -->
        <?php if($_SESSION['Permit'] == 1){ ?>
            <button type="button" class="btn btn-info float" data-toggle="modal" data-target="#uploadmodal" data-toggle="tooltip" data-placement="top" title="new post">
                <i class="fa fa-plus"></i>
            </button>
        <?php } ?>


        <!-- Upload Error modal -->
        <div class="modal fade" id="uploaderrormodal" role="dialog" >
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploaderrorModalTitle">Please check the following:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <?php
                        if(!empty($uploadErr)){
                            foreach ($uploadErr as $error) {
                                ?>
                                    <div class="error alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                 <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Upload success modal -->
        <div class="modal fade" id="uploadsuccessmodal" role="dialog" >
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">

                    <?php
                        if(isset($_SESSION['Upfile'])){

                            ?>
                                <div class="error alert alert-success">
                                    <?php echo $_SESSION['Upfile']; ?>
                                </div>

                            <?php
                            unset($_SESSION['Upfile']);
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Upload modal -->
        <div class="modal fade" id="uploadmodal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">New Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="new-post" action="<?php echo "upload.php" ?>" method="post" enctype="multipart/form-data">
                            <div class="wrapper">
                                <div class="file-upload">
                                    <i class="fa fa-upload" style="font-size:100px;margin-right:20px;"></i>
                                    <input type="file" name="file" id="file"/>Choose a file to upload

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title"><strong>Title</strong></label>
                                <input type="text" class="form-control" required="true" id="title" name="title" placeholder="Enter illustration title">

                            </div>
                            <div class="form-group">
                                <label for="caption"><strong>Caption</strong></label>
                                <textarea rows="4" class="form-control" id="caption" name="caption" placeholder="Write a caption"></textarea>
                            </div>
                            <div class="radio">
                                <label class="radio-label">Traditional
                                    <input type="radio" name="optradio" value="0" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label class="radio-label">Digital
                                    <input type="radio" value="1" name="optradio">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-info btn-block" name="upload" value="Submit">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    <?php
    }else{
        /*when page is not loaded from log in form*/
        header('location: index.php');
        exit();
    }

     include $tpl . 'footer.php'

    /*unset($_SESSION['Username']);*/
 ?>
