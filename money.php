<?php
//var_dump($argv);
//echo $argv[1];
$today = date('Y-m-d');
if(!$argv[1]) {
    echo "Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки} \n";
    }
else {

//echo (float)$argv[1];
if ((float)$argv[1] > 0)
{

$name = array_slice($argv, 2);
$price = $argv[1];
// присваивает <body text='black'>
//$bodytag = str_replace("%body%", "black", "<body text='%body%'>")
$price = str_replace(",",".",$price);
echo $price;
//var_dump($name);
$name = implode(" ",$name);
file_put_contents('money.csv', "$today;$price;$name; \n",FILE_APPEND);
}
else if ($argv[1]== '--today') 
{
    $summ_today = 0;
    //echo "Вы хотите посчитать сумму за сегодня? \n";
    $from_file = file('money.csv');
    //var_dump($from_file);
    foreach ($from_file as $from_file){
        $from_file = explode(";",$from_file);
        //var_dump($from_file);
        if ($from_file[0] == $today){
            $summ_today += $from_file[1];
            //echo "$summ_today \n";
        }
        
    }
echo "Сумма за сегодня: $summ_today Р \n";
}
else 
{
    echo "Введите корректную сумму \n";
}

}

?>