<style>
@media (max-width: 992px) {
    .mobile-dodaj-do-koszyka {
        width: 100% !important;
        justify-content: center;
    }
}
</style>

<section class="product-head">
    <div class="photos-container">


        <a class="main-photo position-relative" data-lightbox="photos" href="<?= $product->photo; ?>">
            <div class="unavailable-mask" style="height: 85%; z-index: 0;">
                <div>BRAK ZDJĘCIA</div>
            </div>
            <div class="bg lazy position-relative" data-bg="<?= $product->photo; ?>" title="<?= $product->alt; ?>">
            </div>
        </a>

        <div class="variants">
            <h3 class="variant-title">Warianty:</h3>
            <div class="d-flex flex-wrap">
                <?php foreach ($variants as $variant) : ?>
                <div class="variant" data-original-title="Kliknij, aby przejść do wariantu!" data-toggle="popover"
                    data-content="<?= $variant->name ?>">
                    <a class="position-relative"
                        href="<?= base_url("produkt/" . slug($variant->name) . "/$variant->id") ?>">
                        <div class="unavailable-mask" style="z-index: 0">
                            <div>BRAK ZDJĘCIA</div>
                        </div>
                        <div class="bg lazy position-relative" data-bg="<?= $variant->photo_min; ?>"></div>
                    </a>
                </div>
                <?php endforeach; ?>

                <?php if (!$variants) echo "<h5>Ten produkt nie posiada wariantów lub są one dostępne jako osobny produkt w sklepie.</h5>"; ?>
            </div>
        </div>


    </div>
    <form id="submit_product" method="post" action="<?= base_url('dodaj_do_koszyka/' . $product->id); ?>"
        class="actions-container">
        <div class="labels">
            <?php if ($product->promo_active == 1) : ?>
            <div class="label orange"><?= $products_desc->promotion ?></div>
            <?php endif; ?>
            <?php if ($product->news == 1) : ?>
            <div class="label turquise"><?= $products_desc->news ?></div>
            <?php endif; ?>
            <?php if ($product->outlet == 1) : ?>
            <div class="label red"><?= $products_desc->outlet ?></div>
            <?php endif; ?>
        </div>
        <?php if ($producer) : ?>
        <div class="producer mt-3">
            <img data-src="<?= base_url('uploads/' . $producer->photo); ?>" alt="<?= $producer->title; ?>"
                class="lazy product-logo producer-img">
        </div>
        <?php endif; ?>
        <div class="titles">
            <div class="category">
                <?php foreach ($categories as $i => $category) echo remove_subcategory_prefix($category->title) . ($i == count($categories) - 1 ? '' : ', '); ?>
            </div>
            <h3 class="title"><?= $product->name; ?></h3>
        </div>
        <div class="details">

            <div class="detail">
                <span><b>Producent</b></span>
                <span><?= $producer->title ?? "-" ?></span>
            </div>
            <div class="detail">
                <span><b><?= $products_desc->shipping_price ?></b></span>
                <span><?= $products_desc->from_word ?> <?= single_price_cart($product->delivery_cost); ?></span>
            </div>
            <!-- <div class="detail">
                <span><b><?= $products_desc->availability ?></b></span>
                <span>
                    <?php if ($product_variant->qty == 0) : ?>
                    <div class="available-dot bg-danger"></div>
                    <?= $products_desc->product_inaccessible ?>
                    <?php elseif ($product->low_qty < $product_variant->qty) : ?>
                    <div class="available-dot"></div>
                    <?= $products_desc->big_amount ?>
                    <?php elseif ($product->low_qty >= $product_variant->qty) : ?>
                    <div class="available-dot bg-warning"></div>
                    <?= $products_desc->low_amount ?>
                    <?php endif; ?>
                </span>
            </div> -->
            <?php if ($product->opakowanie ?? null) : ?>
            <div class="detail">
                <span><b>Ilość sztuk w opakowaniu</b></span>
                <span><?= intval($product->opakowanie); ?> szt.</span>
            </div>
            <?php endif; ?>
            <?php if ($product->karton ?? null) : ?>
            <div class="detail">
                <span><b>Ilość sztuk w kartonie</b></span>
                <span><?= intval($product->karton); ?> szt.</span>
            </div>
            <?php endif; ?>
            <?php if ($product->weight ?? null) : ?>
            <div class="detail">
                <span><b>Waga jednostkowa</b></span>
                <span><?= $product->weight; ?> kg</span>
            </div>
            <?php endif; ?>
            <?php if ($product->weight_opak ?? null) : ?>
            <div class="detail">
                <span><b>Waga opakowania</b></span>
                <span><?= $product->weight_opak; ?> kg</span>
            </div>
            <?php endif; ?>
        </div>
        <div class="price-container">
            <div class="price"><?= price_text($product, $product->price_brutto); ?></div>
            <div class="amount-counter">
                <button id="decrease" type="button">-</button>
                <div id="amount">
                    <input id="field-amount-input" class="amount-input" type="number" name="qty" value="1" min="0"
                        max="<?= $product_variant->qty; ?>">
                </div>
                <button id="increase" type="button">+</button>
                <input type="hidden" id="amount-input" value="1" name="amount">
            </div>
        </div>
        <div class="d-lg-flex d-block text-center mt-2">

            <?php if ($product_variant->qty != 0 && intval($product->opakowanie) != 1 && in_array(NULL, [$product->opakowanie, $product->karton])) : ?>
            <button class="first-button button mb-3 mb-lg-0 mobile-dodaj-do-koszyka" type="submit">
                <img data-src="<?= assets(); ?>img/main/recommended/cart.svg" alt="" class="lazy">
                <?= $products_desc->add_to_cart_button_name ?> 1 szt.
            </button>

            <?php endif; ?>

            <?php if ($product->opakowanie ?? null && $product->karton ?? null) : ?>
            <?php if ($product->opakowanie ?? null) : ?>
            <button class="first-button button mb-3 mb-lg-0 mobile-dodaj-do-koszyka" type="button"
                onclick="setAutoQty('<?= $product->opakowanie; ?>')">
                <img data-src="<?= assets(); ?>img/main/recommended/cart.svg" alt="" class="lazy">
                <?= $products_desc->add_to_cart_button_name ?> +<?= intval($product->opakowanie); ?> szt. (opakowanie)
            </button>
            <?php endif; ?>

            <?php if ($product->karton ?? null) : ?>
            <button class="first-button button mb-3 mb-lg-0 mobile-dodaj-do-koszyka" type="button"
                onclick="setAutoQty('<?= $product->karton; ?>')">
                <img data-src="<?= assets(); ?>img/main/recommended/cart.svg" alt="" class="lazy">
                <?= $products_desc->add_to_cart_button_name ?> +<?= intval($product->karton); ?> szt. (karton)
            </button>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (isset($_COOKIE['favouriteProducts']) && in_array($product->id, json_decode($_COOKIE['favouriteProducts']))) {
                $href = base_url('usun_z_ulubionych/' . $product->id);
                $img = assets() . 'img/single-product/heart-white.svg';
                $title = 'Usuń produkt z ulubionych';
            } else {
                $href = base_url('dodaj_do_ulubionych/' . $product->id);
                $img = assets() . 'img/single-product/heart-outline-white.svg';
                $title = 'Dodaj produkt do ulubionych';
            } ?>

            <a href="<?= $href; ?>">
                <div class="heart-container mobile-dodaj-do-koszyka">
                    <img data-src="<?= $img; ?>" alt="<?= $title; ?>" title="<?= $title; ?>" class="lazy heart">
                </div>
            </a>
        </div>

    </form>
</section>
<?php if ($product_variant->qty == 0) : ?>
<section class="reminder">
    <div class="reminder-container">
        <label for="email-reminder">Podaj Twój adres e-mail, a poinformujemy Cię kiedy produkt się
            pojawi!</label>
        <form id="reminder-form" class="reminder-form" method="post" action="<?= base_url("produkt-przypomnienie") ?>">
            <div class="reminder-inputs">
                <input id="email-reminder" type="text" name="email" placeholder="Adres E-mail"
                    class="header-input w-100">
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <button type="submit" class="button first-button">Wyślij</button>
            </div>
            <div class="custom-control custom-checkbox p-0 mt-3">
                <input type="checkbox" id="rodo1remainder" required class="form-check-input" name="rodo1">
                <label class="form-check-label text-white checkbox-label" for="rodo1remainder">
                    <span class="show-rodo">
                        <small><?= $settings->rodo ?></small>
                    </span>
                </label>
            </div>
            <div class="custom-control custom-checkbox p-0">
                <input type="checkbox" id="rodo2remainder" required class="form-check-input" name="rodo2">
                <label class="form-check-label text-white checkbox-label" for="rodo2remainder">
                    <span class="show-rodo">
                        <small><?= $settings->rodo_tel ?></small>
                    </span>
                </label>
            </div>
        </form>
    </div>
</section>
<?php endif; ?>
<section class="product-body">
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel1"
                role="tab"><?= $products_desc->description ?></a>
        </li>
        <?php if (isset($_SESSION['id'])) : ?>
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#panel2" role="tab"><?= $products_desc->opinions ?></a>
        </li>
        <?php else : ?>
        <li id="opinionLogin" class="nav-item" data-toggle="popover" title="Zaloguj się"
            data-content="Musisz się zalogować, żeby dodać opinie.">
            <a class="nav-link " href="<?= base_url('logowanie') ?>"><?= $products_desc->opinions ?></a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel3" role="tab"><?= $products_desc->ask_for_product ?></a>
        </li>
    </ul>
    <div class="tab-content card">
        <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
            <div class="d-flex flex-wrap justify-content-between">
                <div class="col-12 col-lg-7">
                    <h5 class="desc-title"><?= $product->name; ?></h5>
                    <div class="desc-list">
                        <?= $product->description; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <?php if ($product->add_desc || !$product->id_commodity) : ?>
                    <div class="additional-list">
                        <?php if ($product->linia ?? null) : ?>
                        <h5 class="title">LINIA</h5>
                        <div class="item"><?= $product->linia; ?></div>
                        <?php endif; ?>
                        <?php if ($product->grupa ?? null) : ?>
                        <h5 class="title">GRUPA</h5>
                        <div class="item"><?= $product->grupa; ?></div>
                        <?php endif; ?>
                        <?php if (!$product->id_commodity) : ?>
                        <?php foreach ($filters as $filter) : ?>
                        <h5 class="title"><?= $filter->title ?></h5>
                        <div class="item">
                            <?= ($filter_data = trim(implode(', ', array_map(function ($products_filter) {
                                            return $products_filter->title;
                                        }, $products_filters[$filter->id])), " \n\r\t\v\0,")) ? $filter_data : '-' ?>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?= $product->add_desc; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['id'])) : ?>
        <div class="tab-pane fade in" id="panel2" role="tabpanel">
            <?php $this->load->view('front/elements/opinion_section', $product); ?>
        </div>
        <?php endif; ?>
        <div class="tab-pane fade in" id="panel3" role="tabpanel">
            <div class="question-container">
                <div class="d-flex align-items-center justify-content-center mb-4">
                </div>
                <div class="d-flex flex-wrap flex-column">
                    <div class="d-flex flex-wrap justify-content-center">
                        <img class="lazy modal-main-photo" data-src="<?= $product->photo; ?>">
                        <div class="d-flex justify-content-center flex-column">
                            <h4 class="product-cat">
                                <?php foreach ($categories as $i => $category) echo $category->title . ($i == count($categories) - 1 ? '' : ', '); ?>
                            </h4>
                            <h3 class="product-name"><?= $product->name; ?></h3>
                        </div>
                    </div>
                    <form id="opinion-form" method="post" action="<?= base_url('zapytaj_o_produkt'); ?>"
                        class="modal-form mt-4">
                        <input required class="modal-input" placeholder="Imię i nazwisko" name="name" type="text">
                        <input required class="modal-input" placeholder="Adres E-mail" name="email" type="email">
                        <input required class="modal-input" placeholder="Temat" name="subject" type="text"
                            value="<?= $product->name; ?>" readonly>
                        <textarea required placeholder="Wiadomość" class="modal-input" name="message" rows="4"
                            type="text"></textarea>
                        <div class="custom-control custom-checkbox p-0">
                            <input type="checkbox" id="rodo1z" required class="form-check-input" name="rodo1">
                            <label class="form-check-label text-white checkbox-label" for="rodo1z">
                                <span class="show-rodo">
                                    <small>Wyrażam zgodę na przetwarzanie przez danych osobowych podanych w formularzu.
                                        Podanie danych jest dobrowolne. Administratorem podanych przez Pana / Panią
                                        danych osobowych jest <?= $contact->company; ?> z siedzibą w
                                        <?= $contact->address; ?>, <?= $contact->city; ?>,
                                        <?= $contact->zip_code; ?>. Pana / Pani dane będą przetwarzane w celach
                                        związanych z udzieleniem odpowiedzi, przedstawieniem oferty usług
                                        <?= $contact->company; ?> oraz świadczeniem usług przez administratora
                                        danych. Przysługuje Panu / Pani prawo dostępu do treści swoich danych oraz ich
                                        poprawiania.</small>
                                </span>
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox p-0">
                            <input type="checkbox" id="rodo2z" required class="form-check-input" name="rodo2">
                            <label class="form-check-label text-white checkbox-label" for="rodo2z">
                                <span class="show-rodo">
                                    <small>Wyrażam zgodę na otrzymywanie informacji handlowych od
                                        <?= $contact->company; ?> dotyczących jej oferty w szczególności poprzez
                                        połączenia telefoniczne lub sms z wykorzystaniem numeru telefonu podanego w
                                        formularzu, a także zgodę na przetwarzanie moich danych osobowych w tym celu
                                        przez <?= $contact->company; ?> oraz w celach promocji, reklamy i badania
                                        rynku.</small>
                                </span>
                            </label>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit"
                                class="button first-button"><?= $products_desc->ask_button_name ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="recommended-products">
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#recommend1"
                role="tab"><?= $products_desc->last_seen_products ?></a>
        </li>
        <?php if (!empty($product->linked_products)) : ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#recommend3"
                role="tab"><?= $products_desc->similar_products ?></a>
        </li>
        <?php endif; ?>
    </ul>
    <div class="tab-content card">
        <div class="tab-pane fade in show active" id="recommend1" role="tabpanel">
            <?php $this->load->view('front/elements/last_watched.php', $product); ?>
        </div>
        <div class="tab-pane fade" id="recommend3" role="tabpanel">
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

                    <?php foreach ($linked_products as $linked_product) : ?>
                    <div class="product">
                        <a
                            href="<?= base_url('produkt/' . slug($linked_product->name) . '/' . $linked_product->id); ?>">
                            <div data-src="<?= $linked_product->photo ?>" alt=""
                                class="owl-lazy position-relative bg photo">
                                <div class="unavailable-mask">
                                    <div>BRAK ZDJĘCIA</div>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                            <div class="content">
                                <div class="title"><a
                                        href="<?= base_url('produkt/' . slug($linked_product->name) . '/' . $linked_product->id); ?>"><?= $linked_product->name; ?></a>
                                </div>
                                <div class="price">
                                    <?= price_text($linked_product, $linked_product->price_brutto); ?></div>
                            </div>

                        </div>
                    </div>
                    <?php endforeach ?>


                </div>
            </div>
        </div>
    </div>
</section>

<script>
window.addEventListener('load', () => {
    const producerContainer = document.querySelector('.producer');
    const producerImg = producerContainer.querySelector('.producer-img');
    if (producerImg.classList.contains('error')) {
        producerContainer.innerHTML = producerImg.alt;
    }

})


document.querySelectorAll('.desc-list li').forEach(li => {
    if (li.querySelector('a')) li.classList.add('d-none');
})

function setAutoQty(qty) {
    let countQty = document.getElementById('field-amount-input').value;
    document.getElementById('field-amount-input').value = parseInt(qty) * parseInt(countQty);
    document.getElementById("submit_product").submit();
}
</script>