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
                                    <label class="form-control-label">Tytuł: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="title"
                                        value="<?php echo @$value->title; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Imię i nazwisko:</label>
                                    <input class="form-control" type="text" name="name"
                                        value="<?php echo @$value->name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Adres E-mail:</label>
                                    <input class="form-control" type="text" name="email"
                                        value="<?php echo @$value->email; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Telefon:</label>
                                    <input class="form-control" type="text" name="phone"
                                        value="<?php echo @$value->phone; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Temat:</label>
                                    <input class="form-control" type="text" name="subject"
                                        value="<?php echo @$value->subject; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Wiadomość:</label>
                                    <input class="form-control" type="text" name="message"
                                        value="<?php echo @$value->message; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Napis na przycisku:</label>
                                    <input class="form-control" type="text" name="button_name"
                                        value="<?php echo @$value->button_name; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-layout-footer bd pd-20 bd-t-0-force">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <button class="btn btn-secondary"
                                        onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>