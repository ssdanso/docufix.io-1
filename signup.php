<?php
include('connect.php');

$message = '';
    
if(isset($_POST['submit'])){
        $userFirstName = mysqli_escape_string($conn, $_POST ['firstname']);
        $userLastName = mysqli_escape_string($conn, $_POST ['lastname']);
        $userEmail = mysqli_escape_string($conn, $_POST['email']);
        $userNewPassword = mysqli_escape_string($conn, $_POST['password']);
        $userVerifyPassword = mysqli_escape_string($conn, $_POST['verify_password']);
       
        if(empty($userFirstName) || empty($userLastName) || empty($userEmail) || empty($userNewPassword) || empty($userVerifyPassword)){
            die ("All fields are Required");
            }
            if ( strlen ( $userFirstName ) < 2 || strlen ( $userFirstName ) > 50) {
                $message = '<div class="alert alert-danger" role="alert">First name must be between 1 and 55 characters</div>';
                echo $message;
                }
                if ( strlen ( $userLastName ) < 2 || strlen ( $userLastName ) > 50) {
                $message = '<div class="alert alert-danger" role="alert">Last name must be between 1 and 55 characters</div>';
                echo $message;
                }
                if ( strlen ( $userEmail ) < 2 || strlen( $userEmail ) > 250) {
                $message = '<div class="alert alert-danger" role="alert">Email must be between 1 and 254 characters</div>';
                echo $message;
                }
                if ( strlen ( $userNewPassword ) < 8) {
                $message = '<div class="alert alert-danger" role="alert">Password should be at least 8 characters long</div>';
                echo $message;
                }
                if($userNewPassword === $userVerifyPassword){
                    $userNewPassword = password_hash($userNewPassword, PASSWORD_DEFAULT);
                }
                else{
                    die ("Error: Password does not match". "<br>");
                }




                $sql = "SELECT email FROM users WHERE email = '$userEmail' ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  die('email address exists');
                   }
                else { 

                    $sql = "INSERT INTO users(firstname, lastname, email, password)
                    VALUES('$userFirstName', 
                            '$userLastName',
                            '$userEmail',
                            '$userNewPassword'       )";
                           
                           $result = mysqli_query($conn , $sql);
                    if($result){
                                    $message .= '<div class="alert alert-success" role="alert">
                                    Record Saved Successfully <button class="btn"><a href = "index.html">Home</a></button></div>';
                                            echo ($message);

                    }
                    else{
                        $message .= '<div class="alert alert-danger" role="alert">
                        Record not Saved ' . mysqli_error($conn) . '<button class="btn"><a href = "index.html">Home</a></button>
                        </div>';
                    
                    }

                }


    }
 ?>

<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Docufix | Signup</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/header&footer.css">
        <link rel="icon" type="image/png" href="https://res.cloudinary.com/thecavemann/image/upload/v1571839870/logo_g4kuoa.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <script src="https://kit.fontawesome.com/75f59c3e4c.js" crossorigin="anonymous"></script>
        
        <style>
             body{
                overflow-x: hidden;
                width: auto;
             }
             .div-wrapper {
                 width: 100%;
                 position: absolute;
                 bottom: 0;
             }
              .forgot__pass__link {
                margin-top: -20px;
                padding-bottom: 30px;
                 font-size: 20px;
                  color: rgb(150, 149, 146); 
             }
             .forgot__pass__link :hover{
                text-decoration: none !important;
                color: #3B1F9E !important;
             }
             .div-wrapper img {
                 position: relative;
                 display: block;
                 float: left;
                 width: 350px;
             }
             
             .login-section {
                 /* margin: 0;
                 position: absolute;
                 top: 100%;
                 left: 50%;
                 -ms-transform: translate(-50%, -50%);
                 transform: translate(-50%, -50%); */
                 margin-top: -50px;
             }
             
             form {
                 display: flex;
                 flex-direction: column;
                 align-items: center;
             }
             
             .forgot__pass__link {
                 padding-right: 200px;
                 margin-bottom: -15px;
             }
             .link {
                 font-size: 18px !important;
                color: #3B1F9E !important;
                font-weight: 800px !important;
                padding-top: 20px !important;
             }
             .link :hover {
                text-decoration: none !important;
             }
             
         @media only screen and (max-width: 575.98px){
            .login-section{
                margin-top: -40px;
            }
            .page{
                background-color: #ffffff;
                padding: 20px 10px 40px 10px;
            }
            .link {
                margin-left: 120px ;
                margin-bottom: 50px !important;  
            }
            .lc {
                margin-top: 2px;

            }
            .form-control {
                height: 60px;
                width: 400px;
                padding-right: 70px !important; 
                margin-bottom: 10px;
                margin-left: -15px;

            }
            .signup-btn {
                 border-radius: 5px;
                 background: #3B1F9E;
                 width: 31%;
                 font-weight: bold;
                 height: 60px !important;
                width: 400px !important;
                 font-size: 24px;
                 color: #ffffff;
                 margin-bottom: 30px;
                 
                 border-radius: 42px;

             }
             .btn-grp {
                margin-bottom: 10px !important;           
                padding-top: 30px;
                margin-left: -60px; 
            }
             .facebook {
                    margin-bottom: 20px;
                   height: 60px !important;
                width: 400px !important;
                border-radius: 42px;
             }
             .google {
                height: 60px !important;
                width: 400px !important; 
                border-radius: 42px;            }
             .title {
                text-align: center;
             }
        }
        @media (max-width:425px){
                .form-control {
                    width: 300px !important;
                    height: 40px !important;
                    
                }
                .signup-btn {
                    width: 300px !important;
                    height: 40px !important;
                    margin-left: 3px;
                    background: #3B1F9E !important;
                    margin-top: 15px ;
                     
                }
                .google{
                    width: 300px !important;
                    height: 40px !important;
                }
                .facebook {
                    width: 300px !important;
                    height: 40px !important;
                }
                
                p {
                    font-size: 18px !important;
                }
                h3 {
                    padding-top: 10px;
                    font-size: 25px;
                }
                .link {
                    margin-left: 12vh;
                    margin-right: 0px !important;
                    padding-top: 5vh !important;
                    margin-bottom: -15px !important;
                }
             }
        @media (min-width: 576px) and (max-width: 767.98px){
            .page{
                background-color: #ffffff;
                padding: 20px 20px;
            }
            .link {
                margin-left: 100px !important;
                margin-bottom: 50px !important;
                height: 40px;
                width: 100px;
                margin-right: -20px;

            }
            .form-control {
                height: 70px;
                width: 450px;
                padding-right: 70px !important; 
                margin-left: 15px !important;
                margin-bottom: 10px;

            }
            .signup-btn {
                 border-radius: 5px;
                 background: #3B1F9E;
                 width: 31%;
                 font-weight: bold;
                 height: 70px !important;
                 width: 450px !important;
                 font-size: 24px;
                 color: #ffffff;
                 margin-bottom: 30px;
                 border-radius: 42px;

             }
             .btn-grp {
                margin-bottom: 30px !important;           
                padding-top: 30px;
                margin-right: -5px; 
            }
             .facebook {
                    margin-bottom: 20px;
                    height: 70px !important;
                 width: 450px !important;
                 border-radius: 42px;
             }
             .google {
                height: 70px !important;
                 width: 450px !important;
                 border-radius: 42px;
             }
             .title {
                text-align: center;
             }
        }
        @media (min-width: 768px) and (max-width: 991.98px){
            .page{
                background-color: #ffffff;
                padding: 20px 20px 50px 20px;
            }
            .link {
                margin-left: 170px !important;
                margin-bottom: 50px !important;
                height: 40px;
                width: 100px;
                margin-right: -20px;
                padding-top: 5px;

            }
            .form-control {
                height: 65px;
                width: 500px;
                padding-right: 70px !important; 
                margin-left: -145px !important;
                margin-bottom: 10px;

            }
            .signup-btn {
                 border-radius: 5px;
                 background: #3B1F9E;
                 width: 31%;
                 font-weight: bold;
                 height: 65px !important;
                 width: 500px !important;
                 font-size: 24px;
                 color: #ffffff;
                 margin-bottom: 30px;
                 margin-left: 10px;
                 border-radius: 42px;

             }
             .btn-grp {
                margin-bottom: 10px !important;           
                padding-top: 30px;
                margin-left: 140px; 
            }
             .facebook {
                    margin-bottom: 20px;
                    height: 65px !important;
                 width: 500px !important;
                 border-radius: 42px;
             }
             .google {
                height: 65px !important;
                 width: 500px !important;
                 border-radius: 42px;
             }
             .title {
                text-align: center;
             }
        }
        @media (min-width: 992px) and (max-width: 1199.98px){
            body {
                 font-family: 'Rubik', sans-serif;
                 margin: 36px 70px;
                 background: #E5E5E5;
             }
             
             .form-control {
                 border: 1px solid #C4C4C4;
                 border-radius: 5px;
                 height: 70px !important;
                 width: 500px !important;
                 margin-bottom: 10px;
                 padding: 30px 25px 25px 25px ;
                 font-style: normal;
                 font-weight: 600px;
                 font-size: 20px;
                 line-height: 33px;
                 color: #C4C4C4;
                 margin-left: -20px;
             }
             
             form {
                margin-left: auto;
             }
             .signup-btn {
                 border-radius: 5px;
                 background: #3B1F9E;
                 width: 31%;
                 font-weight: bold;
                 height: 70px !important;
                 width: 500px !important;
                 font-size: 24px;
                 color: #ffffff;
                 margin-bottom: 30px;
                 margin-left: -1px;
                 border-radius: 42px;
                 margin: auto;
                 line-height: 33px;

             }
             .form-align {
                margin: auto !important;

             }
             h3 {
                padding-top: 30px;
                font-weight: bold;
             }
             .page{
                padding: 50px 50px ;
                background-color: #ffffff;          
                width: ;
                height: 952px;
             }
             .btn-grp {
                display: flex;
                margin-bottom: 10px !important;
                margin-left: -140px;
                padding-top: 30px;

             }
             .google  {
                margin-left: 10px;
                border-radius: 42px;
                width: 230px !important;

             }
             .facebook {
                border-radius: 42px;
                width: 230px !important;
             }
             .title{
                margin-left: -24px !important;
             }
             .link {
                font-size: 18px !important;
                margin-left: 35px;
             }
         
        }
        @media (min-width: 1200px){
            body {
                 font-family: 'Rubik', sans-serif;
                 margin: 36px auto;
                 background: #E5E5E5
             }
             .link {
                margin-left: 10vh; 
             }
             .form-control {
                 border: 1px solid #C4C4C4;
                 border-radius: 5px;
                 height: 70px !important;
                 width: 636px !important;
                 margin-bottom: 10px;
                 padding: 30px 25px 25px 25px ;
                 font-style: normal;
                 font-weight: 600px;
                 font-size: 24px;
                 line-height: 33px;
                 color: #C4C4C4;
                 margin-left: -3vh; ;
             }
             
             .signup-btn {
                 border-radius: 5px;
                 background: #3B1F9E;
                 width: 31%;
                 font-weight: bold;
                 height: 70px !important;
                 width: 636px !important;
                 font-size: 24px;
                 color: #ffffff;
                 margin-bottom: 30px;
                 margin-left: 10vh;
                 border-radius: 42px;
                 margin: auto;

             }
             .page{
                padding: 50px 50px ;
                background-color: #ffffff;          
                width: 1064px;
                height: 952px;
             }
             .btn-grp {
                display: flex;
                margin-bottom: 30px !important;
                margin-left: -23vh;
                padding-top: 30px;

             }
             .google  {
                margin-left: 40px;
                height: 60px;
                width: 250px;
                border-radius: 42px;
             }
             .facebook{
                height: 60px;
                width: 250px;
                border-radius: 42px;
             }
             h3 {
                font-weight: bold;
                margin-top: 5vh;

             }
             .signUP {
                margin: 0px;
             }
             .title {
                margin-left:-3vh !important;
             }
         .form-align {
            margin: auto;
         }
        
        }
        @media only screen and  (max-width: 2560px){
            .lc{
                margin-right: -100px !important;
                text-align: ;

             }
        
             
             
             .bottom-ellipse {
                 /* background: rgba(33, 89, 168, 0.05); */
                 transform: rotate(-162.89deg);
                 width: 668px;
                 top: 300px;
                 position: fixed;
                 left: -55px;
                 z-index: -99;
             }
             
             input {
                 padding: 25px;
                 font-style: normal;.

                 font-weight: normal;
                 font-size: 14px;
                 line-height: 17px;
                 color: rgba(0, 0, 0, 0.56);
                 margin-bottom: 50px;
             }
             
             
             
             .signUP {
                font-style: normal;
                font-weight: 800;
                margin-bottom: 30px !important;
                margin-top: 100px;
                font-family: Nunito;
                font-size: 36px;
                line-height: 49px;
                color: rgba(51, 51, 51, 0.8);
             }
             
             .welcome {
                 padding-bottom: 2em;
             }
             
             .Already-acc {
                 margin-top: 10px;
                 font-size: 18px;
                 line-height: 21px;
                 font-style: normal;
                 font-weight: normal;
             }
             
             .Already-acc a {
                 text-decoration: none;
             }
             
             .Already-acc span {
                 color: #2B4CF2;
             }
             
             .Already-acc span:hover {
                 color: #2B4CF2;
                 text-decoration: underline;
             }
             
             .okmessage {
                color: #0000FF;
                margin-bottom: 1em;
                text-align: center;
                width: 100%;
             }
             .title{
                display: flex;
                 flex-direction: column;
                 align-items: center;
                 margin-left: 3px;
                 padding-bottom: 20px;

             }
             
             .facebook {
                background-color: #245C9B;
                width: 250px;
                height: 60px;
                font-size: 16px;
                color: #ffffff;
             }
             .google {
                background-color: #F34A38;
                width: 250px;
                height: 60px;
                font-size: 16px;
                color: #ffffff;

             }
             
             
             .fab {
                font-size: 25px;
                padding-right: 5px;
                padding-bottom: 0px !important;
             }
             .bar{
                display: flex;
             }

        </style>
    </head>



    <body class="">
        <div class="container-fluid col-lg-12 col-sm- col-xs- page animated finite pulse">
        <header class="">
            <div class="row   ">
                <div class="col-sm-12 bar justify-content-between">
                    <div class="col-lg-4 col-sm-3">
                        <a class="navbar-brand  " href="index.html"><img src="https://res.cloudinary.com/kuic/image/upload/v1572638901/docufix/Docufix_Logo_lnsgsr.svg" alt="DOCUFIX" id="image" width="75"  height="13"></a>
                    </div>
                    <div class="col-lg-2 col-sm-4 lc">
                        <a class="link " href="login.php">Sign in</a>
                    </div>
               </div>
            </div>
        </header>

        <section class="container login-section">
            <div class="title">
                <div class="col-lg-8 col-sm-12 ">
                    <h3 class=" signUP">Welcome, create an account</h3>
                    <p class="form-text ">
                         Enter your full name, email, and password to  create an account
                    </p>
                </div>
            </div>
                
            <form class="form-align" method="POST" action="">
                
                <div class="form-group col-md-4 col-lg-8">
                    <input type="text" class="form-control" id="name" name="firstname" placeholder="First Name" pattern="[a-zA-Z]{1,}" data-toggle="tooltip" data-placement="bottom" title="Enter Your First Name" required><span class="error"></span>
                </div>

                <div class="form-group col-md-4 col-lg-8">
                    <input type="text" class="form-control" id="name" name="lastname" placeholder="Last Name" pattern="[a-zA-Z]{1,}" data-toggle="tooltip" data-placement="bottom" title="Enter Your Last Name" required><span class="error"></span>
                </div>
              
                <!-- <div class="form-group col-md-4">
                    <input type="text" class="form-control" aria-describedby="usernameHelp" placeholder="Your username" id="username" name="username" pattern="[0-9a-zA-Z]{3,}" data-toggle="tooltip" data-placement="bottom" 
                    title="Enter username (must be more than 3 character)" required><span class="error"> </span>
                </div> -->

                <div class="form-group col-md-4 col-lg-8">
                    <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Your email address" id="emailAddress" name="email"  data-toggle="tooltip" data-placement="bottom" title="Please enter a valid Email Address" required><span class="error"></span>
                </div>

                <div class="form-group col-md-4 col-lg-8">
                    <input class="form-control" type="password" name="password" id="password" class="form-control" placeholder="Your password" data-toggle="tooltip" data-placement="bottom"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>     
                </div>
                <div class="form-group col-md-4 col-lg-8">
                    <input type="password" class="form-control" name="verify_password" id="confirmPassword" placeholder="Confirm password" data-toggle="tooltip" data-placement="bottom" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                    title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><span class="error"></span>
                </div>
                <button id="submitData" name="submit" type="submit" class="btn signup-btn "  >
                            Sign Up
                        </button>
                <!-- <h3 class="col-lg-8 text-center">OR</h3> 
                <div class=" btn-grp col-lg-7  justify-content-between">

                    <DIV class="col-lg-4">
                        <button id="submitData" name="submit" type="submit" class="btn facebook " >
                            <i class="fab fa-facebook-f pr-2"></i>
                            Register with facebook
                        </button>
                    </DIV>
                    <DIV class="col-lg-4">
                        <button id="submitData" name="submit" type="submit" class="btn google " >
                            <i class="fab fa-google-plus-g pr-2"></i>
                            Register with google
                        </button>
                    </DIV>
                </div> -->

            </form>
            <span class="error"></span>
        </section>


        <img src="images/Ellipse.png" class="img-fluid bottom-ellipse " alt="">
    </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="./js/account.js" ></script>
         <script src="app.js"></script>
    </body>

    </html>