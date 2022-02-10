<?php if ($this->session->flashdata('validation_false')) : ?>

<section class="validation-errors" style="position: relative;">
    <div role="alert" class="alert position-relative  w-100"
        style="z-index: 1000; position: absolute!important; right: 0">
        <?= $this->session->flashdata('validation_false'); ?>
    </div>
</section>

<?php endif; ?>
<style>
.login-label {
    font-weight: 700;
    font-size: .8rem;
    margin-bottom: .2rem;
}
</style>

<section class="register-form login-form">
    <h2 class="page-title"><?= $auth_desc->login_title ?></h2>
    <div class="d-flex flex-wrap mb-5">
        <div class="col-12 col-lg-6">
            <div class="bg lazy" title="<?= $auth_desc->alt ?>" data-bg="<?= file_url($auth_desc->photo) ?>"></div>
        </div>
        <div class="col-12 col-lg-6 pl-0 pl-lg-5 align-self-center">
            <form method="post" action="<?= base_url('logowanie-akcja') ?>">

                <label for="email-input" class="login-label"><?= $auth_desc->email ?>:</label>
                <input id="email-input" required type="email" value="<?= $this->session->flashdata('email') ?? '' ?>"
                    placeholder="<?= $auth_desc->email ?>" name="email" class="header-input">

                <label for="password-input" class="login-label"><?= $auth_desc->password ?>:</label>
                <input id="password-input" required type="password" placeholder="<?= $auth_desc->password ?>"
                    name="password" class="header-input">
                <p><a class="form-link"
                        href="<?= base_url('resetowanie-hasla') ?>"><?= $auth_desc->password_reminder ?></a></p>



                <button type="submit" class="first-button button mt-4"><?= $auth_desc->login_button_name ?></button>
                <p class="mt-2 mb-0"><a class="form-link"
                        href="<?= base_url('rejestracja') ?>"><?= $auth_desc->register_please ?></a></p>
            </form>
        </div>

    </div>


</section>