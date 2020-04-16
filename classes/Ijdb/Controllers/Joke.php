<?php

namespace Ijdb\Controllers;

use \Ninja\DatabaseTable;

class Joke
{
    private $jokesTable;
    private $authorsTable;

    public function __construct(
        DatabaseTable $jokesTable,
        DatabaseTable $authorsTable
    ) {
        $this->jokesTable = $jokesTable;
        $this->authorsTable = $authorsTable;
    }

    public function home()
    {
        $title = 'Internet Joke Database';

        return ['template' => 'home.html.php', 'title' => $title];
    }

    public function list()
    {

        $jokes = $this->jokesTable->allJokes();

        $totalJokes = $this->jokesTable->total();
        $title = 'Jokes';
        return [
            'template' => 'jokes.html.php',
            'title' => $title, 'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes
            ]
        ];
    }

    public function saveEdit()
    {
        $joke = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $joke['authorId'] = 1;
        $this->jokesTable->save($joke);
        header('location: /joke/list');
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $joke = $this->jokesTable->findById($_GET['id']);
        }
        $title = 'Edit joke';
        return [
            'template' => 'editjoke.html.php',
            'title' => $title,
            'variables' => [
                'joke' => $joke ?? null
            ]
        ];
    }


    public function delete()
    {
        $this->jokesTable->delete($_POST['id']);

        header('location: /joke/list', 301);
    }
}
