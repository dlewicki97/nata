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

        <form class="form-layout form-layout-2"
            action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2); ?>/<?php echo @$value->id; ?>"
            method="post" enctype="multipart/form-data">



            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab"
                        aria-controls="data" aria-selected="true">Dane produktu</a>
                </li>
                <?php if (isset($value)) : ?>
                <li class="nav-item">
                    <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="photo"
                        aria-selected="false">Zdjęcie</a>
                </li>
                <!-- 
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo base_url(); ?>panel/settings/gallery/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>"
                        onclick="window.open('<?php echo base_url(); ?>panel/settings/gallery/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>', 'newwindow', 'width=1280,height=1024'); return false;"
                        target="_blank">Galeria zdjęć</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" id="prices-tab" data-toggle="tab" href="#prices" role="tab"
                        aria-controls="prices" aria-selected="false">Ceny produktu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab"
                        aria-controls="delivery" aria-selected="false">Wysyłka</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab"
                        aria-controls="details" aria-selected="false">Właściwości</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="settings2-tab" data-toggle="tab" href="#settings2" role="tab"
                        aria-controls="settings2" aria-selected="false">Ustawienia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="variants-tab" data-toggle="tab" href="#variants" role="tab"
                        aria-controls="variants" aria-selected="false">Magazyn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="opinions-tab" data-toggle="tab" href="#opinions" role="tab"
                        aria-controls="opinions" aria-selected="false">Opinie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="related_products-tab" data-toggle="tab" href="#related_products" role="tab"
                        aria-controls="related_products" aria-selected="false">Powiązane produkty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="additonal_parameters-tab" data-toggle="tab" href="#additonal_parameters"
                        role="tab" aria-controls="additonal_parameters" aria-selected="false">Filtry</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo"
                        aria-selected="false">SEO</a>
                </li>
                <?php endif; ?>

            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade  show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                    <?php $this->load->view('back/pages/products/data.php'); ?>
                </div>

                <?php if (isset($value)) : ?>
                <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                    <?php $this->load->view('back/pages/products/photo.php'); ?>
                </div>

                <div class="tab-pane fade" id="prices" role="tabpanel" aria-labelledby="prices-tab">
                    <?php $this->load->view('back/pages/products/prices.php'); ?>
                </div>

                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                    <?php $this->load->view('back/pages/products/delivery.php'); ?>
                </div>

                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <?php $this->load->view('back/pages/products/details.php'); ?>
                </div>

                <div class="tab-pane fade" id="settings2" role="tabpanel" aria-labelledby="settings2-tab">
                    <?php $this->load->view('back/pages/products/settings.php'); ?>
                </div>

                <div class="tab-pane fade" id="variants" role="tabpanel" aria-labelledby="variants-tab">
                    <?php $this->load->view('back/pages/products/variants.php'); ?>
                </div>

                <div class="tab-pane fade" id="opinions" role="tabpanel" aria-labelledby="opinions-tab">
                    <?php $this->load->view('back/pages/products/opinions.php'); ?>
                </div>

                <div class="tab-pane fade" id="related_products" role="tabpanel" aria-labelledby="related_products-tab">
                    <?php $this->load->view('back/pages/products/related_products.php'); ?>
                </div>

                <div class="tab-pane fade" id="additonal_parameters" role="tabpanel"
                    aria-labelledby="additonal_parameters-tab">
                    <?php $this->load->view('back/pages/products/additional_parameteres.php'); ?>
                </div>

                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    <?php $this->load->view('back/pages/products/seo.php'); ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-layout-footer bd bd-t-0-force pd-20">
                                <button class="btn btn-info" type="submit">Zapisz</button>
                                <a class="btn btn-secondary" href="<?= base_url("panel/products") ?>">
                                    Anuluj

                                </a>
                                <?php if ($value ?? null) : ?>
                                <a class="btn btn-danger"
                                    onclick="return confirm('Czy na pewno chcesz usunąć <?php echo $value->name; ?>? #<?php echo $value->id; ?>')"
                                    href="<?php echo base_url(); ?>panel/products/delete/<?php echo $value->id; ?>">
                                    Usuń
                                </a>
                                <?php endif; ?>
                            </div><!-- form-group -->
                        </div>
                    </div>
                </div>
            </div>
        </form><!-- form-layout -->