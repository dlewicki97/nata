    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
            <p class="mg-b-0"><?php echo subtitle(); ?></p>
            <hr>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-0 pd-x-30">
            <div id="alert-box" class="d-none"></div>

            <h5 class="tx-gray-800 mg-b-5">Przychód</h5>
            <form class="form-layout form-layout-2"
                action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/add" method="post"
                enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Produkt: <span class="tx-danger">*</span></label>


                                    <input data-form-endpoint="add" class="form-control" list="sku0" type="text"
                                        required>
                                    <datalist id="sku0"></datalist>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pl-0">
                                <div class="form-group bd-l-0-force">
                                    <label class="form-control-label">Ilość sztuk do dodania:</label>
                                    <input class="form-control" step="1" type="number" name="qty0"
                                        value="<?php echo @$value->qty; ?>">
                                </div>
                            </div><!-- col-4 -->
                        </div> <!-- set -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-layout-footer bd-t-0-force bd pd-20">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <button class="btn btn-secondary"
                                        onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div><!-- form-group -->
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

            </form><!-- form-layout -->

            <hr>

            <h5 class="tx-gray-800 mg-b-5">Rozchód</h5>
            <form class="form-layout form-layout-2"
                action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/remove"
                method="post" enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Produkt: <span class="tx-danger">*</span></label>
                                    <input data-form-endpoint="remove" class="form-control" list="sku1" type="text"
                                        required>
                                    <datalist id="sku1"></datalist>

                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pl-0">
                                <div class="form-group bd-l-0-force">
                                    <label class="form-control-label">Ilość sztuk do odjęcia:</label>
                                    <input class="form-control" step="1" type="number" name="qty1" value="">
                                </div>
                            </div><!-- col-4 -->
                        </div> <!-- set -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-layout-footer bd-t-0-force bd pd-20">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <button class="btn btn-secondary"
                                        onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div><!-- form-group -->
                            </div>
                        </div>
                    </div>
                </div><!-- row -->

            </form><!-- form-layout -->


            <script>
            let forms = document.querySelectorAll('form');

            forms.forEach((form, i) => {
                const input = form.querySelector(`input[list]`);


                form.addEventListener('submit', e => {
                    e.preventDefault();

                    const sku = input.value.match(/\[(.*)\]/g).join("").replaceAll(/(\[|\])/g, "");
                    const qtyInput = document.querySelector(`input[name=qty${i}]`);
                    const qty = qtyInput.value;

                    let body = new FormData();
                    body.append("sku", sku);
                    body.append("qty", qty);

                    fetch(
                            `${form.action}`, {
                                method: 'POST',
                                body
                            })
                        .then(res => res.json())
                        .then(data => {
                            console.log(data);
                            if (data.status) {
                                input.value = '';
                                qtyInput.value = '';
                            }
                            let alertBox = document.querySelector('#alert-box');
                            alertBox.innerHTML = data.message;
                            alertBox.classList.remove('d-none');


                            setTimeout(() => alertBox.classList.add('d-none'), 3000);
                        })
                })
                let datalist = form.querySelector('datalist');
                input.addEventListener('keyup', async () => {
                    console.log(input.value)
                    let body = new FormData();
                    body.append("search", input.value);
                    body.append("limit", 50);
                    await fetch(
                            `<?= base_url("api/products/search_panel") ?>`, {
                                method: 'POST',
                                body,
                            })
                        .then(res => res.json())
                        .then(products => {
                            datalist.innerHTML = '';
                            for (let i = 0; i < products.length; i++) {
                                const product = products[i];
                                const value =
                                    `SKU: [${product.sku}], (Ilość: ${product.qty}), ${product.name}`;
                                datalist.innerHTML +=
                                    `<option value="${value}">${value}</option>`;
                            }
                        })
                })
            })
            </script>