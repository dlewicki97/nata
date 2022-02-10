    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Podstrony</h4>
            <p class="mg-b-0"><?php echo subtitle(); ?></p>
            <hr>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-0 pd-x-30">
            <?php if (isset($_SESSION['flashdata'])) : ?>
                <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
            <?php endif; ?>

            <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2) . '/' . @$value->id; ?>" method="post" enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-12 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Tytuł: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="title" value="<?php echo @$value->title; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Link</label>
                                    <input class="form-control" type="text" name="link" value="<?php echo @$value->link; ?>" readonly>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Meta title: (SEO)</label>
                                    <input class="form-control" type="text" name="meta_title" value="<?php echo @$value->meta_title; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Meta description: (SEO)</label>
                                    <input class="form-control" type="text" name="meta_description" value="<?php echo @$value->meta_description; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Keywords: (SEO)</label>
                                    <input class="form-control" type="text" name="keywords" value="<?php echo @$value->keywords; ?>" data-role="tagsinput">
                                </div>
                            </div><!-- col-4 -->
                        </div> <!-- set -->
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-layout-footer bd pd-20 bd-t-0-force">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div><!-- form-group -->
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </form><!-- form-layout -->