<?php
include('connect.php');
session_start();

$message = ''; 
if(isset($_POST['submit'])){
    // userEmail and userPassword sent from form 
    
    $userEmail = mysqli_real_escape_string($conn,$_POST['email']);
    $userPassword = mysqli_real_escape_string($conn,$_POST['password']);    


    $sql1 = "Select * from users where email = '$userEmail'";
    $query = mysqli_query($conn, $sql1) or die(mysql_error());
    $result = mysqli_fetch_assoc($query);
    $count = mysqli_num_rows($query);
    if ($count === 1 ) {

            if (password_verify($userPassword, $result["password"])) {

                $_SESSION['login_user'] = $userEmail;
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $result['firstname'];
                $_SESSION['login_id'] = $result['id'];
                header("location: index.php");
            }
            else { 
                     $message = '<p class="text-warning">Invalid login credentials</p>';
                     echo $message;
            }
        } 
        else {
        $message = '<p class="text-warning">Invalid login credentials</p>';
       echo $message;
    }
}

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Docufix | Log in</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/header&footer.css">
        <link rel="icon" type="image/png" href="https://res.cloudinary.com/thecavemann/image/upload/v1571839870/logo_g4kuoa.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
         body {
             font-family: 'Rubik', sans-serif;
             margin: 1rem;
             height: 100vh;
         }
         
         .div-wrapper {
             width: 100%;
             position: absolute;
             bottom: 0;
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
         
         .form-control {
             border: 1px solid rgba(0, 0, 0, 0.15);
             border-radius: 0;
             height: 50px;
             margin-bottom: 10px;
             padding: 25px;
             font-style: normal;
             font-weight: normal;
             font-size: 14px;
             line-height: 17px;
             color: rgba(0, 0, 0, 0.56);
         }
         
         /* .spacing {
             margin-top: 250px;
         } */
         
         .login-btn {
             border-radius: 0;
             background: #2B4CF2;
             width: 31%;
             font-weight: bold;
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
             font-style: normal;
             font-weight: normal;
             font-size: 14px;
             line-height: 17px;
             color: rgba(0, 0, 0, 0.56);
             margin-bottom: 300px;
         }
         
         .form-align {}
         
         .signUP {
             font-style: normal;
             font-weight: 500;
             font-size: 25px;
             line-height: 30px;
             margin-bottom: 1rem;
         }
         
         .welcome {
             padding-bottom: 2em;
             margin-top: 100px;
         }
         
         .Already-acc {
             margin-top: 1em;
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
        /*  
         .container {
             margin-bottom: 5em;
         } */

         .okmessage {
            color: #0000FF;
            margin-bottom: 1em;
            text-align: center;
            width: 100%;
            }
    </style>
</head>

<body>

    <header>
          <nav class="navbar navbar-expand-lg navbar-light scrolling-navbar fixed-top">
            <a class="navbar-brand px-sm-5 ml-3" href="index.html"><img src="https://res.cloudinary.com/kuic/image/upload/v1572638901/docufix/Docufix_Logo_lnsgsr.svg" alt="DOCUFIX" id="image"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto px-5">
                <li class="nav-item">
                  <a class="nav-link text-center" href="signup.php">Sign Up</a>
                </li>
                
              </ul>
            </div>
          </nav>
    </header>
    <section class="container login-section ">
        <div class="text-center spacing">

        </div>
        <h3 class=" welcome text-center spacing">Welcome Back!</h3>
        <form class="" method="POST">
            <div class="form-group col-md-4 ">
                <input type="email" name="email" id="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address" required><span class="error"></span>
            </div>

            <div class="form-group col-md-4">
                <input type="password" name="password" id="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required><span class="error"></span>
            </div>

            <div class="forgot__pass__link">
                <a href="">Forgot Password?</a>
            </div>
            <br>
            <!-- <button type="submit" class="btn btn-primary login-btn">Login</button> -->
            <input id="submitData" name="submit" type="submit" class="btn btn-primary login-btn" value = "Login"/>
    
            <p class="Already-acc">New to Docufix?&nbsp;&nbsp;<span><a href="signup.php"> Sign Up</span></a></p>

        </form>

    </section>


    <img src="images/Ellipse.png" class="img-fluid bottom-ellipse d-none d-md-none d-lg-block" alt="">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <script src="app.js"></script>
</body>

</html>