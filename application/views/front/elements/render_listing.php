<style>
.label.news {
    background-color: var(--first-color);
}

.label.promotion {
    background-color: #19a299;
}

.label.outlet {
    background-color: #c36161;
}

.labels {
    position: absolute;
    top: 0;
    left: 0;
    margin-top: 0.5rem;
}

.label {
    font-weight: 700;
    color: white;
    font-size: 0.7rem;
    padding: 0.1rem 0.7rem;
    text-align: center;
    margin: 0 0.5rem;
    margin-bottom: 0.4rem;
}
</style>
<section class="sort">
    <h2 class="title"><?= $products_desc->title ?></h2>
    <div class="double-slider-container mb-3">
        <h6 class="sort-title"><?= $products_desc->price ?></h6>
        <div class="d-flex align-items-center mr-2">
            <input id="price-range-min" class="price-input mx-0" aria-label="min" type="text" name="price_min"
                min-price="0" />
            <div id="price-slider"></div>
            <input id="price-range-max" class="price-input mx-0" aria-label="text" type="text" name="price_max"
                max-price="<?= ceil($max_price->price_brutto); ?>" />
        </div>
        <button id="price-sort-button" class="button first-button mr-2">Filtruj po cenie</button>
        <button type="submit"
            onclick="document.querySelector('#filters-input').value = ''; document.querySelector('#filters-form').submit()"
            class="button first-button clear-filters">Wyczyść filtry</button>
    </div>
    <div class="sort-type-container mb-3">
        <h6 class="sort-title"><?= $products_desc->sort_by ?> </h6>
        <select id="sortBy" class="sort-select" onchange="sort()">
            <option value="" disabled selected></option>
            <option <?php if (isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'price|ASC') {
                        echo 'selected';
                    } ?> value="price|ASC"><?= $products_desc->cheapest ?></option>
            <option <?php if (isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'price|DESC') {
                        echo 'selected';
                    } ?> value="price|DESC"><?= $products_desc->most_expensive ?></option>
            <option <?php if (isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'updated|DESC') {
                        echo 'selected';
                    } ?> value="updated|DESC"><?= $products_desc->created_date ?></option>
            <option <?php if (isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'priority|ASC') {
                        echo 'selected';
                    } ?> value="priority|ASC"><?= $products_desc->popularity ?></option>
            <option <?php if (isset($_COOKIE['sort']) && $_COOKIE['sort'] == 'name|ASC') {
                        echo 'selected';
                    } ?> value="name|ASC"><?= $products_desc->alphabetical ?></option>
        </select>
    </div>
    <div class="layout-switch mb-3">
        <div class="switch columns active">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                <g>
                    <g>
                        <g>
                            <path d="M0 9V0h9v9z" />
                        </g>
                        <g>
                            <path d="M13 9V0h9v9z" />
                        </g>
                        <g>
                            <path d="M13 22v-9h9v9z" />
                        </g>
                        <g>
                            <path d="M0 22v-9h9v9z" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <div class="switch rows">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21">
                <g>
                    <g>
                        <g>
                            <path d="M0 5V0h22v5z" />
                        </g>
                        <g>
                            <path d="M0 13V8h22v5z" />
                        </g>
                        <g>
                            <path d="M0 21v-5h22v5z" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</section>
<section class="sort mt-4">
    <div class="used-filters">
        <div class="title" style="width: unset"><?= $products_desc->used_filters ?></div>
        <div class="tags">
            <?php if (!empty($filters_cookie)) : ?>
            <?php foreach ($filters_cookie as $tag) : ?>
            <?php if (is_null($tag)) continue; ?>
            <div id="tag-<?= $tag->id ?>" class="tag"><?= $tag->title ?>
                <span class="dismiss">x</span>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>
<?php if ($_COOKIE['search'] ?? false) : ?>
<section class="search-info">
    <h2>Wyszukiwanie po frazie: <i><?= "\"{$_COOKIE['search']}\""; ?></i> <a
            href="<?= base_url('usun-wyszukiwanie'); ?>" style="display: inline-block"
            class="button first-button ml-3 px-2"><span class="dismiss" style="font-size: 2rem">x</span></a></h2>
</section>
<?php endif; ?>
<section id="products" class="listing">
    <?php if ($count_products === 0) : echo $products_desc->products_lack_alert; ?>
    <?php else : ?>
    <?php
        $i = 0;
        do {
            $productLink = base_url('produkt/' . slug($rows[$i]->name) . '/' . $rows[$i]->id); ?>
    <div class="col-12 col-md-3">
        <div class="product" style="position:relative">
            <div class="listing-photo-container position-relative">
                <div class="unavailable-mask" style="height: 85%; z-index: 0;">
                    <div>BRAK ZDJĘCIA</div>
                </div>
                <div data-bg="<?= $rows[$i]->photo_min; ?>" title="<?= $rows[$i]->alt ?>" class="bg photo lazy"
                    style="background-color: unset">
                    <a href="<?= $productLink; ?>" class="anchor_to_product product-show-link">
                        <?php if ($this->back_m->get_where('variants', 'product_id', $rows[$i]->id)->qty <= 0) : ?>
                        <div class="unavailable-mask">
                            <div><?= $products_desc->product_lack ?></div>
                        </div>
                        <?php endif; ?>
                        <?php if (isset($_COOKIE['favouriteProducts']) && in_array($rows[$i]->id, json_decode($_COOKIE['favouriteProducts']))) {
                                    $href = base_url('usun_z_ulubionych/' . $rows[$i]->id);
                                    $img = assets() . 'img/listing/heart.svg';
                                    $title = 'Usuń produkt z ulubionych';
                                } else {
                                    $href = base_url('dodaj_do_ulubionych/' . $rows[$i]->id);
                                    $img = assets() . 'img/listing/heart-outline.svg';
                                    $title = 'Dodaj produkt do ulubionych';
                                } ?>
                        <div class="heart-container">
                            <a href="<?= $href; ?>">
                                <img src="<?= $img; ?>" alt="<?= $title; ?>" title="<?= $title; ?>" class="heart">
                            </a>
                        </div>
                        <div class="labels">
                            <?php if ($rows[$i]->news) : ?>
                            <div class="label news">
                                <?= $products_desc->news ?>
                            </div>
                            <?php endif; ?>
                            <?php if ($rows[$i]->promo_active) : ?>
                            <div class="label promotion">
                                <?= $products_desc->promo_active ?>
                            </div>
                            <?php endif; ?>
                            <?php if ($rows[$i]->outlet) : ?>
                            <div class="label outlet">
                                <?= $products_desc->outlet ?>
                            </div>
                            <?php endif; ?>
                        </div>
                </div>
            </div>
            </a>
            <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                <div class="content">
                    <div class="title"><a class="product-show-link"
                            href="<?= $productLink; ?>"><?= $rows[$i]->name; ?></a>
                    </div>
                    <div class="price"><?= price_text($rows[$i], $rows[$i]->price_brutto); ?></div>
                    <div class="price_gross d-none"><?= price($rows[$i], $rows[$i]->price_brutto * 100, 0); ?></div>
                </div>

            </div>
        </div>
    </div>
    <?php
            $i++;
        } while (count($rows) > $i);
        ?>
    <?php endif; ?>
</section>
<section class="pagination align-items-center my-5">
    <div class="d-flex align-items-center mb-2 mb-sm-0 result-container">
        <form action="<?= base_url() ?>"></form>
        <select name="per_page" id="perPage" class="sort-select pr-1 mr-2" onchange="productsPerPage()">
            <option <?php if (isset($_COOKIE['perPage']) && $_COOKIE['perPage'] == '16') {
                        echo 'selected';
                    } ?> value="16">16</option>
            <option <?php if (isset($_COOKIE['perPage']) && $_COOKIE['perPage'] == '32') {
                        echo 'selected';
                    } ?> value="32">32</option>
            <option <?php if (isset($_COOKIE['perPage']) && $_COOKIE['perPage'] == '96') {
                        echo 'selected';
                    } ?> value="96">96</option>
        </select>
        <span><?= $products_desc->results_per_page ?></span>
    </div>

    <style>
    section.pagination .pagination-row strong,
    section.pagination .pagination-row a {
        background-color: #383d47;
        width: fit-content;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s all;
        font-size: 1rem;
        color: white;
        cursor: pointer;
    }

    section.pagination strong {
        background-color: #19a299 !important;
    }

    section.pagination a,
    section.pagination strong {
        margin-right: 0.3rem;
    }

    section.pagination strong {
        font-weight: 300;
    }

    section.pagination .pagination-row img,
    section.pagination .pagination-row img {
        height: 15px;
    }

    section.pagination .pagination-row .invert,
    section.pagination .pagination-row .invert {
        filter: invert(1);
    }
    </style>

    <div class="d-flex flex-wrap justify-content-center pagination-row align-items-center mb-2 mb-sm-0">
        <?php echo $this->pagination->create_links(); ?>
    </div>
    <span class="desc">
        <?= $count_products; ?> <?= $products_desc->products_count ?>
    </span>
</section>
<script type="text/javascript" src="<?= assets() ?>js/listing/double-slider/nouislider.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/listing/double-slider/wNumb.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.1/dist/lazyload.min.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/listing/layout-switch/switcher.js"></script>

<script>
let productShowLinks = document.querySelectorAll('.product-show-link');
productShowLinks.forEach(link => link.addEventListener('click', e => {
    setCookie('productShow', 1);
}))
</script>