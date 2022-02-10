    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5"><?= $footer->title ?> - Lista</h4>
            <p class="mg-b-0"><?php echo subtitle(); ?></p>
            <hr>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-0 pd-x-30">
            <?php if (isset($_SESSION['flashdata'])) : ?>
            <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
            <?php endif; ?>

            <form class="form-layout form-layout-2"
                action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2); ?>/<?php echo $footer->id . '/' . @$value->id; ?>"
                method="post" enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-12 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Tytuł: </label>
                                    <input class="form-control" type="text" name="title"
                                        value="<?php echo @$value->title; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Link: </label>
                                    <input class="form-control" type="text" name="link"
                                        value="<?php echo @$value->link; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="ckbox">
                                        <input type="checkbox" name="bold" <?php if (@$value->bold) echo "checked" ?>>
                                        <span><strong>Wytłuszczony tekst?</strong></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="ckbox">
                                        <input type="checkbox" name="blank" <?php if (@$value->blank) echo "checked" ?>>
                                        <span><strong>Otworzyć w nowej karcie?</strong></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Ikona (opcjonalnie): </label>
                                    <textarea class="form-control" name="icon" rows="10"><?= @$value->icon ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label mg-b-0-force">Blok footera: <span
                                            class="tx-danger">*</span></label>
                                    <select id="select2-a" class="form-control select2-show-search" name="footer_id"
                                        data-placeholder="Wybierz blok" required>
                                        <?php foreach ($footer_items as $item) : ?>
                                        <option value="<?= $item->id ?>"
                                            <?php if (isSelected($footer->id, $item->id, @$value)) echo 'selected'; ?>>
                                            <?= $item->title ?>
                                        </option>
                                        <?php endforeach; ?>

                                    </select>
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