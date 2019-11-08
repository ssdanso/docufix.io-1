<?php
// include('connect.php'); I dont need it


  $text = $_POST['txt'];
     $email = $_POST['mail'];
    $docName = $_POST['docName'];
    $doctype = $_POST['select'];
 
    
$fname = $docName.$doctype;
// echo $fname;
$file= file_put_contents('alldocs/'.$fname, $text);

// $userEmail = mysqli_real_escape_string($conn, $email); 


// $sql = "SELECT userEmail FROM docufix WHERE userEmail = '$userEmail'";
// $qpas = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// $count = mysqli_num_rows($qpas);
       
//           if ($count == 0 ) {
          
//         echo 'You have not subscribed to our mail. please subscribe here <a href="login.php">login</a>';     
//         } else {
         
      
// $contents = file_put_contents( $re , $text);

// $contents = explode("\n", $contents);
// foreach($contents as $line){
// $firstComma = (strpos($line, ","))+1;
// $newline= substr($line, $firstComma);

// echo $newline."\n"; this line of code does the samae thing the readfile does, so no need;
// }// 
if (empty($email)) {
    echo " email should not be empty ";
    }

else if (!empty($email)){
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
require 'mailer/Exception.php';


$the_mailer = new PHPMailer\PHPMailer\PHPMailer;
$the_mailer ->Host = "smtp.gmail.com";

$the_mailer->isSMTP();

$the_mailer->SMTPAuth = true;
$the_mailer->SMTPDebug = 0; 
$the_mailer->Username = "docufixwebapp@gmail.com";
$the_mailer->Password = "docufixwebapP60";
$the_mailer->SMTPSecure = "tls";//TLS;
$the_mailer->Port = 587;
$the_mailer->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$the_mailer->setFrom ("docufixwebapp@gmail.com", "DOCUFIX DOC ");
$the_mailer->subject = "Your document";
$the_mailer->addAddress($email); 
$the_mailer-> isHTML(true);
$the_mailer->Subject = "Compared Document";
$the_mailer->Body = "Your document";
$the_mailer->addAttachment('alldocs/'.$fname);
echo $fname;
if ($the_mailer->send()){
    echo '<p class="text-warning">Yepeeee. Email with attachement has been sent Successfully! Kindly check your mail!</p>';
    unlink('alldocs/'.$fname);
return true;
    } else{
        echo '<p class="text-warning" id="output">Email failed <a href="login.php">login</a></p>'.$the_mailer->ErrorInfo;
        unlink('alldocs/'.$fname);
        return false;
    }

}

 
?>