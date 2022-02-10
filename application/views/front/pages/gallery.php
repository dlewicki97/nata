<section class="galleries">
    <h2 class="page-title"><?= $gallery->title ?></h2>
    <div class="galleries-row d-flex flex-wrap">
        <?php foreach ($images as $image) : ?>
            <a class="col-12 col-lg-4" data-lightbox="gallery" href="<?= base_url("uploads/$image->photo") ?>">
                <div class="bg lazy" data-bg="<?= base_url("uploads/$image->photo") ?>"></div>
            </a>
        <?php endforeach; ?>
    </div>
    <?php if (empty($images)) echo "Strona w budowie"; ?>

</section>