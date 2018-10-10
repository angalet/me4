<?php
if(!$argv[1]) {
    echo "Ошибка! Аргументы не заданы. Введите название книги!\n";
    }
else {
    $query = $argv[1];
$books = file_get_contents("https://www.googleapis.com/books/v1/volumes?q=".urlencode($query)."&startIndex=0&maxResults=1");
$books = json_decode($books, true);

if (!function_exists('json_last_error_msg')) {
    function json_last_error_msg() {
        static $ERRORS = array(
            JSON_ERROR_NONE => 'No error',
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );

        $error = json_last_error();
        return isset($ERRORS[$error]) ? $ERRORS[$error] : 'Unknown error';
    }
}

//var_dump($books)."\n";
$id = $books["items"][0]["id"];
$author = $books["items"][0]["volumeInfo"]["authors"][0]."\n";
$book = $books["items"][0]["volumeInfo"]["title"];
file_put_contents('books.csv', $id.", ".$book.", ".$author);
}
?>