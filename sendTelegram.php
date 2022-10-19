<!DOCTYPE html>
<html class="no-js" lang="ru">
  <head>
    <meta charset="utf-8" />
    <title>
      ДОКТОР-БЫТ - Качественный ремонт бытовой техники по низким ценам!
    </title>
    <meta
      name="description"
      content="Профессиональный ремонт бытовой техники на дому от ДОКТОР-БЫТ - срочный и надежный ремонт по приемлемым ценам. Установка бытовой техники. Гарантия! Скидки пенсионерам 10%!"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="icon.png" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css?v=2.2" />

    <meta name="theme-color" content="#0080FA" />
  </head>
<body>
  
<?php

// сюда нужно вписать токен вашего бота
// define('TELEGRAM_TOKEN', '5756913387:AAHAs5fnle0_tp_DibQUMnIlHjoXCeX3e0w'); доктор
define('TELEGRAM_TOKEN', '5602655393:AAFzSQtL41LnkFn2qUmFqILl4jze8e0TQLM');

// сюда нужно вписать ваш внутренний айдишник
// define('TELEGRAM_CHATID', '1961810723'); доктор
define('TELEGRAM_CHATID', '708412997');

$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['description'];
$url = $_SERVER['HTTP_REFERER'];

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $recaptcha=$_POST['g-recaptcha-response'];
    if(!empty($recaptcha))
    {
 
        $google_url="https://www.google.com/recaptcha/api/siteverify";
        $secret='6LeWEJAiAAAAAChp8Ap6Msoj0McRvVznBUrl-qhn';
        $ip=$_SERVER['REMOTE_ADDR'];
        $url=$google_url."?secret=".$secret."&response=".$recaptcha."&remoteip=".$ip;
        $res=SiteVerify($url);
        $res= json_decode($res, true);
 
    //var_dump($res);
        if($res['success'])
        {
            // Проверка каптчи пройдена успешно, продолжаем дальше выполнение проверки формы и т.д.
            message_to_telegram("Имя: $name \nТелефон: $phone \nТекст: $message");
            // echo("Ваше сообщение отправлено.\nСейчас Вы вернётесь на сайт.");
            echo("<meta http-equiv='refresh' content='5; url=https://doktorbyt.ru/'>");
            ?>
            <dialog open>
              Ваше сообщение отправлено.<br>
              Сейчас Вы вернётесь на сайт.
            </dialog>
            <?php
        }
        else
        {
          // Проверка не пройдена
            echo("<meta http-equiv='refresh' content='5; url=$url'>");
            ?>
            <dialog open>
            Вы не поставили галочку и не подтвердили, что не являетесь роботом.<br>
            Сейчас Вы вернётесь на сайт.
            </dialog>
            <?php
        }
 
    }
    else
    {
          // Проверка не пройдена
            echo("<meta http-equiv='refresh' content='5; url=$url'>");
            ?>
            <dialog open>
            Вы не поставили галочку и не подтвердили, что не являетесь роботом.<br>
            Сейчас Вы вернётесь на сайт.
            </dialog>
            <?php
    }
 
}

function SiteVerify($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 15);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36");
    $curlData = curl_exec($curl);
    curl_close($curl);
    return $curlData;
}


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
?>

</body>
</html>