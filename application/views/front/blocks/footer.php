</main>
<footer>
    <section class="newsletter lazy bg" title="<?= $newsletter_desc->alt ?>" data-bg="<?= file_url($newsletter_desc->photo) ?>">
        <div class="col-12 col-lg-6">
            <h3 class="section-title text-white"><?= $newsletter_desc->title ?></h3>
            <div class="section-subtitle">
                <p>
                    <?= $newsletter_desc->subtitle ?>
                </p>
            </div>
            <form method="post" action="<?= base_url('newsletter/send') ?>">
                <input class="newsletter-input" name="email" required placeholder="<?= $newsletter_desc->email ?>" type="email" />
                <div class="custom-control custom-checkbox p-0">
                    <input type="checkbox" required name="newsletter" class="form-check-input" id="newsletter_cbx" />
                    <label class="form-check-label text-white checkbox-label" for="newsletter_cbx"><?= $settings->rodo_newsletter ?></label>
                </div>
                <button type="submit" class="button white-button"><?= $newsletter_desc->txt_btn ?></button>
            </form>
        </div>
    </section>
    <section class="footer">
        <div class="content w-100">
            <?php foreach ($footer as $col) : ?>
                <div class="column">
                    <h6><?= $col->title ?></h6>
                    <ul>
                        <?php foreach ($footer_lists as $list_item) : ?>
                            <?php if ($list_item->title === 'Zaloguj się' && isset($_SESSION['client'])) continue; ?>
                            <?php if ($list_item->footer_id == $col->id) : ?>
                                <li class="<?php if ($list_item->bold) echo "bold" ?>">
                                    <?php if ($list_item->link) : ?>
                                        <a <?php if ($list_item->blank) echo 'target="_blank"' ?> href="<?= strpos($list_item->link, 'http') === false && strpos($list_item->link, 'mailto:') === false && strpos($list_item->link, 'tel:') === false ?  base_url($list_item->link) : $list_item->link ?>">
                                        <?php endif; ?>
                                        <?php if ($list_item->icon) echo $list_item->icon; ?>
                                        <?= $list_item->title ?>
                                        <?php if ($list_item->link) : ?>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="ad-awards">
        © Copyright <?= date('Y'); ?> BY NATA PPHU. CREATED WITH LOVE BY
        <a class="adawards-link" target="_blank" href="https://agencjamedialna.pro/">AD AWARDS</a>
    </section>
</footer>
<script>
    let baseUrl = '<?= base_url() ?>';
</script>

<?php if (in_array($this->uri->segment(1), $lightbox_links)) : ?>
    <script src="<?= assets() ?>lightbox-js/dist/js/lightbox-plus-jquery.min.js"></script>
<?php endif; ?>

<script type="text/javascript" src="<?= assets() ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.1/dist/lazyload.min.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/initializator.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/livesearch.js"></script>
<script type="text/javascript" src="<?= assets() ?>js/popover/popover.js"></script>


<?php if ($this->uri->segment(1) == '') : ?>
    <script src="<?= assets() ?>dist/owl.carousel.js"></script>
    <script src="<?= assets() ?>js/slider.js"></script>
    <script src="<?= assets() ?>js/recommended-first-carousel.js"></script>
    <script src="<?= assets() ?>js/recommended-second-carousel.js"></script>
    <script src="<?= assets() ?>js/recommended-third-carousel.js"></script>
    <script src="<?= assets() ?>js/brands.js"></script>
<?php elseif ($this->uri->segment(1) == 'sklep' || $this->uri->segment(1) == 'nowosci' || $this->uri->segment(1) == 'outlet') : ?>
    <script type="text/javascript" src="<?= assets() ?>js/listing/aside-accordions.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/hearts.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/tags/tags.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/tags/new-tag.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/tags/fill-tags-after-render-listing.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/searching-filters.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/set-cookie.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/double-slider/get-sort-uri.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/double-slider/price-sort.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/double-slider/double-slider-config.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/scripts-after-render-listing.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/filters/fetchFilterList.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/filters/setContentsListeners.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/filters/printFilterList.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/paginationRowLastChildWidth.js"></script>



    <?php if ($this->uri->segment(2) == 'kategoria') : ?>
        <script type="text/javascript">
            $("#render-listing").load(
                "<?= base_url("generuj/lista_produktow/kategoria/{$this->uri->segment(4)}/" . ($this->uri->segment(5) ?? 0)); ?>",
                scriptsAfterRenderListing);
        </script>
    <?php elseif ($this->uri->segment(1) == 'nowosci') : ?>
        <script type="text/javascript">
            $("#render-listing").load("<?= base_url('generuj/lista_produktow/nowosci/' . ($this->uri->segment(2) ?? 0)); ?>",
                scriptsAfterRenderListing);
        </script>
    <?php elseif ($this->uri->segment(1) == 'outlet') : ?>
        <script type="text/javascript">
            $("#render-listing").load("<?= base_url('generuj/lista_produktow/outlet/' . ($this->uri->segment(2) ?? 0)); ?>",
                scriptsAfterRenderListing);
        </script>
    <?php else : ?>
        <script type="text/javascript">
            $("#render-listing").load("<?= base_url('generuj/lista_produktow/' . $this->uri->segment(2)); ?>",
                scriptsAfterRenderListing);
        </script>
    <?php endif; ?>
    <script type="text/javascript">
        function sort() {
            var value = document.getElementById('sortBy').value;
            document.getElementById('render-listing').innerHTML =
                '<div class="elements-preloader"><i class="fas fa-spinner fa-pulse"></i></div>';
            setCookie('sort', value);
            $("#render-listing").load("<?= base_url('generuj/lista_produktow' . get_sort_uri()); ?>",
                scriptsAfterRenderListing);
        }

        function productsPerPage() {
            var value = document.getElementById('perPage').value;
            document.getElementById('render-listing').innerHTML =
                '<div class="elements-preloader"><i class="fas fa-spinner fa-pulse"></i></div>';
            setCookie('perPage', value);
            location.reload();
            $("#render-listing").load("<?= base_url('generuj/lista_produktow' . get_sort_uri()); ?>", function() {
                var element = document.getElementById("scrollHere");
                scriptsAfterRenderListing()
                element.scrollIntoView({
                    behavior: "smooth",
                    inline: "nearest"
                });

            });
        }
    </script>
<?php elseif ($this->uri->segment(1) == 'produkt') : ?>
    <script src="<?= assets() ?>lightbox-js/dist/js/lightbox-plus-jquery.min.js"></script>
    <script src="<?= assets() ?>dist/owl.carousel.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/single-product/product-head-carousel.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/single-product/amount-counter.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/single-product/heart.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/single-product/stars.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/single-product/recommended-products-carousel.js"></script>
    <script type="text/javascript" src="<?= assets() ?>js/listing/hearts.js"></script>
    <script async defer src="https://www.google.com/recaptcha/api.js?render=<?= $settings->captcha ?>"></script>
    <script async>
        $('#opinion-form').submit(function(event) {
            event.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('<?= $settings->captcha ?>', {
                    action: 'mailer/send'
                }).then(function(token) {
                    $('#opinion-form').prepend(`<input type="hidden" name="token" value="${token}">`);
                    $('#opinion-form').unbind('submit').submit();
                });;
            });
        });
        $('#reminder-form').submit(function(event) {
            event.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('<?= $settings->captcha ?>', {
                    action: 'mailer/send'
                }).then(function(token) {
                    $('#reminder-form').prepend(`<input type="hidden" name="token" value="${token}">`);
                    $('#reminder-form').unbind('submit').submit();
                });;
            });
        });
    </script>

<?php endif; ?>
<script>
    [...document.getElementsByTagName('p')].forEach(p => {
        if (p.innerText == '') p.style.height = '.9rem';
    })
</script>
<?= $scripts_editor['footer']->description ?>

<?php if ($this->uri->segment(1) == 'kontakt' || $this->uri->segment(1) === 'rejestracja') : ?>
    <script async defer src="https://www.google.com/recaptcha/api.js?render=<?= $settings->captcha ?>"></script>
    <script async>
        $('#contact-form').submit(function(event) {
            event.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('<?= $settings->captcha ?>', {
                    action: 'mailer/send'
                }).then(function(token) {
                    $('#contact-form').prepend(`<input type="hidden" name="token" value="${token}">`);
                    $('#contact-form').unbind('submit').submit();
                });;
            });
        });
    </script>
<?php endif; ?>

<?php if ($this->uri->segment(2) == 'dane_klienta' || $this->uri->segment(1) == 'rejestracja' || $this->uri->segment(1) == 'ustawienia-konta') : ?>
    <script type="text/javascript" src="<?= assets() ?>js/inputmask.js"></script>
    <script type="text/javascript">
        $("#input-phone").inputmask({
            "mask": "999 999 999"
        });
        $(".input-phone").inputmask({
            "mask": "999 999 999"
        });
        $("#input-zipcode").inputmask({
            "mask": "99-999"
        });
        $(".input-zipcode").inputmask({
            "mask": "99-999"
        });
        $(".input-nip").inputmask({
            "mask": "999 999 99 99"
        });
    </script>
<?php endif ?>






</body>

</html>