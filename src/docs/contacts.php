<?
if (array_key_exists('messageFF', $_POST)) {
   $to = 'roilist7000@mail.ru';
 $subject = 'Заяка с сайта';
   $subject = "=?utf-8?b?". base64_encode($subject) ."?=";
   $message = 
   "<html><head></head><body> 
                <h1 style='text-align:center;'>На сайте оставленна заявка!</h1><div>
   \nИмя: ".$_POST['nameFF']."</div><div>\nIP: ".$_SERVER['REMOTE_ADDR']."</div><div>\nТелефон: ".$_POST['tel']."</div><div><a href=".$_SERVER['HTTP_REFERER'].">Ссылка на страницу</a></div></body></html>";
   $headers = "From: 123 <isk-vitaspb@yandex.ru>\r\nContent-type: text/html; charset=UTF-8;";
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
   mail($to, $subject, $message, $headers);
    echo $_POST['"Ваша заявка принята"'];
}
?>	