<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['text'])) {
        $text        = $_POST['text'] ?? '';
        $db_host     = 'php-db';
        $db_name     = 'php';
        $db_user     = 'test';
        $db_password = 'test';
        $db_port     = '3306';
        $date_time   = date('Y-m-d H:i:s', time());
        $query       = "INSERT INTO log (date_time, text) VALUES ('$date_time', '$text')";

        try{
            $db = new PDO("mysql:host=$db_host;dbname=$db_name;port=$db_port", $db_user, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->exec($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $array = [
            'text' => $text,
        ];

        $ch = curl_init('http://app:8090');

        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => http_build_query($array, '', '&'),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER         => false,
        ]);

        $html = curl_exec($ch);

        curl_close($ch);

        echo $html;
    }
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <form class="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <textarea class="text" name="text" placeholder="Введите текст сообщения для отправки всем подписанным клиентам" required></textarea>
        <div class="button-wrapper">
            <button class="button">Отправить</button>
        </div>
    </form>
</body>
</html>