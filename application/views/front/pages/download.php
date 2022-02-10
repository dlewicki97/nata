<section class="downloads">
    <h2 class="page-title">Pliki do pobrania - <?= $downloads_category->title ?></h2>
    <div class="d-flex flex-column align-items-center column">


        <?php foreach ($downloads as $download) : ?>
        <a class="text-center" download <?php if ($download->link) echo 'target="_blank"'; ?>
            href="<?= $download->link ? $download->link : base_url("uploads/$download->path") ?>">
            <button class="button first-button"><?= $download->title ?></button>
        </a>
        <?php endforeach; ?>


    </div>
    <?php if (empty($downloads)) echo "Strona w budowie"; ?>
</section>