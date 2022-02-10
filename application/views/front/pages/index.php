    <section class="slider-container">
        <section class="slider-counter">
            <div class="element active">
                <div class="number">01</div>
                <div class="position-relative">
                    <div class="track"></div>
                    <div class="line"></div>
                </div>
            </div>
            <div class="element">
                <div class="number">02</div>
                <div class="position-relative">
                    <div class="track"></div>
                    <div class="line"></div>
                </div>
            </div>
            <div class="element">
                <div class="number">03</div>
                <div class="position-relative">
                    <div class="track"></div>
                    <div class="line"></div>
                </div>
            </div>
        </section>
        <section class="slider">
            <div class="owl-carousel">
                <?php foreach ($slider as $slide) : ?>
                <div class="slider-item d-flex flex-wrap">
                    <div class="col-12 col-lg-6 title-col">
                        <h2 class="title"><?= $slide->title ?></h2>
                        <div class="subtitle">
                            <p><?= $slide->subtitle ?></p>

                        </div>
                        <?php if ($slide->txt_btn && $slide->txt_url) : ?>
                        <a href="<?= $slide->txt_url ?>">
                            <button class="button first-button"><?= $slide->txt_btn ?></button>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-lg-6 img-col">
                        <img data-src="<?= file_url($slide->photo) ?>" alt="" class="owl-lazy img-fluid" />
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </section>
    <section class="categories">
        <h3 class="section-title"><?= $headers['categories']->title ?></h3>

        <div class="d-flex flex-wrap justify-content-between categories-row">
            <?php foreach ($categories_page as $category) : ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <a href="<?= base("sklep/kategoria/" . slug($category->title) . "/$category->id") ?>">
                    <div class="d-flex category">
                        <img data-src="<?= file_url($category->photo) ?>" alt="<?= $category->alt ?>" class="lazy">
                        <?= $category->title ?>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>

        </div>
    </section>
    <section class="recommended">
        <?php if (!empty($awarded_products)) : ?>
        <div class="first-carousel">
            <div class="d-flex flex-wrap justify-content-between">
                <h3 class="section-title"><?= $headers['recommended']->title ?></h3>
                <div class="arrows">
                    <div class="arrow-container left">
                        <img data-src="<?= file_url($icons['arrow-left-white']->photo) ?>"
                            alt="<?= $icons['arrow-left-white']->alt ?>" class="lazy" />
                    </div>
                    <div class="arrow-container mr-0 right">
                        <img data-src="<?= file_url($icons['arrow-right-white']->photo) ?>"
                            alt="<?= $icons['arrow-right-white']->alt ?>" class="lazy" />
                    </div>
                </div>
            </div>

            <div class="owl-carousel mb-5 pb-5">
                <?php foreach ($awarded_products as $awarded_product) : ?>
                <div class="product">
                    <a class="d-block p-3 bg-white"
                        href="<?= base("produkt/" . slug($awarded_product->name) . "/$awarded_product->id") ?>">
                        <div title="<?= $awarded_product->name ?>"
                            data-src="<?= is_photo_exists($awarded_product->photo) ? $awarded_product->photo : "" ?>"
                            alt="" class="bg-picture photo position-relative">
                            <?php if (!is_photo_exists($awarded_product->photo)) : ?>
                            <div class="unavailable-mask">
                                <div>BRAK ZDJĘCIA</div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </a>

                    <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                        <div class="content">

                            <div class="title"><a
                                    href="<?= base("produkt/" . slug($awarded_product->name) . "/$awarded_product->id") ?>"><?= $awarded_product->name ?></a>
                            </div>
                            <div class="price"><?= price_text($awarded_product, $awarded_product->price_brutto); ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>


            </div>
        </div>
        <?php endif; ?>

        <div class="second-carousel">
            <div class="arrows">
                <div class="arrow-container left">
                    <img data-src="<?= file_url($icons['arrow-left-white']->photo) ?>"
                        alt="<?= $icons['arrow-left-white']->alt ?>" class="lazy" />
                </div>
                <div class="arrow-container mr-0 right">
                    <img data-src="<?= file_url($icons['arrow-right-white']->photo) ?>"
                        alt="<?= $icons['arrow-right-white']->alt ?>" class="lazy" />
                </div>
            </div>
            <div class="owl-carousel">
                <?php foreach ($advertising_slider as $ad_slide) : ?>
                <img data-src="<?= file_url($ad_slide->photo) ?>" alt="<?= $ad_slide->alt ?>" class="owl-lazy" />
                <?php endforeach; ?>
            </div>
        </div>

        <div class="third-carousel mt-5">
            <div class="owl-carousel">
                <?php foreach ($advertising_slider as $ad_slide) : ?>
                <img data-src="<?= file_url($ad_slide->photo) ?>" alt="<?= $ad_slide->alt ?>" class="owl-lazy" />
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <section class="handmade">
        <h3 class="section-title"><?= $headers['handmade']->title ?></h3>
        <div class="d-flex flex-wrap">
            <div class="col-12 col-lg-7">
                <?php for ($i = 0; $i < 2; $i++) : ?>
                <div class="h-50 <?= $i === 0 ? 'pb-4' : '' ?>">
                    <div class="bg-picture lazy" title="<?= $handmades[$i]->alt ?>"
                        data-bg="<?= base_url("uploads/{$handmades[$i]->photo}") ?>">
                        <h3 class="title"><?= $handmades[$i]->title ?></h3>
                        <a href="<?= base("produkcja-wlasna/{$handmades[$i]->id}/" . slug($handmades[$i]->title)) ?>">
                            <button class="button first-button"><?= $handmades[$i]->button_name ?></button>
                        </a>
                    </div>
                </div>

                <?php endfor; ?>
            </div>
            <div class="col-12 col-lg-5 pl-0 pl-lg-4 pt-4 pt-lg-0">
                <div class="bg-picture lazy" data-bg="<?= base_url("uploads/" . end($handmades)->photo) ?>">
                    <h3 class="title"><?= end($handmades)->title ?></h3>
                    <a
                        href="<?= base("produkcja-wlasna/" . end($handmades)->id . "/" . slug(end($handmades)->title)) ?>">
                        <button class="button first-button"><?= end($handmades)->button_name ?></button>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="brands">
        <div class="d-flex flex-wrap align-items-center justify-content-between title-container">
            <div class="d-flex flex-wrap align-items-center">
                <h3 class="section-title"><?= $headers['brands']->title ?></h3>
                <input id="brand-search" type="text" class="header-input"
                    placeholder="<?= $producents_desc->search ?>" />
            </div>

            <div class="arrows">
                <div class="arrow-container left">
                    <img data-src="<?= file_url($icons['arrow-left-white']->photo) ?>"
                        alt="<?= $icons['arrow-left-white']->alt ?>" class="lazy" />
                </div>
                <div class="arrow-container mr-0 right">
                    <img data-src="<?= file_url($icons['arrow-right-white']->photo) ?>"
                        alt="<?= $icons['arrow-right-white']->alt ?>" class="lazy" />
                </div>
            </div>
        </div>
        <style>
        .owl-stage {
            margin-left: auto;
            margin-right: auto;
        }
        </style>
        <div class="owl-carousel">
            <?php foreach ($producers as $producer) : ?>
            <form id="<?= "producer-$producer->id" ?>" method="post" action="<?= base_url("shop/filters") ?>">
                <input type="hidden" name="filters" value="<?= $producer->id ?>">
                <div style="cursor: pointer" onclick="document.querySelector('#producer-<?= $producer->id ?>').submit()"
                    class="owl-lazy bg-picture" title="Szukaj w naszym sklepie produktów marki: <?= $producer->title ?>"
                    data-src="<?= file_url($producer->photo) ?>"></div>
            </form>
            <?php endforeach; ?>
        </div>
    </section>