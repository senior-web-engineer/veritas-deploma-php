<?php 

/**
 * Classe Envoie des fichiers
 * @author Diakite
*/
class SENDMAIL 
{
	public function __construct() {}

	public function envoieEmail($destinataire, $destinataire_copie, $raison_sociale, $file, $objet, $message)
	{
		$mail = new PHPMailer;
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'rimacam12@gmail.com';                     //SMTP username
	    $mail->Password   = 'diakite@664';                               //SMTP password
	    $mail->SMTPSecure = 'ssl'; //'tls';            //Enable implicit TLS encryption
	    $mail->Port       = 465; //587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure 
	    //Recipients
	    $mail->setFrom('rimacam12@gmail.com', 'Mame Sorel');

		//exemple1@gmail.com;exemple2@gmail.com;
	    
	    $count_mail_destinataire = explode(';', $destinataire);
	    
	    for($i=0;$i<count($count_mail_destinataire); $i++):
	    	$mail->addAddress($count_mail_destinataire[$i]);
	    endfor;

	    $count_mail_destinataire_copy = explode(';', $destinataire_copie);
	    
	    for($i=0;$i<count($count_mail_destinataire_copy); $i++):
	    	$mail->addCC($count_mail_destinataire_copy[$i]);
	    endfor;

	    //$mail->addAddress($destinataire, $raison_sociale);     //Add a recipient
	    //$mail->addAddress('ellen@example.com');               //Name is optional
	    $mail->addReplyTo('rimacam12@gmail.com', 'Information');
	    //$mail->addCC($destinataire_copie);
	    //$mail->addBCC('bcc@example.com');
	    //Attachments
	    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
	    $mail->addAttachment($file, 'Bon de commande');    //Optional name
	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = $objet;
	    $mail->Body    = $message;  //'Veuillez trouvez ci-joint les pieces jointes de bon commande'
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	    
	    if(!$mail->send())
	    {
	        echo "Echec";
	    }else {
	        echo 'succes';
	    }
	}
}