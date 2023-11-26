<?php
    if (isset($_POST['notARobot'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $userSubject = $_POST['subject'];
        $userMessage = $_POST['message'];
        $currentFile = __FILE__;
        sendMail($name, $email, $userSubject, $userMessage);

    } else {
        echo "An error occurred while processing your request. Please Try again <br />";
        die('<a href="index.php#contact">Go Back</a>');

    }


function sendMail($name, $emailAddress, $userSubject, $userMessage)
{
    $to = 'leatkins@aboveall-media.tech';
    $subject = "Contact Us ::: New form entry ::: hwg-unlymited.com";

    $message =
        '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us ::: New form entry ::: hwg-unlymited.com</title>
</head>
<body style="background-color:black;width:100%">

<div style="padding:10%;margin-top:20px;margin-left:5%;width:70%;background-color:whitesmoke; border-radius:3em;text-align:center">

  <img src="https://hwg-unlymited.com/assets/web_img/coverAd_HWG.png" target="_blank" width="35%" alt="HWG-Unlymited">
  <a href="https://www.hwg-unlymited.com"><p>www.HWG-UNLYMITED.com</p></a>
  <hr/>
  <h1 style="color:orangered">Contact Us: Form Entry </h1>
  <p><strong>From: </strong>' . $name . '</p>
  <p><strong>E-Mail Address: </strong><a href="mailto:' . $emailAddress . '">' . $emailAddress . '</a></p><br />
  <p><strong>Subject: </strong>' . $userSubject . '</p><hr />
  <p><strong><i>' . $userMessage . '</i></strong></p>
  
</div>

</body>
</html>
';

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <no-reply@hwg-unlymited.com>' . "\r\n";

    mail($to, $subject, $message, $headers);
    header("Location:contactThankYou.html");


}
