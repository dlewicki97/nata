<div class="row no-gutters">
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-12">
                <div class="form-group bd-b-0-force">
                    <label class="form-control-label">Płatna dostawa:</label>
                    <select class="form-control select2 w-100" name="delivery_active" style="width: 100%;">
                        <option value="0" <?php if (@$value->delivery_active == 0) {
                                                echo 'selected';
                                            } ?>>Nie</option>
                        <option value="1" <?php if (@$value->delivery_active == 1) {
                                                echo 'selected';
                                            } ?>>Tak</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force bd-b-0-force">
                    <label class="form-control-label">Wysokość produktu w CM:</label>
                    <input class="form-control" type="text" name="height" value="<?php echo @$value->height; ?>">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group bd-b-0-force">
                    <label class="form-control-label">Szerokość produktu w CM:</label>
                    <input class="form-control" type="text" name="width" value="<?php echo @$value->width; ?>">
                </div>
            </div>

            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force">
                    <label class="form-control-label">Długość produktu w CM:</label>
                    <input class="form-control" type="text" name="length" value="<?php echo @$value->length; ?>">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group">
                    <label class="form-control-label">Waga w KG:</label>
                    <input class="form-control" type="text" name="weight" value="<?php echo @$value->weight; ?>">
                </div>
            </div>

            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force bd-t-0-force">
                    <label class="form-control-label">Cena wysyłki kurierem - przedpłata:</label>
                    <input class="form-control" type="text" name="delivery_cost"
                        value="<?php echo @$value->delivery_cost; ?>">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group bd-t-0-force">
                    <label class="form-control-label">Cena wysyłki kurierem - pobranie:</label>
                    <input class="form-control" type="text" name="delivery_cost_on_delivery"
                        value="<?php echo @$value->delivery_cost_on_delivery; ?>">
                </div>
            </div>

            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force bd-t-0-force">
                    <label class="form-control-label">Cena wysyłki paczkomatem - przedpłata:</label>
                    <input class="form-control" type="text" name="delivery_cost_paczkomat"
                        value="<?php echo @$value->delivery_cost_paczkomat; ?>">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group bd-t-0-force">
                    <label class="form-control-label">Cena wysyłki paczkomatem - pobranie:</label>
                    <input class="form-control" type="text" name="delivery_cost_on_delivery_paczkomat"
                        value="<?php echo @$value->delivery_cost_on_delivery_paczkomat; ?>">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group bd-t-0-force">
                    <label class="form-control-label">Dostępne formy dostawy:</label>
                    <select class="form-control select2-show-search w-100" name="delivery[]" style="width: 100%;"
                        multiple>
                        <option value="0" <?php if (in_array(0, explode(',', @$value->delivery))) {
                                                echo 'selected';
                                            } ?>>Kurier</option>
                        <option value="1" <?php if (in_array(1, explode(',', @$value->delivery))) {
                                                echo 'selected';
                                            } ?>>Kurier za pobraniem</option>
                        <option value="2" <?php if (in_array(2, explode(',', @$value->delivery))) {
                                                echo 'selected';
                                            } ?>>Odbiór osobisty</option>
                        <option value="3" <?php if (in_array(3, explode(',', @$value->delivery))) {
                                                echo 'selected';
                                            } ?>>InPost</option>
                        <option value="4" <?php if (in_array(4, explode(',', @$value->delivery))) {
                                                echo 'selected';
                                            } ?>>InPost za pobraniem</option>
                        <option value="5" <?php if (in_array(5, explode(',', @$value->delivery))) {
                                                echo 'selected';
                                            } ?>>Paczkomat</option>
                        <option value="6" <?php if (in_array(6, explode(',', @$value->delivery))) {
                                                echo 'selected';
                                            } ?>>Paczkomat za pobraniem</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
</div>