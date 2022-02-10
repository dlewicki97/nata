<div class="row no-gutters">
    <div class="col-md-12">
        <div class="row">
            <!-- set -->
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-control-label">Tytuł:</label>
                    <input class="form-control" type="text" name="name" value="<?php echo @$value->name; ?>">
                </div>
            </div>
            <!-- col-4 -->
        </div>
        <!-- set -->
        <div class="row">
            <!-- set -->
            <div class="col-md-12">
                <div class="form-group bd-t-0-force" style="overflow-x: hidden;">
                    <label class="form-control-label">Kategoria główna:</label>
                    <select class="form-control select2-show-search" multiple name="category[]">
                        <?php foreach ($categories as $v) : ?>
                        <option <?php if (is_category_selected($v->id, @$value->id)) {
                                        echo 'selected';
                                    } ?> value="<?= $v->id; ?>"><?= $v->title; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <!-- col-4 -->
        </div>
        <!-- set -->

        <!-- set -->
        <div class="row">
            <!-- set -->
            <div class="col-md-12">
                <div class="form-group bd-t-0-force">
                    <label class="form-control-label">Krótki opis:</label>
                    <textarea class="summernote" name="description"><?php echo @$value->description; ?></textarea>
                </div>
            </div>
            <!-- col-4 -->
        </div>
        <!-- set -->
        <!-- set -->
        <div class="row">
            <!-- set -->
            <div class="col-md-12">
                <div class="form-group bd-t-0-force">
                    <label class="form-control-label">Dodatkowy opis:</label>
                    <textarea class="summernote" name="add_desc"><?php echo @$value->add_desc; ?></textarea>
                </div>
            </div>
            <!-- col-4 -->
        </div>
        <!-- set -->
    </div>
</div>
<!-- row -->