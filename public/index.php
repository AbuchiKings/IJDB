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
    $jokes = $pdo->query($getAll);

    $output = 'Connected to the db';
} catch (\Throwable $e) {
    $output = 'Error: Unable to connect to the db ' .
        $e->getMessage() . ' in' . $e->getFile() . ': Line ' .
        $e->getLine();
}

include __DIR__ . '/../templates/output.html.php';

// $add = 'INSERT INTO `joke` VALUES 
// (1,'How many programmers does it take to screw in a lightbulb? None, it\'s a hardware problem.','2017-04-01',1),
// (2,'Why did the programmer quit his job? He didn\'t get arrays','2017-04-01',1),
// (3,'Why was the empty array stuck outside? It didn\'t have any keys','2017-04-01',2)'
