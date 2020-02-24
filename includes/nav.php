<!-- Navigation -->
<nav class="navbar navbar-dark navbar-expand-lg  fixed-top">
   <div class="container">
       <a class="navbar-brand" href="index.php"><i class="fab fa-artstation"></i>Artwork Blog</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarResponsive">

            <form method="get" action="illustrations.php" class="form-inline my-2 my-lg-0" style="">
              <input style="" class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
              <input style="" class="btn btn-info my-2 my-sm-0" type="submit" value="Search">
            </form>

           <ul class="navbar-nav ml-auto ">

               <li class="nav-item ">
                   <a class="nav-link" href="index.php">Home
                       <span class="sr-only">(current)</span>
                   </a>
               </li>

               <li class="nav-item dropdown">
                 <a class="nav-link" data-toggle="dropdown" href=""><i class="fas fa-paint-brush"></i> Illustrations
                   <span class="sr-only">(current)</span>
                 </a>
                 <ul class="dropdown-menu">
                    <a href="illustrations.php?page=1"><li>All</li></a>
                    <a href="<?php if(isset($_GET['page'])){ echo "?page=" . $_GET['page'] . "&"; }else{echo "illustrations.php?";}?>medium=digital"><li>digital</li></a>
                    <a href="<?php if(isset($_GET['page'])){ echo "?page=" . $_GET['page'] . "&"; }else{echo "illustrations.php?";}?>medium=traditional"><li>traditional</li></a>
                 </ul>
               </li>
               <?php
                   if (($_SERVER['REQUEST_URI']=="/artworkBlog/index.php")) {
                       ?>
                       <li class="nav-item ">
                         <a class="nav-link" href="#latest">Latest
                           <span class="sr-only">(current)</span>
                         </a>
                       </li>
                       <?php
                   }

               ?>

            <?php if(isset($_SESSION['Username'])){ ?>

               <li class="nav-item dropdown">

                   <a class="nav-link " data-toggle="dropdown" href="">
                       <img src="images/img_avatar.png" alt="" style="width:30px;height:30px;margin-right:8px;border-radius:50%;"><?php echo $_SESSION['Username']?>
                       <span class="sr-only caret">(current)</span></a>
                       <ul class="dropdown-menu">
                         <a href="logout.php"><li>Log out</li></a>

                       </ul>

               </li>

           <?php }else{

               ?>

               <li class="nav-item ">
                 <span  class="nav-link" data-toggle="modal" data-target="#subscribemodal">Subscribe
                   <span class="sr-only">(current)</span>
               </span>
               </li>

               <li class="nav-item ">
                 <span  class="nav-link" data-toggle="modal" data-target="#signinmodal">Sign in
                   <span class="sr-only">(current)</span>
               </span>
               </li>

               <?php

           } ?>

           <li class="nav-item ">
               <span class="nav-link" id="todown" href="javascript(void)"><i class="fas fa-arrow-alt-circle-down"></i>
                   <span class="sr-only">(current)</span>
               </span>
           </li>

           </ul>
       </div>
   </div>
</nav>
