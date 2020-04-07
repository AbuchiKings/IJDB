<?php
try {
    if (isset($_POST['joketext'])) {

        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        insert($pdo, 'joke', [
            'authorId' => 1,
            'jokeText' => $_POST['joketext'],
            'jokedate' => new DateTime()
        ]);

        header('location: jokes.php');
    } else {
        $title = 'Add a new joke';
        ob_start();
        include __DIR__ . '/../templates/addjoke.html.php';
        $output = ob_get_clean();
    }
} catch (\PDOException $e) {
    $title = 'An error has occured';
    $output = 'Error: ' .
        $e->getMessage() . ' in' . $e->getFile() . ': Line ' .
        $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';
