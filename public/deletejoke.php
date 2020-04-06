<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    $xen;
    $sql = 'DELETE FROM `joke` WHERE `id` = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_POST['id']);
    $stmt->execute();
    header('location: jokes.php', $http_response_code = 200);
} catch (\Throwable $e) {
    $title = 'An error has occured';
    $output = 'Error: Unable to connect to the db ' .
        $e->getMessage() . ' in' . $e->getFile() . ': Line ' .
        $e->getLine();
}
