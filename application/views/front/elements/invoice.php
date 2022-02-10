<?php $json = file_get_contents(base_url() . '/assets/countryList.json');
$jsonIterator = json_decode($json); ?>
<div class="col-12">
    <div class="d-flex flex-column mb-3">
        <label class="input-label" for="input-company">Nazwa firmy<span class="text-danger">*</span></label>
        <input id="input-company" class="contact-input" type="text" name="company" value="<?php if (@$client->company != null) {
                                                                                                echo @$client->company;
                                                                                            } ?>" required />
    </div>
</div>
<div class="col-12">
    <div class="d-flex flex-column mb-3">
        <label class="input-label" for="input-nip">NIP<span class="text-danger">*</span></label>
        <input id="input-nip" class="contact-input" type="text" name="nip" value="<?php if (@$client->nip != null) {
                                                                                        echo @$client->nip;
                                                                                    } ?>" required />
    </div>
</div>
<div class="col-12">
    <div class="d-flex flex-column mb-3">
        <label class="input-label" for="input-country_company">Kraj w którym znajduje się firma<span class="text-danger">*</span></label>
        <select id="input-country_company" class="contact-input" name="country_company" required>
            <?php foreach ($jsonIterator as $k => $v) : ?>
                <option value="<?= $v->code; ?>" <?php if (@$client->country_company != null && @$client->country_company == $v->code) {
                                                        echo 'selected';
                                                    } elseif ('PL' == $v->code) echo 'selected'; ?>><?= $v->name_pl; ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>
<div class="col-12">
    <div class="d-flex flex-column mb-3">
        <label class="input-label" for="input-city_company">Miasto w którym znajduje się firma<span class="text-danger">*</span></label>
        <input id="input-city_company" class="contact-input" type="text" name="city_company" value="<?php if (@$client->city_company != null) {
                                                                                                        echo @$client->city_company;
                                                                                                    } ?>" required />
    </div>
</div>
<div class="col-12">
    <div class="d-flex flex-column mb-3">
        <label class="input-label" for="input-zipcode_company">Kod pocztowy firmy<span class="text-danger">*</span></label>
        <input id="input-zipcode_company" class="contact-input" type="text" name="zipcode_company" value="<?php if (@$client->zipcode_company != null) {
                                                                                                                echo @$client->zipcode_company;
                                                                                                            } ?>" required />
    </div>
</div>
<div class="col-12">
    <div class="d-flex flex-column mb-3">
        <label class="input-label" for="input-address_company">Adres firmy<span class="text-danger">*</span></label>
        <input id="input-address_company" class="contact-input" type="text" name="address_company" value="<?php if (@$client->address_company != null) {
                                                                                                                echo @$client->address_company;
                                                                                                            } ?>" required />
    </div>
</div>