<?php
$flag = false;
if (file_exists('books.json')) {
    $json = file_get_contents('books.json');
    $books = json_decode($json, true);
    foreach ($books as $key => $value) {
        if ($value['id'] == $_GET['id']) {
            array_splice($books, 1, 1);
            $flag = true;
            $books = json_encode($books);
            file_put_contents('books.json', $books);
            header("Location: index.php");
            break;
        }
    }
    if ($flag == false) {
        header("Location: 404.php");
    }
}
