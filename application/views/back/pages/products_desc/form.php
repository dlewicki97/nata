    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
            <p class="mg-b-0"><?php echo subtitle(); ?></p>
            <hr>
        </div>

        <div class="br-pagebody mg-t-0 pd-x-30">
            <?php if (isset($_SESSION['flashdata'])) : ?>
            <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
            <?php endif; ?>

            <form class="form-layout form-layout-2"
                action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2); ?>/<?php echo @$value->id; ?>"
                method="post" enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Filtruj produkty: <span
                                            class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="filter_title"
                                        value="<?php echo @$value->filter_title; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kategorie:</label>
                                    <input class="form-control" type="text" name="categories"
                                        value="<?php echo @$value->categories; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Napis na przycisku filtrującym:</label>
                                    <input class="form-control" type="text" name="filter_button_name"
                                        value="<?php echo @$value->filter_button_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Napis na polu wyszukującym filtr:</label>
                                    <input class="form-control" type="text" name="filter_input_placeholder"
                                        value="<?php echo @$value->filter_input_placeholder; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Tytuł:</label>
                                    <input class="form-control" type="text" name="title"
                                        value="<?php echo @$value->title; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Cena:</label>
                                    <input class="form-control" type="text" name="price"
                                        value="<?php echo @$value->price; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Sortuj według:</label>
                                    <input class="form-control" type="text" name="sort_by"
                                        value="<?php echo @$value->sort_by; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Od najtańszych:</label>
                                    <input class="form-control" type="text" name="cheapest"
                                        value="<?php echo @$value->cheapest; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Od najdroższych:</label>
                                    <input class="form-control" type="text" name="most_expensive"
                                        value="<?php echo @$value->most_expensive; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Data utworzenia:</label>
                                    <input class="form-control" type="text" name="created_date"
                                        value="<?php echo @$value->created_date; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Popularność:</label>
                                    <input class="form-control" type="text" name="popularity"
                                        value="<?php echo @$value->popularity; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Alfabetycznie:</label>
                                    <input class="form-control" type="text" name="alphabetical"
                                        value="<?php echo @$value->alphabetical; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Użyte filtry:</label>
                                    <input class="form-control" type="text" name="used_filters"
                                        value="<?php echo @$value->used_filters; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Brak produktu w magazynie:</label>
                                    <input class="form-control" type="text" name="product_lack"
                                        value="<?php echo @$value->product_lack; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Etykieta nowości:</label>
                                    <input class="form-control" type="text" name="news"
                                        value="<?php echo @$value->news; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Etykieta promocji:</label>
                                    <input class="form-control" type="text" name="promotion"
                                        value="<?php echo @$value->promotion; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Etykieta outlet:</label>
                                    <input class="form-control" type="text" name="outlet"
                                        value="<?php echo @$value->outlet; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">"Wyników na stronie":</label>
                                    <input class="form-control" type="text" name="results_per_page"
                                        value="<?php echo @$value->results_per_page; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">"Produktów":</label>
                                    <input class="form-control" type="text" name="products_count"
                                        value="<?php echo @$value->products_count; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">"Brak produktów spełniających wybrane
                                        kryteria...":</label>
                                    <input class="form-control" type="text" name="products_lack_alert"
                                        value="<?php echo @$value->products_lack_alert; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Cena przesyłki:</label>
                                    <input class="form-control" type="text" name="shipping_price"
                                        value="<?php echo @$value->shipping_price; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Od:</label>
                                    <input class="form-control" type="text" name="from_word"
                                        value="<?php echo @$value->from_word; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Dostępność:</label>
                                    <input class="form-control" type="text" name="availability"
                                        value="<?php echo @$value->availability; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Produkt niedostępny:</label>
                                    <input class="form-control" type="text" name="product_inaccessible"
                                        value="<?php echo @$value->product_inaccessible; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Duża ilość:</label>
                                    <input class="form-control" type="text" name="big_amount"
                                        value="<?php echo @$value->big_amount; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Mała ilość:</label>
                                    <input class="form-control" type="text" name="low_amount"
                                        value="<?php echo @$value->low_amount; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Do koszyka:</label>
                                    <input class="form-control" type="text" name="add_to_cart_button_name"
                                        value="<?php echo @$value->add_to_cart_button_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Opis:</label>
                                    <input class="form-control" type="text" name="description"
                                        value="<?php echo @$value->description; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Opinie:</label>
                                    <input class="form-control" type="text" name="opinions"
                                        value="<?php echo @$value->opinions; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Zapytaj o produkt:</label>
                                    <input class="form-control" type="text" name="ask_for_product"
                                        value="<?php echo @$value->ask_for_product; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Wyślij zapytanie:</label>
                                    <input class="form-control" type="text" name="ask_button_name"
                                        value="<?php echo @$value->ask_button_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Ostatnio oglądane produkty:</label>
                                    <input class="form-control" type="text" name="last_seen_products"
                                        value="<?php echo @$value->last_seen_products; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Podobne produkty:</label>
                                    <input class="form-control" type="text" name="similar_products"
                                        value="<?php echo @$value->similar_products; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">({ilosc} opinii):</label>
                                    <input class="form-control" type="text" name="opinions_amount"
                                        value="<?php echo @$value->opinions_amount; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Masz ten produkt?:</label>
                                    <input class="form-control" type="text" name="got_this_product"
                                        value="<?php echo @$value->got_this_product; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Pomóż innym w wyborze!:</label>
                                    <input class="form-control" type="text" name="help_others"
                                        value="<?php echo @$value->help_others; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Napis na przycisku otwierającym modal
                                        opinii:</label>
                                    <input class="form-control" type="text" name="add_opinion_button_name"
                                        value="<?php echo @$value->add_opinion_button_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Tytuł modala opinii:</label>
                                    <input class="form-control" type="text" name="opinion_modal_title"
                                        value="<?php echo @$value->opinion_modal_title; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Placeholder opinii:</label>
                                    <input class="form-control" type="text" name="opinion_placeholder"
                                        value="<?php echo @$value->opinion_placeholder; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Napis na przycisku wysyłania opinii:</label>
                                    <input class="form-control" type="text" name="opinion_send_button_name"
                                        value="<?php echo @$value->opinion_send_button_name; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Opinie użytkowników:</label>
                                    <input class="form-control" type="text" name="users_opinions"
                                        value="<?php echo @$value->users_opinions; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-layout-footer bd pd-20 bd-t-0-force">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <button class="btn btn-secondary"
                                        onclick="window.history.go(-1); return false;">Anuluj</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>