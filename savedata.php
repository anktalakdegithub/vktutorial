<?php      
 
    // include('config.php');  
    include('smtp/PHPMailerAutoload.php');
    $name=$_POST['name'];
    $email=$_POST['email'];
    $board=$_POST['board'];
    $grade=$_POST['grade'];
    $contactnum=$_POST['contactnum'];
    $message="Thanks You for Contact Us";
    $admin_message="Thank You";


				$data=array();
		if(empty($name)){
			$data['code']="404";
		$data['msg']="Please Enter  name.";
		}
	 else if(empty($email)){
			$data['code']="404";
		$data['msg']="Please Enter email.";
		}
		else if(empty($board)){
			$data['code']="404";
		$data['msg']="Please Select board.";
		}
        else if(empty($grade)){
			$data['code']="404";
		$data['msg']="Please Select Grade.";
		}

		else{

				// Insert into Database
                // $sql = "INSERT INTO `special_contact_form`(`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$admin_message')";
                // mysqli_query($con,$sql);
                $amsg="Name: $name<br/> Email: $email<br/>Board: $board<br/>Grade: $grade<br/>Contact Number:$contactnum";
                blastEmail($email,"Welcome to VK's Tutorial's",$message);
                blastEmail("Vktutorialsthane@gmail.com",'Vk Details',$amsg);
						$data['code']="200";
						$data['msg']="Thank you! Data submitted Succefully.";
		}			
        function blastEmail($to,$subject,$message){
	
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = "587";
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Username = "Vktutorialsthane@gmail.com";
            $mail->Password = 'vk@123456';
            $mail->SetFrom("Vktutorialsthane@gmail.com","VK's Tutorial");
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AddAddress($to);
            $mail->SMTPOptions = array('ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => false
            ));
            if (!$mail->Send()) {
                echo $mail->ErrorInfo;
            } else {
            
               $emailmsg="Your message has been sent. Thank you!";
            }
            }
            

		echo json_encode($data);	

        