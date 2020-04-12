<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/jokes.css">
    <link rel="stylesheet" href="/form.css">
    <title><?= $title; ?></title>
</head>

<body>
    <header>
        <h1>Internet Joke Database</h1>
    </header>

    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/joke/list">Jokes</a></li>
            <li><a href="/joke/edit">Add Joke</a></li>
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