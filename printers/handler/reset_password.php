<?php
	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");
	require ("../../PHPMailer/PHPMailerAutoload.php");

	$mail = new PHPMailer;

	$email = sanitize($_POST['email']);
	$random_number = rand(1000000,9999999);
	$random_sanitized = sha1(md5($random_number));
	
	$sql = "SELECT email FROM printers WHERE email='{$email}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$sql = "UPDATE printers SET password='{$random_sanitized}' WHERE email='{$email}'";
		if($connection->query($sql))
		{

			$mail->isSMTP();                                   // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                            // Enable SMTP authentication
			$mail->Username = 'akobundumichael94@gmail.com';          // SMTP username
			$mail->Password = 'akobundumic?'; // SMTP password
			$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                 // TCP port to connect to

			$mail->setFrom('info@poda.ng', 'PODA');
			$mail->addReplyTo('info@poda.ng', 'PODA');
			$mail->addAddress($email);   // Add a recipient
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			$mail->isHTML(true);  // Set email format to HTML
			
			$bodyContent = "<h1>Password Reset Mail</h1>";
			$bodyContent .= "<p>Your PODA password has been reseted to {$random_number}, Kindly ignore this message if you feel that
			it is not relevant</p>";

			$mail->Subject = "Password Reset";
			$mail->Body    = $bodyContent;

			if(!$mail->send())
			{
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
			else
			{
				echo 'reseted';
			}
		}
	}
	else
	{
		echo "Sorry you don't have an account with us,click here to <a href='register.php'>register</a>";
	}
?>