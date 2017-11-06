<?php

// manage all books logic

function loadBooks()
{
    $str = file_get_contents('books.txt');
    $books = unserialize($str);
    
    return $books;
}

function loadBook($id)
{
    $books = loadBooks();
    
    foreach ($books as $book) {
        if ($book['id'] == $id) {
            return $book;
        }
    }
    
    return false;
}

if ($action == 'show' && $id = requestGet('id')) {
    $book = loadBook($id);
    
    if (!$book) {
        die('Book not found');
    }
    
    $view = 'book_show';
} else {
    $books = loadBooks();
}

if ($action == 'delete' && $id = requestGet('id')) {
    $currentCart = cookieGet('cart', serialize([]));
    $currentCart = unserialize($currentCart);
    while (in_array($id, $currentCart)){
        $key = array_search($id, $currentCart);
        unset($currentCart[$key]);
    }
    echo $id;
    var_dump( $currentCart);

    cookieSet('cart', serialize($currentCart));

     redirect('/?page=cart');
}
