<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    delete($pdo, 'joke', 'id', $_POST['id']);
    
    header('location: jokes.php', $http_response_code = 200);
} catch (\Throwable $e) {
    $title = 'An error has occured';
    $output = 'Error: ' .
        $e->getMessage() . ' in' . $e->getFile() . ': Line ' .
        $e->getLine();
}
