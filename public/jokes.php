<?php
try {
    $pdo = new PDO(
        'mysql: host=localhost;dbname=homestead;charset=utf8',
        'homestead',
        'secret'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'CREATE TABLE IF NOT EXISTS joke(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        joketext TEXT,
        jokedate DATE NOT NULL
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

    $getAll = 'SELECT `joketext` FROM `joke`';

    $pdo->exec($sql);
    $result = $pdo->query($getAll);

    // while ($row = $result->fetch()) {
    //     $jokes[] = $row['joketext'];
    // }

    foreach ($result as $row) {
        $jokes[] = $row['joketext'];
    }

    $title = 'Jokes';
    ob_start();
    include __DIR__ . '/../templates/jokes.html.php';
    $output = ob_get_clean();
} catch (\Throwable $e) {
    $title = 'An error has occured';
    $output = 'Error: Unable to connect to the db ' .
        $e->getMessage() . ' in' . $e->getFile() . ': Line ' .
        $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';

// $add = 'INSERT INTO `joke` VALUES 
// (1,'How many programmers does it take to screw in a lightbulb? None, it\'s a hardware problem.','2017-04-01',1),
// (2,'Why did the programmer quit his job? He didn\'t get arrays','2017-04-01',1),
// (3,'Why was the empty array stuck outside? It didn\'t have any keys','2017-04-01',2)'
