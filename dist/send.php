<?php
mb_internal_encoding("UTF-8");
$to = 'a.bahmutsky@sotrans.ru,espolikarpova@yandex.ru,leysan.n@tc-sotrans.ru,ak@trucks.ru,sotransgroup@yandex.ru,d.sharapov@sotrans.ru';

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && !empty($_POST['name']))  {
  $name  = substr( $_POST['name'], 0, 64 );
  $tel = substr( $_POST['tel'], 0, 64 );

  $message = substr( $_POST['comment'], 0, 1000 );


  if ($_FILES['attachment']['error'] == UPLOAD_ERR_OK){
    $filepath = $_FILES['attachment']['tmp_name'];
    $filename = $_FILES['attachment']['name'];
    echo $filename;
    echo 'нет ошибочка';
    print_r($_FILES);
  } else {
    $filepath = '';
    $filename = '';
  }

  $body = "Имя:\r\n".$name."\r\n\r\n";
  $body .= "Контактный номер:\r\n".$tel."\r\n\r\n";
  if (isset( $_POST['mail'])){
    $mail = substr( $_POST['mail'], 0, 64 );
    $body .= "E-mail:\r\n".$mail."\r\n\r\n";
  }
  $body .= "Описание заказа:\r\n".$message;

  send_mail($to, $body, $email, $filepath, $filename);
}

// Вспомогательная функция для отправки почтового сообщения с вложением
function send_mail($to, $body, $email, $filepath, $filename)
{
  $from = "ftc@sotrans.ru"; // Почта отправителя
  $subject = 'Заявка с сайта ftc.sotrans.ru';
  $boundary = "--".md5(uniqid(time())); // генерируем разделитель
  $headers = "From: $from\nReply-To: $from\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .="Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";
  $multipart = "--".$boundary."\r\n";
  $multipart .= "Content-type: text/plain; charset=\"utf-8\"\r\n";
  $multipart .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";

  $body = $body."\r\n\r\n";

  $multipart .= $body;

  $file = '';
  if ( !empty( $filepath ) ) {
    $fp = fopen($filepath, "r");
    if ( $fp ) {
      $content = fread($fp, filesize($filepath));
      fclose($fp);
      $file .= "--".$boundary."\r\n";
      $file .= "Content-Type: application/octet-stream\r\n";
      $file .= "Content-Transfer-Encoding: base64\r\n";
      $file .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
      $file .= chunk_split(base64_encode($content))."\r\n";
    }
  }
  $multipart .= $file."--".$boundary."--\r\n";
  mail($to, $subject, $multipart, $headers);
}
?>
