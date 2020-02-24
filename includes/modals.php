
    <!-- Floating Action Button -->
    <?php if(isset($_SESSION['Username'])){ ?>
        <?php if($_SESSION['Permit'] == 1){ ?>
            <button type="button" class="btn btn-info float" data-toggle="modal" data-target="#uploadmodal" data-toggle="tooltip" data-placement="top" title="new post">
                <i class="fa fa-plus"></i>
            </button>
        <?php } ?>
    <?php } ?>

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
                    <form class="new-post" action="<?php echo "upload.php"; ?>" method="post" enctype="multipart/form-data">
                        <div class="wrapper">
                            <div class="file-upload">
                                <i class="fa fa-upload" style="font-size:100px;margin-right:20px;"></i>
                                <input type="file" name="file" id="file"/>Choose a file to upload <br>drag file or click here

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
                            <input type="submit" class="btn color-primary btn-block" name="upload" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Form Error modal -->
    <div class="modal fade" id="errormodal" role="dialog" >
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalTitle">Please check the following:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <?php
                    if(!empty($formErr)){
                        foreach ($formErr as $error) {
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

    <!-- Sign in Modal -->
   <div class="modal fade" id="signinmodal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="ModalTitle">Sign in</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>

                   <form class="login" action="<?php echo "signin.php" ?>" method="post">

                       <div class="form-group">
                           <label for="user"><strong>Username</strong></label>
                           <input type="text" class="form-control" required="true" id="user" name="user" aria-describedby="emailHelp" placeholder="Enter username">

                       </div>
                       <div class="form-group">
                           <label for="password"><strong>Password</strong></label>
                           <input type="password" class="form-control" required="true" id="password" name="pass" placeholder="Password">
                       </div>
                       <!--<i class="fas fa-sign-in-alt icon"></i>-->
                       <input type="submit" class="btn color-primary btn-block submit" name="sign" value="sign in">
                   </form>


           </div>
       </div>
   </div>

     <!-- Subscribe Modal -->
    <div class="modal fade" id="subscribemodal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTitle">Subscribe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" action="<?php echo "signup.php" ?>" method="post">
                        <div class="form-group">
                            <label for="username"><strong>Username</strong></label>
                            <input type="text" class="form-control" required="true" id="subscribe-username" name="user" aria-describedby="emailHelp" placeholder="Enter username 3 - 20 characters">

                        </div>
                        <div class="form-group">
                            <label for="email"><strong>Email address</strong></label>
                            <input type="email" class="form-control" required="true" id="subscribe-email" name="email" aria-describedby="emailHelp" placeholder="Enter a valid email">

                        </div>
                        <div class="form-group">
                            <label for="password1"><strong>Password</strong></label>
                            <input type="password" class="form-control" required="true" id="password1" name="pass1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password2"><strong>ReEnter Password</strong></label>
                            <input type="password" class="form-control" required="true" id="password2" name="pass2" placeholder="Enter same password">
                        </div>

                        <div class="modal-footer">
                            <input type="submit" class="btn color-primary btn-block" name="sub" value="Submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
