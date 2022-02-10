<?php $json = file_get_contents(base_url() . '/assets/countryList.json');
$jsonIterator = json_decode($json); ?>

<?php if ($this->session->flashdata('validation_false')) : ?>
    <section class="validation-errors">
        <div role="alert" class="alert position-relative  w-100" style="z-index: 1000;top:0">
            <?= $this->session->flashdata('validation_false'); ?>

        </div>

    </section>

<?php endif; ?>
<section>
    <h2 class="page-title"><?= $current_subpage->title ?></h2>
</section>
<section class="account-settings d-flex flex-wrap justify-content-center">
    <div class="col-12 text-center">
        <h3 class="bold"><?= $account_settings_desc->you_are_a_client ?>
            <?= $this->session->userdata('client')->type_client ? $account_settings_desc->wholesale : $account_settings_desc->detail; ?>
        </h3>
        <h4 class="mb-5">
            Twój rabat wynosi: <span class="bold"><?= $_SESSION['discount'] ?>%</span>
        </h4>
    </div>
    <form class="col-12 col-lg-4" method="post" action="<?= base_url('edycja-konta') ?>">
        <label class="custom-label"><?= $account_settings_desc->first_name ?>:</label>
        <input type="text" name="first_name" placeholder="<?= $account_settings_desc->first_name ?>" value="<?= $this->session->userdata('client')->first_name ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->last_name ?>:</label>
        <input type="text" name="last_name" placeholder="<?= $account_settings_desc->last_name ?>" value="<?= $this->session->userdata('client')->last_name ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->email ?>:</label>
        <input type="email" name="email" placeholder="<?= $account_settings_desc->email ?>" disabled value="<?= $this->session->userdata('client')->email ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->phone ?>:</label>
        <input type="text" name="phone" placeholder="<?= $account_settings_desc->phone ?>" value="<?= $this->session->userdata('client')->phone ?>" class="header-input input-phone">
        <label class="custom-label"><?= $account_settings_desc->country ?>:</label>

        <select name="country" placeholder="<?= $account_settings_desc->country ?>" class="header-input">

            <?php foreach ($jsonIterator as $k => $v) : ?>
                <option value="<?= $v->code; ?>" <?php if (@$_SESSION['country'] == $v->code) echo 'selected';
                                                    elseif (set_value('country') == $v->code) echo 'selected'; ?>>
                    <?= $v->name_pl; ?>
                </option>
            <?php endforeach ?>
        </select>
        <label class="custom-label"><?= $account_settings_desc->city ?>:</label>
        <input type="text" name="city" placeholder="<?= $account_settings_desc->city ?>" value="<?= $this->session->userdata('client')->city ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->zip_code ?>:</label>
        <input type="text" name="zipcode" placeholder="<?= $account_settings_desc->zip_code ?>" value="<?= $this->session->userdata('client')->zipcode ?>" class="header-input input-zipcode">
        <label class="custom-label"><?= $account_settings_desc->street ?>:</label>
        <input type="text" name="street" placeholder="<?= $account_settings_desc->street ?>" value="<?= $this->session->userdata('client')->street ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->house_number ?>:</label>
        <input type="text" name="housenumber" placeholder="<?= $account_settings_desc->house_number ?>" value="<?= $this->session->userdata('client')->housenumber ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->flat_number ?>:</label>
        <input type="text" name="flatnumber" placeholder="<?= $account_settings_desc->flat_number ?>" value="<?= $this->session->userdata('client')->flatnumber ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->company ?>:</label>
        <input type="text" name="company" placeholder="<?= $account_settings_desc->company ?>" value="<?= $this->session->userdata('client')->company ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->nip ?>:</label>
        <input type="text" name="nip" placeholder="<?= $account_settings_desc->nip ?>" value="<?= $this->session->userdata('client')->nip ?>" class="header-input input-nip">
        <label class="custom-label"><?= $account_settings_desc->country_company ?>:</label>


        <select name="country_company" placeholder="<?= $account_settings_desc->country_company ?>" class="header-input">

            <?php foreach ($jsonIterator as $k => $v) : ?>
                <option value="<?= $v->code; ?>" <?php if (@$_SESSION['country_company'] == $v->code) echo 'selected';
                                                    elseif (set_value('country_company') == $v->code) echo 'selected'; ?>><?= $v->name_pl; ?>
                </option>
            <?php endforeach ?>
        </select>
        <label class="custom-label"><?= $account_settings_desc->city_company ?>:</label>
        <input type="text" name="city_company" placeholder="<?= $account_settings_desc->city_company ?>" value="<?= $this->session->userdata('client')->city_company ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->zip_code_company ?>:</label>
        <input type="text" name="zipcode_company" placeholder="<?= $account_settings_desc->zip_code_company ?>" value="<?= $this->session->userdata('client')->zipcode_company ?>" class="header-input input-zipcode">
        <label class="custom-label"><?= $account_settings_desc->address_company ?>:</label>
        <input type="text" name="address_company" placeholder="<?= $account_settings_desc->address_company ?>" value="<?= $this->session->userdata('client')->address_company ?>" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->new_password ?>:</label>
        <input type="password" placeholder="<?= $account_settings_desc->new_password ?>" name="new_password" class="header-input">
        <label class="custom-label">Potwierdź nowe hasło:</label>
        <input type="password" placeholder="Potwierdź nowe hasło" name="new_password_confirm" class="header-input">
        <label class="custom-label"><?= $account_settings_desc->old_password ?>:</label>
        <input type="password" placeholder="<?= $account_settings_desc->old_password ?>" name="old_password" class="header-input">

        <button type="submit" class="first-button button mt-3"><?= $account_settings_desc->button_name ?></button>

    </form>
</section>