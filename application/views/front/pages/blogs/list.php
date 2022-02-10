<section class="blog">
    <h2 class="page-title"><?= $current_subpage->title ?></h2>
    <?php foreach ($blogs as $blog) : ?>
    <a href="<?= base("blog/$blog->id/" . slug($blog->title)); ?>">
        <div class="blog-row">
            <div class="col-12 col-lg-8 d-flex flex-column justify-content-between">
                <div class="content">
                    <h4 class="title"><?= $blog->title ?></h4>
                    <div class="short-description">
                        <p><?= $blog->short_desc ?></p>
                    </div>
                </div>
                <div class="date"><?= format_date($blog->created) ?></div>

            </div>
            <div class="col-12 col-lg-4">
                <img data-src="<?= file_url($blog->photo) ?>" alt="<?= $blog->alt ?>" class="lazy img-fluid">
            </div>
        </div>
    </a>
    <?php endforeach; ?>
    <?php if (empty($blogs)) echo "Strona w budowie"; ?>

</section>

<section class="pagination mt-5">
    <div class="d-flex flex-wrap justify-content-center align-items-center pagination-row">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</section>