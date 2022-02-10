<div class="row related-products">
    <div class="col-md-12">
        <div class="form-group filter bd-b-0-force">
            <?php $linked = explode(',', $value->linked_products); ?>
            <label class="form-control-label">Powiązane produkty</label>
            <select name="linked_products[]" class="form-control related-products select2 select2-show-search"
                style="width: 100%; color: black;" multiple>
                <?php foreach ($products as $v) : if ($v->id != $value->id) : ?>
                <option value="<?php echo $v->id; ?>" <?php if (@in_array($v->id, $linked)) echo 'selected'; ?>>
                    <?php echo $v->name; ?>
                </option>
                <?php endif;
        endforeach ?>
            </select>
        </div>
    </div>
</div>