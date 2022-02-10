<?php $json = file_get_contents(base_url() . '/assets/countryList.json');
$jsonIterator = json_decode($json); ?>
<style type="text/css">
    p {
        margin-bottom: 0;
    }
</style>
<section class="container">
    <form action="" method="post" class="form_client_data">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label class="input-label" for="input-first_name">Imię<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('first_name'); ?></span>
                    <input id="input-first_name" class="contact-input <?php if (form_error('first_name') != null) {
                                                                            echo 'is-invalid';
                                                                        } ?>" type="text" name="first_name" value="<?php if (@$client->first_name != null) {
                                                                                                                        echo @$client->first_name;
                                                                                                                    } else {
                                                                                                                        echo set_value('first_name');
                                                                                                                    } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-last_name">Nazwisko<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('last_name'); ?></span>
                    <input id="input-last_name" class="contact-input <?php if (form_error('last_name') != null) {
                                                                            echo 'is-invalid';
                                                                        } ?>" type="text" name="last_name" value="<?php if (@$client->last_name != null) {
                                                                                                                        echo @$client->last_name;
                                                                                                                    } else {
                                                                                                                        echo set_value('last_name');
                                                                                                                    } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-email">Adres e-mail<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('email'); ?></span>
                    <input id="input-email" class="contact-input <?php if (form_error('email') != null) {
                                                                        echo 'is-invalid';
                                                                    } ?>" type="email" name="email" value="<?php if (@$client->email != null) {
                                                                                                                echo @$client->email;
                                                                                                            } else {
                                                                                                                echo set_value('email');
                                                                                                            } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-phone">Numer telefonu<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('phone'); ?></span>
                    <input id="input-phone" class="contact-input <?php if (form_error('phone') != null) {
                                                                        echo 'is-invalid';
                                                                    } ?>" type="tel" name="phone" value="<?php if (@$client->phone != null) {
                                                                                                                echo @$client->phone;
                                                                                                            } else {
                                                                                                                echo set_value('phone');
                                                                                                            } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-country">Kraj<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('country'); ?></span>
                    <select id="input-country" class="contact-input <?php if (form_error('country') != null) {
                                                                        echo 'is-invalid';
                                                                    } ?>" name="country" required>
                        <?php foreach ($jsonIterator as $k => $v) : ?>
                            <option value="<?= $v->code; ?>" <?php if (@$client->country != null && @$client->country == $v->code) {
                                                                    echo 'selected';
                                                                } elseif (set_value('country') == $v->code) {
                                                                    echo 'selected';
                                                                } elseif ('PL' == $v->code) echo 'selected' ?>><?= $v->name_pl; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-city">Miasto<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('city'); ?></span>
                    <input id="input-city" class="contact-input <?php if (form_error('city') != null) {
                                                                    echo 'is-invalid';
                                                                } ?>" type="text" name="city" value="<?php if (@$client->city != null) {
                                                                                                            echo @$client->city;
                                                                                                        } else {
                                                                                                            echo set_value('city');
                                                                                                        } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-zipcode">Kod pocztowy<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('zipcode'); ?></span>
                    <input id="input-zipcode" class="contact-input <?php if (form_error('zipcode') != null) {
                                                                        echo 'is-invalid';
                                                                    } ?>" type="text" name="zipcode" value="<?php if (@$client->zipcode != null) {
                                                                                                                echo @$client->zipcode;
                                                                                                            } else {
                                                                                                                echo set_value('zipcode');
                                                                                                            } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-street">Ulica<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('street'); ?></span>
                    <input id="input-street" class="contact-input <?php if (form_error('street') != null) {
                                                                        echo 'is-invalid';
                                                                    } ?>" type="text" name="street" value="<?php if (@$client->street != null) {
                                                                                                                echo @$client->street;
                                                                                                            } else {
                                                                                                                echo set_value('street');
                                                                                                            } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-housenumber">Numer budynku / domu<span class="text-danger">*</span></label>
                    <span class="small_valid text-danger"><?= form_error('housenumber'); ?></span>
                    <input id="input-housenumber" class="contact-input <?php if (form_error('housenumber') != null) {
                                                                            echo 'is-invalid';
                                                                        } ?>" type="text" name="housenumber" value="<?php if (@$client->housenumber != null) {
                                                                                                                        echo @$client->housenumber;
                                                                                                                    } else {
                                                                                                                        echo set_value('housenumber');
                                                                                                                    } ?>" required />
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex flex-column mb-3">
                    <label class="input-label" for="input-flatnumber">Numer mieszkania</label>
                    <span class="small_valid text-danger"><?= form_error('flatnumber'); ?></span>
                    <input id="input-flatnumber" class="contact-input <?php if (form_error('flatnumber') != null) {
                                                                            echo 'is-invalid';
                                                                        } ?>" type="text" name="flatnumber" value="<?php if (@$client->flatnumber != null) {
                                                                                                                        echo @$client->flatnumber;
                                                                                                                    } else {
                                                                                                                        echo set_value('flatnumber');
                                                                                                                    } ?>" />
                </div>
            </div>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="checkbox" class="form-check-input" id="invoiceCheckbox" name="invoice" onchange="invoiceFields()" <?php if (set_value('invoice') != null) {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                    <label class="form-check-label" for="invoiceCheckbox">Faktura</label>
                </div>
            </div>
            <span id="invoice" class="w-100 mt-3">
                <?php if (set_value('invoice') != null) : ?>
                    <div class="col-12">
                        <div class="d-flex flex-column mb-3">
                            <label class="input-label" for="input-company">Nazwa firmy<span class="text-danger">*</span></label>
                            <span class="small_valid text-danger"><?= form_error('company'); ?></span>
                            <input id="input-company" class="contact-input <?php if (form_error('company') != null) {
                                                                                echo 'is-invalid';
                                                                            } ?>" type="text" name="company" value="<?php if (@$client->company != null) {
                                                                                                                        echo @$client->company;
                                                                                                                    } else {
                                                                                                                        echo set_value('company');
                                                                                                                    } ?>" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column mb-3">
                            <label class="input-label" for="input-nip">NIP<span class="text-danger">*</span></label>
                            <span class="small_valid text-danger"><?= form_error('nip'); ?></span>
                            <input id="input-nip" class="contact-input <?php if (form_error('nip') != null) {
                                                                            echo 'is-invalid';
                                                                        } ?>" type="text" name="nip" value="<?php if (@$client->nip != null) {
                                                                                                                echo @$client->nip;
                                                                                                            } else {
                                                                                                                echo set_value('nip');
                                                                                                            } ?>" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column mb-3">
                            <label class="input-label" for="input-country_company">Kraj w którym znajduje się firma<span class="text-danger">*</span></label>
                            <span class="small_valid text-danger"><?= form_error('country_company'); ?></span>
                            <select id="input-country_company" class="contact-input <?php if (form_error('country_company') != null) {
                                                                                        echo 'is-invalid';
                                                                                    } ?>" name="country_company" required>
                                <?php foreach ($jsonIterator as $k => $v) : ?>
                                    <option value="<?= $v->code; ?>" <?php if (@$client->country_company != null && @$client->country_company == $v->code) {
                                                                            echo 'selected';
                                                                        } elseif (set_value('country_company') == $v->code) {
                                                                            echo 'selected';
                                                                        } elseif ('PL' == $v->code) echo 'selected'; ?>><?= $v->name_pl; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column mb-3">
                            <label class="input-label" for="input-city_company">Miasto w którym znajduję się firma<span class="text-danger">*</span></label>
                            <span class="small_valid text-danger"><?= form_error('city_company'); ?></span>
                            <input id="input-city_company" class="contact-input <?php if (form_error('city_company') != null) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" type="text" name="city_company" value="<?php if (@$client->city_company != null) {
                                                                                                                                    echo @$client->city_company;
                                                                                                                                } else {
                                                                                                                                    echo set_value('city_company');
                                                                                                                                } ?>" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column mb-3">
                            <label class="input-label" for="input-zipcode_company">Kod pocztowy firmy<span class="text-danger">*</span></label>
                            <span class="small_valid text-danger"><?= form_error('zipcode_company'); ?></span>
                            <input id="input-zipcode_company" class="contact-input <?php if (form_error('zipcode_company') != null) {
                                                                                        echo 'is-invalid';
                                                                                    } ?>" type="text" name="zipcode_company" value="<?php if (@$client->zipcode_company != null) {
                                                                                                                                        echo @$client->zipcode_company;
                                                                                                                                    } else {
                                                                                                                                        echo set_value('zipcode_company');
                                                                                                                                    } ?>" required />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex flex-column mb-3">
                            <label class="input-label" for="input-address_company">Adres firmy<span class="text-danger">*</span></label>
                            <span class="small_valid text-danger"><?= form_error('address_company'); ?></span>
                            <input id="input-address_company" class="contact-input <?php if (form_error('address_company') != null) {
                                                                                        echo 'is-invalid';
                                                                                    } ?>" type="text" name="address_company" value="<?php if (@$client->address_company != null) {
                                                                                                                                        echo @$client->address_company;
                                                                                                                                    } else {
                                                                                                                                        echo set_value('address_company');
                                                                                                                                    } ?>" required />
                        </div>
                    </div>
                <?php endif; ?>
            </span>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="checkbox" class="form-check-input" id="regulation" name="regulation" required>
                    <label class="form-check-label rodo-checkbox" for="regulation">
                        <span class="small_valid text-danger"><?= form_error('regulation'); ?></span>
                        <small>Potwierdzam <u><a href="<?= base_url('regulamin-zakupow'); ?>">Regulamin<span class="text-danger">*</span></a></u></small>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="checkbox" class="form-check-input" id="rodo1" name="rodo1" required>
                    <label class="form-check-label rodo-checkbox" for="rodo1">
                        <span class="small_valid text-danger"><?= form_error('rodo1'); ?></span>
                        <small>Wyrażam zgodę na przetwarzanie przez danych osobowych podanych w formularzu. Podanie
                            danych jest dobrowolne. Administratorem podanych przez Pana / Panią danych osobowych jest
                            <?php echo $contact->company; ?> z siedzibą w <?php echo $contact->address; ?>,
                            <?php echo $contact->city; ?>, <?php echo $contact->zip_code; ?>. Pana / Pani dane będą
                            przetwarzane w celach związanych z udzieleniem odpowiedzi, przedstawieniem oferty usług
                            <?php echo $contact->company; ?> oraz świadczeniem usług przez administratora danych.
                            Przysługuje Panu / Pani prawo dostępu do treści swoich danych oraz ich poprawiania.<span class="text-danger">*</span></small>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check pl-0">
                    <input type="checkbox" class="form-check-input" id="rodo2" name="rodo2">
                    <label class="form-check-label rodo-checkbox" for="rodo2">
                        <span class="small_valid text-danger"><?= form_error('rodo2'); ?></span>
                        <small>Wyrażam zgodę na otrzymywanie informacji handlowych od <?php echo $contact->company; ?>
                            dotyczących jej oferty w szczególności poprzez połączenia telefoniczne lub sms z
                            wykorzystaniem numeru telefonu podanego w formularzu, a także zgodę na przetwarzanie moich
                            danych osobowych w tym celu przez <?php echo $contact->company; ?> oraz w celach promocji,
                            reklamy i badania rynku.</small>
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="first-button button float-right">
            Przejdź dalej
        </button>
    </form>
</section>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
    function invoiceFields() {
        document.getElementById('invoice').innerHTML = '<div class="loader"><i class="fas fa-spinner fa-pulse"></i></div>';
        var value = document.getElementById('invoiceCheckbox').checked;
        if (value == true) {
            $("#invoice").load("<?= base_url('dane_faktury'); ?>", function() {
                $("#input-nip").inputmask({
                    "mask": "999 999 99 99"
                });
                $("#input-zipcode_company").inputmask({
                    "mask": "99-999"
                });
            });
        } else {
            document.getElementById('invoice').innerHTML = '';
        }
    }
</script>