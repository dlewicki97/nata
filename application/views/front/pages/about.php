<section class="about-page pl-0 pr-0">
    <h2 class="page-title"><?= $current_subpage->title ?></h2>
    <?php foreach ($about as $row) : ?>
    <div class="d-flex flex-wrap mb-5 about-row">
        <div class="col-12 col-lg-6">
            <a data-lightbox="about" href="<?= file_url($row->photo); ?>">
                <div class="bg lazy" title="<?= $row->alt ?>" data-bg="<?= file_url($row->photo); ?>"></div>
            </a>
        </div>
        <div class="col-12 col-lg-6 p-4">
            <h4 class="title"><?= $row->title ?></h4>
            <div class="description">
                <?= $row->description ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($about)) echo "Strona w budowie"; ?>
</section>