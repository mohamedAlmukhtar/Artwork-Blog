<?php
    session_start();
    /*print_r($_SESSION);*/

    include 'init.php';
    include $tpl . 'header.php';


    if(isset($_GET['page'])){
        ?>
            <script>
                $(document).ready(function(){
                    var divPosition = $('#illustrations').offset();
                    $('html, body').animate({scrollTop: divPosition.top}, 2);
                })
            </script>
        <?php
    }

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


     <!-- top background-->
     <div class="container-fluid topbg">

         <div class="row">

             <div class="col-lg-2 col-md-1 col-sm-12 col-xs-12"></div>

             <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                 <div class="welcome welcome-logged">
                     <div class="welcome-heading" data-aos="fade-in">

                         <h2>ARTWORK BLOG</h2>

                     </div>

                     <a href="illustrations.php?page=1"><button type="button" data-aos="fade-up" class="btn btn-danger welcome-btn" name="button">VIEW ARTWORK</button></a>

                 </div>
             </div>

             <div class="col-lg-2 col-md-1 col-sm-12 col-xs-12"></div>

            <!-- old topBG
            <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">

                <div class="welcome">
                    <div class="welcome-heading">

                        <h2><strong>This is an Art Blog</strong></h2>
                        <h4 class="welcome-subheading">Artwork submited regularly, subscribe to get notified.</h4>
                        <button type="button" class="btn btn-info submit" id="subscribe" name="button" data-toggle="modal" data-target="#subscribemodal" data-toggle="tooltip" data-placement="top" title="Register by creating account"><i class="fas fa-user-plus icon"></i>Subscribe</button>
                    </div>

                </div>

            </div>

            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12" id="login-container">

                <form class="login" action="<//?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <h4>Sign in</h4>
                    <div class="form-group">
                        <label for="user"><strong>Username</strong></label>
                        <input type="text" class="form-control" required="true" id="user" name="user" aria-describedby="emailHelp" placeholder="Enter username">

                    </div>
                    <div class="form-group">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control" required="true" id="password" name="pass" placeholder="Password">
                    </div>-->
                    <!--<i class="fas fa-sign-in-alt icon"></i>
                    <input type="submit" class="btn btn-info btn-block submit" name="sign" value="sign in">
                </form>

            </div>
            -->
        </div>

     </div>

     <!--
     <div class="container-two">
      <div class="section-one">
        <div class="content-one">
        </div>
      </div>
      <div class="section-two">
        <div class="content-one">
        </div>
      </div>
    </div>
    -->

    <div class="parent container-fluid">

        <a href="illustrations.php?medium=digital">
            <div class="one">
                <div id="digital"><span>Digital</span></div>
            </div>
        </a>
        <a href="illustrations.php?medium=traditional">
            <div class="two">
                <div id="traditional"><span>Traditional</span></div>
            </div>
        </a>

    </div>


     <!-- transition between top background and latest -->
    <div class="container-fluid transition" id="latest">
    </div>

    <!-- latest post -->
    <div class="container-fluid third-container" >
        <?php

            $stmt = $conn->prepare("SELECT * FROM posts ORDER BY ID DESC LIMIT 1");
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);

         ?>
        <div class="row">

            <div class="col-lg-6">
                <div class="card-decks" data-aos="fade-right" id="latest-post">
                    <a href="post.php?post=<?php echo $rows['ID'] ?>">
                    <div class="card">
                        <div class="card-header">
                            <h5>Latest post</h5>
                        </div>
                        <img class="card-img-top" src="<?php echo $rows['image'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $rows['title'] ?></h5>
                            <p class="card-text" id="illustrations"><small class="text-muted"><?php echo $rows['date'] ?></small></p>
                            <span class="heart-tag" style="color:black;right:20px;"><i class="fas fa-heart fa-1x"></i> <?php echo $rows['likes'] ?></span>

                        </div>
                    </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 third-section2">

                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-aos="fade-left">

                  <div class="carousel-inner" style="color:black;">
                      <?php if(!isset($_SESSION['Username'])){ ?>
                    <div class="carousel-item active">

                            <div class="subscribe" >
                                <div class="subscribe-heading">
                                    <div class="subscribe-inner">
                                        <h2><strong>Subscribe!</strong></h2>
                                        <h4 class="subscribe-subheading">Artwork submited regularly, subscribe to get notified.</h4>
                                        <button type="button" class="btn btn-info submit" id="subscribe" name="button" data-toggle="modal" data-target="#subscribemodal" data-toggle="tooltip" data-placement="top" title="Register by creating account"><i class="fas fa-user-plus icon"></i>Subscribe</button>

                                    </div>
                                </div>

                            </div>

                    </div>
                    <?php } ?>
                    <div class="carousel-item <?php if(isset($_SESSION['Username'])){ echo "active"; }?>">
                        <div class="gallery">
                            <div class="column">


                              <img src="images/maxresdefault.jpg" alt="">
                               <img src="images/i7L82bM.jpg" alt="">

                               <img src="images/watchtower-clouds-forest-mountain-landscape-digital-art-20.jpg" alt="">
                               <img src="images/1_lTGwPZY2ut9aIlSqnL1Drw.png" alt="">

                           </div>
                           <div class="column">



                              <img src="images/tumblr_o9fsf3MLb01qahvd2o4_r1_1280.jpgt1503677894041ampwidth1024ampnametumblr_o9fsf3MLb01qahvd2o4_r1_1280.jpg" alt="">

                              <img src="images/8c2b23cc33f02afd4ea1236a_rw_1920.jpg" alt="">

                              <img src="images/yuumei-background-8.jpg" alt="">

                              <img src="images/Fantasy-Tiger-Digital-Art-Wallpaper-2560x1600.jpeg" alt="">



                          </div>
                          <div class="column">


                            <img src="images/33-journey-painting-jordan-grimmer-concept-art.jpg" alt="">
                             <img src="images/sketch_002.jpg" alt="">
                             <img src="images/9ba5a220b73eb7cf1eabcbedf3101fe9.jpg" alt="">

                             <a href="illustrations.php?page=1">
                                 <div class="btn btn-outline-primary" style="height:35%;display: table;">
                                     <div class="" style="display:table-cell;vertical-align:middle;">
                                         <i class="fas fa-paint-brush"></i>
                                        <h4>See More</h4>
                                     </div>

                                 </div>
                             </a>

                         </div>

                        </div>
                    </div>

                  </div>
                  <?php if(!isset($_SESSION['Username'])){ ?>
                  <a class="carousel-control-prev slide-arrow" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next slide-arrow" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                  <?php } ?>
                </div>

                <div class="row">
                    <div class="col-lg-12 visible">
                        <?php if(!isset($_SESSION['Username'])){ ?>

                              <div class="subscribe " >
                                  <div class="subscribe-heading">
                                      <div class="subscribe-inner">
                                          <h2><strong>Subscribe!</strong></h2>
                                          <h4 class="subscribe-subheading">Artwork submited regularly, subscribe to get notified.</h4>
                                          <button type="button" class="btn btn-info submit" id="subscribe" name="button" data-toggle="modal" data-target="#subscribemodal" data-toggle="tooltip" data-placement="top" title="Register by creating account"><i class="fas fa-user-plus icon"></i>Subscribe</button>

                                      </div>
                                  </div>

                              </div>
                         <?php } ?>
                    </div>
                    <div class="col-lg-12 visible">
                        <div class="gallery ">
                            <div class="column">


                              <img src="images/maxresdefault.jpg" alt="">
                               <img src="images/i7L82bM.jpg" alt="">

                               <img src="images/watchtower-clouds-forest-mountain-landscape-digital-art-20.jpg" alt="">
                               <img src="images/1_lTGwPZY2ut9aIlSqnL1Drw.png" alt="">

                           </div>
                           <div class="column">



                              <img src="images/tumblr_o9fsf3MLb01qahvd2o4_r1_1280.jpgt1503677894041ampwidth1024ampnametumblr_o9fsf3MLb01qahvd2o4_r1_1280.jpg" alt="">

                              <img src="images/8c2b23cc33f02afd4ea1236a_rw_1920.jpg" alt="">

                              <img src="images/yuumei-background-8.jpg" alt="">

                              <img src="images/Fantasy-Tiger-Digital-Art-Wallpaper-2560x1600.jpeg" alt="">



                          </div>
                          <div class="column">


                            <img src="images/33-journey-painting-jordan-grimmer-concept-art.jpg" alt="">
                             <img src="images/sketch_002.jpg" alt="">
                             <img src="images/9ba5a220b73eb7cf1eabcbedf3101fe9.jpg" alt="">

                             <a href="illustrations.php?page=1">
                                 <div class="btn btn-outline-primary" style="height:35%;display: table;">
                                     <div class="" style="display:table-cell;vertical-align:middle;">
                                         <i class="fas fa-paint-brush"></i>
                                        <h4>See More</h4>
                                     </div>

                                 </div>
                             </a>

                         </div>

                        </div>
                    </div>
                </div>

              </div>




            </div>



        </div>
    </div>

    <div class="container-fluid">

    </div>

    <!-- PAGE MODALS AND FAB -->
    <?php include $tpl . 'modals.php' ?>


<?php include $tpl . 'footer.php' ?>
