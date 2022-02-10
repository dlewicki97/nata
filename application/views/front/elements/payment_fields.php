<?php if ($this->uri->segment(2) == 'paczkomat' || $this->uri->segment(2) == 'paczkomat_pobranie') : ?>
    <hr>
    <link rel="stylesheet" href="https://geowidget.easypack24.net/css/easypack.css" />
    <script src="https://geowidget.easypack24.net/js/sdk-for-javascript.js"></script>
    <h4 class="payment-delivery__title mb-3">Wybierz paczkomat:</h4>
    <script type="text/javascript">
        window.easyPackAsyncInit = function() {
            easyPack.init({
                mapType: 'osm',
                searchType: 'osm',
            });
            var map = easyPack.mapWidget('easypack-map', function(point) {
                console.log(point);
                document.getElementById('inpost_code').value = point.name;
                document.getElementById('inpost_parcel').value = point.address.line1 + ', ' + point.address.line2;

                var element = document.getElementById("scrollTo");
                element.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                    inline: "nearest"
                });
            });
        };
    </script>
    <div id="easypack-map"></div>
    <div class="mb-5"></div>

    <input type="hidden" id="inpost_code" name="inpost_code">
    <div id="scrollTo" class="md-form">
        <div class="active" for="inpost_parcel">Paczkomat:</div>
        <input type="text" id="inpost_parcel" name="inpost_parcel" class="form-control" readonly required>
    </div>
<?php endif; ?>
<hr>
<?php if ($this->uri->segment(2) == 'kurier' || $this->uri->segment(2) == 'osobisty' || $this->uri->segment(2) == 'paczkomat') : ?>
    <?php if ((!isset($_SESSION['type_client']) || $_SESSION['type_client'] == 0) && $payments[0]->active_detal == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input type="radio" class="form-check-input" id="<?= $payments[0]->short_name; ?>" name="payment" value="<?= $payments[0]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[0]->short_name; ?>">
                    <?= $payments[0]->title; ?>
                </label>
            </div>
        </div>
    <?php elseif (isset($_SESSION['type_client']) && $_SESSION['type_client'] == 1 && $payments[0]->active_hurt == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input type="radio" class="form-check-input" id="<?= $payments[0]->short_name; ?>" name="payment" value="<?= $payments[0]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[0]->short_name; ?>">
                    <?= $payments[0]->title; ?>
                </label>
            </div>
        </div>
    <?php endif; ?>


    <?php if ((!isset($_SESSION['type_client']) || $_SESSION['type_client'] == 0) && $payments[1]->active_detal == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input type="radio" class="form-check-input" id="<?= $payments[1]->short_name; ?>" name="payment" value="<?= $payments[1]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[1]->short_name; ?>">
                    <?= $payments[1]->title; ?>
                </label>
            </div>
        </div>
    <?php elseif (isset($_SESSION['type_client']) && $_SESSION['type_client'] == 1 && $payments[1]->active_hurt == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input type="radio" class="form-check-input" id="<?= $payments[1]->short_name; ?>" name="payment" value="<?= $payments[1]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[1]->short_name; ?>">
                    <?= $payments[1]->title; ?>
                </label>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!$this->uri->segment(2) == 'osobisty') : ?>
        <?php if ((!isset($_SESSION['type_client']) || $_SESSION['type_client'] == 0) && $payments[2]->active_detal == 1) : ?>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input checked type="radio" class="form-check-input" id="<?= $payments[2]->short_name; ?>" name="payment" value="<?= $payments[2]->short_name; ?>" required>
                    <label class="form-check-label" for="<?= $payments[2]->short_name; ?>">
                        <?= $payments[2]->title; ?>
                    </label>
                </div>
            </div>
        <?php elseif (isset($_SESSION['type_client']) && $_SESSION['type_client'] == 1 && $payments[2]->active_hurt == 1) : ?>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input checked type="radio" class="form-check-input" id="<?= $payments[2]->short_name; ?>" name="payment" value="<?= $payments[2]->short_name; ?>" required>
                    <label class="form-check-label" for="<?= $payments[2]->short_name; ?>">
                        <?= $payments[2]->title; ?>
                    </label>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


<?php if ($this->uri->segment(2) == 'pobranie' || $this->uri->segment(2) == 'paczkomat_pobranie') : ?>
    <?php if ((!isset($_SESSION['type_client']) || $_SESSION['type_client'] == 0) && $payments[2]->active_detal == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input checked type="radio" class="form-check-input" id="<?= $payments[2]->short_name; ?>" name="payment" value="<?= $payments[2]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[2]->short_name; ?>">
                    <?= $payments[2]->title; ?>
                </label>
            </div>
        </div>
    <?php elseif (isset($_SESSION['type_client']) && $_SESSION['type_client'] == 1 && $payments[2]->active_hurt == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input type="radio" class="form-check-input" id="<?= $payments[2]->short_name; ?>" name="payment" value="<?= $payments[2]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[2]->short_name; ?>">
                    <?= $payments[2]->title; ?>
                </label>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if ($this->uri->segment(2) == 'osobisty') : ?>
    <?php if ((!isset($_SESSION['type_client']) || $_SESSION['type_client'] == 0) && $payments[3]->active_detal == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input type="radio" class="form-check-input" id="<?= $payments[3]->short_name; ?>" name="payment" value="<?= $payments[3]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[3]->short_name; ?>">
                    <?= $payments[3]->title; ?>
                </label>
            </div>
        </div>
    <?php elseif (isset($_SESSION['type_client']) && $_SESSION['type_client'] == 1 && $payments[3]->active_hurt == 1) : ?>
        <div class="col-12">
            <div class="form-check pl-0">
                <input type="radio" class="form-check-input" id="<?= $payments[3]->short_name; ?>" name="payment" value="<?= $payments[3]->short_name; ?>" required>
                <label class="form-check-label" for="<?= $payments[3]->short_name; ?>">
                    <?= $payments[3]->title; ?>
                </label>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<br><br>