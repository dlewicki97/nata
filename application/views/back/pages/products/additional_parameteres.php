<div class="row additional-attributes">
    <div class="col-md-12">
        <div class="form-group bd-b-0-force">
            <div class="col-md-12">
                <div id="producer" class="form-group filter bd-b-0-force" style="overflow-x: hidden;">
                    <label class="form-control-label">Producent: <a href="<?= base_url('panel/filter_lists/list/1') ?>">
                            Dodaj nowego producenta</a></label>
                    <!-- <input class="form-control" list="producers-list" value="<?= @$producer->filter_list_id ?>"
                        type="text">
                    <datalist id="producers-list">
                        <?php foreach ($producers as $prod) : ?>
                        <option <?php if (is_filter_list_selected($prod->id, $value->id)) echo 'selected'; ?>
                            value="<?= $prod->id; ?>"><?= $prod->title; ?></option>
                        <?php endforeach; ?>
                    </datalist>
                    <input type="hidden" id="producer-input" value="<?= @$producer->filter_list_id ?>" name="producer"> -->

                    <select id="producer-input" class="form-control select2-show-search " multiple name="filter_list[]">
                        <?php foreach ($producers as $prod) : ?>
                        <option <?php if (is_filter_list_selected($prod->id, $value->id)) echo 'selected'; ?>
                            value="<?= $prod->id; ?>"><?= $prod->title; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
            <div class="col-md-12">
                <div id="color" class="form-group filter bd-b-0-force" style="overflow-x: hidden;">
                    <label class="form-control-label">Kolory: <a href="<?= base_url('panel/filter_lists/list/6') ?>">
                            Dodaj nowy kolor</a></label>
                    <select class="form-control select2-show-search " multiple name="filter_list[]">
                        <?php foreach ($colors as $color) : ?>
                        <option <?php if (is_filter_list_selected($color->id, $value->id)) echo 'selected'; ?>
                            value="<?= $color->id; ?>"><?= $color->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>


            <div class="col-md-12">
                <div id="size" class="form-group filter bd-b-0-force" style="overflow-x: hidden;">
                    <label class="form-control-label">Rozmiary: <a href="<?= base_url('panel/filter_lists/list/8') ?>">
                            Dodaj nowe rozmiary</a></label>
                    <select class="form-control select2-show-search " multiple name="filter_list[]">
                        <?php foreach ($sizes as $size) : ?>
                        <option <?php if (is_filter_list_selected($size->id, $value->id)) echo 'selected'; ?>
                            value="<?= $size->id; ?>"><?= $size->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div id="standard" class="form-group filter" style="overflow-x: hidden;">
                    <label class="form-control-label">Normy: <a href="<?= base_url('panel/filter_lists/list/5') ?>">
                            Dodaj nowe normy</a></label>
                    <select class="form-control select2-show-search " multiple name="filter_list[]">
                        <?php foreach ($standards as $standard) : ?>
                        <option <?php if (is_filter_list_selected($standard->id, $value->id)) echo 'selected'; ?>
                            value="<?= $standard->id; ?>"><?= $standard->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div id="industry" class="form-group bd-t-0-force filter" style="overflow-x: hidden;">
                    <label class="form-control-label">Branże: <a href="<?= base_url('panel/filter_lists/list/9') ?>">
                            Dodaj nowe branże</a></label>
                    <select class="form-control select2-show-search " multiple name="filter_list[]">
                        <?php foreach ($industries as $industry) : ?>
                        <option <?php if (is_filter_list_selected($industry->id, $value->id)) echo 'selected'; ?>
                            value="<?= $industry->id; ?>"><?= $industry->title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </div>
    </div>
</div>