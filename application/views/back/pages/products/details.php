<div class="row no-gutters">
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force bd-b-0-force">
                    <label class="form-control-label">Aktywny:</label>
                    <label class="ckbox">
                        <input type="checkbox" <?php if (@$value->active == 1) {
                                             echo 'checked';
                                          } ?> name="active" value="1">
                        <span>Produkt aktywny i widoczny na sklepie</span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group bd-b-0-force">
                    <label class="form-control-label">Wyróżniony:</label>
                    <label class="ckbox">
                        <input type="checkbox" <?php if (@$value->awarded == 1) {
                                             echo 'checked';
                                          } ?> name="awarded" value="1">
                        <span>Produkt wyróżniony na stronie głównej</span>
                    </label>
                </div>
            </div>

            <!-- <div class="col-md-6 pr-0">
                <div class="form-group bd-b-0-force bd-r-0-force">
                    <label class="form-control-label">Specjalne zamówienia:</label>
                    <label class="ckbox">
                        <input type="checkbox" <?php if (@$value->special_order == 1) {
                                             echo 'checked';
                                          } ?> name="special_order" value="1">
                        <span>Pozwalaj na zamówienia oczekujące na dostawę z magazynu</span>
                    </label>
                </div>
            </div> -->

            <div class="col-md-6 pr-0">
                <div class="form-group bd-b-0-force">
                    <label class="form-control-label">OUTLET:</label>
                    <label class="ckbox">
                        <input type="checkbox" <?php if (@$value->outlet == 1) {
                                             echo 'checked';
                                          } ?> name="outlet">
                        <span>Określ produkt jako OUTLET</span>
                    </label>
                </div>
            </div>

            <div class="col-md-6 pl-0">
                <div class="form-group bd-b-0-force">
                    <label class="form-control-label">Jeden w koszyku:</label>
                    <label class="ckbox">
                        <input type="checkbox" <?php if (@$value->one_in_cart == 1) {
                                             echo 'checked';
                                          } ?> name="one_in_cart" value="1">
                        <span>Pozwalaj na zamówienie tylko jednego produktu w pojedyńczym zamówieniu</span>
                    </label>
                </div>
            </div>

            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force">
                    <label class="form-control-label">Opinie:</label>
                    <label class="ckbox">
                        <input type="checkbox" <?php if (@$value->opinions == 1) {
                                             echo 'checked';
                                          } ?> name="opinions" value="1">
                        <span>Pozwalaj na wystawianie opinii temu produktowi</span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group">
                    <label class="form-control-label">Nowość:</label>
                    <label class="ckbox">
                        <input type="checkbox" <?php if (@$value->news == 1) {
                                             echo 'checked';
                                          } ?> name="news" value="1">
                        <span>Okreś produkt jako NOWOŚĆ</span>
                    </label>
                </div>
            </div>

        </div>
    </div>
</div>