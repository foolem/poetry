<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load composer's autoloader
include_once 'vendor/autoload.php';
include_once "config.inc.php";

if (isset($_POST) && !empty($_POST)) {
  $id = $_POST['id'];
  $status = 'published';
  $stmt = $PDO->prepare("UPDATE poem SET status = '{$status}' WHERE id = :id");
  $stmt->bindParam(':id', $id);

  $stmt->execute();

}
$stmt = $PDO->prepare("select user.name as user_name, user.email as user_email, poem.* from poem inner join user on poem.author = user.id where poem.id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$poem = $stmt->fetch(PDO::FETCH_OBJ);

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'suapoesiamail@gmail.com';                 // SMTP username
    $mail->Password = 'naosounob1';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $email = $poem->user_email;
    $name = $poem->user_name;
    $title = $poem->title;
    //Recipients
    $mail->setFrom('suapoesiamail@gmail.com', 'Equipe');
    $mail->addAddress($email, $name);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'SuaPoesia: Seu poema foi aprovado!';
    $mail->Body    = "Oi! {$name}, seu poema {$title}foi publicado, obrigado por fazer parte deste projeto!<br>Seu poema foi publicado :)<br>Link de acesso: <a href='http://suapoesia-com-br.umbler.net'>SuaPoesia</a>";
    $mail->AltBody = "Oi! {$name}, seu poema {$title}foi publicado, obrigado por fazer parte deste projeto!<br>Seu poema foi publicado :)<br>Link de acesso: http://suapoesia-com-br.umbler.net";

    header('Location: index_appraiser.php');
    $mail->send();

} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
