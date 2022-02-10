<div class="loading-block d-none">
    <div class="loader"><i class="fas fa-spinner fa-pulse"></i></div>
</div>

<section class="product-head">
    <h3 class="font-weight-bold">Uwaga! Koszt wysyłki naliczany jest względem ilości wybranych kartonów! (np. 2 kartony
        - kurier 15.00 zł * 2 =
        30.00 zł)</h3>

    <div class="table-responsive">
        <span id="refreshTable">

            <h4>Obecna ilość kartonów: <?= getBoxes() ?></h4>
            <?php if (empty($this->cart->contents())) : echo 'Twój koszyk jest pusty'; ?>
            <?php else : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 20%" scope="col">Zdjęcie</th>
                        <th style="width: 25%" scope="col">Produkt</th>
                        <th style="width: 10%" scope="col">Ilość</th>
                        <th style="width: 15%" scope="col">Cena jedn.</th>
                        <th style="width: 15%" scope="col">Cena</th>
                        <th style="width: 15%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        $suma = 0;
                        foreach ($this->cart->contents() as $k => $v) :
                            $product = $this->back_m->get_one('products', $v['product_id']);
                            $i++;
                            $suma += $v['price'] * $v['qty'];
                        ?>
                    <tr>
                        <td class="align-middle">
                            <a href="<?= base_url('produkt/' . slug($product->name) . '/' . $v['product_id']); ?>">
                                <img src="<?= $product->photo_min ?>" class="img-fluid img-thumbnail" width="64">
                            </a>
                        </td>
                        <td class="align-middle">
                            <a href="<?= base_url('produkt/' . slug($product->name) . '/' . $v['product_id']); ?>">
                                <?= $product->name; ?></a>
                        </td>
                        <td class="align-middle">
                            <?php if (!$product->opakowanie && !$product->karton) : ?>
                            <input value="<?= $v['qty'] ?>" type="number" step="1" min="1"
                                id="quantity<?= $v['rowid']; ?>" class="form-control quantity-input">

                            <?php else : ?>

                            <label title="Mnożnik" data-toggle="popover"
                                data-content="(wybierz i kliknij opakowanie lub karton)">Mnożnik:</label>
                            <input class="form-control" id="multiplier<?= $k ?>" type="number" step="1" value="1">
                            <div class="d-flex justify-content-between mt-2">

                                <button style="font-size: .6rem!important;width:80px" data-row-id="<?= $v['rowid'] ?>"
                                    data-qty="<?= $product->opakowanie ?>"
                                    class="first-button button  package d-flex flex-column justify-content-center align-items-center mr-2 py-1 px-3">

                                    opakowanie <br> (<?= (int)$product->opakowanie ?> szt.)
                                </button>
                                <button style="font-size: .6rem!important;width:80px" data-row-id="<?= $v['rowid'] ?>"
                                    data-qty="<?= $product->karton ?>"
                                    class="first-button button  box d-flex flex-column justify-content-center align-items-center ml-2 py-1 px-3">

                                    karton <br> (<?= (int)$product->karton ?> szt.)
                                </button>
                            </div>

                            <strong class="mt-4 d-block">Ilość: <?= $v['qty'] ?></strong>
                            <?php endif; ?>


                        </td>
                        <td class="align-middle"><?= price_cart($v['price'], $v['rl_price']); ?> BRUTTO</td>
                        <td class="align-middle">
                            <?= price_cart((float)$v['price'] * $v['qty'], $v['rl_price'] * $v['qty']); ?> BRUTTO
                        </td>
                        <td class="align-middle">
                            <button class="first-button button" onclick="removeProduct('<?= $v['rowid']; ?>')"
                                title="Usuń ten produkt z koszyka.">
                                <img data-src="<?= base_url(); ?>assets/front/img/icons/trash2.png"
                                    src="<?= base_url(); ?>assets/front/img/icons/trash2.png" alt=""
                                    class="lazy entered loaded" data-ll-status="loaded"
                                    style="width: 16px; margin-top: -2px; filter: invert(1)">
                            </button>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php endif; ?>
        </span>
        <span id="refreshSuma">
            <?php if (!empty($this->cart->contents())) : ?>
            <hr>
            <div class="text-right">
                <?php if (isset($_SESSION['used_discount']) && $_SESSION['used_discount'] != '') : ?>
                <small>Użyty kod rabatowy: <strong><?= $_SESSION['used_discount']; ?></strong></small><br>
                <small>Wartość kod rabatowy: <strong><?= $_SESSION['value_discount']; ?></strong></small><br><br>
                <?php endif; ?>
                <h4>Suma zamówienia: <?= price_cart($suma); ?> BRUTTO</h4>
            </div>
            <div class="d-flex">
                <div class="d-flex ml-auto mb-3 flex-wrap">
                    <div class="mr-3 mb-2">
                        <form class="d-flex" method="post" action="<?= base_url('rabat'); ?>">
                            <input class="discount_input" type="text" name="discount_code"
                                placeholder="Kod promocyjny..." required />
                            <button class="first-button button" type="submit">Aktywuj</button>
                        </form>
                    </div>
                    <div>
                        <a href="<?= base_url('koszyk/dane_klienta'); ?>" class="first-button button d-block">Przejdź
                            dalej <img data-src="https://nata.pl/uploads/2021-04-13/arrow-right.svg" alt=""
                                class="ml-3 lazy entered loaded" data-ll-status="loaded"
                                src="https://nata.pl/uploads/2021-04-13/arrow-right.svg"
                                style="width: 8px; margin-top: -2px"></a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </span>
    </div>
</section>

<script type="text/javascript">
const initializeQuantityInputs = () => document.querySelectorAll('.quantity-input').forEach(qtyInput => qtyInput
    .addEventListener('keyup',
        changeQty));
const initializeQuantityMassButtons = () => document.querySelectorAll('.button:is(.package, .box)').forEach(button =>
    button
    .addEventListener('click', changeQtyMass))

initializeQuantityInputs();
initializeQuantityMassButtons();

function changeQtyMass(event) {

    const button = event.path.find(el => el.nodeName == 'BUTTON');

    const rowId = button.dataset.rowId;

    const qty = Number(button.dataset.qty) * Number(document.querySelector(
        `#multiplier${rowId}`).value);


    sendRequest("<?php echo base_url('koszyk/aktualizuj/'); ?>" + rowId, {
        qty
    });
}

function changeQty(event) {
    const qty = event.target.value;
    if (!qty || qty <= 0) return;

    const rowId = event.target.id.replace('quantity', '');

    sendRequest("<?php echo base_url('koszyk/aktualizuj/'); ?>" + rowId, {
        qty
    })
}

function removeProduct(rowid) {
    sendRequest("<?php echo base_url('koszyk/usun/'); ?>" + rowid);
}

function sendRequest(url, data = {}) {
    $(".loading-block").removeClass("d-none");
    $.ajax({
        type: "post",
        url,
        data,
        cache: false,
        success: function(html) {
            console.log(html);
            $("#refreshTable").load(location.href + " #refreshTable");
            $("#refreshSuma").load(location.href + " #refreshSuma", function() {
                $(".loading-block").addClass("d-none");
                initializeQuantityInputs();
                initializeQuantityMassButtons();
            });
        }
    });
}
</script>