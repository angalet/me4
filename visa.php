<?php
$data = file('https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8');
if(!isset($argv[1])) {
    echo "Ошибка! Аргументы не заданы. Введите название страны! \n";
}
else {
    $match_something = false;
    foreach($data as $value){
        $str = explode(",",$value);
        $country_name = trim($str[1],' \"');
        $visa_type = trim($str[4]);
        $lev = levenshtein(mb_strtolower($argv[1]), mb_strtolower($country_name),1,1,1);
        //как это работает? пробовал чтобы например вводя "поль" он находил "польша"
        //но не находит, выводит вес 4. Но ведь вес вставки я поставил 1, 2*1=2, откуда 4?
        //пробовал много разных вариантов, методом исключения, логику работы функции не обнаружил.
        //echo mb_strtolower($country_name)." ".$lev."\n";
            if ($lev<=2){
                $match_something = true;
                echo "Вы имели ввиду ".$country_name."? \n";
                echo $country_name.": ".trim($visa_type,' \"')."\n";
            }          
    }
    if ($match_something == false){
        echo "По Вашему запросу ничего не найдено, попробуйте ввести другое название \n";
    }
}
?>
