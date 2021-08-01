<?php

class Model_User extends Model
{
    public function get_books ()
    {
        //return $_GET;
        return array(
            0 => ['img' => '22.jpg',
            'title' => 'Си и компьютерная графика',
            'authors' => 'я и компания']
        );
    }

    public function get_book()
    {
        return explode('/', $_SERVER['REQUEST_URI'])[3];
    }
}