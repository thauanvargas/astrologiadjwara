<?php
  include("phpmailer/src/oAuth.php");
  include("phpmailer/src/Exception.php");
  include("phpmailer/src/POP3.php");
  include("phpmailer/src/PHPMailer.php");
  include("phpmailer/src/SMTP.php");
  
if(isset($_POST['name'])      ||
   isset($_POST['email'])     ||
   isset($_POST['phone'])     ||
   isset($_POST['message']))
   {
$mensagem = $_POST['message'];
$email = $_POST['email'];
$nome = $_POST['name'];
$phone = $_POST['phone'];
$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$mail->IsSMTP();
$mail->Charset = 'UTF-8';
$mail->SMTPDebug  = 0;                  
$mail->SMTPAuth   = true;        
$mail->SMTPSecure = "tls";                 
$mail->Host       = "smtp.gmail.com";    
$mail->Port       = 587;              
$mail->Username   = "djawaramailer@gmail.com"; 
$mail->Password   = "Astrologia2018";     
$mail->SetFrom('astrologiadjawara@gmail.com', 'Contactado por ' .$nome);
$mail->FromName = 'Contactado por ' .$nome;
$address = "astrologiadjawara@gmail.com";
$mail->AddAddress($address, "Astrólogo Djawara");
$mail->isHTML(true);
$mail->Subject = $email ." lhe contactou.";
$mail->Body = "<h1 style='text-align:center'>Mensagem de ".$nome."</h1><br /><h3 style='text-align:center'>".$mensagem."</h3><br /><br /><br /><br /><spanstyle='text-align:center;color:#555'>Telefone: ".$phone." | Email: ".$email." | Nome: ".$nome."</span>";

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    $result = array('status'=>"success", 'message'=>"Mensagem Enviada!");
    echo json_encode($result);
}
   }else{
   echo "<script>alert('Erro, verifique se preencheu os dados e o email!');</script>";
	$url = '../index.php#contatos';
	echo'<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';
   return false;
   }

?>