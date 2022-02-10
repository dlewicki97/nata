    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
            <p class="mg-b-0"><?php echo subtitle(); ?></p>
            <hr>
        </div>

        <div class="br-pagebody mg-t-0 pd-x-30">
            <?php if (isset($_SESSION['flashdata'])) : ?>
            <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
            <?php endif; ?>

            <form class="form-layout form-layout-2"
                action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2); ?>/<?php echo @$value->id; ?>"
                method="post" enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Temat: <span class="tx-danger">*</span></label>
                                    <input class="form-control" <?php if (isset($value)) echo 'disabled';  ?>
                                        type="text" name="subject" value="<?php echo @$value->subject; ?>" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force bd-b-0-force">
                                    <label class="form-control-label">Wiadomość: <span
                                            class="tx-danger">*</span></label>
                                    <?php if (isset($value)) :  ?>
                                    <div style="color: black; font-size: 0.875rem; font-weight: 500">
                                        <?php echo @$value->message; ?>
                                    </div>
                                    <?php else : ?>
                                    <textarea required class="summernote"
                                        name="message"><?php echo @$value->message; ?></textarea>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-layout-footer bd pd-20">
                                    <button class="btn btn-info" <?php if (isset($value)) echo 'disabled'; ?>
                                        type="submit">Zapisz</button>
                                    <button class="btn btn-secondary"
                                        onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>