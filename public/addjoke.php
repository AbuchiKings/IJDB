<?php
if (isset($_POST['joketext'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=homestead;
        charset=utf8', 'homestead', 'secret');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO `joke` SET
        `joketext` = :joketext,
        `jokedate` = CURDATE()';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->execute();

        header('location: jokes.php');
    } catch (\PDOException $e) {
        $title = 'An error has occured';
        $output = 'Database error';
    }
} else {
    $title = 'Add a new joke';
    ob_start();
    include __DIR__ . '/../templates/addjoke.html.php';
    $output = ob_get_clean();
}
include __DIR__ . '/../templates/layout.html.php';
