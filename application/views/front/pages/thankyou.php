<?php $realPrice = 0;
foreach ($this->cart->contents() as $k => $v) {
	$realPrice += $v['price'] * $v['qty'];
} ?>

<section class="container my-5">
    <div action="" method="post" class="form_client_data">
        <div>
            <h5 class="text-center">Dziękujemy za zakupy w naszym sklepie.<br>Cieszymy się ogromnie, że to co tworzymy
                stało się cząstką Twojego życia.<br>Życzymy samych przyjemnych chwil!<br>Szczegóły Twojego zamówienia
                wysłaliśmy w wiadomości e-mail.</h5>
        </div>
        <div class="row my-3 text-center">
            <div class="col-12">
                <?php if ($_SESSION['payment'] == 'tradycyjny') : ?>
                <hr>
                Prosimy o wpłatę kwoty
                <strong><?= single_price_cart($subtotal + $_SESSION['delivery_cost']); ?></strong> na numer konta:<br>
                <strong><?= $settings->bank_account; ?></strong><br>
                Do tytułu przelewu prosimy wpisać -
                <strong><?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . ' ' . date('d.m.Y'); ?></strong><br>
                Po zaksięgowaniu wpłaty zamówienie zostanie zrealizowane.
                <?php endif; ?>
            </div>
            <div class="col-12">
                <?php if ($_SESSION['delivery'] == 'osobisty') : ?>
                <hr>
                <p>Adres odbioru</p>
                <strong>
                    <?= $contact->company; ?><br>
                    <?= $contact->name; ?><br>
                    Polska, <?= $contact->city; ?>, <?= $contact->zip_code; ?><br>
                    <?= $contact->address; ?><br>
                    <?= $contact->phone1; ?><br>
                    <?= $contact->email1; ?>
                </strong>
                <hr>
                <p>Godziny otwarcia</p>
                <strong>
                    <?= $hours->hours; ?>
                </strong>
                <hr>
                <p>Dane kontaktowe</p>
                <strong>
                    <?= $contact->phone1; ?><br>
                    <?= $contact->email1; ?><br>
                </strong>
                <?php endif; ?>
            </div>
        </div>
        <a href="<?= base_url(); ?>" class="first-button button" style="font-size: 1.125rem">
            <i class="fas fa-chevron-left mr-2"></i> Powrót do strony głównej
        </a>
    </div>
</section>