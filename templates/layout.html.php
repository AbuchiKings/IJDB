<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="jokes.css">
    <title><?= $title; ?></title>
</head>

<body>
    <header>
        <h1>Internet Joke Database</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="jokes.php">Jokes</a></li>
        </ul>
    </nav>

    <main>
        <?php echo $output; ?>
    </main>

    <footer>
        &copy; IJDB <?php echo date('Y'); ?>
    </footer>
</body>

</html>