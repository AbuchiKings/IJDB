<?php

namespace Ijdb\Controllers;

use Ninja\Authentication;
use \Ninja\DatabaseTable;

class Joke
{
    private $jokesTable;
    private $authorsTable;
    private $categoriesTable;
    private $authentication;

    public function __construct(
        DatabaseTable $jokesTable,
        DatabaseTable $authorsTable,
        DatabaseTable $categoriesTable,
        Authentication $authentication
    ) {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
        $this->categoriesTable = $categoriesTable;
        $this->authentication = $authentication;
    }

    public function home()
    {
        $title = 'Internet Joke Database';

        return ['template' => 'home.html.php', 'title' => $title];
    }

    public function list()
    {

        if (isset($_GET['category'])) {
            $category = $this->categoriesTable->findById($_GET['category']);
            $jokes = $category->getJokes();
        } else {
            $jokes = $this->jokesTable->findAll();
        }

        $title = 'Jokes';
        // $jokes = [];
        // foreach ($result as $joke) {
        //     $author = $this->authorsTable->findById($joke->authorid);
        //     $jokes[] = [
        //         'id' => $joke->id,
        //         'joketext' => $joke->joketext,
        //         'jokedate' => $joke->jokedate,
        //         'name' => $author->name,
        //         'email' => $author->email,
        //         'authorId' => $joke->authorid

        //     ];
        // }
        $totalJokes = $this->jokesTable->total();

        $author = $this->authentication->getUser();
        return [
            'template' => 'jokes.html.php',
            'title' => $title, 'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes,
                'userId' => $author->id ?? null,
                'categories' => $this->categoriesTable->findAll()
            ]
        ];
    }

    public function saveEdit()
    {
        $author = $this->authentication->getUser();

        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $jokeEntity = $author->addJoke($joke);
        foreach ($_POST['category'] as $categoryId) {
            $jokeEntity->addCategory($categoryId);
        }
        header('location: /joke/list');
    }

    public function edit()
    {
        $author = $this->authentication->getUser();
        $categories = $this->categoriesTable->findAll();
        if (isset($_GET['id'])) {
            $joke = $this->jokesTable->findById($_GET['id']);
        }
        $title = 'Edit joke';
        return [
            'template' => 'editjoke.html.php',
            'title' => $title,
            'variables' => [
                'joke' => $joke ?? null,
                'userId' => $author->id ?? null,
                'categories' => $categories
            ]
        ];
    }


    public function delete()
    {
        $author = $this->authentication->getUser();
        $joke = $this->jokesTable->findById($_POST['id']);
        if ($joke->authorid != $author->id) {
            return;
        }
        $this->jokesTable->delete($_POST['id']);

        header('location: /joke/list', 301);
    }
}
