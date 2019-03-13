<!--Создайте скрипт index.php, в котором разместите форму для ввода длинного URL
После отправки формы генерируйте уникальный короткий адрес из 6 символов в диапазонах A-Z, a-z,
например, JhBFZp и сохраняйте оригинальный длинный URL в файл /urls/JhBFZp.url

Создайте скрипт go.php, который будет принимать GET параметр u=короткий_адрес, например go.php?u=JhBFZp и
перенаправлять браузер на оригинальный длинный URL
Сделайте перенаправление через header() и заголовок 302 Found; предусмотрите, что один и тот же URL может
создаваться разными пользователями, а значит, каждый из них должен иметь уникальный короткий адрес
Предусмотрите, что если короткий адрес не существует, скрипт должен отдавать ответ 404 Not Found
Добавьте логотип на главную страницу, оформите страницу с bootstrap
Загрузите свой сервис на свой хостинг на st.php-academy.org



Дополнительное задание


Сделайте с помощью .htaccess перенаправление таким образом, чтобы запрос http://localhost/go/JhBFZp
перенаправлялся на http://localhost/go.php?u=JhBFZp

Сделайте на главной странице счетчик созданных ссылок (сделайте это через подсчет кол-ва файлов в
директории через функцию glob())
Запоминайте пользователя с помощью Cookie; сделайте так, чтобы пользователь мог смотреть и удалять свои ссылки-->






<?php
    /**
     * Created by PhpStorm.
     * User: andrey
     * Date: 18.02.18
     * Time: 17:34
     */

    $log_folder='urls'.DIRECTORY_SEPARATOR;

    function generateShortURL() {


        A:
        $characters='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $shortURL='';
        for ($i=0;$i<=5;$i++){
            $shortURL.=$characters[rand(0,strlen($characters)-1)];

        }

        //check whether shortURL is unique;
        if (isShortURLExists($shortURL)==true) goto A;

        return $shortURL;
    }



    function saveURLtofile($longURL,$shortURL){
        global $log_folder;


        if (!is_dir($log_folder)) {
            mkdir($log_folder,0777);
        }

        $h1 = fopen($log_folder.$shortURL.'.url', 'w+');
        fwrite($h1, $longURL);
        fclose($h1);

    }


    function isShortURLExists($shortURL) {
        global $log_folder;

        if (is_file($log_folder.$shortURL.'.url'))
            $exists=true;
        else
            $exists=false;

        return $exists;
    }

    function URLNumber(){
        global $log_folder;
        $items=count(glob($log_folder."*.url"));

        return $items;
    }



    if (isset($_GET['inputURL'])) {

        $url=$_GET['inputURL'];

        $lnk=generateShortURL();
        saveURLtofile($url,$lnk);


    }

    else {
        $lnk='';
        $url='';
    }





?>

<!doctype html>
<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="main.css">

</head>
<body>


<nav class="navbar navbar-default"">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img src="img/1_Primary_logo_on_transparent_405x63-2.png">
            </a>
        </div>
    </div>
</nav>

<br>
<H5>Get short URL:</H5>
<br>
<form method="GET" action="">
    <div class="form-group">
        <label for="InputURL">URL:</label>
        <input type="text" class="form-control" id="InputURL" name="inputURL"  value="<?=$url?>" placeholder="Enter URL" required>
    </div>

    <div class="form-group">
        <label for="Text1">ShortURL:</label>
        <input type="text" class="form-control" id="Text1" name="txtarea" rows="3" value="<?=$lnk?>">
    </div>
    <button type="submit" class="btn btn-primary">Generate</button>
</form>

<hr>

<br>
<H5>Redirect with short URL:</H5>
<br>

<form method="GET" action="go.php">
    <div class="form-group">
        <label for="u">Short URL:</label>
        <input type="text" class="form-control" id="InputshortURL" name="u" value='' placeholder="Enter short URL" required>
    </div>

    <button type="submit" class="btn btn-primary">Redirect</button>
</form>






<div class="vyvod">
    <span>Links generated :</span>
    <?=URLNumber()?>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</head>
</html>