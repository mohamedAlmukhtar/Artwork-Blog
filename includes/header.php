<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>artworkBlog</title>

        <script src="<?php echo $js; ?>jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" href="<?php echo $css; ?>all.css">
        <link rel='stylesheet' href='<?php echo $css; ?>typicons.min.css' />
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $css; ?>bricklayer.min.css">
        <link rel="stylesheet" href="<?php echo $css; ?>aos.css">

        <!--<link rel="stylesheet" href="<?php echo $css; ?>styles.css">-->
        <link rel="stylesheet" href="<?php echo $css; ?>styles.css">

        <link rel="stylesheet" href="layout/css/fstyles.css">


        <script src="<?php echo $js; ?>all.js"></script>
        <script src="<?php echo $js; ?>aos.js"></script>
        <script src="<?php echo $js; ?>imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo $js; ?>masonry.pkgd.min.js"></script>


        <link rel="stylesheet" href="<?php echo $js; ?>bricklayer.min.js">

        <!--<link rel="stylesheet" href="<?php echo $css; ?>frontend.css">-->

        <!-- smooth scroll -->
        <script type="text/javascript">



            function post(e){


                var data = $('#comment').val();


                $.ajax({
                    type: 'POST',
                    url: 'comments.php',
                    data: { comment: data},
                    success: function(response) {
                         document.getElementById("all-comments").innerHTML=response+document.getElementById("all-comments").innerHTML;
                         document.getElementById("comment").value="";
                         $('.no-comments').css('display', 'none');
                         setTimeout( function() {
                            $('.comment-container').removeAttr("data-aos");
                        }, 1000);

                    }
                });

                return false;


            }







            window.onbeforeunload = function (event) {
       // Make an ajax call to run session_destroy() on server
                $.ajax({url: "C:/wamp64/www/artworkBlog/session_destroy.php", success: function(result){
                    console.log(result);
                }});
            }

            $("#nav ul li a[href^='#']").on('click', function(e) {

               // prevent default anchor click behavior
               e.preventDefault();

               // store hash
               var hash = this.hash;

               // animate
               $('html, body').animate({
                   scrollTop: $(hash).offset().top
                 }, 300, function(){

                   // when done, add hash to url
                   // (default click behaviour)
                   window.location.hash = hash;
                 });

            });

        </script>

        <!-- SlideShow Area Change on screen resize -->
        <script type="text/javascript">

        $(document).ready(function(){
            if(parseInt($(window).width()) > 974){
                $('.carousel').show();
                $('.visible').hide();
            }else {
                $('.carousel').hide();
                $('.visible').show();
            }
        })

        $(window).resize(function(){
            if(parseInt($(window).width()) > 974){
                $('.carousel').show();
                $('.visible').hide();
                $('.pagination').addClass('pagination-lg');
                $('.pagination').removeClass('pagination-md');
            }else {
                $('.carousel').hide();
                $('.visible').show();
                $('.pagination').addClass('pagination-md');
                $('.pagination').removeClass('pagination-lg');
            }
        })


        <!-- /*AOS*/ -->
        $(document).ready(function(){
            AOS.init({
                duration: 1500,
            })

            var $grid = $('.grid').imagesLoaded( function() {
              // init Masonry after all images have loaded
              $grid.masonry({
                  // options...
              	itemSelector: '.grid-item',
              	isFitWidth: true,
              	columnWidth: 250
              });
            });

        })


            //requires jQuery
            $(window).scroll(function(){
            var threshold = 1; // number of pixels before bottom of page that you want to start fading
            var op = ($('#nel').height() - $(window).scrollTop()) - 310;
            if( op <= 0 ){
                $("#fixed").hide();
            } else {
                $("#fixed").show();
            }
            });

            function adjustWidth() {
               var parentwidth = $("#image-title").width();
               $(".fixed").width(parentwidth);
            }



            $(function() {

                $(window).resize(
                    function() {
                    adjustWidth();
                })

            })

            /* Links Animation Effect on hover */
            $(function() {

                $('.one').hover(function() {
                    $('#digital').css("top","-300px");

                }, function(){
                    $('#digital').css("top","0px");
                });

                $('.two').hover(function() {
                    $('#traditional').css("bottom","-300px");


                }, function(){
                    $('#traditional').css("bottom","0px");


                });

            })

            /* Heart Animation Effect in CARD on hover
            $(function() {

                $('.card').hover(function() {
                    $('.heart-tag').css("right","20px");

                }, function(){
                    $('.heart-tag').css("right","-34px");
                });

            }) */


            <?php
                if (($_SERVER['REQUEST_URI']!="/artworkBlog/index.php")) {
                    ?>
                    $(document).ready(function() {
                        $('.navbar').addClass('nav-color');
                    })
                    <?php
                }
             ?>

             $(document).ready(function(){
                 $('#todown').click(function(){
                     $('html, body').animate({
                         scrollTop: $(document).height()
                     }, 1);
                     return false;
                 });
             })

            $(document).ready(function() {



                var height = $('.topbg').height();
                var scrollTop = $(window).scrollTop();

                if (scrollTop >= height - 40) {
                    $('.navbar').addClass('solid-nav');
                } else {
                    $('.navbar').removeClass('solid-nav');
                }

                $(window).scroll(function() {

                    var height = $('.topbg').height();
                    var scrollTop = $(window).scrollTop();

                    if (scrollTop >= height - 40) {
                        $('.navbar').addClass('solid-nav');
                    } else {
                        $('.navbar').removeClass('solid-nav');
                    }

                });
            });



        </script>

        <script type="text/javascript">
            $(document).ready(function(){

                $('.like-button').unbind('click').bind('click', function (e) {
                    var likedata = $('.like-button').attr('var');
                    //alert(likedata);
                    $('.like-post').attr('value', likedata);
                    $('.like-form').submit();
                });

                $('.like-form').unbind('submit').bind('submit',function() {
                    var sentlike = $('.like-post').val();
                    //alert(sentlike);
                    $.ajax({
                        type: 'POST',
                        url: 'likes.php',
                        dataType: 'json',
                        data: {like: sentlike},
                        success: function(response){
                            //alert(response.icon);
                            $('#like-icon').attr('class', response.icon);
                            var set = sentlike == 0 ? 1 : 0;
                            $('.like-button').attr('var', set);
                            $('#total-likes').html(response.total);
                            $('.like-button').toggleClass('bloom');
                            document.getElementById("like-post").value="";
                            var val = $('.like-post').val();

                        }
                    });

                    return false;
                });

            })

        </script>

    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="50">

        <!--- this is the header --->
