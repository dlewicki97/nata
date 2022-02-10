<section class="galleries">
    <h2 class="page-title"><?= $current_subpage->title ?></h2>
    <div class="galleries-row d-flex flex-wrap w-100">
        <?php foreach ($galleries as $gallery) : ?>
            <a class="col-12 col-lg-4 p-3" href="<?= base("galeria/" . slug($gallery->title)) . "/$gallery->id"; ?>">
                <div class="bg lazy" data-bg="<?= base_url("uploads/$gallery->photo") ?>"></div>
                <h4 class="title"><?= $gallery->title ?></h4>


            </a>
        <?php endforeach; ?>
    </div>
    <?php if (empty($galleries)) echo "Strona w budowie"; ?>

</section>