<section class="blog single-blog">
    <a data-lightbox="info" href="<?= file_url($blog->photo) ?>">
        <div class="bg lazy main-photo" title="<?= $blog->alt ?>" data-bg="<?= file_url($blog->photo) ?>"></div>
    </a>

    <div class="blog-row" style="box-shadow: 2px 11px 54px -21px #8c8c8c; cursor: default">
        <div class="content">
            <h4 class="title"><?= $blog->title ?></h4>
            <div class="short-description">
                <p><?= $blog->short_desc ?></p>
            </div>
        </div>
        <div class="date"><?= format_date($blog->created) ?></div>

        <div class="description">
            <?= $blog->description ?>
        </div>

        <div class="d-flex flex-wrap w-100">
            <?php foreach ($gallery as $photo) : ?>
            <div class="col-12 col-lg-4 p-3">
                <a data-lightbox="info" href="<?= file_url($photo->photo) ?>">
                    <div class="bg lazy gallery-photo" title="<?= $photo->alt ?>"
                        data-bg="<?= file_url($photo->photo) ?>"></div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>