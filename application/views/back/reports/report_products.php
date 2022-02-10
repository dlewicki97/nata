<?php 
foreach ($report as $v) {
  $exp = explode('|', $v->product_id);
  foreach ($exp as $v_exp) {
    if(!isset($product[$v_exp])) {
      $product[$v_exp] = 1;
    } else {
      $product[$v_exp] += 1;
    }
  }
}
?>
<style type="text/css">
  .specialbox {
    background-color: #fff;
    border-radius: 3px;
    border: 1px solid #efefef;
    margin-top: 35px;
    box-shadow: 0 0 30px black;
  }
</style>
<div class="table-wrapper container specialbox">
  <div class="form-layout form-layout-2" enctype="multipart/form-data">
    <div class="row no-gutters">
        <div class="col-md-12">
          <div class="text-center py-3">
            <h3>Sprzedane produkty w okresie od <strong><?= date('d.m.Y', strtotime($_GET['date_start'])); ?></strong> do <strong><?= date('d.m.Y', strtotime($_GET['date_end'])); ?></strong></h3>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Lp</th>
                <th>Id produktu</th>
                <th>Nazwa produktu</th>
                <th>Ilość sprzedanych</th>
                <th>Cena jedn. netto</th>
                <th>Wartość netto</th>
                <th>Całościowa wartość brutto</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=0; $sumaQty=0; $sumaPLNBrutto=0; $sumaPLNNetto=0; foreach ($product as $k => $v): $i++; ?>
              <tr>
                  <td class="align-middle"><?= $i; ?>.</td>
                  <td class="align-middle"><?= $k; ?></td>
                  <td class="align-middle"><?= $this->back_m->get_one('products', $k)->name; ?></td>
                  <td class="align-middle">
                    <?= $v; ?> szt.
                    <?php $sumaQty += $v; ?>
                  </td>
                  <td class="align-middle"><?= number_format($this->back_m->get_one('products', $k)->price_netto,2); ?> PLN</td>
                  <td class="align-middle">
                    <?= number_format($this->back_m->get_one('products', $k)->price_netto * $v,2); ?> PLN
                    <?php $sumaPLNNetto += $this->back_m->get_one('products', $k)->price_netto * $v; ?>
                  </td>
                  <td class="align-middle">
                    <?= number_format($this->back_m->get_one('products', $k)->price_brutto * $v,2); ?> PLN
                    <?php $sumaPLNBrutto += $this->back_m->get_one('products', $k)->price_brutto * $v; ?>
                  </td>
              </tr>
              <?php endforeach ?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td class="text-right">Razem:</td>
                <td><?= $sumaQty; ?> szt.</td>
                <td></td>
                <td><?= number_format($sumaPLNNetto,2); ?> PLN</td>
                <td><?= number_format($sumaPLNBrutto,2); ?> PLN</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div><!-- row -->
  </div><!-- form-layout -->
</div><!-- table-wrapper -->