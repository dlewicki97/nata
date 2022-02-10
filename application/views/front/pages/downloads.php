<section class="downloads">
    <h2 class="page-title">Pliki do pobrania - kategorie</h2>
    <div class="d-flex flex-column align-items-center column">

        <?php foreach ($downloads_categories as $category) : ?>

        <a class="text-center" href="<?= base_url("pliki-do-pobrania/" . slug($category->title) . "/$category->id") ?>">
            <button class="button first-button"><?= $category->title ?></button>
        </a>
        <?php endforeach; ?>

    </div>
    <?php if (empty($downloads_categories)) echo "Strona w budowie"; ?>
</section>