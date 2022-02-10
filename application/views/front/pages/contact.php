<section class="contact-page pl-0 pr-0">
    <form class="contact-form" id="contact-form" method="post" action="<?= base('mailer/send'); ?>">
        <div class="d-flex flex-wrap">
            <div class="col-12 col-lg-8">
                <h2 class="page-title"><?= $contact_desc->title ?></h2>
                <input class="header-input" required name="name" placeholder="<?= $contact_desc->name ?>" type="text">
                <input class="header-input" required name="email" placeholder="<?= $contact_desc->email ?>"
                    type="email">
                <input class="header-input" required name="phone" placeholder="<?= $contact_desc->phone ?>" type="text">
                <input class="header-input" required name="subject" placeholder="<?= $contact_desc->subject ?>"
                    type="text">
                <textarea rows="5" required class="header-input" name="message"
                    placeholder="<?= $contact_desc->message ?>" type="text"></textarea>

                <div class="custom-control custom-checkbox p-0">
                    <input type="checkbox" required name="rodo1" class="form-check-input" id="rodo1">
                    <label class="form-check-label checkbox-label" for="rodo1"><?= $settings->rodo ?></label>
                </div>
                <div class="custom-control custom-checkbox p-0">
                    <input type="checkbox" required name="rodo2" class="form-check-input" id="rodo2">
                    <label class="form-check-label checkbox-label" for="rodo2"><?= $settings->rodo_tel ?></label>
                </div>
                <div class="d-flex justify-content-center w-100">
                    <button type="submit" class="button first-button"><?= $contact_desc->button_name ?></button>
                </div>
            </div>
            <div class="col-12 col-lg-4 pt-5 pt-lg-0 d-flex flex-column justify-content-between align-items-center">
                <div class="contact-data text-center">
                    <a href="tel:<?= $contact->phone1 ?>">
                        <div class="icon-container">
                            <i class="<?= $contact_icons[0]->icon ?>"></i>
                        </div>
                        <?= $contact->phone1 ?>
                    </a>,<br>
                    <a href="tel:<?= $contact->phone2 ?>"><?= $contact->phone2 ?></a>
                </div>
                <div class="contact-data text-center">
                    <a href="mailto:<?= $contact->email1 ?>">
                        <div class="icon-container">
                            <i class="<?= $contact_icons[1]->icon ?>"></i>
                        </div>
                        <?= $contact->email1 ?>
                    </a>
                    <br>
                    <a href="mailto:<?= $contact->email2 ?>"><?= $contact->email2 ?></a>
                </div>
                <div class="contact-data location text-center">
                    <a target="_blank"
                        href="https://www.google.com/maps/dir//NATA+P.P.H.U.+Przesmyk+7+20-341+Lublin/@51.2302266,22.5765811,16z/data=!4m5!4m4!1m0!1m2!1m1!1s0x4722575300e549bb:0xf16dc096f6981db">
                        <div class="icon-container">
                            <i class="<?= $contact_icons[2]->icon ?>"></i>
                        </div>
                        <?= $contact->address ?> <br>
                        <?= "$contact->zip_code $contact->city" ?>

                    </a>
                </div>
                <div class="contact-data text-center">
                    <a style="cursor: default">
                        NIP: <?= $contact->nip ?> <br>
                    </a>
                    <a style="cursor: default">
                        REGON: <?= $contact->regon ?> <br>
                    </a>

                </div>
            </div>
            <iframe class="lazy mt-5" data-src="<?= $contact->map ?>" width="100%" height="450" style="border:0;"
                allowfullscreen="" loading="lazy"></iframe>
        </div>
    </form>
</section>