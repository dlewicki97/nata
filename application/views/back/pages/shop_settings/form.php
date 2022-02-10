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

            <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2); ?>/<?php echo @$value->id; ?>" method="post" enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-12">
                        <p class="mb-3">Faktury - ustawienia</p>
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Nazwa firmy: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="company_name" value="<?php echo @$value->company_name; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force">
                                    <label class="form-control-label">Imię i Nazwisko: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="<?php echo @$value->name; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Miasto i kod pocztowy: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="city" value="<?php echo @$value->city; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Adres <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="adress" value="<?php echo @$value->adress; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">NIP: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="nip" value="<?php echo @$value->nip; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Nr tel: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="phone" value="<?php echo @$value->phone; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Bank oraz numer konta:<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="bank_account" value="<?php echo @$value->bank_account; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                        </div>
                        <p class="mb-3 mt-3">DPD - ustawienia</p>
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Numer FID:</label>
                                    <input class="form-control" type="text" name="dpd_fid" value="<?php echo @$value->dpd_fid; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force">
                                    <label class="form-control-label">Login:</label>
                                    <input class="form-control" type="text" name="dpd_login" value="<?php echo @$value->dpd_login; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Hasło:</label>
                                    <input class="form-control" type="text" name="dpd_password" value="<?php echo @$value->dpd_password; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                <label class="form-control-label">Sandbox:</label>
                                <select class="form-control select2" data-placeholder="Sandbox" name="dpd_sandbox">
                                    <option <?php if(@$value->dpd_sandbox == 1){ echo 'selected'; } ?> value="1">Tak</option>
                                    <option <?php if(@$value->dpd_sandbox == 0){ echo 'selected'; } ?> value="0">Nie</option>
                                </select>
                                </div>
                            </div><!-- col-4 -->
                        </div>
                        <p class="mb-3 mt-3">InPost - ustawienia</p>
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Token:</label>
                                    <input class="form-control" type="text" name="inpost_token" value="<?php echo @$value->inpost_token; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force">
                                    <label class="form-control-label">Login:</label>
                                    <input class="form-control" type="text" name="inpost_login" value="<?php echo @$value->inpost_login; ?>">
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Hasło:</label>
                                    <input class="form-control" type="text" name="inpost_password" value="<?php echo @$value->inpost_password; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-t-0-force bd-l-0-force">
                                <label class="form-control-label">Sandbox:</label>
                                <select class="form-control select2" data-placeholder="Sandbox" name="inpost_sandbox">
                                    <option <?php if(@$value->inpost_sandbox == 1){ echo 'selected'; } ?> value="1">Tak</option>
                                    <option <?php if(@$value->inpost_sandbox == 0){ echo 'selected'; } ?> value="0">Nie</option>
                                </select>
                                </div>
                            </div><!-- col-4 -->
                        </div>
                        <p class="mb-3 mt-3">Przelewy24 - ustawienia</p>
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Merchant ID:</label>
                                    <input class="form-control" type="text" name="p24_id" value="<?php echo @$value->p24_id; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force">
                                    <label class="form-control-label">CRC:</label>
                                    <input class="form-control" type="text" name="p24_crc" value="<?php echo @$value->p24_crc; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force bd-b-0-force">
                                <label class="form-control-label">Sandbox:</label>
                                <select class="form-control select2" data-placeholder="Sandbox" name="p24_sandbox">
                                    <option <?php if(@$value->p24_sandbox == 1){ echo 'selected'; } ?> value="1">Tak</option>
                                    <option <?php if(@$value->p24_sandbox == 0){ echo 'selected'; } ?> value="0">Nie</option>
                                </select>
                                </div>
                            </div><!-- col-4 -->
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-layout-footer bd pd-20">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div><!-- form-group -->
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
            </form><!-- form-layout -->