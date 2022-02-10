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
                            <th class="wd-5p align-top">ID</th>
                            <th class="wd-45p align-top">Nazwa produktu</th>
                            <th class="wd-30p align-top">Stan magazynowy</th>
                            <th class="wd-20p text-right no-sort">
                                <a href class="btn btn-sm btn-info generate-pdf"><i class="far fa-file-pdf mg-r-10"></i>
                                    Generuj PDF</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($rows as $value) :
                            $data['inventory'] = $this->shop_m->variant('variants', $value->id);

                        ?>

                        <tr>
                            <td class="align-middle"><?php echo $value->id; ?></td>
                            <td class="align-middle"><a
                                    href="<?= base_url("panel/products/update/$value->id") ?>"><?php echo $value->name; ?></a>
                            </td>
                            <td class="align-middle"><?php echo $data['inventory']->qty;
                                                            ?></td>
                            <td class="text-right">
                            </td>
                        </tr>
                        <?php $i++;
                        endforeach; ?>
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




            <script>
            document.querySelector('.generate-pdf').addEventListener('click', async e => {
                e.preventDefault();

                let productsCount = <?= $this->back_m->get_count('products'); ?>;

                let pdfSegments = productsCount / 1007;

                for (let i = 0; i < pdfSegments; i++) {

                    await fetch(`<?= base_url('panel/inventory_report/generate_pdf_segment/') ?>${i}`)
                        .then(function(res) {
                            return res.json();
                        })
                        .then(function(data) {
                            console.log(`${parseInt((i + 1)/pdfSegments)}%`)
                        })
                }
            })
            </script>