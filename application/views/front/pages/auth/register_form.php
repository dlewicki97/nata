<?php $json = file_get_contents(base_url() . '/assets/countryList.json');
$jsonIterator = json_decode($json); ?>

<?php if ($this->session->flashdata('validation_false')) : ?>
<section class="validation-errors">
    <div role="alert" class="alert position-relative  w-100" style="z-index: 1000;top:0;">
        <?= $this->session->flashdata('validation_false'); ?>

    </div>

</section>

<?php endif; ?>

<style>
.register-label {
    font-weight: 700;
    font-size: .8rem;
    margin-bottom: .2rem;
}
</style>

<section class="register-form">
    <h2 class="page-title"><?= $auth_desc->register_title ?></h2>
    <div class="d-flex flex-wrap mb-5">
        <div class="col-12 col-lg-6">
            <div class="bg lazy" title="<?= $auth_desc->alt2 ?>" data-bg="<?= file_url($auth_desc->photo2) ?>"></div>
        </div>
        <div class="col-12 col-lg-6 pl-0 pl-lg-5">
            <form id="contact-form" method="post" action="<?= base_url('stworz-uzytkownika') ?>">
                <label class="register-label" for="first-name-input"><?= $auth_desc->first_name ?>:</label>
                <input id="first-name-input" required type="text"
                    value="<?= $this->session->flashdata('first_name') ?? '' ?>"
                    placeholder="<?= $auth_desc->first_name ?>" name="first_name" class="header-input">

                <label class="register-label" for="last-name-input"><?= $auth_desc->last_name ?>:</label>
                <input id="last-name-input" required type="text"
                    value="<?= $this->session->flashdata('last_name') ?? '' ?>"
                    placeholder="<?= $auth_desc->last_name ?>" name="last_name" class="header-input">

                <label class="register-label" for="email-input"><?= $auth_desc->email ?>:</label>
                <input id="email-input" required type="email" value="<?= $this->session->flashdata('email') ?? '' ?>"
                    placeholder="<?= $auth_desc->email ?>" name="email" class="header-input">

                <label class="register-label" for="phone-input"><?= $auth_desc->phone ?>:</label>
                <input id="phone-input" required type="text" value="<?= $this->session->flashdata('phone') ?? '' ?>"
                    placeholder="<?= $auth_desc->phone ?>" name="phone" class="header-input input-phone">

                <label class="register-label" for="country-input"><?= $auth_desc->country ?>:</label>
                <select id="country-input" name="country" placeholder="<?= $auth_desc->country ?>" class="header-input">

                    <?php foreach ($jsonIterator as $k => $v) : ?>
                    <option value="<?= $v->code; ?>" <?php if ('PL' == $v->code) echo 'selected'; ?>>
                        <?= $v->name_pl; ?>
                    </option>
                    <?php endforeach ?>
                </select>

                <label class="register-label" for="street-input"><?= $auth_desc->street ?>:</label>
                <input id="street-input" type="text" value="<?= $this->session->flashdata('street') ?? '' ?>"
                    placeholder="<?= $auth_desc->street ?>" name="street" class="header-input">

                <label class="register-label" for="housenumber-input"><?= $auth_desc->house ?>:</label>
                <input id="housenumber-input" type="text" value="<?= $this->session->flashdata('housenumber') ?? '' ?>"
                    placeholder="<?= $auth_desc->house ?>" name="housenumber" class="header-input">


                <label class="register-label" for="flat-input"><?= $auth_desc->flat ?>:</label>
                <input id="flat-input" type="text" value="<?= $this->session->flashdata('flatnumber') ?? '' ?>"
                    placeholder="<?= $auth_desc->flat ?>" name="flatnumber" class="header-input">

                <label class="register-label" for="input-zipcode"><?= $auth_desc->zip_code ?>:</label>
                <input id="input-zipcode" required type="text" value="<?= $this->session->flashdata('zipcode') ?? '' ?>"
                    placeholder="<?= $auth_desc->zip_code ?>" name="zipcode" class="header-input">

                <label class="register-label" for="city-input"><?= $auth_desc->city ?>:</label>
                <input id="city-input" type="text" value="<?= $this->session->flashdata('city') ?? '' ?>"
                    placeholder="<?= $auth_desc->city ?>" name="city" class="header-input">

                <label class="register-label" for="password-input"><?= $auth_desc->password ?>:</label>
                <input id="password-input" required type="password"
                    value="<?= $this->session->flashdata('password') ?? '' ?>" placeholder="<?= $auth_desc->password ?>"
                    name="password" class="header-input">

                <label class="register-label" for="confirm-password-input"><?= $auth_desc->confirm_password ?>:</label>
                <input id="confirm-password-input" required type="password"
                    value="<?= $this->session->flashdata('confirm_password') ?? '' ?>"
                    placeholder="<?= $auth_desc->confirm_password ?>" name="confirm_password" class="header-input">

                <div class="custom-control custom-checkbox p-0 pt-2">
                    <input required type="checkbox" <?= $this->session->flashdata('regulation') ? 'checked' : '' ?>
                        name="regulation" class="form-check-input" id="regulation">
                    <label class="form-check-label text-white checkbox-label"
                        for="regulation"><?= $settings->regulation ?></label>
                </div>
                <div class="custom-control custom-checkbox p-0 pt-2">
                    <input required type="checkbox" <?= $this->session->flashdata('rodo1') ? 'checked' : '' ?>
                        name="rodo1" class="form-check-input" id="rodo1">
                    <label class="form-check-label text-white checkbox-label" for="rodo1"><?= $settings->rodo ?></label>
                </div>
                <div class="custom-control custom-checkbox p-0 pt-2">
                    <input type="checkbox" name="rodo2" <?= $this->session->flashdata('rodo2') ? 'checked' : '' ?>
                        class="form-check-input" id="rodo2">
                    <label class="form-check-label text-white checkbox-label"
                        for="rodo2"><?= $settings->rodo_tel ?></label>
                </div>

                <button type="submit" class="first-button button mt-4"><?= $auth_desc->register_button_name ?></button>
            </form>
        </div>

    </div>


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