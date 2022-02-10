<section class="partners pl-0 pr-0">
    <h2 class="page-title"><?= $current_subpage->title ?></h2>
    <div class="d-flex flex-wrap">
        <?php foreach ($partners as $partner) : ?>
        <div class="col-12 col-lg-4 partner-col p-4">
            <a target="_blank" href="<?= $partner->link ?>">
                <div class="bg lazy" title="<?= $partner->alt ?>" data-bg="<?= file_url($partner->photo) ?>"></div>

                <h4 class="title"><?= $partner->title ?></h4>
                <div class="subtitle">
                    <?= $partner->subtitle ?>
                </div>
            </a>

        </div>
        <?php endforeach; ?>

        <?php if (empty($partners)) echo "Strona w budowie"; ?>
    </div>
</section>