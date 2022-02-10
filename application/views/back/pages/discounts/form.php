    <div class="br-mainpanel">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
        <p class="mg-b-0"><?php echo subtitle(); ?></p>
        <hr>
      </div>

      <div class="br-pagebody mg-t-0 pd-x-30">
        <?php if(isset($_SESSION['flashdata'])): ?>
        <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
        <?php endif; ?>

          <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2); ?>/<?php echo @$value->id; ?>" method="post"  enctype="multipart/form-data">

            <div class="row no-gutters">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            <div class="form-group">
                                <label class="form-control-label">Tytuł: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="title" value="<?php echo @$value->title; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 pr-0">
                            <div class="form-group bd-t-0-force">
                            <label class="form-control-label">Wybierz typ rabatu</label>
                            <select class="form-control select2" data-placeholder="Wybierz typ rabatu" name="type" required>
                                <option value="0" <?php if(@$value->type == '0') { echo 'selected'; } ?>>Rabat procentowy</option>
                                <option value="1" <?php if(@$value->type == '1') { echo 'selected'; } ?>>Rabat w postaci kwoty</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-md-12 pr-0">
                            <div class="form-group bd-t-0-force">
                                <label class="form-control-label">Wartość rabatu: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="value" value="<?php echo @$value->value; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 pr-0">
                            <div class="form-group bd-t-0-force bd-b-0-force">
                                <label class="form-control-label">Kod: 
                                    <small style="cursor: pointer" onclick="document.getElementById('codeDiscount').value = generateCodeDiscount();">
                                        (KLIKNIJ ABY WYGENEROWAĆ)
                                    </small>
                                    <span class="tx-danger">*</span>
                                </label>
                                <input id="codeDiscount" class="form-control" type="text" name="discount_code" value="<?php echo @$value->discount_code; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row"> <!-- set -->
                        <div class="col-md-6 pr-0">
                            <div class="form-group">
                                <label class="form-control-label">Data ważności od: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="date" name="code_start" value="<?php echo @$value->code_start; ?>" required>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-md-6 px-0">
                            <div class="form-group bd-l-0-force">
                                <label class="form-control-label">Data ważności do: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="date" name="code_end" value="<?php echo @$value->code_end; ?>" required>
                            </div>
                        </div><!-- col-4 -->
                    </div> <!-- set -->
                    <div class="row">
                        <div class="col-md-12 pr-0">
                            <div class="form-layout-footer bd pd-20 bd-t-0-force">
                                <button class="btn btn-info" type="submit">Zapisz</button>
                                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Anuluj</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </form>