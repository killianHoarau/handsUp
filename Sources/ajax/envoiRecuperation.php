<?php
/**
 * This example shows making an SMTP connection with authentication.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that

$email = $_POST['email'];
$link = new mysqli('localhost', 'root', 'mysql', 'handsup');		//CONNEXION
$query = "SELECT * FROM utilisateur WHERE email = '$email';";
	$result = $link->query($query);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$login = $row['login'];
		$mdp = $row['motDePasse'];
	}
	
date_default_timezone_set('Etc/UTC');
require '../PHPMailer-master/PHPMailerAutoload.php';
$msg = "<span>Vos identifiants sont :</span><br>
		<span>Login : $login</span><br>
		<span>Mot de passe : $mdp</span><br>";
// Create a new PHPMailer instance
$mail = new PHPMailer;
// Tell PHPMailer to use SMTP
$mail->isSMTP();
// Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
// Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
// Set the hostname of the mail server
$mail->SMTPSecure = "tls"; 
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; 
// Set the SMTP port number - likely to be 25, 465 or 587
// Whether to use SMTP authentication
$mail->SMTPAuth = true;
// Username to use for SMTP authentication
$mail->Username = "handsup.service.mail@gmail.com";
// Password to use for SMTP authentication
$mail->Password = utf8_encode("handsUp2016");
// Set who the message is to be sent from
$mail->setFrom($mail->Username, 'Hands Up');
// Set an alternative reply-to address
$mail->addReplyTo('ne.pas.repondre@svp.plz', 'NE PAS REPONDRE');
// Set who the message is to be sent to
$mail->addAddress($email);
// Set the subject line
$mail->Subject = utf8_decode('HandsUp récuperation de vos identifiants');
// Read an HTML message body from an external file, convert referenced images to embedded,
// convert HTML into a basic plain-text alternative body
$mail->msgHTML($msg);
// Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
// Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');
// send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>