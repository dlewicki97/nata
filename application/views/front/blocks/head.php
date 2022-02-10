<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= $meta_title ?> - <?= $settings->meta_title ?></title>
    <meta name="description" content="<?= strip_tags($meta_description) ?>">
    <link rel="shortcut icon" type="image/png" href="<?= base_url("uploads/$settings->favicon"); ?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= assets() ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://geowidget.easypack24.net/css/easypack.css" />
    <link rel="stylesheet" href="<?= assets() ?>css/mdb.min.css" />
    <link rel="stylesheet" async href="<?= assets(); ?>css/preloader.css">

    <?php if ($this->uri->segment(1) != 'aktualnosci') : ?>
        <link rel="stylesheet" async href="<?= assets() ?>dist/assets/owl.carousel.min.css" />
        <link rel="stylesheet" async href="<?= assets() ?>dist/assets/owl.theme.default.min.css" />
    <?php endif; ?>

    <link rel="stylesheet" href="<?= assets() ?>min-css/layout.min.css" />
    <link rel="stylesheet" href="<?= assets() ?>css/style.min.css" />

    <?php if (!$this->uri->segment(1)) : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/home.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'aktualnosci') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/news.min.css" />
    <?php endif; ?>
    <?php if ($this->uri->segment(1) == 'galeria') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/galleries.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'o-nas') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/about.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'partnerzy') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/partners.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'blog') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/blog.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'kontakt') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/contact.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php endif; ?>

    <?php if (in_array($this->uri->segment(1), $lightbox_links)) : ?>
        <link rel="stylesheet" href="<?= assets() ?>lightbox-js/dist/css/lightbox.min.css">
        <style>
            .lightbox {
                position: fixed !important;
                top: 50% !important;
                transform: translateY(-50%) !important;
            }
        </style>
    <?php endif; ?>


    <?php if ($this->uri->segment(1) == 'nowosci' || $this->uri->segment(1) == 'outlet' || $this->uri->segment(1) == 'sklep') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/listing.min.css" />
        <link rel="stylesheet" href="<?= assets() ?>min-css/nouislider.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'produkt') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/single_product.min.css" />
        <link rel="stylesheet" href="<?= assets() ?>lightbox-js/dist/css/lightbox.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <?php endif; ?>

    <?php if (in_array($this->uri->segment(1), $auth_links)) : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/auth.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'koszyk' || $this->uri->segment(1) == 'dziekujemy' || $this->uri->segment(1) == 'ulubione') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/cart.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'ustawienia-konta') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/account_settings.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'moje-zamowienia') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/my_orders.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'pliki-do-pobrania') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/downloads.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'uslugi') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/services.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'produkcja-wlasna') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/handmades.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'koszty-dostawy') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/delivery_costs.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'zwroty-i-reklamacje') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/complaint.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'regulamin-zakupow') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/shopping_regulation.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'formy-platnosci') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/payments.min.css" />
    <?php endif; ?>

    <?php if ($this->uri->segment(1) == 'oferta-hurtowa') : ?>
        <link rel="stylesheet" href="<?= assets() ?>min-css/wholesale_offer.min.css" />
    <?php endif; ?>

    <style>
        .fa,
        .far,
        .fas {
            font-family: "Font Awesome 5 Free" !important;
        }

        *[data-toggle="popover"] {
            position: relative
        }

        .waves-effect {
            overflow: unset !important
        }

        .popover {
            position: absolute;
            top: 100% !important;
            left: 0 !important;
            width: max-content !important;
            opacity: 0;
            visibility: none !important;
            pointer-events: none !important;
        }

        .popover:hover {
            opacity: 0 !important;
            visibility: none !important;
            pointer-events: none !important;
            display: none !important;
        }

        *[data-toggle="popover"]:hover .popover {
            opacity: 1;
            visibility: visible !important;
            pointer-events: unset !important;
        }

        .popover .popover-header {
            background-color: #19a299;
            color: white;
            font-weight: 500
        }
    </style>

    <?= $scripts_editor['head']->description ?>


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L4JYV046N1"></script>
    <script src="https://kit.fontawesome.com/3353bb36d2.js" crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-L4JYV046N1');
    </script>

</head>

<body>

    <div id="preloader">
        <div class="spinner">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>

    <?php if (isset($_SESSION['flashdata_true'])) : ?>
        <div role="alert" id="hideInfo" class="alert alert-success-custom position-relative alert-dismissable position-fixed" style="z-index: 1000;">
            <?= $_SESSION['flashdata_true'] ?>
            <button type="button" class="close position-absolute" style="right: 5px;top: 50%;transform: translateY(-50%);" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php unset($_SESSION['flashdata_true']);
    endif; ?>
    <?php if (isset($_SESSION['flashdata_false'])) : ?>
        <div role="alert" id="hideInfo" class="alert alert-danger-custom position-relative alert-dismissable position-fixed" style="z-index: 1000;">
            <?= $_SESSION['flashdata_false'] ?>
            <button type="button" class="close position-absolute" style="right: 5px;top: 50%;transform: translateY(-50%);" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php unset($_SESSION['flashdata_false']);
    endif; ?>