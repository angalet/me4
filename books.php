<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$argv[2] = NULL;
if(!isset($argv[1])) {
    echo "Ошибка! Аргументы не заданы. Введите название книги!\n";
    }
else {
    $query = $argv[1].' '.$argv[2];
    $books = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.urlencode($query).'&startIndex=0&maxResults=40');
    if (!$books){   
        echo json_last_error_msg()."\n";
        echo json_last_error()."\n";
    }
    $books = json_decode($books, true);
    $fp = fopen('books.csv', 'w');
    //print_r($books);
    $i=0;
    foreach ($books['items'] as $book){
        $i++;
        $id = $book['id'];
        if (isset($book['volumeInfo']['authors'][0])){
            $author = $book['volumeInfo']['authors'][0];
        }else{
            $author = 'не автора';
        }
        $book_name = $book['volumeInfo']['title'];
        $new_line = array($id,$book_name,$author);
        echo $i.' '.$new_line[1].' - '.$new_line[2]."\n";
        fputcsv($fp, $new_line,';');  
    }
    fclose($fp);
}
?>