<?php if ($this->session->flashdata('validation_false')) : ?>
    <section class="validation-errors">
        <div role="alert" class="alert position-relative  w-100" style="z-index: 1000;top:0;">
            <?= $this->session->flashdata('validation_false'); ?>

        </div>

    </section>

<?php endif; ?>

<section class="register-form login-form password-reset">
    <h2 class="page-title"><?= $password_reset_desc->title ?></h2>
    <div class="d-flex flex-wrap mb-5">
        <div class="col-12 col-lg-6">
            <div class="bg lazy" title="<?= $password_reset_desc->alt ?>" data-bg="<?= file_url($password_reset_desc->photo) ?>"></div>
        </div>
        <div class="col-12 col-lg-6 pl-0 pl-lg-5 align-self-center">
            <form method="post" action="<?= base_url('haslo-reset') ?>">


                <input required type="email" value="<?= $this->session->flashdata('email') ?? '' ?>" placeholder="<?= $password_reset_desc->email ?>" name="email" class="header-input">


                <button type="submit" class="first-button button mt-4"><?= $password_reset_desc->button_name ?></button>

            </form>
        </div>

    </div>


</section>