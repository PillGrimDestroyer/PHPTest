<?php
function getFeeds($url)
{
    $content = file_get_contents($url);
    $items = new SimpleXmlElement($content);

    foreach ($items->xpath('//item') as $item) {
        echo "<div class='card' style='width: 30rem; margin-top: 10px; margin-right: auto; margin-left: auto;'>
            <div class='card-body'>
                <h5 class='card-title'>$item->title</h5>
                <p class='card-text'>$item->description</p>
                <a href='$item->guid' class='card-link'>Подробнее...</a>
            </div>
        </div>";
    }
}

?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">

    <title>Home</title>
</head>
<body>

<?php
if (isset($_COOKIE['user_id'])) {
    getFeeds("http://news.yandex.ru/gadgets.rss");
} else {
    echo "<a href='login.php' style='font-size: 21pt'>Авторизоваться</a>";
}
?>
</body>
</html>