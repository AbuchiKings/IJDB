<?php if ($joke !== null && $userId !== $joke['authorid']) : ?>
    <p>You may only edit jokes that you posted.</p>

<?php else : ?>
    <form action="" method="post">
        <input type="hidden" name="joke[id]" value="<?= $joke['id'] ?? '' ?>">
        <label for="joketext">Type your joke here:
        </label>
        <textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?php if (isset($joke)) : ?>
<?= $joke['joketext'] ?>
<?php endif; ?></textarea>
        <input type="submit" name="submit" value="Save">
    </form>
<?php endif; ?>