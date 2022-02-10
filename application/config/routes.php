<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['aktualnosci'] = 'news';
$route['aktualnosci/(.*)/(.+)'] = 'news/show/$1';
$route['aktualnosci/(.*)'] = 'news/index/$1';
$route['blog'] = 'blog';
$route['blog/(.*)/(.+)'] = 'blog/show/$1';
$route['blog/(.*)'] = 'blog/index/$1';
$route['o-nas'] = 'about';
$route['partnerzy'] = 'partners';
$route['kontakt'] = 'contact';
$route['galeria'] = 'galleries';
$route['galeria/(.*)/(.+)'] = 'galleries/show/$2';
$route['uslugi/(.*)/(.+)'] = 'services/show/$1';
$route['produkcja-wlasna/(.*)/(.+)'] = 'handmades/show/$1';
$route['pliki-do-pobrania'] = 'downloads';
$route['pliki-do-pobrania/(.*)/(.+)'] = 'downloads/show/$2';

$route['logowanie'] = 'auth/login';
$route['rejestracja'] = 'auth/register';
$route['stworz-uzytkownika'] = 'auth/register/create_user';
$route['logowanie-akcja'] = 'auth/login/sign_in';
$route['aktywacja/(.*)'] = 'auth/register/activate_user/$1';
$route['resetowanie-hasla'] = 'auth/password_reset';
$route['haslo-reset'] = 'auth/password_reset/reset';
$route['wyloguj'] = 'auth/logout';
$route['ustawienia-konta'] = 'auth/account_settings';
$route['edycja-konta'] = 'auth/account_settings/update';

$route['moje-zamowienia'] = 'my_orders';

$route['koszty-dostawy'] = 'delivery_costs';
$route['zwroty-i-reklamacje'] = 'complaint';
$route['regulamin-zakupow'] = 'shopping_regulation';
$route['formy-platnosci'] = 'payments';
$route['oferta-hurtowa'] = 'wholesale_offer';


$route['sklep'] = 'shop/listing';
$route['nowosci'] = 'shop/listing';
$route['nowosci/(.*)'] = 'shop/listing/$1';
$route['outlet'] = 'shop/listing';
$route['outlet/(.*)'] = 'shop/listing/$1';
$route['sklep/(.*)'] = 'shop/listing/$1';
$route['generuj/lista_produktow'] = 'shop/render_listing';
$route['generuj/lista_produktow/kategoria/(.*)/(.+)'] = 'shop/render_category_listing/$1/$2';
$route['generuj/lista_produktow/nowosci/(.*)'] = 'shop/render_news_listing/$1';
$route['generuj/lista_produktow/outlet/(.*)'] = 'shop/render_outlet_listing/$1';
$route['generuj/lista_produktow/(.*)'] = 'shop/render_listing/$1';
$route['produkt/(.*)/(.+)'] = 'shop/product/$1/$2';
$route['wyslij_opinie'] = 'shop/sendOpinion';
$route['zapytaj_o_produkt'] = 'mailer/question_for_product';
$route['filtry'] = 'shop/filters';
$route['wyszukaj/(.*)'] = 'home/render_search/$1';
$route['produkt-przypomnienie'] = 'product_reminder/store';

$route['usun-wyszukiwanie'] = 'shop/removeSearchValue';

$route['koszyk'] = 'cart';
$route['dodaj_do_koszyka/(.*)'] = 'cart/add/$1';
$route['koszyk/usun/(.*)'] = 'cart/remove/$1';
$route['koszyk/aktualizuj/(.*)'] = 'cart/qty/$1';
$route['rabat'] = 'cart/discount';


$route['koszyk/dane_klienta'] = 'cart/client_data';
$route['dane_faktury'] = 'cart/invoice_fields';
$route['koszyk/platnosc'] = 'cart/delivery_payment';
$route['wybor_platnosci/(.*)'] = 'cart/payment_fields/$1';
$route['koszyk/podsumowanie'] = 'cart/summary';
$route['dziekujemy'] = 'cart/thankyou';

$route['ulubione'] = 'clients/favourite';
$route['dodaj_do_ulubionych/(.*)'] = 'clients/add_favourite_product/$1';
$route['usun_z_ulubionych/(.*)'] = 'clients/remove_favourite_product/$1';

$route['p24/status/(.*)'] = 'cart/p24_status/$1';

//SCIAGA
// $route['odziez/(.*)/(.+)'] = 'home/odziez/$1/$2';
// $route['obuwie/(.*)/(.+)'] = 'home/obuwie/$1/$2';
// $route['akcesoria/(.*)/(.+)'] = 'home/akcesoria/$1/$2';
// $route['kolekcje/(.*)/(.+)'] = 'home/kolekcje/$1/$2';
// $route['gazetka/(.*)/(.+)'] = 'home/gazetka/$1/$2';
// $route['produkt/(.*)/(.+)'] = 'home/produkt/$1/$2';
// $route['o_nas'] = 'home/o_nas';
// $route['wydarzenia'] = 'home/wydarzenia';
// $route['wpis'] = 'home/wpis';
// $route['aktualnosci'] = 'p/aktualnosci';
// $route['uzywane_podglad/(.*)/(.+)'] = 'p/uzywane_podglad/$1/$2';
// $route['promocje'] = 'p/promocje';
// $route['promocja/(.*)/(.+)'] = 'p/promocja/$1/$2';
// $route['uslugi'] = 'p/uslugi';
// $route['usluga/(.*)/(.+)'] = 'p/usluga/$1/$2';
// $route['o-nas/(.*)/(.+)'] = 'p/o_nas/$1/$2';
// $route['kontakt/(.*)/(.+)'] = 'p/kontakt/$1/$2';
// $route['media'] = 'p/media';
// $route['nowe/(.*)/(.+)'] = 'p/nowe/$1/$2';
// $route['nowe'] = 'p/nowe';
// $route['akcesoria/(.*)'] = 'p/akcesoria/$1';