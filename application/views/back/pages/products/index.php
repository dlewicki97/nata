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
            <div class="table-wrapper bg-white p-3 rounded">
                <div class="paging text-right">
                    Przejdź na stronę: &nbsp;
                    <input class="page_number" type="number" id="page" step="1"
                        value="<?= ceil($this->uri->segment(4) / 10) + 1; ?>"
                        onchange="getPage(<?= ceil(count($count) / 10); ?>)" min="1"
                        max="<?= ceil(count($count) / 10); ?>">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                <table class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p align-top">L.p.</th>
                            <th class="wd-5p align-top"></th>
                            <th class="wd-30p align-top">Tytuł</th>
                            <th class="wd-45p text-right no-sort">
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4">
                                        <div class="input-group  form-sm form-2 pl-0">
                                            <input id="products-count" class="form-control my-0 py-1 red-border"
                                                type="number" value="<?= $_COOKIE['panelProductsCount'] ?? 10 ?>"
                                                placeholder="Wyników na stronie">
                                            <input id="products-search" class="form-control my-0 py-1 red-border"
                                                type="text" data-filter="productsSearch"
                                                value="<?= $_COOKIE['panelProductsSearch'] ?? "" ?>"
                                                placeholder="Wyszukaj" aria-label="Search">
                                        </div>
                                        <div id="loadProducts"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/insert"
                                            class="btn btn-sm btn-info"><i class="fa fa-plus mg-r-10"></i> Dodaj</a>
                                    </div>
                                </div>
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
                                    <input type="checkbox" id="check<?php echo $value->id; ?>"
                                        onchange="active(<?php echo $value->id; ?>, '<?php echo $this->uri->segment(2); ?>');"
                                        <?php if ($value->active == 1) echo 'checked'; ?>>
                                    <span><strong>Aktywne</strong></span>
                                </label>
                            </td>
                            <td class="align-middle">
                                <div class="product_name">

                                    <?php if ($value->low_qty >= $this->shop_m->variant('variants', $value->id)->qty) : ?>
                                    <?php if ($this->shop_m->variant('variants', $value->id)->qty <= 0) : ?>
                                    <span class="qty_warning">
                                        <i class="fas fa-exclamation-circle text-danger" data-container="body"
                                            data-toggle="popover" data-popover-color="default" data-placement="top"
                                            data-html="true"
                                            data-content="Brak produktu na stanie magazynowym.<br>Pozostało sztuk: <strong><?= $this->shop_m->variant('variants', $value->id)->qty; ?></strong><br>Optymalna ilość produktu wynosi: <strong><?= $value->low_qty; ?></strong>"></i>
                                    </span>
                                    <?php else : ?>
                                    <span class="qty_warning">
                                        <i class="fas fa-exclamation-triangle text-warning" data-container="body"
                                            data-toggle="popover" data-popover-color="default" data-placement="top"
                                            data-html="true"
                                            data-content="Niski stan magazynowy produktu.<br>Pozostało sztuk: <strong><?= $this->shop_m->variant('variants', $value->id)->qty; ?></strong>.<br>Optymalna ilość produktu wynosi: <strong><?= $value->low_qty; ?></strong>"></i>
                                    </span>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($value->photo != null) : ?>
                                    <img src="<?= $value->photo; ?>" width="auto" style="max-height: 48px;">
                                    <?php endif; ?>
                                    <?= substr($value->name, 0, 50); ?>
                                    <?php if (strlen($value->name) > 49) {
                                            echo '...';
                                        } ?>
                                </div>
                            </td>
                            <td class="text-right">
                                <!-- <a href="<?php echo base_url(); ?>panel/settings/gallery/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>"
                                    class="btn btn-sm btn-secondary"><i class="icon ion-images mg-r-10"></i> Galeria</a> -->
                                <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/update/<?php echo $value->id; ?>"
                                    class="btn btn-sm btn-info"><i class="icon ion-compose mg-r-10"></i> Edytuj</a>
                                <a href="<?php echo base_url(); ?>panel/settings/delete/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>"
                                    class="btn btn-sm btn-secondary"
                                    onclick="return confirm('Czy na pewno chcesz usunąć <?php echo $value->name; ?>? #<?php echo $value->id; ?>')">
                                    <i class="fa fa-close mg-r-10"></i> Usuń
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- table-wrapper -->



            <script type="text/javascript">
            function getPage(max) {
                page = document.getElementById('page').value;
                if (max < page) {
                    page = max
                }
                if (page <= 0) {
                    page = 1
                }
                page = (page - 1) * 10;
                window.location.href = "<?= base_url('panel/' . $this->uri->segment(2) . '/index/'); ?>" + page;
            }
            </script>


            <script type="text/javascript">
            function active(id, table) {
                value = document.getElementById('check' + id).checked;
                if (value == true) {
                    value = 1;
                } else {
                    value = 0;
                }
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/active",
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
                    }
                });
            }

            document.querySelector('#products-search').addEventListener('keyup', renderProducts);
            document.querySelector('#products-count').addEventListener('keyup', setProductsCount);
            document.querySelector('#products-search').addEventListener('focus', openProductsList);

            function setProductsCount(e) {
                if (e.key == 'Enter') {
                    setCookie('panelProductsCount', e.target.value, 30);
                    window.location.reload();
                }
            }

            function renderProducts(e) {
                if (e.key == 'Enter') {
                    setCookie('panelProductsSearch', e.target.value, 30);
                    window.location.reload();
                }
                $("#loadProducts").load(`<?= base_url(); ?>panel/products/render_products/${e.target.value}`);
            }

            function resetSearchList() {
                document.querySelector('#productsSearch').style.display = 'none';
            }

            function openProductsList() {
                document.querySelector('#productsSearch').style.display = 'block';
            }

            function setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                let expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
            </script>