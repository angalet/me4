<?php
$argv[2] = NULL;
if(!isset($argv[1])) {
    echo "Ошибка! Аргументы не заданы. Введите название книги!\n";
    }
else {
    $query = $argv[1]." ".$argv[2];
    $books = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=".urlencode($query)."&startIndex=0&maxResults=1");
    if (!$books){   
        echo json_last_error_msg()."\n";
        echo json_last_error()."\n";
    }
    $books = json_decode($books, true);
    $id = $books["items"][0]["id"];
    $author = $books["items"][0]["volumeInfo"]["authors"][0];
    $book = $books["items"][0]["volumeInfo"]["title"];
    $fp = fopen('books.csv', 'w');
    $new_line = array($id,$book,$author);
    fputcsv($fp, $new_line,';');
    fclose($fp);
}
?>