    <!-- ########## START: MAIN PANEL ########## -->
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
            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p align-top">L.p.</th>
                            <th class="wd-5p align-top">Menu</th>
                            <th class="wd-5p align-top">Strona<br>główna</th>
                            <th class="wd-5p align-top">Strona<br>główna<br>kolejność</th>
                            <th class="wd-45p align-top">Tytuł</th>
                            <th class="wd-50p text-right no-sort">
                                <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/insert"
                                    class="btn btn-sm btn-info"><i class="fa fa-plus mg-r-10"></i> Dodaj</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
              foreach (array_reverse($rows) as $value) : $i++; ?>
                        <tr>
                            <td class="align-middle"><?php echo $i; ?>.</td>
                            <td class="align-middle">
                                <label class="ckbox">
                                    <input type="checkbox" id="menu<?php echo $value->id; ?>"
                                        onchange="menu(<?php echo $value->id; ?>, '<?php echo $this->uri->segment(2); ?>');"
                                        <?php if (@$value->menu == 1) echo 'checked'; ?>>
                                    <span></span>

                                </label>
                            </td>
                            <td class="align-middle">
                                <label class="ckbox">
                                    <input class="home-checkbox" type="checkbox" id="home<?php echo $value->id; ?>"
                                        onchange="home(<?php echo $value->id; ?>, '<?php echo $this->uri->segment(2); ?>');"
                                        <?php if (@$value->home == 1)  echo 'checked'; ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td class="align-middle">
                                <input class="main-home-checkbox" style="color: black;" type="number"
                                    id="main-home<?php echo $value->id; ?>"
                                    onkeyup="homeOrder(<?php echo $value->id; ?>, '<?php echo $this->uri->segment(2); ?>');"
                                    value="<?= @$value->home_order ?>">
                            </td>
                            <td class="align-middle"><?php echo $value->title; ?></td>
                            <td class="text-right">
                                <a href="<?php echo base_url(); ?>panel/settings/gallery/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>"
                                    class="btn btn-sm btn-secondary"><i class="icon ion-images mg-r-10"></i> Galeria</a>
                                <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/update/<?php echo $value->id; ?>"
                                    class="btn btn-sm btn-info"><i class="icon ion-compose mg-r-10"></i> Edytuj</a>
                                <a href="<?php echo base_url(); ?>panel/settings/delete/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>"
                                    class="btn btn-sm btn-secondary"
                                    onclick="return confirm('Czy na pewno chcesz usunąć <?php echo $value->title; ?>? #<?php echo $value->id; ?>')">
                                    <i class="fa fa-close mg-r-10"></i> Usuń
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- table-wrapper -->

            <script type="text/javascript">
            function menu(id, table) {
                value = document.getElementById('menu' + id).checked;
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/menu",
                    data: {
                        id: id,
                        value: +Boolean(value),
                        table: table
                    },
                    cache: false,
                    beforeSend: function(html) {
                        console.log(html);
                    },
                    complete: function(html) {
                        console.log(html);
                    }
                });
            }

            function home(id, table) {
                var id = id;
                var value = document.getElementById('home' + id).checked;
                setHomeCheckboxes();
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/home",
                    data: {
                        id: id,
                        value: +Boolean(value),
                        table: table
                    },
                    cache: false,
                    complete: function(html) {
                        console.log(html);
                        $('#refreshSend').load(document.URL + ' #refreshSend', function() {
                            initializeOneMoreTime();
                        });
                    }
                });
            }

            function homeOrder(id, table) {
                var id = id;
                var value = document.getElementById('main-home' + id).value;
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/home_order",
                    data: {
                        id: id,
                        value: +(value),
                        table: table
                    },
                    cache: false,
                    complete: function(html) {
                        console.log(html);
                        $('#refreshSend').load(document.URL + ' #refreshSend', function() {
                            initializeOneMoreTime();
                        });
                    }
                });
            }
            setHomeCheckboxes();

            function setHomeCheckboxes() {
                let checkboxes = document.querySelectorAll('.home-checkbox');
                let actives = 0;
                checkboxes.forEach(checkbox => {
                    if (Boolean(checkbox.checked)) actives++;
                    if (actives === 3) {
                        checkboxes.forEach(ckb => ckb.disabled = !Boolean(ckb.checked));
                        return;
                    } else {
                        checkboxes.forEach(ckb => ckb.disabled = false);
                    }
                });
            }
            </script>