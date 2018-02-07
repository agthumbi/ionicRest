<?php

require 'mail/swift_required.php';

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 486))
        ->setUsername('agthumbi')
        ->setPassword('Matiek201414')
;

/*
  You could alternatively use a different transport such as Sendmail:

  // Sendmail
  $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
 */

// Create the Mailer using your created Transport
$transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
        ->setUsername('agthumbi')
        ->setPassword('Matiek201414')
;
$mailer = Swift_Mailer::newInstance($transporter);


//$this->mailer = Swift_Mailer::newInstance($transporter);
// Create a message
$message = Swift_Message::newInstance()
        // The subject of your email
        ->setSubject('Kichen Wares')
        // The from address(es)
        ->setFrom(array('no-reply@makio.com' => 'Makio'))
        // The to address(es)
        ->setTo(array($sendMail => $SendName))
        // Here, you put the content of your email
        ->setBody('<h3>Login Credentials</h3>
	<p>Thank you for joining us.Please find your login credentials</p>
	<p>Username:<span>' . $sendMail . '</span></p>
		<p>Password:' . $rawp . '</p>
		<p></p>
		<p>Best Regards,</p>
		<p>Admin</p>', 'text/html');

// Send the message
$result = $mailer->send($message);
?>