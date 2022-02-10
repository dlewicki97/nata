<?php

$paymentType['p24'] = 'Przelewy24';
$paymentType['payu'] = 'PayU';
$paymentType['tradycyjny'] = 'Przelew tradycyjny';
$paymentType['pobranie'] = 'Płatność za pobraniem';
$paymentType['odbiorze'] = 'Płatność przy odbiorze';

$status[0] = 'W trakcie realizacji';
$status[1] = 'Anulowane przez administratora';
$status[2] = 'Anulowane przez klienta';
$status[3] = 'Zatwierdzone';
$status[4] = 'Wysłane';
$status[5] = 'Zrealizowane';

$discount_type[0] = '%';
$discount_type[1] = 'PLN';

$pieces = explode("|", $value->qty);
$i = 0;
foreach ($pieces as $v_ex) {
    $i++;
    $qty[$i] = $v_ex;
}
$pieces = explode("|", $value->price);
$i = 0;
$rl_suma = 0;
foreach ($pieces as $v_ex2) {
    $i++;
    $price[$i] = $v_ex2;
    $rl_suma += $v_ex2;
}

$pieces = explode("|", $value->price_netto);
$i = 0;
foreach ($pieces as $v_ex3) {
    $i++;
    $price_netto[$i] = $v_ex3;
}

$pieces = explode("|", $value->price_brutto);
$i = 0;
foreach ($pieces as $v_ex4) {
    $i++;
    $price_brutto[$i] = $v_ex4;
}

$pieces = explode("|", $value->product_id);
$i = 0;
foreach ($pieces as $v_ex5) {
    $i++;
    $prod_id[$i] = $v_ex5;
}

?>

<div class="br-mainpanel">
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
        <p class="mg-b-0"><?php echo subtitle(); ?></p>
        <hr>
    </div><!-- d-flex -->

    <div class="br-pagebody mg-t-0 pd-x-30">
        <?php if (isset($_SESSION['flashdata'])) : ?>
        <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
        <?php endif; ?>

        <?php if ($shipment_validation_errors = $this->session->flashdata('shipment_validation_errors')) : ?>
        <div class="alert alert-danger alert-dismissible position-relative"><?= $shipment_validation_errors ?><span
                data-dismiss="alert" style="cursor: pointer;position:absolute; top: 5px; right: 10px;z-index: 1;"
                class="close p-0">
                x</span>
        </div>
        <?php endif; ?>
        <div class="row no-gutters">
            <div class="card bd-0 w-100">
                <div class="card-header bg-dark text-white">
                    Zamówienie nr #<?php echo $value->id; ?> z dnia <?php echo $value->created; ?>
                </div>
                <div class="card-body bd bd-t-0 rounded-bottom">
                    <div class="row">
                        <div class="col-md-4">
                            Status:
                            <span id="refreshStatus">
                                <p class="font-weight-bold"><?php echo $status[$value->status]; ?></p>
                            </span>
                            Zmień na:
                            <ul class="pl-0" style="list-style-type: none">
                                <li>
                                    <a onclick="changeStatus('transaction', <?php echo $value->id; ?>, 0)"
                                        class="text-primary" style="cursor: pointer;">W trakcie realizacji</a>
                                </li>
                                <li>
                                    <a onclick="changeStatus('transaction', <?php echo $value->id; ?>, 1)"
                                        class="text-primary" style="cursor: pointer;">Anulowane przez administratora</a>
                                </li>
                                <li>
                                    <a onclick="changeStatus('transaction', <?php echo $value->id; ?>, 2)"
                                        class="text-primary" style="cursor: pointer;">Anulowane przez klienta</a>
                                </li>
                                <li>
                                    <a onclick="changeStatus('transaction', <?php echo $value->id; ?>, 3)"
                                        class="text-primary" style="cursor: pointer;">Zatwierdzone</a>
                                </li>
                                <li>
                                    <a onclick="changeStatus('transaction', <?php echo $value->id; ?>, 4)"
                                        class="text-primary" style="cursor: pointer;">Wysłane</a>
                                </li>
                                <li>
                                    <a onclick="changeStatus('transaction', <?php echo $value->id; ?>, 5)"
                                        class="text-primary" style="cursor: pointer;">Zrealizowane</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            Forma płatności:
                            <p class="font-weight-bold"><?php echo ucfirst($paymentType[$value->payment]); ?></p>
                            <hr>
                            Klient:
                            <p class="font-weight-bold"><?php echo $value->first_name . ' ' . $value->last_name; ?><br>
                                <?php echo $value->email; ?><br>
                                <?php echo $value->phone; ?><br>
                                <?php echo $value->city . ' ' . $value->zipcode; ?><br>

                                <?php if (isset($value->flatnumber)) {
                                    $addresNumber = $value->housenumber . '/' . $value->flatnumber;
                                } else {
                                    $addresNumber = $value->housenumber;
                                } ?>

                                <?php echo $value->street; ?> <?= $addresNumber; ?><br>
                                <?php echo $value->country; ?></p>
                        </div>
                        <?php if ($value->company ?? null) : ?>
                        <div class="col-md-4">
                            Dane firmy:
                            <p class="font-weight-bold"><?php echo $value->company; ?><br>
                                <?php echo $value->nip; ?><br>
                                <?php echo $value->city_company . ' ' . $value->zipcode_company; ?><br>
                                <?php echo $value->address_company; ?><br>
                                <?php echo $value->country_company; ?></p>
                            <hr>
                            <button class="btn btn-sm btn-secondary btn-block" data-toggle="modal"
                                data-target="#modaldemo<?php echo $value->id; ?>" type="button">
                                <i class="icon fas fa-file-pdf mg-r-10"></i> Faktura
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            Komentarz do zamówienia:
                            <p class="font-weight-bold"><?php echo nl2br($value->order_message); ?></p>
                        </div>
                        <div class="col-md-4">
                            Ilość produktów:
                            <p class="font-weight-bold">
                                <?php $pieces = explode("|", $value->qty);
                                $sum = 0;
                                $i = 0;
                                foreach ($pieces as $v) {
                                    $i++;
                                    $sum += $v;
                                    $amount[$i] = $v;
                                }
                                echo $sum ?>
                            </p>
                            <hr>
                            Koszt wysyłki:
                            <?php if ($value->delivery == 'pobranie') : ?>
                            <p class="font-weight-bold">
                                <?php echo number_format($value->delivery_cost_on_delivery, 2); ?> PLN</p>
                            <?php else : ?>
                            <p class="font-weight-bold"><?php echo number_format($value->delivery_cost, 2); ?> PLN</p>
                            <?php endif; ?>
                            <hr>
                            Kwota zamówienia:
                            <p class="font-weight-bold">
                                <?= number_format($value->suma - $value->delivery_cost); ?> PLN
                            </p>
                            <hr>
                            Suma zamówienia:
                            <p class="font-weight-bold">
                                <?= number_format($value->suma); ?> PLN
                            </p>
                        </div>

                        <div class="col-md-4">
                            <?php if ($value->discount_value != '' && $value->discount_value > 0) :
                                $typeDiscount[0] = '%';
                                $typeDiscount[1] = 'PLN'; ?>
                            <hr>
                            Wartość rabatu:
                            <p class="font-weight-bold">
                                <?php echo $value->used_discount ?><br>
                                <?php echo $value->discount_value . ' ' . $typeDiscount[$value->discount_type]; ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="font-weight-bold">Wygeneruj wysyłkę</p>
                            <?php if ($value->inpost_code != null) : ?>
                            <p>Przesyłka do paczkomatu: <br><strong>[<?= $value->inpost_code; ?>]
                                    <?= $value->inpost_parcel; ?></strong></p>
                            <?php endif; ?>
                            <?php $label = $this->back_m->get_where('transaction_shipment', 'transaction_id', $value->id, 'desc'); ?>
                            <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                                data-target="#inpostModal">
                                <img src="<?= base_url('assets/back/img/inpost_logo.png'); ?>" width="24"> InPost
                            </button>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#dpdModal">
                                <img src="<?= base_url('assets/back/img/dpd_logo.png'); ?>" width="24"> DPD
                            </button>
                            <?php if (!empty($label) && $label->courier == 'inpost') : ?>
                            <a href="<?= base_url('panel/transaction/inpost_label/' . $label->package_id); ?>"
                                class="btn btn-secondary" target="_blank">
                                <img src="<?= base_url('assets/back/img/inpost_logo.png'); ?>" width="24"> Etykieta
                            </a>
                            <?php else :
                                $dpd_label = $this->back_m->get_where('dpd_label', 'order_id', $value->id, 'desc'); ?>
                            <?php if (!empty($dpd_label)) : ?>
                            <a href="<?= base_url($dpd_label->pdf); ?>" class="btn btn-secondary" target="_blank">
                                <img src="<?= base_url('assets/back/img/dpd_logo.png'); ?>" width="24"> Etykieta
                            </a>
                            <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card bd-0 mt-4 w-100">
                <div class="card-header bg-dark text-white">
                    Zamówione produkty
                </div>
                <div class="card-body bd bd-t-0 rounded-bottom">
                    <table class="table table-bordered" style="font-size: 10px">
                        <thead class="thead-colored thead-light">
                            <th>Lp</th>
                            <th>Nazwa produktu</th>
                            <th>Ilość</th>
                            <th>Cena jedn. netto / brutto</th>
                            <th>Wartość netto / brutto</th>
                            <th>VAT [%]</th>
                            <th>Kwota podatku</th>
                            <th>Rabat</th>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach (explode("|", $value->name) as $v) : ?>
                            <tr>
                                <td><?= ++$i; ?></td>
                                <td><?= $v; ?></td>
                                <td><?= $qty[$i]; ?> szt.</td>
                                <td><?= number_format($price_netto[$i], 2); ?> PLN /
                                    <?= number_format($price_brutto[$i], 2); ?> PLN</td>
                                <td><?= number_format(($price_netto[$i] * $qty[$i]), 2); ?> PLN /
                                    <?= number_format(($price_brutto[$i] * $qty[$i]), 2); ?> PLN</td>
                                <td>23%</td>
                                <td><?= number_format((($price_brutto[$i] - $price_netto[$i]) * $qty[$i]), 2); ?> PLN
                                </td>
                                <?php if ($value->discount ?? null) : ?>
                                <td><?= $value->discount; ?> %</td>
                                <?php else : ?>
                                <td><?= $value->discount_value . ' ' . $discount_type[$value->discount_type]; ?></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- row -->
        </form><!-- form-layout -->


        <!-- Modal -->
        <div class="modal fade" id="inpostModal" tabindex="-1" role="dialog" aria-labelledby="inpostModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="<?= base_url('panel/transaction/inpost/' . $value->id); ?>"
                    class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Przesyłka InPost</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Rozmiar przesyłki</label>
                        <select class="form-control" name="package_size" onchange="choosenInpost(this)" required>
                            <option value="" selected disabled></option>
                            <option value="small">[A] Mała (8 x 38 x 61 cm | do 25 kg)</option>
                            <option value="medium">[B] Średnia (19 x 38 x 64 cm | do 25 kg)</option>
                            <option value="large">[C] Duża (41 x 38 x 64 cm | do 25 kg)</option>
                            <option value="xlarge">[D] Bardzo duża - tylko dla przesyłek kurierskich (50 x 50 x 80 cm |
                                do 25 kg)</option>
                        </select>
                        <br>
                        <label>Typ przesyłki</label>
                        <select id="packageType" class="form-control" name="package_type"
                            onchange="choosenInpostType(this)" required>
                            <option value="" selected disabled></option>
                            <option value="inpost_locker_standard">Przesyłka paczkomatowa</option>
                            <option value="inpost_courier_c2c">Przesyłka kurierska InPost Kurier</option>
                        </select>
                        <br>
                        <div id="inpostMap" style="display: none">
                            <label>Wybierz paczkomat do nadania</label>
                            <div id="easypack-widget"></div>
                            <br>
                            <label>Wybrany paczkomat</label>
                            <input id="inpost_parcel" class="form-control" type="text" name="paczkomat" required
                                readonly>
                            <input id="inpost_code" type="hidden" name="dropoff_point">
                            <br>
                        </div>
                        <label>Waga paczki w KG</label>
                        <input class="form-control" type="number" name="weight" step="1" required>
                        <br>
                        <label>Długość paczki w cm</label>
                        <input class="form-control" type="number" name="length" step="1" required>
                        <br>
                        <label>Szerokość paczki w cm</label>
                        <input class="form-control" type="number" name="width" step="1" required>
                        <br>
                        <label>Wysokość paczki w cm</label>
                        <input class="form-control" type="number" name="height" step="1" required>
                        <label class="mt-4">Opis dla kuriera</label>
                        <textarea rows="3" class="form-control" name="comment"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-info">Generuj przesyłkę</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="dpdModal" tabindex="-1" role="dialog" aria-labelledby="dpdModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="post" action="<?= base_url('panel/transaction/dpd/' . $value->id); ?>"
                    class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Przesyłka DPD</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Waga paczki w KG</label>
                        <input class="form-control" type="number" name="weight" step="1">
                        <br>
                        <label>Długość paczki w cm</label>
                        <input class="form-control" type="number" name="length" step="1">
                        <br>
                        <label>Szerokość paczki w cm</label>
                        <input class="form-control" type="number" name="width" step="1">
                        <br>
                        <label>Wysokość paczki w cm</label>
                        <input class="form-control" type="number" name="height" step="1">
                        <label class="mt-4">Opis dla kuriera</label>
                        <textarea rows="3" class="form-control" name="message"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-info">Generuj przesyłkę</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- Wiadomość do grupy -->
        <div id="modaldemo<?php echo $value->id; ?>" class="modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bd-0 tx-14">
                    <div class="modal-header pd-y-20 pd-x-25">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Generowanie faktury nr:
                            FA/<?php echo $value->id; ?>/<?= date("Y") ?></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pd-25">
                        <form class="form-layout form-layout-2"
                            action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/generate_pdf/<?php echo $value->id; ?>"
                            method="post" enctype="multipart/form-data">

                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Data wystawienia faktury: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" name="date_of_issue" required>
                                            </div>
                                        </div>

                                        <?php if ($value->paid == '0') : ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Termin płatności: <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="date" name="payment_deadline"
                                                    required>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-layout-footer bd pd-20">
                                                <button class="btn btn-info" type="submit">Wyślij</button>
                                                <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Wiadomość do grupy -->

        <script type="text/javascript">
        function choosenInpost(e) {
            if (e.value == 'xlarge') {
                document.getElementById("packageType").options[1].disabled = true;
            } else {
                document.getElementById("packageType").options[1].disabled = false;
            }
        }

        function choosenInpostType(e) {
            if (e.value == 'inpost_locker_standard') {
                document.getElementById('inpostMap').style.display = 'block';
            } else {
                document.getElementById('inpostMap').style.display = 'none';
            }
        }

        function changeStatus(table, id, value) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>panel/<?= $this->uri->segment(2); ?>/changestatus",
                data: {
                    id: id,
                    value: value,
                    table: table
                },
                cache: false,
                beforeSend: function(html) {
                    console.log(html);
                },
                complete: function(html) {
                    console.log(html);
                    window.location.reload(true);
                    // $("#refreshStatus").load(window.location.href + " #refreshStatus");
                    // $("#refreshDelivery").load(window.location.href + " #refreshDelivery");
                }
            });
        }
        </script>

        <script type="text/javascript">
        function service_load(id) {
            var id = id;
            document.getElementById('check_services').innerHTML =
                '<div class="text-center"><span class="text-center h1-responsive" style="font-size: 4rem;"><i class="fas fa-circle-notch fa-spin"></i></span></div>';
            setTimeout(function() {
                $('#check_services').load(
                    '<?php echo base_url() . 'panel/furgonetka_shipping/create_shipping/' ?>' + id);
            }, 1000);
        }
        </script>

        <script type="text/javascript">
        easyPack.init({
            instance: 'pl',
            mapType: 'osm',
            searchType: 'osm',
            points: {
                types: ['parcel_locker'],
            },
            map: {
                useGeolocation: true,
                initialTypes: ['parcel_locker']
            }
        })
        easyPack.dropdownWidget('easypack-widget', function(point) {
            console.log(point)
            document.getElementById('inpost_code').value = point.name;
            document.getElementById('inpost_parcel').value = '(' + point.name + ') ' + point.address.line1 +
                ', ' + point.address.line2;
        });
        </script>