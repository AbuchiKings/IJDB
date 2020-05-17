<div>
    <ul class="categories">
        <?php
        foreach ($categories as $category) :
        ?>
            <li>
                <a href="/joke/list?category=<?= $category->id ?>">
                    <?= $category->name ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <BR></BR>
    <p><?= $totalJokes ?> jokes have been submitted to the Internet Joke Database.</p>

    <?php foreach ($jokes as $joke) : ?>
        <blockquote>

            <?php
            $markdown = new \Ninja\Markdown($joke->joketext);
            echo $markdown->toHtml();
            ?>
            <p> (by <a href="mailto:<?php
                                    echo htmlspecialchars($joke->getAuthor()->email, ENT_QUOTES, 'UTF-8');
                                    ?>">
                    <?php
                    echo htmlspecialchars($joke->getAuthor()->name, ENT_QUOTES, 'UTF-8');
                    ?></a> on <?php
                                $date = new DateTime($joke->jokedate);

                                echo $date->format('jS F Y');
                                ?> )
                <?php if ($user) : ?>
                    <?php if (
                        $user->id == $joke->authorid ||
                        $user->hasPermission(\Ijdb\Entity\Author::EDIT_JOKES)
                    ) : ?>
                        <a href="/joke/edit?id=<?= $joke->id ?>">
                            Edit</a>
                    <?php endif; ?>
                    <?php if (
                        $user->id == $joke->authorid ||
                        $user->hasPermission(\Ijdb\Entity\Author::DELETE_JOKES)
                    ) :
                    ?>
                        <form action="/joke/delete" method="post">
                            <input type="hidden" name="id" value="<?= $joke->id ?>">
                            <input type="submit" value="Delete">
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </p>
        </blockquote>
    <?php endforeach; ?>
    Select page:
    <?php
    //Calculate the total number of pages
    $numPages = ceil($totalJokes / 3);

    // Display link to each page
    for ($i = 1; $i <= $numPages; $i++) :
        if ($i == $currentPage) : ?>
            <a class="currentpage" href="/joke/list?page=<?= $i ?>"><?= $i ?></a>
        <?php else : ?>
            <a href="/joke/list?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>