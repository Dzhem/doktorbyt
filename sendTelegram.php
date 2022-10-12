<meta http-equiv='refresh' content='1; url=http://localhost/feedback_form'>
<meta charset="UTF-8" />

<?php

// сюда нужно вписать токен вашего бота
// define('TELEGRAM_TOKEN', '5756913387:AAHAs5fnle0_tp_DibQUMnIlHjoXCeX3e0w'); // doktorbyt
define('TELEGRAM_TOKEN', '5602655393:AAFzSQtL41LnkFn2qUmFqILl4jze8e0TQLM');

// сюда нужно вписать ваш внутренний айдишник
// define('TELEGRAM_CHATID', '1961810723');  // doktorbyt
define('TELEGRAM_CHATID', '708412997');

$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['description'];

message_to_telegram("Имя: $name \nТелефон: $phone \nТекст: $message");

function message_to_telegram($text)
{
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}