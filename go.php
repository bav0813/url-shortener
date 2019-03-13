<!-- Создайте скрипт go.php, который будет принимать GET параметр u=короткий_адрес, например go.php?u=JhBFZp и
перенаправлять браузер на оригинальный длинный URL
Сделайте перенаправление через header() и заголовок 302 Found; предусмотрите, что один и тот же URL может
создаваться разными пользователями, а значит, каждый из них должен иметь уникальный короткий адрес
Предусмотрите, что если короткий адрес не существует, скрипт должен отдавать ответ 404 Not Found
 -->

<?php

    if (isset($_GET['u'])) {

        $longURL=getURLfromfile($_GET['u']);
        header("Location: $longURL",true,302);


    }


    function getURLfromfile($shortURL){
        $log_folder='urls'.DIRECTORY_SEPARATOR;

        $src_file=$log_folder.$shortURL.'.url';


        if (!is_file($src_file)) {
            header("HTTP/1.0 404 Not Found",true,404);
            //header("Location: 404.php");

            exit;
        }

        else {
            $h1 = fopen($src_file, 'r');
            $data=fread($h1, filesize($src_file));
            fclose($h1);
        }
        return $data;

    }