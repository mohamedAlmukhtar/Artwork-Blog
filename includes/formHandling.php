<?php

    include 'init.php';
    include $tpl . 'header.php';

    if(isset($_SESSION['FormErr']) && isset($_SESSION['Error'])){

        if($_SESSION['Error']=="sign"){
                $formErr = $_SESSION['FormErr'];
                unset( $_SESSION['FormErr']);
                unset( $_SESSION['Error']);
                ?>
                <script>
                    $(document).ready(function(){
                        $('#errormodal').modal('show');
                        $('#errormodal').on('hidden.bs.modal',function(){
                            <?php
                                echo "$('#user').css('border','2px solid red');";
                                echo "$('#password').css('border','2px solid red');";
                            ?>

                            $('#signinmodal').modal('show');
                        })
                    })
                </script>
                <?php


        }elseif($_SESSION['Error']=="sub") {

            $formErr = $_SESSION['FormErr'];
            $errork = $_SESSION['Errork'];
            unset( $_SESSION['FormErr']);
            unset( $_SESSION['Error']);
            unset( $_SESSION['Errork']);

            ?>
                <script type="">
                    $(document).ready(function(){
                        $('#errormodal').modal('show');
                        $('#errormodal').on('hidden.bs.modal',function(){
                            <?php
                                if(in_array(1,$errork)){

                                    echo "$('#subscribe-username').css('border','2px solid red');";

                                } if(in_array(3,$errork)){

                                    echo "$('#subscribe-email').css('border','2px solid red');";
                                }if(in_array(2,$errork)){
                                    echo "$('#password1').css('border','2px solid red');";
                                    echo "$('#password2').css('border','2px solid red');";
                                }
                            ?>

                            $('#subscribemodal').modal('show');

                        })
                    })
                </script>
            <?php

        }elseif ($_SESSION['Error']=="upload") {

            $formErr = $_SESSION['FormErr'];
            unset( $_SESSION['FormErr']);
            unset( $_SESSION['Error']);
            ?>
                <script type="">
                    $(document).ready(function(){
                        $('#errormodal').modal('show');
                        $('#errormodal').on('hidden.bs.modal',function(){


                            $('#uploadmodal').modal('show');

                        })
                    })
                </script>
            <?php
        }
    }

 ?>
