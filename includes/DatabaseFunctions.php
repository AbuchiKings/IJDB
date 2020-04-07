<?php
include __DIR__ . '/./DatabaseConnection.php';

function query($pdo, $sql, $parameters = [])
{
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function totalJokes($pdo)
{
    $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');
    $row = $query->fetch();
    return $row[0];
}

function getJoke($pdo, $id)
{
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
    return $query->fetch();
}

function insertJoke($pdo, $joketext, $authorid)
{
    $sql = 'INSERT INTO `joke`(`joketext`, jokedate, `authorid`)
    VALUES (:joketext, CURDATE(), :authorid)';
    //$date = date('Y') . '-' . date('m') . '-' . date('d');
    $parameters = [':joketext' => $joketext, ':authorid' => $authorid];
    query($pdo, $sql, $parameters);
}

function updateJoke($pdo, $jokeId, $joketext, $authorid)
{
    $parameters = [':authorid' => $authorid, ':joketext' => $joketext, ':id' => $jokeId];
    $sql =  'UPDATE `joke` SET `authorid` = :authorid, `joketext` = :joketext WHERE `id` = :id';
    query($pdo, $sql, $parameters);
}

function deleteJoke($pdo, $id)
{
    $parameters = [':id' => $id];
    $sql = 'DELETE FROM `joke` WHERE `id` = :id';
    query($pdo, $sql, $parameters);
}
