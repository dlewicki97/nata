    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Opisy ustawień konta</h4>
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
                                    <label class="form-control-label">Jesteś klientem:</label>
                                    <input class="form-control" type="text" name="you_are_a_client"
                                        value="<?php echo @$value->you_are_a_client; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Detalicznym: </label>
                                    <input class="form-control" type="text" name="detail"
                                        value="<?php echo @$value->detail; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Hurtowym: </label>
                                    <input class="form-control" type="text" name="wholesale"
                                        value="<?php echo @$value->wholesale; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Imię: </label>
                                    <input class="form-control" type="text" name="first_name"
                                        value="<?php echo @$value->first_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Nazwisko:</label>
                                    <input class="form-control" type="text" name="last_name"
                                        value="<?php echo @$value->last_name; ?>">
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
                                    <label class="form-control-label">Kraj:</label>
                                    <input class="form-control" type="text" name="country"
                                        value="<?php echo @$value->country; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Miasto:</label>
                                    <input class="form-control" type="text" name="city"
                                        value="<?php echo @$value->city; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kod pocztowy:</label>
                                    <input class="form-control" type="text" name="zip_code"
                                        value="<?php echo @$value->zip_code; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Ulica:</label>
                                    <input class="form-control" type="text" name="street"
                                        value="<?php echo @$value->street; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Numer budynku:</label>
                                    <input class="form-control" type="text" name="house_number"
                                        value="<?php echo @$value->house_number; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Numer lokalu:</label>
                                    <input class="form-control" type="text" name="flat_number"
                                        value="<?php echo @$value->flat_number; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">NIP:</label>
                                    <input class="form-control" type="text" name="nip"
                                        value="<?php echo @$value->nip; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Nazwa firmy:</label>
                                    <input class="form-control" type="text" name="company"
                                        value="<?php echo @$value->company; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kraj firmy:</label>
                                    <input class="form-control" type="text" name="country_company"
                                        value="<?php echo @$value->country_company; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Miasto firmy:</label>
                                    <input class="form-control" type="text" name="city_company"
                                        value="<?php echo @$value->city_company; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kod pocztowy firmy:</label>
                                    <input class="form-control" type="text" name="zip_code_company"
                                        value="<?php echo @$value->zip_code_company; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Adres firmy:</label>
                                    <input class="form-control" type="text" name="address_company"
                                        value="<?php echo @$value->address_company; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Nowe hasło:</label>
                                    <input class="form-control" type="text" name="new_password"
                                        value="<?php echo @$value->new_password; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Twoje obecne hasło:</label>
                                    <input class="form-control" type="text" name="old_password"
                                        value="<?php echo @$value->old_password; ?>">
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