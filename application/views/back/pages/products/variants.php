<div class="row no-gutters">
    <div class="col-md-12">
        <div class="row">

            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force">
                    <label class="form-control-label">Identyfikator wariantu:</label>
                    <input class="form-control" type="text" name="sku" value="<?php echo @$variant->sku; ?>" readonly
                        required>
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group">
                    <label class="form-control-label">Ilość w magazynie:</label>
                    <input class="form-control" type="text" name="qty" value="<?php echo @$variant->qty; ?>">
                    <?php if (@$variant->qty <= 0) : ?>
                    <input class="form-control" type="text" name="qty_old" value="<?php echo @$variant->qty; ?>" hidden>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6 pr-0">
                <div class="form-group bd-r-0-force bd-t-0-force">
                    <label class="form-control-label">Ilość sztuk w opakowaniu:</label>
                    <input class="form-control" type="number" name="opakowanie"
                        value="<?php echo @$value->opakowanie; ?>">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="form-group bd-t-0-force">
                    <label class="form-control-label">Ilość sztuk w kartonie:</label>
                    <input class="form-control" type="number" name="karton" value="<?php echo @$value->karton; ?>">
                </div>
            </div>

        </div>
    </div>
</div>