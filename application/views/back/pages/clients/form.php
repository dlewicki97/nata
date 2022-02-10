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
                <?php if (@$value->active == 0) {
                    echo '<p class="text-danger">Ten użytkownik nie zweryfikował jeszcze swojego konta. 
                <a href="' . base_url('panel/' . $this->uri->segment(2) . '/resendActive/' . $value->id) . '">Wyślij przypomnienie</a>';
                } ?>
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="row">
                            <!-- set -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Imię: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="first_name"
                                        value="<?php echo @$value->first_name; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force">
                                    <label class="form-control-label">Nazwisko: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name"
                                        value="<?php echo @$value->last_name; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">E-mail: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="email"
                                        value="<?php echo @$value->email; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Telefon: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="phone"
                                        value="<?php echo @$value->phone; ?>" required>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kraj: </label>
                                    <input class="form-control" type="text" name="country"
                                        value="<?php echo @$value->country; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Miasto:</label>
                                    <input class="form-control" type="text" name="city"
                                        value="<?php echo @$value->city; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kod pocztowy: </label>
                                    <input class="form-control" type="text" name="zipcode"
                                        value="<?php echo @$value->zipcode; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Adres:</label>
                                    <input class="form-control" type="text" name="street"
                                        value="<?php echo @$value->street; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Numer domu: </label>
                                    <input class="form-control" type="text" name="housenumber"
                                        value="<?php echo @$value->housenumber; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Numer mieszkania:</label>
                                    <input class="form-control" type="text" name="flatnumber"
                                        value="<?php echo @$value->flatnumber; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Nazwa firmy: </label>
                                    <input class="form-control" type="text" name="country"
                                        value="<?php echo @$value->company; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">NIP:</label>
                                    <input class="form-control" type="text" name="city"
                                        value="<?php echo @$value->nip; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kod pocztowy siedziby firmy: </label>
                                    <input class="form-control" type="text" name="zipcode_company"
                                        value="<?php echo @$value->zipcode_company; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Miasto siedziby firmy:</label>
                                    <input class="form-control" type="text" name="city_company"
                                        value="<?php echo @$value->city_company; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Adres siedziby firmy: </label>
                                    <input class="form-control" type="text" name="address_company"
                                        value="<?php echo @$value->address_company; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group bd-l-0-force bd-t-0-force">
                                    <label class="form-control-label">Kraj siedziby firmy:</label>
                                    <input class="form-control" type="text" name="country_company"
                                        value="<?php echo @$value->country_company; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Rabat (%): </label>
                                    <input class="form-control" type="text" name="discount"
                                        value="<?php echo @$value->discount; ?>">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group  bd-t-0-force  bd-l-0-force">
                                    <label class="form-control-label">Rodzaj klienta:</label>
                                    <select name="type_client" class="form-control select2" style="width: 100%;">
                                        <option value="0" <?php if (@$value->type_client == '0') {
                                                                echo 'selected';
                                                            } ?>>
                                            Klient detaliczny
                                        </option>
                                        <option value="1" <?php if (@$value->type_client == '1') {
                                                                echo 'selected';
                                                            } ?>>
                                            Klient hurtowy
                                        </option>
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Grupa klienta:</label>
                                    <select name="client_group" class="form-control select2" style="width: 100%;">
                                        <option value="">Wybierz do której grupy ma należeć klient</option>
                                        <?php foreach ($groups as $v) : ?>
                                        <option value="<?= $v->id; ?>" <?php if (@$v->id == @$value->client_group) {
                                                                                echo 'selected';
                                                                            } ?>>
                                            <?= $v->title; ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-md-6 px-0">
                                <div class="form-group  bd-t-0-force bd-l-0-force">
                                    <label class="form-control-label">
                                        Hasło <small>(zostaw to pole puste, jeżeli nie chcesz zmieniać hasła)</small>:
                                        <small style="cursor: pointer"
                                            onclick="document.getElementById('change_password').value = generatePassword();">
                                            (KLIKNIJ ABY WYGENEROWAĆ)
                                        </small>
                                    </label>
                                    <input id="change_password" class="form-control" type="text" name="password"
                                        placeholder="Kliknij tutaj aby wygenerować hasło automatycznie">
                                </div>
                            </div><!-- col-4 -->
                        </div> <!-- set -->
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-layout-footer bd pd-20 bd-t-0-force">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <button class="btn btn-secondary"
                                        onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div><!-- form-group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="form-group bd-l-0-force">
                                <label class="form-control-label">Oświadczam, że zapoznałem się z <a
                                        href="<?php echo base_url('uploads/' . $settings->privace); ?>">Regulaminem</a>
                                    sklepu <?php echo $contact->company; ?> co jest równoznaczne z wyrażeniem zgody na
                                    przetwarzanie moich danych osobowych w ramach opisanych w niniejszym
                                    regulaminie.</label>
                                <?php echo (@$value->regulation == 1) ? '<i class="text-success fas fa-check"></i> Zaakceptowane' : '<i class="text-danger fas fa-times"></i> Niezaakceptowane'; ?>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-md-12">
                            <div class="form-group bd-l-0-force bd-t-0-force">
                                <label class="form-control-label">Wyrażam zgodę na przetwarzanie przez danych osobowych
                                    podanych w formularzu. Podanie danych jest dobrowolne. Administratorem podanych
                                    przez Pana / Panią danych osobowych jest <?php echo $contact->company; ?> z siedzibą
                                    w <?php echo $contact->address; ?>, <?php echo $contact->city; ?>,
                                    <?php echo $contact->zip_code; ?>. Pana / Pani dane będą przetwarzane w celach
                                    związanych z udzieleniem odpowiedzi, przedstawieniem oferty usług
                                    <?php echo $contact->company; ?> oraz świadczeniem usług przez administratora
                                    danych. Przysługuje Panu / Pani prawo dostępu do treści swoich danych oraz ich
                                    poprawiania.</label>
                                <?php echo (@$value->rodo1 == 1) ? '<i class="text-success fas fa-check"></i> Zaakceptowane' : '<i class="text-danger fas fa-times"></i> Niezaakceptowane'; ?>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-md-12">
                            <div class="form-group bd-l-0-force bd-t-0-force">
                                <label class="form-control-label">Wyrażam zgodę na otrzymywanie informacji handlowych od
                                    <?php echo $contact->company; ?> dotyczących jej oferty w szczególności poprzez
                                    połączenia telefoniczne lub sms z wykorzystaniem numeru telefonu podanego w
                                    formularzu, a także zgodę na przetwarzanie moich danych osobowych w tym celu przez
                                    <?php echo $contact->company; ?> oraz w celach promocji, reklamy i badania
                                    rynku.</label>
                                <?php echo (@$value->rodo2 == 1) ? '<i class="text-success fas fa-check"></i> Zaakceptowane' : '<i class="text-danger fas fa-times"></i> Niezaakceptowane'; ?>
                            </div>
                        </div><!-- col-4 -->

                    </div>
                </div><!-- row -->
            </form><!-- form-layout -->