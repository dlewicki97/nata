<?php
$deliveryOne = true;
$deliveryTwo = true;
$deliveryThree = true;
$deliveryFour = true;
$deliveryFive = true;
$deliveryPrice1 = 'Darmowa dostawa';
$deliveryPrice2 = 'Darmowa dostawa';
$deliveryPrice3 = 'Darmowa dostawa';
$deliveryPrice4 = 'Darmowa dostawa';
$free_shipping_min_price = $this->back_m->get_one('free_shipping_min_price', 1)->price;
$cart_sum = 0.0;

foreach ($this->cart->contents() as $v) {
    if ($this->back_m->get_one('products', $v['product_id'])->delivery_active == 1) {
        $deliveryPrice1 = 0;
        $deliveryPrice2 = 0;
        $deliveryPrice3 = 0;
        $deliveryPrice4 = 0;
    }
    $cart_sum += $v['subtotal'];
}

$deliveries_keys = ['delivery_cost', 'delivery_cost_on_delivery', 'delivery_cost_paczkomat', 'delivery_cost_on_delivery_paczkomat'];

$delivery_prices = [];

foreach ($deliveries_keys as $key) $delivery_prices[$key] = 0.0;

foreach ($this->cart->contents() as $v) {
    $product = $this->back_m->get_one('products', $v['product_id']);
    $products_deliveries = explode(',', $product->delivery);
    if (!(in_array(0, $products_deliveries) || in_array(3, $products_deliveries)) && $deliveryOne == true) $deliveryOne = false;

    if (!(in_array(1, $products_deliveries) || !in_array(4, $products_deliveries)) && $deliveryTwo == true) {
        $deliveryTwo = false;
    }
    if (!in_array(2, $products_deliveries) && $deliveryThree == true) {
        $deliveryThree = false;
    }
    if (!in_array(5, $products_deliveries) && $deliveryFour == true) {
        $deliveryFour = false;
    }
    if (!in_array(6, $products_deliveries) && $deliveryFive == true) {
        $deliveryFive = false;
    }
    if ($product->delivery_active == 1) {

        foreach ($deliveries_keys as $key) {

            if ($delivery_prices[$key] < $product->{$key}) $delivery_prices[$key] = $product->{$key};
        }
    }
}

foreach ($delivery_prices as $key => $price) $delivery_prices[$key] = number_format($delivery_prices[$key] * getBoxes(), 2);

?>

<section class="container">

    <form action="" method="post" class="form_client_data">
        <div class="row">
            <div class="col-12">
                <span class="small_valid text-danger"><?= form_error('delivery'); ?></span>
                <span class="small_valid text-danger"><?= form_error('payment'); ?></span>
                <span class="small_valid text-danger"><?= form_error('inpost_code'); ?></span>
            </div>
            <?php if ($deliveryOne == true) : ?>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="radio" class="form-check-input" id="delivery_0" name="delivery"
                        value="kurier|<?= $delivery_prices['delivery_cost']; ?>" onchange="paymentFields(0)" required>
                    <label class="form-check-label" for="delivery_0">
                        Kurier - <strong><?= $delivery_prices['delivery_cost']; ?></strong>
                        <?php if ($delivery_prices['delivery_cost'] != 'Darmowa dostawa') echo 'PLN'; ?>
                    </label>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($deliveryTwo == true) : ?>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="radio" class="form-check-input" id="delivery_1" name="delivery"
                        value="pobranie|<?= $delivery_prices['delivery_cost_on_delivery']; ?>"
                        onchange="paymentFields(1)" required>
                    <label class="form-check-label" for="delivery_1">
                        Kurier za pobraniem - <strong><?= $delivery_prices['delivery_cost_on_delivery']; ?></strong>
                        <?php if ($delivery_prices['delivery_cost_on_delivery'] != 'Darmowa dostawa')  echo 'PLN'; ?>
                    </label>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($deliveryFour == true) : ?>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="radio" class="form-check-input" id="delivery_3" name="delivery"
                        value="paczkomat|<?= $delivery_prices['delivery_cost_paczkomat']; ?>"
                        onchange="paymentFields(3)" required>
                    <label class="form-check-label" for="delivery_3">
                        Paczkomat - <strong><?= $delivery_prices['delivery_cost_paczkomat']; ?></strong>
                        <?php if ($delivery_prices['delivery_cost_paczkomat'] != 'Darmowa dostawa') echo 'PLN'; ?>
                    </label>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($deliveryFive == true) : ?>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="radio" class="form-check-input" id="delivery_4" name="delivery"
                        value="paczkomat_pobranie|<?= $delivery_prices['delivery_cost_on_delivery_paczkomat']; ?>"
                        onchange="paymentFields(4)" required>
                    <label class="form-check-label" for="delivery_4">
                        Paczkomat za pobraniem -
                        <strong><?= $delivery_prices['delivery_cost_on_delivery_paczkomat']; ?></strong>
                        <?php if ($delivery_prices['delivery_cost_on_delivery_paczkomat'] != 'Darmowa dostawa') echo 'PLN'; ?>
                    </label>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="radio" class="form-check-input" id="delivery_2" name="delivery" value="osobisty|0"
                        onchange="paymentFields(2)" required>
                    <label class="form-check-label" for="delivery_2">
                        Odbiór osobisty - <strong><?= number_format(0, 2); ?></strong> PLN
                    </label>
                </div>
            </div>
            <span id="payments" class="w-100 mt-3"></span>
        </div>
        <button type="submit" class="first-button button float-right">
            Przejdź dalej
        </button>
    </form>
</section>

<script type="text/javascript">
function paymentFields(radio) {
    document.getElementById('payments').innerHTML = '<div class="loader"><i class="fas fa-spinner fa-pulse"></i></div>';
    var val = document.getElementById('delivery_' + radio).value;
    val = val.split("|", 1)[0];
    $("#payments").load("<?= base_url('wybor_platnosci/'); ?>" + val);

    if (radio == 1) {
        document.querySelector('#payments').style.display = 'none';
    } else {
        document.querySelector('#payments').style.display = '';

    }

}
</script>