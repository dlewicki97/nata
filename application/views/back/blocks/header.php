<!-- ########## START: LEFT PANEL ########## -->

<style>
    .back-to-main-page {
        font-size: .7rem;
        font-weight: 500;
    }
</style>
<div class="br-logo d-flex flex-column justify-content-center">
    <a href=""><span>[</span>AD Awards<span>]</span></a>
    <a class="back-to-main-page" href="<?= base_url() ?>"><span>[</span>Strona główna<span>]</span></a>
</div>

<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Nawigacja</label>
    <div class="br-sideleft-menu">
        <a href="<?php echo base_url(); ?>panel/dashboard" class="br-menu-link 
        <?php if ($this->uri->segment(2) == 'dashboard') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-desktop tx-20"></i>
                <span class="menu-item-label">Dashboard</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/mails" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'mails') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-mail-bulk tx-20"></i>
                <span class="menu-item-label">Skrzynka mailowa</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/media" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'media') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fab fa-medium tx-20"></i>
                <span class="menu-item-label">Media</span>
            </div>
        </a>
        <label class="sidebar-label pd-x-15 mg-t-20">CMS</label>
        <a href="<?php echo base_url(); ?>panel/subpages" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'subpages' || $this->uri->segment(4) == 'subpages') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-file-code tx-20"></i>
                <span class="menu-item-label">Podstrony</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/headers" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'headers' || $this->uri->segment(4) == 'headers') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-header tx-20"></i>
                <span class="menu-item-label">Nagłówki</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/icons" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'icons' || $this->uri->segment(4) == 'icons') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fab fa-connectdevelop tx-20"></i>
                <span class="menu-item-label">Ikony</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/logos" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'logos' || $this->uri->segment(4) == 'logos') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fab fa-pied-piper tx-20"></i>
                <span class="menu-item-label">Loga na stronie</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/scripts_editor" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'scripts_editor' || $this->uri->segment(4) == 'scripts_editor') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-terminal tx-20"></i>
                <span class="menu-item-label">Skrypty na stronie</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/slider" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'slider' || $this->uri->segment(4) == 'slider') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon far fa-images tx-20"></i>
                <span class="menu-item-label">Slider strony głównej</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/advertising_slider" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'advertising_slider' || $this->uri->segment(4) == 'advertising_slider') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon far fa-images tx-20"></i>
                <span class="menu-item-label">Slider reklamowy</span>
            </div>
        </a>


        <?php $links = ['Opisy' => 'newsletter_desc', 'Newsletter' => 'newsletters', 'Subskrybenci' => 'newsletter_subscribers']; ?>
        <a href="#" class="br-menu-link
    <?php if (in_array($this->uri->segment(2), $links)) {
        echo 'show-sub';
    } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-newspaper tx-20"></i>
                <span class="menu-item-label">Newsletter</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <?php foreach ($links as $key => $value) : ?>
                <li class="nav-item"><a href="<?= base_url() . 'panel/' . $value ?>" class="nav-link <?php if ($this->uri->segment(2) == $value) echo 'active' ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>

        <?php $links = ['Opisy' => 'contact_desc', 'Ikony' => 'contact_icons']; ?>
        <a href="#" class="br-menu-link
    <?php if (in_array($this->uri->segment(2), $links)) {
        echo 'show-sub';
    } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-phone tx-20"></i>
                <span class="menu-item-label">Kontakt</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <?php foreach ($links as $key => $value) : ?>
                <li class="nav-item"><a href="<?= base_url() . 'panel/' . $value ?>" class="nav-link <?php if ($this->uri->segment(2) == $value) echo 'active' ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>



        <a href="<?php echo base_url(); ?>panel/footer" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'footer' || $this->uri->segment(4) == 'footer') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-shoe-prints tx-20"></i>
                <span class="menu-item-label">Footer</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/breadcrumb" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'breadcrumb' || $this->uri->segment(4) == 'breadcrumb') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-bread-slice tx-20"></i>
                <span class="menu-item-label">Breadcrumb</span>
            </div>
        </a>


        <a href="<?php echo base_url(); ?>panel/partners" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'partners' || $this->uri->segment(4) == 'partners') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-handshake tx-20"></i>
                <span class="menu-item-label">Partnerzy</span>
            </div>
        </a>

        <?php $links = ['Opisy' => 'producents_desc']; ?>
        <a href="#" class="br-menu-link
    <?php if (in_array($this->uri->segment(2), $links)) {
        echo 'show-sub';
    } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fab fa-joomla tx-20"></i>
                <span class="menu-item-label">Producenci</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <?php foreach ($links as $key => $value) : ?>
                <li class="nav-item"><a href="<?= base_url() . 'panel/' . $value ?>" class="nav-link <?php if ($this->uri->segment(2) == $value) echo 'active' ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>

        <?php $links = ['Opisy formularzy' => 'auth_desc', 'Opisy resetu<br>hasła' => 'password_reset_desc', 'Opisy ustawień konta' => 'account_settings_desc']; ?>
        <a href="#" class="br-menu-link
    <?php if (in_array($this->uri->segment(2), $links)) {
        echo 'show-sub';
    } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-user-circle tx-20"></i>
                <span class="menu-item-label">Użytkownicy</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <?php foreach ($links as $key => $value) : ?>
                <li class="nav-item"><a href="<?= base_url() . 'panel/' . $value ?>" class="nav-link <?php if ($this->uri->segment(2) == $value) echo 'active' ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>

        <a href="<?php echo base_url(); ?>panel/services" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'services' || $this->uri->segment(4) == 'services') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-concierge-bell tx-20"></i>
                <span class="menu-item-label">Usługi</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/galleries" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'galleries' || $this->uri->segment(4) == 'galleries') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-images tx-20"></i>
                <span class="menu-item-label">Galerie</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/handmades" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'handmades' || $this->uri->segment(4) == 'handmades') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-hand-paper tx-20"></i>
                <span class="menu-item-label">Produkcja własna</span>
            </div>
        </a>


        <a href="<?php echo base_url(); ?>panel/contact" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'contact' || $this->uri->segment(4) == 'contact') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-address-book tx-20"></i>
                <span class="menu-item-label">Kontakt</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/about" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'about' || $this->uri->segment(4) == 'about') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-address-card tx-20"></i>
                <span class="menu-item-label">O nas</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/news" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'news' || $this->uri->segment(4) == 'news') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon far fa-newspaper tx-20"></i>
                <span class="menu-item-label">Aktualności</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/products_desc" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'products_desc' || $this->uri->segment(4) == 'products_desc') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-box-open tx-20"></i>
                <span class="menu-item-label">Opisy Produktów</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/my_orders_desc" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'my_orders_desc' || $this->uri->segment(4) == 'my_orders_desc') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-pencil-alt tx-20"></i>
                <span class="menu-item-label">Opisy Moich<br>Zamówień</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/blogs" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'blogs' || $this->uri->segment(4) == 'blogs') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-blog tx-20"></i>
                <span class="menu-item-label">Blog</span>
            </div>
        </a>

        <?php $links = ['Pliki' => 'downloads', 'Kategorie' => 'downloads_categories']; ?>
        <a href="#" class="br-menu-link
    <?php if (in_array($this->uri->segment(2), $links)) {
        echo 'show-sub';
    } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-download tx-20"></i>
                <span class="menu-item-label">Pliki do pobrania</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <?php foreach ($links as $key => $value) : ?>
                <li class="nav-item"><a href="<?= base_url() . 'panel/' . $value ?>" class="nav-link <?php if ($this->uri->segment(2) == $value) echo 'active' ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>



        <a href="<?php echo base_url(); ?>panel/regulations" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'regulations' || $this->uri->segment(4) == 'regulations') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-book tx-20"></i>
                <span class="menu-item-label">Regulamin i inne</span>
            </div>
        </a>
        <label class="sidebar-label pd-x-15 mg-t-20">SKLEP</label>
        <a href="<?php echo base_url(); ?>panel/discounts" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'discounts' || $this->uri->segment(4) == 'discounts') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-percent tx-20"></i>
                <span class="menu-item-label">Kody rabatowe</span>
            </div>
        </a>
        <a href="#" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'clients' || $this->uri->segment(4) == 'clients') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon fas fa-users tx-20"></i>
                <span class="menu-item-label">Klienci sklepu</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="<?php echo base_url(); ?>panel/clients" class="nav-link">Klienci</a></li>
            <li class="nav-item"><a href="<?php echo base_url(); ?>panel/clients_groups" class="nav-link">Grupy
                    klientów</a></li>
        </ul>
        <a href="<?php echo base_url(); ?>panel/categories" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'categories' || $this->uri->segment(4) == 'categories') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-archive tx-20"></i>
                <span class="menu-item-label">Kategorie produktów</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/products" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'products' || $this->uri->segment(4) == 'products') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-box-open tx-20"></i>
                <span class="menu-item-label">Produkty</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/filters" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'filters' || $this->uri->segment(4) == 'filters') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-sort tx-20"></i>
                <span class="menu-item-label">Filtrowanie produktów</span>
            </div>
        </a>


        <a href="#" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'transaction') {
            echo 'active show-sub';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-money-check-alt tx-20"></i>
                <span class="menu-item-label">Transakcje</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/transaction?detaliczne=0" class="nav-link <?php if (isset($_GET['detaliczne']) && !(isset($_GET['status']))) {
                                                                                                        echo 'active';
                                                                                                    } ?>">Transakcje
                    detaliczne</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/transaction?hurtowe=1" class="nav-link <?php if (isset($_GET['hurtowe']) && !(isset($_GET['status']))) {
                                                                                                    echo 'active';
                                                                                                } ?>">Transakcje
                    hurtowe</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/transaction?detaliczne=0&status=1" class="nav-link <?php if (isset($_GET['detaliczne']) && isset($_GET['status'])) {
                                                                                                                echo 'active';
                                                                                                            } ?>">Trans. det.
                    zakończone</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/transaction?hurtowe=1&status=1" class="nav-link <?php if (isset($_GET['hurtowe']) && isset($_GET['status'])) {
                                                                                                            echo 'active';
                                                                                                        } ?>">Trans.
                    hurt.
                    zakończone</a>
            </li>
        </ul>
        <a href="<?php echo base_url(); ?>panel/expense_income" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'expense_income' || $this->uri->segment(4) == 'expense_income') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-truck-loading tx-20"></i>
                <span class="menu-item-label">Rozchód i przychód</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/inventory_report" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'inventory_report' || $this->uri->segment(4) == 'inventory_report') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon far fa-file-pdf tx-20"></i>
                <span class="menu-item-label">Raport stanu <br>magazynowego</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/delivery_costs" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'delivery_costs' || $this->uri->segment(4) == 'delivery_costs') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-truck tx-20"></i>
                <span class="menu-item-label">Koszty dostawy</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/complaint" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'complaint' || $this->uri->segment(4) == 'complaint') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-copy tx-20"></i>
                <span class="menu-item-label">Zwroty i<br>reklamacje</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/shopping_regulation" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'shopping_regulation' || $this->uri->segment(4) == 'shopping_regulation') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-list tx-20"></i>
                <span class="menu-item-label">Regulamin zakupów</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/wholesale_offer" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'wholesale_offer' || $this->uri->segment(4) == 'wholesale_offer') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-industry tx-20"></i>
                <span class="menu-item-label">Oferta hurtowa</span>
            </div>
        </a>

        <a href="<?php echo base_url(); ?>panel/payments" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'payments' || $this->uri->segment(4) == 'payments') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-money-bill-wave tx-20"></i>
                <span class="menu-item-label">Płatności</span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/shipping_countries" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'shipping_countries' || $this->uri->segment(4) == 'shipping_countries') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-globe tx-20"></i>
                <span class="menu-item-label">Obsługiwane kraje</span>
            </div>
        </a>
        <a href="#" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'report' || $this->uri->segment(2) == 'statistics'  || $this->uri->segment(2) == 'report_magazine'  || $this->uri->segment(2) == 'report_outofstock' || $this->uri->segment(2) == 'report_products') {
            echo 'active show-sub';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon fas fa-chart-line tx-20"></i>
                <span class="menu-item-label">Raporty i statystyki</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/report" class="nav-link <?php if ($this->uri->segment(2) == 'report') {
                                                                                    echo 'active';
                                                                                } ?>">Raport sprzedaży</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/report_products" class="nav-link <?php if ($this->uri->segment(2) == 'report_products') {
                                                                                                echo 'active';
                                                                                            } ?>">Raport produktów</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/report_magazine" class="nav-link <?php if ($this->uri->segment(2) == 'report_magazine') {
                                                                                                echo 'active';
                                                                                            } ?>">Raport stanu<br>
                    magazynowego</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/report_outofstock" class="nav-link <?php if ($this->uri->segment(2) == 'report_outofstock') {
                                                                                                echo 'active';
                                                                                            } ?>">Lista produktów<br>
                    bliskich
                    wyczerpaniu</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>panel/statistics" class="nav-link <?php if ($this->uri->segment(2) == 'statistics') {
                                                                                        echo 'active';
                                                                                    } ?>">Statystyki</a>
            </li>
        </ul>
        <a href="<?php echo base_url(); ?>panel/margin" class="br-menu-link
          <?php if ($this->uri->segment(2) == 'margin' || $this->uri->segment(4) == 'margin') {
                echo 'active';
            } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-file-invoice-dollar tx-20"></i>
                <span class="menu-item-label">Marża
                </span>
            </div>
        </a>
        <?php $links = ['Wagi kategorii' => 'category_weights', 'Wagi produktów' => 'product_weights', "Minimalna waga do<br>naliczania kartonów" => 'product_min_weight_to_box']; ?>
        <a href="#" class="br-menu-link
    <?php if (in_array($this->uri->segment(2), $links)) {
        echo 'show-sub';
    } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-weight tx-20"></i>
                <span class="menu-item-label">Malfini wagi</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <?php foreach ($links as $key => $value) : ?>
                <li class="nav-item"><a href="<?= base_url() . 'panel/' . $value ?>" class="nav-link <?php if ($this->uri->segment(2) == $value) echo 'active' ?>"><?= $key ?></a></li>
            <?php endforeach; ?>
        </ul>
        <a href="<?php echo base_url(); ?>panel/free_shipping_min_price" class="br-menu-link
          <?php if ($this->uri->segment(2) == 'free_shipping_min_price' || $this->uri->segment(4) == 'free_shipping_min_price') {
                echo 'active';
            } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-dollar tx-20"></i>
                <span class="menu-item-label">Minimalna cena<br>darmowej dostawy
                </span>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>panel/shop_settings/form/update/1" class="br-menu-link
          <?php if ($this->uri->segment(2) == 'shop_settings' || $this->uri->segment(4) == 'shop_settings') {
                echo 'active';
            } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fas fa-file-invoice-dollar tx-20"></i>
                <span class="menu-item-label">Ustawienia sklepu,</br>
                    dostaw
                </span>
            </div>
        </a>

        <!-- <a href="<?php echo base_url(); ?>panel/example" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'example' || $this->uri->segment(4) == 'example') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon icon fab fa-wpforms tx-20"></i>
                <span class="menu-item-label">Example form</span>
            </div>
        </a>
        <a href="#" class="br-menu-link
        <?php if ($this->uri->segment(2) == 'example_dropdown' || $this->uri->segment(4) == 'example_dropdown') {
            echo 'active';
        } ?>">
            <div class="br-menu-item">
                <i class="menu-item-icon far fa-caret-square-down tx-20"></i>
                <span class="menu-item-label">Example dropdown</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="chart-flot.html" class="nav-link">Flot Charts</a></li>
            <li class="nav-item"><a href="chart-chartjs.html" class="nav-link">Chart JS</a></li>
            <li class="nav-item"><a href="chart-rickshaw.html" class="nav-link">Rickshaw</a></li>
            <li class="nav-item"><a href="chart-chartist.html" class="nav-link">Chartist</a></li>
            <li class="nav-item"><a href="chart-sparkline.html" class="nav-link">Sparkline</a></li>
            <li class="nav-item"><a href="chart-peity.html" class="nav-link">Peity</a></li>
        </ul> -->
    </div><!-- br-sideleft-menu -->
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->

<!-- ########## START: HEAD PANEL ########## -->
<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
                    <i class="icon ion-ios-email-outline tx-24"></i>
                    <!-- start: if statement -->
                    <?php $unreadMessage = false;
                    $i = 0;
                    foreach ($mails as $value) {
                        $i++;
                        if ($value->answer == 0) {
                            $unreadMessage = true;
                        }
                        if ($i == 5) {
                            break;
                        }
                    }
                    if ($unreadMessage == true) : ?>
                        <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
                    <?php endif; ?>
                    <!-- end: if statement -->
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
                    <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
                        <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Wiadomości</label>
                    </div><!-- d-flex -->

                    <div class="media-list">
                        <?php if (empty($mails)) {
                            echo '<p class="p-3">Brak wiadomości w skrzynce</p>';
                        } ?>
                        <?php $i = 0;
                        foreach (array_reverse($mails) as $value) : $i++; ?>
                            <a href="<?php echo base_url(); ?>panel/mails/show/<?php echo $value->id; ?>" class="media-list-link <?php if ($value->answer == 0) {
                                                                                                                                        echo 'read';
                                                                                                                                    } ?>">
                                <div class="media pd-x-20 pd-y-15">
                                    <?php if ($value->answer == 1) : ?>
                                        <img src="<?php echo base_url(); ?>assets/back/img/icons/checked.png" class="wd-40 rounded-circle" alt="">
                                    <?php else : $unreadMessage == true; ?>
                                        <img src="<?php echo base_url(); ?>assets/back/img/icons/cancel.png" class="wd-40 rounded-circle" alt="">
                                    <?php endif; ?>
                                    <div class="media-body">
                                        <div class="d-flex align-items-center justify-content-between mg-b-5">
                                            <p class="mg-b-0 tx-medium tx-gray-800 tx-14"><?php echo $value->name; ?></p>
                                            <span class="tx-11 tx-gray-500"><?php echo date('d/m/Y', strtotime($value->created)); ?></span>
                                        </div><!-- d-flex -->
                                        <p class="tx-12 mg-b-0"><?php echo $value->subject; ?></p>
                                    </div>
                                </div><!-- media -->
                            </a>
                            <?php if ($i == 5) {
                                break;
                            } ?>
                        <?php endforeach; ?>
                        <div class="pd-y-10 tx-center bd-t">
                            <a href="<?php echo base_url(); ?>panel/mails" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Wyświetl wszystkie wiadomości</a>
                        </div>
                    </div><!-- media-list -->
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->

            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down"><?php echo ucfirst($_SESSION['rola']); ?></span>
                    <?php if (@$user->avatar != '') {
                        echo '<span class="avatar" style="background: url(' . base_url() . 'uploads/' . @$user->avatar . ')"></span>';
                    } else {
                        echo '<span class="avatar" style="background: url(http://via.placeholder.com/64x64)"></span>';
                    } ?>
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="<?php echo base_url(); ?>panel/profile"><i class="icon ion-ios-person"></i> Edytuj
                                profil</a></li>
                        <li><a href="<?php echo base_url(); ?>panel/home/logout"><i class="icon ion-power"></i> Wyloguj
                                się</a></li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
            <a id="btnRightMenu" href="" class="pos-relative">
                <i class="fas fa-angle-double-left"></i>
                <!-- start: if statement -->

                <!-- end: if statement -->
            </a>
        </div><!-- navicon-right -->
    </div><!-- br-header-right -->
</div><!-- br-header -->
<!-- ########## END: HEAD PANEL ########## -->

<!-- ########## START: RIGHT PANEL ########## -->
<div class="br-sideright">
    <ul class="nav nav-tabs sidebar-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" role="tab" href="#calendar"><i class="icon ion-ios-calendar-outline tx-24"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" href="#attachments"><i class="icon ion-ios-folder-outline tx-22"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" href="#contact"><i class="icon ion-clipboard tx-24"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" role="tab" href="#settings"><i class="icon ion-ios-gear-outline tx-24"></i></a>
        </li>
    </ul><!-- sidebar-tabs -->

    <!-- Tab panes -->
    <div class="tab-content tab-background">

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto active" id="calendar" role="tabpanel">
            <label class="sidebar-label pd-x-25 mg-t-25">Czas &amp; Data</label>
            <div class="pd-x-25">
                <h2 id="brTime" class="tx-white tx-lato mg-b-5"></h2>
                <h6 id="brDate" class="tx-white tx-light op-3"></h6>
            </div>
            <label class="sidebar-label pd-x-25 mg-t-25">Kalendarz</label>
            <div class="datepicker sidebar-datepicker"></div>
        </div>


        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="attachments" role="tabpanel">
            <label class="sidebar-label pd-x-25 mg-t-25">Pliki na serwerze</label>
            <div class="media-file-list">
                <?php $i = 0;
                foreach (array_reverse($media) as $value) :
                    list($type, $ext) = explode("/", $value->type); ?>
                    <div class="media mg-t-20">
                        <div class="pd-10 bg-primary wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
                            <?php if ($type == 'image') : ?>
                                <img src="<?php echo base_url(); ?>uploads/<?php echo date('Y-m-d', strtotime($value->created)); ?>/<?php echo $value->name; ?>" alt="" width="32">
                            <?php elseif ($ext == 'pdf') : ?>
                                <i class="fa fa-file-pdf-o tx-28 tx-white"></i>
                            <?php else : ?>
                                <i class="fa fa-file-video-o tx-28 tx-white"></i>
                            <?php endif; ?>
                        </div>
                        <div class="media-body">
                            <p class="mg-b-0 tx-13"><?php echo substr($value->raw_name, 0, 20); ?></p>
                            <p class="mg-b-0 tx-12 op-5">
                                <?php echo strtoupper($ext) . ' ' . ucfirst($type); ?></p>
                            <p class="mg-b-0 tx-12 op-5"><?php echo number_format($value->size / 1024, 2); ?> MB</p>
                        </div><!-- media-body -->
                        <a class="more" data-container="body" data-toggle="popover" data-popover-color="default" data-placement="right" title="Link pliku" data-content="<?php echo base_url(); ?>uploads/<?php echo date('Y-m-d', strtotime($value->created)); ?>/<?php echo $value->name; ?>"><i class="icon ion-android-more-vertical tx-18"></i></a>
                    </div><!-- media -->
                <?php if ($i == 6) {
                        break;
                    }
                    $i++;
                endforeach; ?>
            </div><!-- media-list -->
        </div><!-- #history -->


        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="contact" role="tabpanel">
            <label class="sidebar-label pd-x-25 mg-t-25">Dane kontaktowe</label>

            <div class="change"></div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Nazwa firmy:</h6>
                <div class="pos-relative">
                    <input type="text" id="company" name="company" onchange="updateField('company' , 'contact_settings')" value="<?php echo $contact->company; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Imię i nazwisko właściciela:</h6>
                <div class="pos-relative">
                    <input type="text" id="name" name="name" onchange="updateField('name' , 'contact_settings')" value="<?php echo $contact->name; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Adres firmy:</h6>
                <div class="pos-relative">
                    <input type="text" id="address" name="address" onchange="updateField('address' , 'contact_settings')" value="<?php echo $contact->address; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Miasto:</h6>
                <div class="pos-relative">
                    <input type="text" id="city" name="city" onchange="updateField('city' , 'contact_settings')" value="<?php echo $contact->city; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Kod pocztowy:</h6>
                <div class="pos-relative">
                    <input type="text" id="zip_code" name="zip_code" onchange="updateField('zip_code' , 'contact_settings')" value="<?php echo $contact->zip_code; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>
            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">NIP:</h6>
                <div class="pos-relative">
                    <input type="text" id="nip" name="nip" onchange="updateField('nip' , 'contact_settings')" value="<?php echo @$contact->nip; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>
            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">REGON:</h6>
                <div class="pos-relative">
                    <input type="text" id="regon" name="regon" onchange="updateField('regon' , 'contact_settings')" value="<?php echo @$contact->regon; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="pd-y-20 pd-l-25 tx-white">
                        <h6 class="tx-13 tx-normal">Etykieta:</h6>
                        <div class="pos-relative">
                            <input type="text" id="label1" name="label1" onchange="updateField('label1' , 'contact_settings')" value="<?php echo $contact->label1; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="pd-y-20 pd-r-25 tx-white">
                        <h6 class="tx-13 tx-normal">Numer telefonu:</h6>
                        <div class="pos-relative">
                            <input type="text" id="phone1" name="phone1" onchange="updateField('phone1' , 'contact_settings')" value="<?php echo $contact->phone1; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="pd-y-20 pd-l-25 tx-white">
                        <h6 class="tx-13 tx-normal">Etykieta:</h6>
                        <div class="pos-relative">
                            <input type="text" id="label2" name="label2" onchange="updateField('label2' , 'contact_settings')" value="<?php echo $contact->label2; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="pd-y-20 pd-r-25 tx-white">
                        <h6 class="tx-13 tx-normal">Numer telefonu:</h6>
                        <div class="pos-relative">
                            <input type="text" id="phone2" name="phone2" onchange="updateField('phone2' , 'contact_settings')" value="<?php echo $contact->phone2; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="pd-y-20 pd-l-25 tx-white">
                        <h6 class="tx-13 tx-normal">Etykieta:</h6>
                        <div class="pos-relative">
                            <input type="text" id="label3" name="label3" onchange="updateField('label3' , 'contact_settings')" value="<?php echo $contact->label3; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="pd-y-20 pd-r-25 tx-white">
                        <h6 class="tx-13 tx-normal">Adres e-mail:<br><small>(przychodzą na niego również
                                formularze):</small></h6>
                        <div class="pos-relative">
                            <input type="text" id="email1" name="email1" onchange="updateField('email1' , 'contact_settings')" value="<?php echo $contact->email1; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="pd-y-20 pd-l-25 tx-white">
                        <h6 class="tx-13 tx-normal">Etykieta:</h6>
                        <div class="pos-relative">
                            <input type="text" id="label4" name="label4" onchange="updateField('label4' , 'contact_settings')" value="<?php echo $contact->label4; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="pd-y-20 pd-r-25 tx-white">
                        <h6 class="tx-13 tx-normal">Adres e-mail:</h6>
                        <div class="pos-relative">
                            <input type="text" id="email2" name="email2" onchange="updateField('email2' , 'contact_settings')" value="<?php echo $contact->email2; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="pd-y-20 pd-l-25 tx-white">
                        <h6 class="tx-13 tx-normal">Etykieta:</h6>
                        <div class="pos-relative">
                            <input type="text" id="label6" name="label6" onchange="updateField('label6' , 'contact_settings')" value="<?php echo $contact->label6; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="pd-y-20 pd-r-25 tx-white">
                        <h6 class="tx-13 tx-normal">Adres e-mail:<br><small>(przychodzą na niego również
                                zamówienia):</small></h6>
                        <div class="pos-relative">
                            <input type="text" id="email3" name="email3" onchange="updateField('email3' , 'contact_settings')" value="<?php echo $contact->email3; ?>" class="form-control form-control-inverse transition pd-y-10">
                        </div>
                    </div>
                </div>
            </div>


            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Link do mapy Google:</h6>
                <div class="pos-relative">
                    <input type="text" id="map" name="map" onchange="updateFieldMap('map' , 'contact_settings')" value="<?php echo $contact->map; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
                <div id="googleMap" class="text-center">
                    <iframe src="<?php echo $contact->map; ?>" width="100%" height="150" frameborder="0" style="border:0; margin-top: 20px;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div><!-- #cotact -->


        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="settings" role="tabpanel">
            <label class="sidebar-label pd-x-25 mg-t-25">Ustawienia strony</label>

            <div class="change"></div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Logo:</h6>
                <p class="op-5 tx-13">Logo wyświetlane w zakładce i Google</p>
                <div class="pos-relative">
                    <div id="photoViewer_logo" class="form-group bd-t-0-force bd-r-0-force text-center">
                        <?php if ($settings->logo != '') {
                            echo '<img class="img-fluid img-thumbnail" src="' . base_url() . 'uploads/' . $settings->logo . '" width=74>';
                        } else {
                            echo '<img class="img-fluid img-thumbnail" src="http://via.placeholder.com/64x64" alt="">';
                        } ?>
                    </div>
                    <input type="hidden" id="name_photo_logo" name="name_photo_logo">
                    <label class="custom-file">
                        <input type="file" id="photo_logo" class="custom-file-input" name="photo_logo" onchange="updateFieldPhoto('photo_logo' , 'settings')">
                        <span class="custom-file-control custom-file-control-inverse"></span>
                    </label>
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Favicon:</h6>
                <p class="op-5 tx-13">Logo wyświetlane w zakładce i Google</p>
                <div class="pos-relative">
                    <div id="photoViewer_favicon" class="form-group bd-t-0-force bd-r-0-force text-center">
                        <?php if (@$settings->favicon != '') {
                            echo '<img class="img-fluid img-thumbnail" src="' . base_url() . 'uploads/' . @$settings->favicon . '" width=74>';
                        } else {
                            echo '<img class="img-fluid img-thumbnail" src="http://via.placeholder.com/64x64" alt="">';
                        } ?>
                    </div>
                    <input type="hidden" id="name_favicon" name="name_favicon">
                    <label class="custom-file">
                        <input type="file" id="favicon" class="custom-file-input" name="favicon" onchange="updateFieldPhoto('favicon' , 'settings')">
                        <span class="custom-file-control custom-file-control-inverse"></span>
                    </label>
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Logo w mailach (PNG/JPG/JPEG):</h6>
                <p class="op-5 tx-13">Logo wyświetlane w mailach</p>
                <div class="pos-relative">
                    <div id="photoViewer_logo_mail" class="form-group bd-t-0-force bd-r-0-force text-center">
                        <?php if (@$settings->logo_mail != '') {
                            echo '<img class="img-fluid img-thumbnail" src="' . base_url() . 'uploads/' . @$settings->logo_mail . '" width=74>';
                        } else {
                            echo '<img class="img-fluid img-thumbnail" src="http://via.placeholder.com/64x64" alt="">';
                        } ?>
                    </div>
                    <input type="hidden" id="name_logo_mail" name="name_logo_mail">
                    <label class="custom-file">
                        <input type="file" id="logo_mail" class="custom-file-input" name="logo_mail" onchange="updateFieldPhoto('logo_mail' , 'settings')">
                        <span class="custom-file-control custom-file-control-inverse"></span>
                    </label>
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Nazwa witryny:</h6>
                <p class="op-5 tx-13">Nazwa, która będzie wyświetlać się w zakładce i przeglądarce Google.</p>
                <div class="pos-relative">
                    <input type="text" id="meta_title" name="meta_title" onchange="updateField('meta_title' , 'settings')" value="<?php echo $settings->meta_title; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Słowa kluczowe:</h6>
                <p class="op-5 tx-13">Frazy po których Google indeksuje stronę.</p>
                <div class="pos-relative">
                    <input type="text" id="keywords" name="keywords" onchange="updateField('keywords' , 'settings')" value="<?php echo $settings->keywords; ?>" class="form-control form-control-inverse transition pd-y-10" data-role="tagsinput">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Opis witryny:</h6>
                <p class="op-5 tx-13">Opis wyświetlany pod nazwa w przeglądarce Google</p>
                <div class="pos-relative">
                    <textarea id="description" name="description" rows="5" onfocusout="updateTextarea('description' , 'settings')" class="form-control form-control-inverse transition pd-y-10"><?php echo $settings->description; ?></textarea>
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Facebook:</h6>
                <p class="op-5 tx-13">Adres URL do Twojego profilu na Facebook'u</p>
                <div class="pos-relative">
                    <input type="text" id="fb_link" name="fb_link" onchange="updateField('fb_link' , 'settings')" value="<?php echo $settings->fb_link; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Twitter:</h6>
                <p class="op-5 tx-13">Adres URL do Twojego profilu na Twitter'ze</p>
                <div class="pos-relative">
                    <input type="text" id="tw_link" name="tw_link" onchange="updateField('tw_link' , 'settings')" value="<?php echo $settings->tw_link; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Instagram:</h6>
                <p class="op-5 tx-13">Adres URL do Twojego profilu na Instagram'ie</p>
                <div class="pos-relative">
                    <input type="text" id="inst_link" name="inst_link" onchange="updateField('inst_link' , 'settings')" value="<?php echo $settings->inst_link; ?>" class="form-control form-control-inverse transition pd-y-10">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Regulamin sklepu:</h6>
                <p class="op-5 tx-13">Klauzula RODO</p>
                <div class="pos-relative">
                    <textarea id="regulation" name="regulation" rows="5" onfocusout="updateTextarea('regulation' , 'settings')" class="form-control form-control-inverse transition pd-y-10"><?php echo @$settings->regulation; ?></textarea>
                </div>
            </div>
            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Oferta i przedstawienie usług:</h6>
                <p class="op-5 tx-13">Klauzula RODO</p>
                <div class="pos-relative">
                    <textarea id="rodo" name="rodo" rows="5" onfocusout="updateTextarea('rodo' , 'settings')" class="form-control form-control-inverse transition pd-y-10"><?php echo @$settings->rodo; ?></textarea>
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Zgoda na otrzymywanie informacji handlowych:</h6>
                <p class="op-5 tx-13">Klauzula RODO</p>
                <div class="pos-relative">
                    <textarea id="rodo_offer" name="rodo_offer" rows="5" onfocusout="updateTextarea('rodo_offer' , 'settings')" class="form-control form-control-inverse transition pd-y-10"><?php echo @$settings->rodo_offer; ?></textarea>
                </div>
            </div>

            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Zgoda na kontakt telefoniczny:</h6>
                <p class="op-5 tx-13">Klauzula RODO</p>
                <div class="pos-relative">
                    <textarea id="rodo_tel" name="rodo_tel" rows="5" onfocusout="updateTextarea('rodo_tel' , 'settings')" class="form-control form-control-inverse transition pd-y-10"><?php echo @$settings->rodo_tel; ?></textarea>
                </div>
            </div>
            <div class="pd-y-20 pd-x-25 tx-white">
                <h6 class="tx-13 tx-normal">Mailing newsletter:</h6>
                <p class="op-5 tx-13">Klauzula RODO</p>
                <div class="pos-relative">
                    <textarea id="rodo_newsletter" name="rodo_newsletter" rows="5" onfocusout="updateTextarea('rodo_newsletter' , 'settings')" class="form-control form-control-inverse transition pd-y-10"><?php echo @$settings->rodo_newsletter; ?></textarea>
                </div>
            </div>

            <div class="pd-y-20 pd-x-25">
                <h6 class="tx-13 tx-normal tx-white m-0">Więcej ustawień</h6>
                <label class="custom-file" style="height:4rem;">
                    <input type="file" id="privace" name="privace" class="custom-file-input" style="height: 0;" onchange="updateFieldPrivace('privace' , 'settings')">
                    <span id="privaceTx" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2 mb-4">
                        Polityka prywatności
                        <?php if ($settings->privace != '') : ?>
                            <i class="fas fa-check"></i>
                        <?php endif; ?>
                    </span>
                </label>
                <a href="<?php echo base_url(); ?>panel/profile" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Ustawienia profilu</a>
            </div>

        </div>
    </div><!-- tab-content -->
</div><!-- br-sideright -->
<!-- ########## END: RIGHT PANEL ########## --->