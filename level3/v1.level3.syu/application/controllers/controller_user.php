<?php

class Controller_User extends Controller
{
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('user_view.php', 'template_view.php', $data);
    }

    function action_books()
    {
        $data = $this->model->get_book();
        $this->view->generate('books_view.php', 'template_view.php', $data);
    }

}