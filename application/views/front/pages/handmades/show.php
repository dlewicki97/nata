<section class="single-handmade">
    <h2 class="page-title"><?= $handmade->title ?></h2>

    <div class="d-flex flex-wrap">
        <a class="w-100" data-lightbox="handmade" href="<?= base_url('uploads/' . $handmade->photo) ?>">
            <div data-bg="<?= base_url('uploads/' . $handmade->photo) ?>" alt="<?= $handmade->alt ?>" class="lazy bg" style="height: 400px"></div>
        </a>
        <div class="description mt-2">
            <?= $handmade->description ?>
        </div>

        <div class="d-flex flex-wrap w-100 mt-4">
            <?php foreach ($gallery as $photo) : ?>
                <div class="col-12 col-lg-4">
                    <a data-lightbox="handmade" href="<?= base_url('uploads/' . $photo->photo) ?>">
                        <div class="bg gallery-photo lazy" title="<?= $photo->alt ?>" data-bg="<?= base_url('uploads/' . $photo->photo) ?>">
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="contact">
            <div class="content">
                <h3 class="title">Masz jakieś pytania? Skontaktuj się z nami!</h3>
                <a href="<?= base_url('kontakt') ?>">
                    <button class="button first-button">Napisz do nas!</button>
                </a>
            </div>
            <div class="icons">
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
                        <br>
                        <a href="mailto:<?= $contact->email2 ?>"><?= $contact->email2 ?></a>
                    </a>
                </div>
                <div class="contact-data location text-center">
                    <a href="<?= base_url('sklep') ?>">
                        <div class="icon-container">
                            <i class="<?= $contact_icons[2]->icon ?>"></i>
                        </div>
                    </a>
                    <a target="_blank" href="https://www.google.com/maps/place/<?= $contact->address ?>,+<?= "$contact->zip_code $contact->city" ?>/data=!4m2!3m1!1s0x4706e0316527679d:0xb9b9a3ea09b6825?sa=X&ved=2ahUKEwiun5ivlbfuAhUJM-wKHeLKBpIQ8gEwAHoECAkQAQ">
                        <?= $contact->address ?> <br>
                        <?= "$contact->zip_code $contact->city" ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</section>