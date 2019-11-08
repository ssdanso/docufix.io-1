<?php
  session_start();
 ob_start();
  Class Controller{
          
  	      private $db_server = "localhost";
          private $db_name = "docufix";
          private $db_user = "root";
          private $db_pass = "6yt5^YT%"; 
          //private $db_pass = ""; 


        //function for connecting to the database
        function connect_db(){

		        $conn = new mysqli($this->db_server, $this->db_user, $this->db_pass, $this->db_name);
		        if ($conn->connect_error) {
		            die("Connection failed: " . $conn->connect_error);
		        }
		        return $conn;
    	}

         //Returns User to login page if not logged on
    	 function access_control()
		 {


		        if (!isset($_SESSION['email'])) {
		            header('location: login.php');
		        }
		 }


		 //check if userexists 
		 function userexists($email)
		 {
		        $newconnection = $this->connect_db();
		        $sql = "SELECT * FROM user where email='$email'";
		        $result = $newconnection->query($sql);
		        $emailfound = false;

		        if ($result->num_rows > 0) {
		            $emailfound = true;
		        }

		        return $emailfound;
		  } 
          
          //Signs User Up
		function signUp($fullname, $email, $password, $verifypassword)
	    {    
	        if($password === $verifypassword){
	                    $password = password_hash($password, PASSWORD_DEFAULT);

	                    $emailfound = $this->userexists($email);

	                if ($emailfound == false) {
	                    $newconnection = $this->connect_db();


	                    $sql = "INSERT INTO user (fullname, email, password) VALUES('$fullname', '$email', '$password')";

	                    if ($newconnection->query($sql) === TRUE) {
	                        echo "<br> Successfully Registered.";
	                        $_SESSION['email'] = $email;
	                        ob_end_clean();
	                        header("location: profile.php");
	                    }
	                    else {
	                        echo "Error: " . $sql . "<br>" . $conn->error;
	                    }
	                  } 
	                else{
	                	
	                    echo ' <div class="alert alert-danger" role="alert">Email Already Registered, Please Signin or Try a Different Email</div>';
	                      }
	             }
	         else{
	             $message = '<div class="alert alert-danger" role="alert">Error: Password does not match</div>';
	             echo $message;
	          }  

	        
	    }
        
        //Sign user in.
	    function signIn($email, $password)
	    {
	        $newconnection = $this->connect_db();
	        $sql = "SELECT * FROM user where email='$email'";
	        $result = $newconnection->query($sql);
	        $userfound = false;

	        if ($result->num_rows > 0) {
	        	 while ($row = $result->fetch_assoc()) {
                $dbpassword = $row['password'];
                if (password_verify($password, $dbpassword)) {
                	$userfound = true;
	                $_SESSION['email'] = $email;
	                ob_end_clean();
	                header("location: profile.php");

                }
                }
	            
	        }



	        if(!$userfound){

	             $message = '<div class="alert alert-danger" role="alert">Wrong Login Details</div>';
	             echo $message;
	            
	        }
	    }

	    //Sign User Out
	    function signOut()
	    {
	        session_unset();
	        session_destroy();
	        header("location: index.php");
	    }

	    //Updatepassword
	    function updatepassword($email, $password){

	    $newconnection = $this->connect_db();
	        $sql = "UPDATE users SET password='$password' WHERE email='$email'";
	        $result = $newconnection->query($sql);
	        
	        if($result){
	          echo "Password Changed Successfully";
	        }
	

	    }

	    //FetchUser Information

	     function fetchemailfromid($id)
	    {

	        $newconnection = $this->connect_db();
	        $sql = "SELECT * FROM users where id='$id'";
	        $result = $newconnection->query($sql);


	        if ($result->num_rows > 0) {
	            while ($row = $result->fetch_assoc()) {
	                $email = $row['email'];
	            }
	        }

	        return $email;
	    }

	    function fetchcontactinformation($email)
	    {

	        $newconnection = $this->connect_db();
	        $sql = "SELECT * FROM users where email='$email'";
	        $result = $newconnection->query($sql);


	        if ($result->num_rows > 0) {
	            while ($row = $result->fetch_assoc()) {
	                $name = $row['fullname'];
	            }
	        }

	        return $name;
	    }

        

      //function to check if email address has been registered on the system
	  function readyemail($email){
                  
			        $newconnection = $this->connect_db();
			        $sql = "SELECT * FROM users where email='$email'";
			        $result = $newconnection->query($sql);
			        $emailfound = false;

			        if ($result->num_rows > 0) {
			          while ($row = $result->fetch_assoc()) {
		                $id = $row['id'];

		                //generate resetcode
		                $resetcode=rand(9999, 99999);

		                //store generated reset code
		                $this->registerresetcode($resetcode);
                          
                        //passed userid and resetcode into the url that would be sent to users mail  
		                $resetlink='https://docufix.io/passwordreset.php?id='.$id.'&code='.$resetcode;
		                //compose message and add reset link
		               $message = $this->composehtmlmessage($resetlink);
		              }
			        }
			        else{
			        	$message=false;
			        }
                    
			        return $message;

			     }

              //this function registers reset code generated
	    function registerresetcode($code){
               $newconnection = $this->connect_db();

            $sql = "INSERT INTO resetcodes(code) VALUES('$code')";

            if ($newconnection->query($sql) === TRUE) {
               $status=true;
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            return $status;
	    }
            
           //This function composes html messages.
		 function composehtmlmessage($resetlink){

		 		$message = '
					<html>
					<head>
					<title>Docufix Password Recovery</title>
					</head>
					<body>
					<p>We received a Password Recovery request for Your Docufix Account, Please click the link below to change your password <br></p>
					<a href='.$resetlink.'><button type="submit">Proceed</button></a>

					
					</body>
					</html>
					';

					return $message;

		 }

		 //This function sends the password reset link using the phpmail function.
		 function sendpasswordresetlink($email){

        	    $emailexists= $this->readyemail($email);
        	    if($emailexists!=false){
        	    	    $message=$emailexists;
		                $to = $email;
					    $subject = "Docufix Account Recovery";
					   
					   
					    // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						// More headers
						 $headers = "From: docufixwebapp@gmail.com";


					    $status = mail($to,$subject,$message,$headers);
					    if($status==1){
					       $returnmessage="A Password reset Link has been sent to your email Address, Please proceed to your email to recover your account";       
					                  }
        	       }
        	    else{
        	    	$returnmessage="Email has not been registered!!!";
        	    }
    
			   
			    
			    return $returnmessage;
			   }		 

}

?>