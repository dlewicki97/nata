<?php
if (isset($_COOKIE['lastWatchedProduct'])) : ?>
<div class="carousel-container">
    <div class="arrows">
        <div class="arrow-container left mr-0">
            <img data-src="<?= assets(); ?>img/main/arrow-left.svg" alt="" class="lazy">
        </div>
        <div class="arrow-container right mr-0">
            <img data-src="<?= assets(); ?>img/main/arrow-right.svg" alt="" class="lazy">
        </div>
    </div>
    <div class="owl-carousel owl-carousel1">
        <?php foreach ($last_watched_products as $last_watched_product) :
                if (!empty($last_watched_product) && $last_watched_product->id != $product->id) : ?>
        <div class="product">
            <a
                href="<?= base_url('produkt/' . slug($last_watched_product->name) . '/' . $last_watched_product->id); ?>">
                <div data-src="<?= $last_watched_product->photo; ?>" title="<?= $last_watched_product->alt; ?>"
                    class="owl-lazy bg photo position-relative">
                    <div class="unavailable-mask" style="height: 100%!important;">
                        <div>BRAK ZDJĘCIA</div>
                    </div>
                </div>
            </a>
            <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                <div class="content">
                    <div class="title"><a
                            href="<?= base_url('produkt/' . slug($last_watched_product->name) . '/' . $last_watched_product->id); ?>"><?= $last_watched_product->name; ?></a>
                    </div>
                    <div class="price"><?= price_text($last_watched_product, $last_watched_product->price_brutto); ?>
                    </div>
                </div>

            </div>
        </div>
        <?php endif;
            endforeach; ?>
    </div>
</div>
<?php endif; ?>