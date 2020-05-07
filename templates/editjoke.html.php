<?php if ($joke !== null && $userId !== $joke->authorid) : ?>
    <p>You may only edit jokes that you posted.</p>

<?php else : ?>
    <form action="" method="post">
        <input type="hidden" name="joke[id]" value="<?= $joke->id ?? '' ?>">
        <label for="joketext">Type your joke here:
        </label>
        <textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?php if (isset($joke)) : ?>
<?= $joke->joketext ?>
<?php endif; ?></textarea>

        <p>Select categories for this joke:</p>
        <?php foreach ($categories as $category) : ?>
            <input type="checkbox" name="category[]" value="<?= $category->id ?>" />
            <label><?= $category->name ?></label>
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Save">
    </form>
<?php endif; ?>