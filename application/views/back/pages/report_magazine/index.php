    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
        <p class="mg-b-0"><?php echo subtitle(); ?></p>
        <hr>
      </div><!-- d-flex -->
      <div class="br-pagebody mg-t-0 pd-x-30">
        <?php if(isset($_SESSION['flashdata'])): ?>
        <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
        <?php endif; ?>
          <!-- <div class="row mb-3">
              <div class="col-md-12">
                  <div class="form-layout-footer bd pd-20">
                      <a href="<?php echo base_url(); ?>panel/mpdf/report_magazine" class="btn btn-info">Generuj PDF</a>
                      <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Anuluj</button>
                  </div>
              </div>
          </div> -->
          <div class="table-wrapper bg-white p-3 rounded">
            <div class="paging text-right">
              Przejdź na stronę: &nbsp;
              <input class="page_number" type="number" id="page" step="1" value="<?= ceil($this->uri->segment(4)/25)+1; ?>" onchange="getPage(<?= ceil(count($count)/25); ?>)" min="1" max="<?= ceil(count($count)/25); ?>">
              <?php echo $this->pagination->create_links(); ?>
            </div>
            <table class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-40p align-top">Nazwa produktu</th>
                  <th class="wd-40p align-top">Wariant i ilość</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach ($rows as $value): $i++; ?>
                <tr>
                  <td class="align-middle"><a href="<?= base_url('panel/products/form/update/'.$value->id); ?>">[<?php echo $value->id; ?>] <?php echo $value->name; ?></a></td>
                  <td class="align-middle">
                    <?php $variants = $this->products_m->get_variants('variants', $value->id);
                    foreach ($variants as $v) {

                      if($v->qty >= $value->low_qty){
                        echo '[' . $v->sku. '] ' . ': <strong>' . $v->qty . '</strong> szt. <br>';
                      } elseif($v->qty != 0) {
                        echo '<span class="text-warning"> [' . $v->sku . '] ' .': <strong>' . $v->qty . '</strong> szt. <br></span>';
                      } else {
                        echo '<span class="text-danger"> [' . $v->sku . '] '.': <strong>' . $v->qty . '</strong> szt. <br></span>';
                      }
                      } ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div><!-- table-wrapper -->

<script type="text/javascript">
        function getPage(max) {
          page = document.getElementById('page').value;
          if(max < page) { page = max}
            if(page <= 0) { page = 1}
              page = (page - 1) * 10;
            window.location.href = "<?= base_url('panel/'.$this->uri->segment(2).'/index/'); ?>"+page; 
          }
</script>