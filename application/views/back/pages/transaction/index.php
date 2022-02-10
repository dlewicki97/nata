<?php if (isset($_GET['detaliczne'])) {
    if (isset($_GET['status'])) :
        $typeaccount = ' - zakończone detaliczne';
    else :
        $typeaccount = ' - detaliczne';
    endif;
    $typeclient = 0;
}
if (isset($_GET['hurtowe'])) {
    if (isset($_GET['status'])) :
        $typeaccount = ' - zakończone hurtowe';
    else :
        $typeaccount = ' - hurtowe';
    endif;
    $typeclient = 1;
}

?>
<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">
            <?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) . $typeaccount; ?></h4>
        <p class="mg-b-0"><?php echo subtitle(); ?></p>
        <hr>
    </div><!-- d-flex -->
    <div class="br-pagebody mg-t-0 pd-x-30">
        <?php if (isset($_SESSION['flashdata'])) : ?>
        <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
        <?php endif; ?>
        <div class="table-wrapper">
            <span id="refreshTable">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p align-top">L.p.</th>
                            <th class="wd-10p align-top">Data</th>
                            <th class="wd-1p align-top">Opłacone</th>
                            <th class="wd-30p align-top">Produkty</th>
                            <th class="wd-10p align-top">Zamawiający</th>
                            <th class="wd-10p align-top">Status</th>
                            <th class="wd-30p text-right no-sort">
                                <!-- <a target="_BLANK" href="https://konto.furgonetka.pl/logowanie?backUrl=furgonetka.pl/konto"><button class="btn btn-info">Przejdź do panelu Furgonetka.pl</button></a> -->
                            </th>
                        </tr>
                    </thead>
                    <?php if (isset($_GET['status'])) :
                        $data['rows'] = $this->back_m->get_finished_transactions_by_typeaccount($this->uri->segment(2), $typeclient);
                    else :
                        $data['rows'] = $this->back_m->get_transactions_by_typeaccount($this->uri->segment(2), $typeclient);
                    endif; ?>
                    <tbody>
                        <?php $i = 0;
                        foreach (array_reverse($data['rows']) as $value) : $i++; ?>
                        <tr id="changeBg<?= $value->id; ?>" style="background-color:
                            <?php if ($value->status == '0') {
                                echo '#2196f3';
                            } elseif ($value->status == '1') {
                                echo '#f4511e';
                            } elseif ($value->status == '2') {
                                echo '#f44336';
                            } elseif ($value->status == '3') {
                                echo '#00796b';
                            } elseif ($value->status == '4') {
                                echo '#ffa000';
                            } elseif ($value->status == '5') {
                                echo '#00C851';
                            } ?>;">
                            <td class="align-middle"><?php echo $i; ?>.</td>
                            <td class="align-middle order_tab_color"><?= $value->created; ?></td>
                            <td id="changeBgCheck<?= $value->id; ?>" class="align-middle" style="background-color:
                                    <?php if ($value->paid == 1) {
                                        echo '#00C851';
                                    } ?>;">
                                <label class="ckbox">
                                    <input type="checkbox" id="checkPayment<?php echo $value->id; ?>"
                                        onchange="activePayment('transaction', <?php echo $value->id; ?>);"
                                        <?php if ($value->paid == 1) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td class="align-middle order_tab_color">
                                <?php $products = explode('|', $value->name);
                                    foreach ($products as $v) {
                                        echo $v . '<br>';
                                    } ?>
                            </td>
                            <td class="align-middle order_tab_color">
                                <?= $value->first_name; ?> <?= $value->last_name; ?><br>
                                <small><?= $value->email; ?></small>
                            </td>
                            <td class="align-middle">
                                <select id="status<?= $value->id; ?>" class="form-control select2" style="width: 100%;"
                                    onchange="changeStatus('transaction', <?= $value->id; ?>)">
                                    <option value="0" <?php if ($value->status == '0') {
                                                                echo 'selected';
                                                            } ?>>
                                        W trakcie realizacji
                                    </option>
                                    <option value="1" <?php if ($value->status == '1') {
                                                                echo 'selected';
                                                            } ?>>
                                        Anulowane przez administratora
                                    </option>
                                    <option value="2" <?php if ($value->status == '2') {
                                                                echo 'selected';
                                                            } ?>>
                                        Anulowane przez klienta
                                    </option>
                                    <option value="3" <?php if ($value->status == '3') {
                                                                echo 'selected';
                                                            } ?>>
                                        Zatwierdzone
                                    </option>
                                    <option value="4" <?php if ($value->status == '4') {
                                                                echo 'selected';
                                                            } ?>>
                                        Wysłane
                                    </option>
                                    <option value="5" <?php if ($value->status == '5') {
                                                                echo 'selected';
                                                            } ?>>
                                        Zrealizowane
                                    </option>
                                </select>
                            </td>
                            <td class="align-middle text-right">
                                <span id="refreshTable<?= $value->id; ?>">
                                    <?php if ($value->company ?? null) : ?>
                                    <a data-toggle="modal" data-target="#modaldemo<?php echo $value->id; ?>"
                                        class="btn btn-sm btn-info text-white"><i
                                            class="icon fas fa-file-invoice-dollar mg-r-10 text-white"></i> Faktura</a>
                                    <?php endif; ?>
                                    <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/update/<?php echo $value->id; ?>"
                                        class="btn btn-sm btn-info"><i class="icon ion-compose mg-r-10"></i>
                                        Szczegóły</a>
                                    <a href="<?php echo base_url(); ?>panel/settings/delete/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>"
                                        class="btn btn-sm btn-secondary"
                                        onclick="return confirm('Czy na pewno chcesz usunąć zamówienie klienta <?php echo $value->first_name; ?>? #<?php echo $value->id; ?>')">
                                        <i class="fa fa-close mg-r-10"></i> Usuń
                                    </a>
                                </span>
                            </td>
                        </tr>
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
                                                                <label class="form-control-label">Data wystawienia
                                                                    faktury: <span class="tx-danger">*</span></label>
                                                                <input class="form-control" type="date"
                                                                    name="date_of_issue" required>
                                                            </div>
                                                        </div>

                                                        <?php if ($value->paid == '0') : ?>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label">Termin płatności:
                                                                    <span class="tx-danger">*</span></label>
                                                                <input class="form-control" type="date"
                                                                    name="payment_deadline" required>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>

                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="form-layout-footer bd pd-20">
                                                                <button class="btn btn-info"
                                                                    type="submit">Wyślij</button>
                                                                <button class="btn btn-secondary"
                                                                    data-dismiss="modal">Anuluj</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Wiadomość do grupy -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </span>
        </div><!-- table-wrapper -->


        <script type="text/javascript">
        function activePayment(table, id) {
            value = document.getElementById('checkPayment' + id).checked;
            if (value == true) {
                value = 1;
                color = '#00C851';
            } else {
                value = 0;
                color = '';
            }
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>panel/<?= $this->uri->segment(2); ?>/activePayment",
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
                    $("#refreshTable" + id).load(window.location.href + " #refreshTable" + id);
                    document.getElementById('changeBgCheck' + id).style.background = color;
                }
            });
        }
        </script>
        <script type="text/javascript">
        function changeStatus(table, id) {
            value = document.getElementById('status' + id).value;
            if (value == 0) {
                color = '#2196f3';
            } else if (value == 1) {
                color = '#f4511e';
            } else if (value == 2) {
                color = '#f44336';
            } else if (value == 3) {
                color = '#00796b';
            } else if (value == 4) {
                color = '#ffa000';
            } else if (value == 5) {
                color = '#00C851';
            }
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
                    $("#refreshTable").load(window.location.href + " #refreshTable", function() {
                        initializeOneMoreTime();
                    });
                    //initializeOneMoreTime();
                    document.getElementById('changeBg' + id).style.background = color;

                }
            });
        }
        </script>