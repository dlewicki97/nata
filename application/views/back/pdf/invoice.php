<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>Faktura do zamówienia nr: <?= $transaction_details->id ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/back/css/pdf_invoice.css" rel="stylesheet">

<body>

    <div class="row">

        <div class="column-2">

            <fieldset>
                <legend class="pl-5 text_bold">Sprzedawca</legend>
                <div class="pl-5 text_bold">"<?= $invoice_settings->company_name ?>"</div>
                <div class="pl-5 text_bold"><?= $invoice_settings->name ?></div>
                <div class="pl-5 text_bold"><?= $invoice_settings->city ?></div>
                <div class="pl-5 text_bold"><?= $invoice_settings->adress ?></div>
                <div class="row">
                    <div class="column-2 text_bold">
                        <div class="pl-5">NIP: <?= $invoice_settings->nip ?></div>
                    </div>
                    <div class="column-2 text_bold">
                        <div style="padding-left: 30px">Nr tel.: <?= $invoice_settings->phone ?></div>
                    </div>
                </div>
                <hr class="black_hr">
                <div class="pl-5 text_bold"><?= $invoice_settings->bank_account ?></div>
            </fieldset>

        </div>

        <div class="column-2 pl-5">

            <div class="grey_background text-center">
                <h2 style="height: 20px;">Faktura VAT</h2>
            </div>
            <h3 style="height: 20px; margin-top: 5px" class="text-center">nr FA/<?= $transaction_details->id ?>/<?php echo date("Y"); ?></h3>

            <div class="row">
                <div class="column-2">
                    <div>Data wystawienia: <span class="text_bold"><?= $date_of_issue ?></span></div>
                </div>
                <div class="column-2">
                    <div>Data sprzedaży: <span class="text_bold"><?= date("Y-m-d", strtotime($transaction_details->created)) ?></span></div>
                </div>
            </div>

        </div>

    </div>
    <div class="row mt-50">

        <div class="column-2">

            <div class="text_bold pl-7">Nabywca:</div>
            <br>
            <div class="text_bold pl-5"><?= $transaction_details->company ?></div>
            <div class="text_bold pl-5"><?= $transaction_details->zipcode_company ?> <?= $transaction_details->city_company ?></div>
            <div class="text_bold pl-5"><?= $transaction_details->zipcode_company ?> <?= $transaction_details->address_company ?></div>
            <div class="text_bold pl-5">NIP: <?= $transaction_details->nip ?></div>

        </div>

        <div class="column-2">

            <div class="text_bold pl-7">Odbiorca:</div>
            <br>
            <div class="text_bold pl-5"><?= $transaction_details->company ?></div>
            <div class="text_bold pl-5"><?= $transaction_details->zipcode_company ?> <?= $transaction_details->city_company ?></div>
            <div class="text_bold pl-5"><?= $transaction_details->zipcode_company ?> <?= $transaction_details->address_company ?></div>
            <div class="text_bold pl-5">NIP: <?= $transaction_details->nip ?></div>

        </div>

    </div>

    <?php
    $products = explode('|', $transaction_details->name);
    $price = explode('|', $transaction_details->price);
    $qty = explode('|', $transaction_details->qty);
    $sum = explode('.', $transaction_details->suma);

    $paymentType['p24'] = 'Przelewy24';
    $paymentType['payu'] = 'PayU';
    $paymentType['tradycyjny'] = 'Przelew tradycyjny';
    $paymentType['pobranie'] = 'Płatność za pobraniem';
    $paymentType['odbiorze'] = 'Płatność przy odbiorze';
    ?>

    <div class="mt-10 text-center">

        <table class="unstyledTable" cellspacing="0">
            <tr>

                <td class="table_border_right" style="width: 5%">Lp.</td>
                <td class="table_border_middle" style="width: 40%">Nazwa towaru/usługi</td>
                <td class="table_border_middle" style="width: 10%">PKWiU</td>
                <td class="table_border_middle" style="width: 5%">Ilość</td>
                <td class="table_border_middle" style="width: 5%">J.m.</td>
                <td class="table_border_middle" style="width: 5%">VAT</td>
                <td class="table_border_middle" style="width: 15%">Cena netto</td>
                <td class="table_border_left" style="width: 15%">Wartość netto</td>

            </tr>

            <?php $i = 0;
            foreach ($products as $k => $v) : $i++; ?>
                <tr>
                    <td><?= $i ?>.</td>
                    <td><?= $v ?></td>
                    <td></td>
                    <td><?= $qty[$k] ?></td>
                    <td>szt</td>
                    <td>23 %</td>
                    <td><?= net_price($price[$k]) ?></td>
                    <td><?= net_value($price[$k], $qty[$k]) ?></td>

                </tr>
            <?php endforeach ?>
        </table>

    </div>

    <div class="row">

        <div class="column-2">

            <table class="unstyledTable mt-10" cellspacing="0">
                <tr>

                    <td class="table_border_alt" style="width: 30%">Forma płatności</td>
                    <td class="table_border_alt" style="width: 40%">Termin</td>
                    <td class="table_border_alt" style="width: 15%">Kwota</td>
                    <td class="table_border_alt" style="width: 15%">Waluta</td>

                </tr>

                <tr>

                    <td><?= $paymentType[$transaction_details->payment] ?></td>
                    <td>
                        <?php if ($transaction_details->paid == '1') :

                            echo date("Y-m-d", strtotime($transaction_details->updated));

                        else :

                            echo $payment_deadline;

                        endif;

                        ?>
                    </td>
                    <td><?= $transaction_details->suma ?></td>
                    <td>PLN</td>

                </tr>

            </table>

        </div>

        <div class="column-2">

            <table class="unstyledTable mt-10 pl-5" cellspacing="0">

                <tr>

                    <td class="table_border_alt" style="width: 10%"></td>
                    <td class="table_border_alt" style="width: 30%">Stawka</td>
                    <td class="table_border_alt" style="width: 20%">Netto</td>
                    <td class="table_border_alt" style="width: 20%">Vat</td>
                    <td class="table_border_alt" style="width: 20%">Brutto</td>
                    
                </tr>

                <tr>

                    <td class="sum_border">Razem:</td>
                    <td class="sum_border-bottom"></td>
                    <td class="text_bold sum_border-bottom"><?= net_price($transaction_details->suma) ?></td>
                    <td class="text_bold sum_border-bottom"><?= count_vat_value($transaction_details->suma) ?></td>
                    <td class="text_bold sum_border-bottom"><?= number_format($transaction_details->suma, 2) ?></td>

                </tr>

                <tr>

                    <td class="sum_border_alt">W tym:</td>
                    <td>23%</td>
                    <td><?= net_price($transaction_details->suma) ?></td>
                    <td><?= count_vat_value($transaction_details->suma) ?></td>
                    <td><?= number_format($transaction_details->suma,2) ?></td>

                </tr>

            </table>

        </div>

    </div>

    <div class="mt-50">


        <div class="row grey_background">

            <div class="column-2">

                <div class="text_bold text-left pl-5">Razem do zapłaty</div>

            </div>

            <div class="column-2">

                <div class="text_bold text-right pr-5"><?= number_format($transaction_details->suma,2) ?> PLN</div>

            </div>

        </div>

        <div class="text-right pr-5 mt-10">

            <em>Słownie: <?= numberToText($transaction_details->suma) ?> PLN 
            <?php if($sum[1] ?? null): echo $sum[1] . '/100';
            else: ?>
            00/100
            <?php endif; ?>
            </em>

        </div>

        <div class="row mt-10">

            <div class="column-2">

                <div class="text-left pl-5">Zapłacono:
                    <?php if ($transaction_details->paid == '1') : ?>
                        <span class="pl-5"><?= number_format($transaction_details->suma,2); ?> PLN</span>
                    <?php else : ?>
                        <span class="pl-5">0,00 PLN</span>
                    <?php endif; ?>
                </div>

            </div>

            <div class="column-2">

                <div class="text-right pr-5">Pozostaje do zapłaty:
                    <?php if ($transaction_details->paid == '0') : ?>
                        <span class="pl-5"><?= number_format($transaction_details->suma,2); ?> PLN</span>
                    <?php else : ?>
                        <span class="pl-5">0,00 PLN</span>
                    <?php endif; ?>
                </div>

            </div>

        </div>

        <hr>

        <div class="row mt-10 text-center">

            <div class="column-3">

                <div class="text_bold"><?= $invoice_settings->name ?></div>

                <hr class="left-hr">

                <div class="text-small">Podpis osoby uprawnionej do wystawienia faktury</div>

            </div>

            <div class="column-3 pl-5">

                <hr class="middle-hr">

                <div class="text-small">Data odbioru</div>

            </div>

            <div class="column-3">

                <hr class="right-hr">

                <div class="text-small">Podpis osoby uprawnionej do odbioru faktury</div>

            </div>


        </div>

    </div>


</body>

</html>

<?php

function net_price($price)
{
    $net_price = round($price / 1.23, 2);
    return number_format($net_price, 2);
}

function net_value($price, $qty)
{
    $net_price = net_price($price);
    $net_value = round($net_price * $qty, 2);
    return number_format($net_value, 2);
}

function count_vat_value($price)
{
    $net_price = net_price($price);
    $count_vat_value = round($price - $net_price, 2);
    return number_format($count_vat_value, 2);
} 

function numberToText($liczba)
{
    $separator = ' ';
    $jednosci = array('', ' jeden', ' dwa', ' trzy', ' cztery', ' pięć', ' sześć', ' siedem', ' osiem', ' dziewięć');
    $nascie = array('', ' jedenaście', ' dwanaście', ' trzynaście', ' czternaście', ' piętnaście', ' szesnaście', ' siedemnaście', ' osiemnaście', ' dziewietnaście');
    $dziesiatki = array('', ' dziesieć', ' dwadzieścia', ' trzydzieści', ' czterdzieści', ' pięćdziesiąt', ' sześćdziesiąt', ' siedemdziesiąt', ' osiemdziesiąt', ' dziewięćdziesiąt');
    $setki  = array('', ' sto', ' dwieście', ' trzysta', ' czterysta', ' pięćset', ' sześćset', ' siedemset', ' osiemset', ' dziewięćset');
    $grupy = array(
        array('', '', ''),
        array(' tysiąc', ' tysiące', ' tysięcy'),
        array(' milion', ' miliony', ' milionów'),
        array(' miliard', ' miliardy', ' miliardów'),
        array(' bilion', ' biliony', ' bilionów'),
        array(' biliard', ' biliardy', ' biliardów'),
        array(' trylion', ' tryliony', ' trylionów')
    );

    $wynik = '';
    $znak = '';
    if ($liczba == 0)
        return 'zero';
    if ($liczba < 0) {
        $znak = 'minus';
        $liczba = -$liczba;
    }
    $g = 0;
    while ($liczba > 0) {


        $s = floor(($liczba % 1000) / 100);
        $n = 0;
        $d = floor(($liczba % 100) / 10);
        $j = floor($liczba % 10);


        if ($d == 1 && $j > 0) {
            $n = $j;
            $d = $j = 0;
        }

        $k = 2;
        if ($j == 1 && $s + $d + $n == 0)
            $k = 0;
        if ($j == 2 || $j == 3 || $j == 4)
            $k = 1;

        if ($s + $d + $n + $j > 0)
            $wynik = $setki[$s] . $dziesiatki[$d] . $nascie[$n] . $jednosci[$j] . $grupy[$g][$k] . $wynik;

        $g++;
        $liczba = floor($liczba / 1000);
    }
    return trim($znak . $wynik);
}

?>