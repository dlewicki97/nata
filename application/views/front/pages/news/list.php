<section class="news">
    <h2 class="page-title"><?= $current_subpage->title ?></h2>
    <?php foreach ($news as $info) : ?>
    <a href="<?= base("aktualnosci/$info->id/" . slug($info->title)); ?>">
        <div class="news-row">
            <div class="col-12 col-lg-8">
                <div class="content">
                    <h4 class="title"><?= $info->title ?></h4>
                    <div class="short-description">
                        <p><?= $info->short_desc ?></p>
                    </div>
                </div>
                <div class="date"><?= format_date($info->created) ?></div>

            </div>
            <div class="col-12 col-lg-4">
                <img data-src="<?= file_url($info->photo) ?>" alt="<?= $info->alt ?>" class="lazy img-fluid">
            </div>
        </div>
    </a>
    <?php endforeach; ?>
    <?php if (empty($news)) echo "Strona w budowie"; ?>

</section>

<section class="pagination mt-5">
    <div class="d-flex flex-wrap justify-content-center align-items-center pagination-row">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</section>