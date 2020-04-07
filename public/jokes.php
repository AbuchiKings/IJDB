<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';

    include __DIR__ . '/../includes/DatabaseFunctions.php';

    $sql = 'CREATE TABLE IF NOT EXISTS joke(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        joketext TEXT,
        jokedate DATE NOT NULL 
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

    $users = 'CREATE TABLE IF NOT EXISTS author(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255),
        `email` VARCHAR(255)
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

    $pdo->exec($sql);
    $pdo->exec($users);

    $jokes = allJokes($pdo);


    // while ($row = $result->fetch()) {
    //     $jokes[] = $row['joketext'];
    // }
    $totalJokes = totalJokes($pdo);
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


// $addAuthor = 'INSERT INTO `author` (`id`, `name`, `email`)
// VALUES (1, "Tom Butler", "tombutler@email.com"),
// (2, "Abuchi Kings", "abuchikings@email.com")';

 //$alter = 'ALTER TABLE `joke` DROP COLUMN `authorname`';
 //$alter = 'ALTER TABLE `joke` ADD COLUMN `authorid` INT';
 //$pdo->exec($alter);
 //$pdo->exec($addAuthor);
// $add = 'INSERT INTO `joke` VALUES 
// (1,'How many programmers does it take to screw in a lightbulb? None, it\'s a hardware problem.','2017-04-01',1),
// (2,'Why did the programmer quit his job? He didn\'t get arrays','2017-04-01',1),
// (3,'Why was the empty array stuck outside? It didn\'t have any keys','2017-04-01',2)'
