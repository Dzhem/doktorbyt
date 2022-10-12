<meta charset="UTF-8" />

<?php

// сюда нужно вписать токен вашего бота
define('TELEGRAM_TOKEN', '5756913387:AAHAs5fnle0_tp_DibQUMnIlHjoXCeX3e0w');

// сюда нужно вписать ваш внутренний айдишник
define('TELEGRAM_CHATID', '1961810723');

$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['description'];
$url = $_SERVER['HTTP_REFERER'];

message_to_telegram("Имя: $name \nТелефон: $phone \nТекст: $message");
echo("Ваше сообщение отправлено.\nСейчас Вы вернётесь на сайт.");
echo("<meta http-equiv='refresh' content='5; url=$url'>");

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