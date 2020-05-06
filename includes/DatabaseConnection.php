<?php
$pdo = new PDO('mysql:host=localhost;dbname=homestead;
      charset=utf8', 'homestead', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// step 1
// $cat = 'CREATE TABLE IF NOT EXISTs `category` (
//       `id` INT NOT NULL AUTO_INCREMENT,
//       `name` VARCHAR(255) NULL,
//       PRIMARY KEY (`id`))';
// $pdo->exec($cat);
