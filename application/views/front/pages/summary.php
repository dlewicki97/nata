<?php $paymentType['tradycyjny'] = 'Przelew tradycyjny';
$paymentType['p24'] = 'Przelewy24';
$paymentType['payu'] = 'PayU';
$paymentType['pobranie'] = 'Płatność za pobraniem';
$paymentType['odbiorze'] = 'Płatność przy odbiorze';
$deliveryType['kurier'] = 'Kurier';
$deliveryType['pobranie'] = 'Kurier za pobraniem';
$deliveryType['osobisty'] = 'Odbiór osobisty';
$deliveryType['paczkomat'] = 'Paczkomat';
$deliveryType['paczkomat_pobranie'] = 'Paczkomat za pobraniem';
$realPrice = 0;
$price = 0;
foreach ($this->cart->contents() as $k => $v) {
	$realPrice += $v['rl_price'] * $v['qty'];
	$price += $v['price'] * $v['qty'];
}

if ($_SESSION['delivery_cost'] == 'Darmowa dostawa') {
	$_SESSION['delivery_cost'] = 0;
} ?>
<section class="container">
	<form action="" method="post" class="form_client_data">
		<div class="row">
			<div class="col-lg-6">
				<p>Imię i nazwisko</p>
				<strong><?= $_SESSION['first_name']; ?> <?= $_SESSION['last_name']; ?></strong>
				<hr>
				<p>Adres e-mail</p>
				<strong><?= $_SESSION['email']; ?></strong>
				<hr>
				<p>Numer telefonu</p>
				<strong><?= $_SESSION['phone']; ?></strong>
				<hr>
				<p>Adres dostawy</p>
				<strong>
					<?= $_SESSION['country']; ?>, <?= $_SESSION['city']; ?> <?= $_SESSION['zipcode']; ?><br>
					<?= $_SESSION['street']; ?> <?= $_SESSION['housenumber']; ?><?php if ($_SESSION['flatnumber'] != null) {
																					echo '/' . $_SESSION['flatnumber'];
																				} ?>
				</strong>
				<hr>
				<p>Sposób dostawy</p>
				<strong><?= $deliveryType[$_SESSION['delivery']]; ?> - <?= number_format($_SESSION['delivery_cost'], 2); ?> PLN</strong>
				<?php if ($_SESSION['delivery'] == 'paczkomat' || $_SESSION['delivery'] == 'paczkomat_pobranie') : ?>
					<br>
					Paczkomat: <strong>[<?= $_SESSION['inpost_code']; ?>] <?= $_SESSION['inpost_parcel']; ?></strong>
				<?php endif; ?>
				<hr>
				<p>Metoda płatności</p>
				<strong><?= $paymentType[$_SESSION['payment']]; ?></strong>
				<hr>
				<p>Suma do zapłacenia</p>
				<strong><?= price_summary($realPrice, $price, $_SESSION['delivery_cost']); ?></strong>
			</div>
			<div class="col-lg-6">
				<label>Wiadomość do zamówienia</label>
				<textarea class="form-control" rows="16" name="order_message"></textarea>
			</div>
		</div>
		<button type="submit" class="first-button button mt-3" name="submit">
			Złóż zamówienie
		</button>
	</form>
</section>