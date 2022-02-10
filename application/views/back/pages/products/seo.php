<div class="row">
    <div class="col-md-12">
        <div class="form-group bd-b-0-force">

            <div class="col-md-12 pr-0">
                <div class="form-group bd-b-0-force">
                    <label class="form-control-label">Meta tytuł:</label>
                    <input class="form-control" type="text" name="title_seo" value="<?php echo @$value->title_seo; ?>">
                </div>
            </div>

            <div class="col-md-12 pr-0">
                <div class="form-group">
                    <label class="form-control-label">Meta opis</label>
                    <textarea class="form-control" rows="6" name="description_seo"><?= @$value->description_seo; ?></textarea>
                </div>
            </div>


        </div>
    </div>
</div>