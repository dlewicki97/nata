    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Opisy formularzy logowania i rejestracji</h4>
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
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Logowanie: </label>
                                    <input class="form-control" type="text" name="login_title"
                                        value="<?php echo @$value->login_title; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Rejestracja: </label>
                                    <input class="form-control" type="text" name="register_title"
                                        value="<?php echo @$value->register_title; ?>">
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
                                    <label class="form-control-label">Nazwisko: </label>
                                    <input class="form-control" type="text" name="last_name"
                                        value="<?php echo @$value->last_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Adres E-mail: </label>
                                    <input class="form-control" type="text" name="email"
                                        value="<?php echo @$value->email; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Numer telefonu: </label>
                                    <input class="form-control" type="text" name="phone"
                                        value="<?php echo @$value->phone; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kraj: </label>
                                    <input class="form-control" type="text" name="country"
                                        value="<?php echo @$value->country; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Miasto: </label>
                                    <input class="form-control" type="text" name="city"
                                        value="<?php echo @$value->city; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Ulica: </label>
                                    <input class="form-control" type="text" name="street"
                                        value="<?php echo @$value->street; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Numer budynku: </label>
                                    <input class="form-control" type="text" name="house"
                                        value="<?php echo @$value->house; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Numer lokalu: </label>
                                    <input class="form-control" type="text" name="flat"
                                        value="<?php echo @$value->flat; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kod pocztowy: </label>
                                    <input class="form-control" type="text" name="zip_code"
                                        value="<?php echo @$value->zip_code; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Hasło: </label>
                                    <input class="form-control" type="text" name="password"
                                        value="<?php echo @$value->password; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Potwierdź hasło: </label>
                                    <input class="form-control" type="text" name="confirm_password"
                                        value="<?php echo @$value->confirm_password; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Napis na przycisku logowania: </label>
                                    <input class="form-control" type="text" name="login_button_name"
                                        value="<?php echo @$value->login_button_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Napis na przycisku rejestracji: </label>
                                    <input class="form-control" type="text" name="register_button_name"
                                        value="<?php echo @$value->register_button_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Zapomniałeś hasła?: </label>
                                    <input class="form-control" type="text" name="password_reminder"
                                        value="<?php echo @$value->password_reminder; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Nie masz konta? Zarejestruj się: </label>
                                    <input class="form-control" type="text" name="register_please"
                                        value="<?php echo @$value->register_please; ?>">
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
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div id="photoViewer_1" class="form-group bd-l-0-force text-center delete_photo cursor"
                                onclick="clear_box(1);">
                                <?php if (@$value->photo != '') {
                                    echo '<img class="img-fluid img-thumbnail" src="' . base_url() . 'uploads/' . $value->photo . '" width=75%>';
                                } else {
                                    echo '<img class="img-fluid img-thumbnail" src="http://via.placeholder.com/64x64" alt="">';
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group bd-t-0-force bd-l-0-force">
                                <label class="form-control-label">Zdjęcie formularza logowania:</label>
                                <input type="hidden" id="name_photo_1" name="name_photo_1">
                                <label class="custom-file">
                                    <input type="file" id="photo_1" class="custom-file-input" name="photo_1">
                                    <span class="custom-file-control custom-file-control-inverse"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="photoViewer_1" class="form-group bd-t-0-force bd-b-0-force bd-l-0-force">
                                <label class="form-control-label">Tekst alternatywny zdjęcia:</label>
                                <input class="form-control" type="text" name="alt" value="<?php echo @$value->alt; ?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div id="photoViewer_2" class="form-group bd-l-0-force text-center delete_photo cursor"
                                onclick="clear_box(2);">
                                <?php if (@$value->photo2 != '') {
                                    echo '<img class="img-fluid img-thumbnail" src="' . base_url() . 'uploads/' . $value->photo2 . '" width=75%>';
                                } else {
                                    echo '<img class="img-fluid img-thumbnail" src="http://via.placeholder.com/64x64" alt="">';
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group bd-t-0-force bd-l-0-force">
                                <label class="form-control-label">Zdjęcie formularza rejestracji:</label>
                                <input type="hidden" id="name_photo_2" name="name_photo_2">
                                <label class="custom-file">
                                    <input type="file" id="photo_2" class="custom-file-input" name="photo_2">
                                    <span class="custom-file-control custom-file-control-inverse"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group bd-t-0-force bd-l-0-force">
                                <label class="form-control-label">Tekst alternatywny zdjęcia formularza
                                    rejestracji:</label>
                                <input class="form-control" type="text" name="alt2"
                                    value="<?php echo @$value->alt2; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </form>