<?php
$data = file('https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8');
if(!$argv[1]) {
    echo "Ошибка! Аргументы не заданы. Введите название страны!";
    }
else {
foreach($data as $value){
        //echo $value."<br>";
        $str = explode(",",$value);
        $str1 = trim($str[1]);
        $str4 = trim($str[4]);
        $lev = levenshtein($argv[1], trim($str1,' \"'));
        if ($lev<=3){
        echo "Вы имели ввиду ".trim($str1,' \"')."? \n";
        echo trim($str1,' \"').": ".trim($str4,' \"')."\n";

    }
}
}
?>