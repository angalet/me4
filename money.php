<?php
$today = date('Y-m-d');
if(!isset($argv[1])) {
    echo "Ошибка! Аргументы не заданы. Укажите флаг --today или запустите скрипт с аргументами {цена} и {описание покупки} \n";
}
else {
    if ((float)$argv[1] > 0){
        $name = array_slice($argv, 2);
        $price = $argv[1];
        $price = str_replace(',','.',$price);
        $name = implode(" ",$name);
        $fp = fopen('money.csv', 'a+');
        $new_line = array($today,$price,$name);
        $a = fputcsv($fp, $new_line,';');
        echo "Добавлен товар: $today $price $name \n";
        echo 'тест'.$a;
        echo $a[0];
        echo $a[1];
        fclose($fp);
    }
    else if ($argv[1]== '--today') 
    {
        $summ_today = 0;
        if (file_exists('money.csv')) {
            $handle = fopen('money.csv', 'r');
            $i = 0;
            while (($from_file = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $i++;
                if ($from_file[0] == $today){
                    $summ_today += $from_file[1];
                    echo "$i ".$from_file[1]." ".$from_file[2]."\n";
                }
            }
        fclose($handle);
        }
        echo "Сумма за сегодня: $summ_today Р \n";
    }
    else 
    {
    echo "Введите корректную сумму \n";
    }
}
?>