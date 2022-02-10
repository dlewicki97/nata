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
        <div id="jsAlert" class="text-danger font-weight-bold"></div>
          <div class="table-wrapper">
            <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/mpdf/report_products" method="post"  enctype="multipart/form-data">
              <div class="row no-gutters">
                  <div class="col-md-12">
                      <div class="row"> <!-- set -->
                          <div class="col-md-6 pr-0">
                              <div class="form-group">
                                  <label class="form-control-label">Data początkowa: <span class="tx-danger">*</span></label>
                                  <input id="date_start" class="form-control" type="date" name="date_start" required>
                              </div>
                          </div><!-- col-4 -->
                          <div class="col-md-6 px-0">
                              <div class="form-group bd-l-0-force">
                                  <label class="form-control-label">Data końcowa: <span class="tx-danger">*</span></label>
                                  <input id="date_end" class="form-control" type="date" name="date_end" required>
                              </div>
                          </div><!-- col-4 -->
                      </div> <!-- set -->
                      <div class="row">
                          <div class="col-md-12 pr-0">
                              <div class="form-layout-footer bd-t-0-force bd pd-20">
                                  <button class="btn btn-info" type="submit">Generuj PDF</button>
                                  <button class="btn btn-secondary" type="button" onclick="renderReport();">Pokaż</button>
                                  <button class="btn btn-info" onclick="window.history.go(-1); return false;">Anuluj</button>
                              </div><!-- form-group -->
                          </div>
                      </div>
                  </div>
              </div><!-- row -->
            </form><!-- form-layout -->
          </div><!-- table-wrapper -->
          <div id="loadReport"></div>


<script type="text/javascript">
function renderReport() {
  document.getElementById('jsAlert').innerHTML = '';
  date_start = document.getElementById('date_start').value;
  date_end = document.getElementById('date_end').value;
  if(date_start == '' || date_end == '') {
    document.getElementById('jsAlert').innerHTML = 'Wybierz datę początkowa i końcową';
  } else {
    document.getElementById('jsAlert').innerHTML = '';
    $("#loadReport").load('<?= base_url(); ?>panel/report_products/render?date_start='+date_start+'&date_end='+date_end); 
  }
}
</script>
