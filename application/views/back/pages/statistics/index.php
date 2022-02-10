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

<?php 
$pln = 0;
foreach ($trans as $value) {
  	$pln += $value->suma;
}
?>
<div class="container">

  <div class="row">
    <form method="post" action="" class="form-group bd-l-0-force w-50">
      <label class="form-control-label">Wybierz miesiąc</label>
      <select name="date" class="form-control select2" style="width: 100%;" onchange="this.form.submit()">
        <option value="" selected disabled>Wybierz miesiąc</option>
        <option value="">Wszystkie miesiące</option>
          <?php foreach ($months as $v): ?>
              <option value="<?php echo $v->year . '-'; if($v->month < 10){echo '0'.$v->month;}else{echo $v->month;} ?>" 
                <?php if(isset($_SESSION['date']) && ($_SESSION['date'] == $v->year . '-' . $v->month || $_SESSION['date'] == $v->year . '-0' . $v->month)){echo 'selected';} ?>>
                  <?= $v->month . '/' . $v->year; ?>
              </option>
          <?php endforeach; ?>
      </select>
    </form>
  </div>
  <div class="row">
    <div class="col-3">
      <p>Kwota przychodów w PLN</p>
      <h5><?= str_replace(',', ' ', number_format($pln,2)); ?> PLN</h5><br>
    </div>
    <div class="col-9">
      <div id="morrisDonut1" class="ht-200 ht-sm-250 text-left"></div>
    </div>
  </div>

  <div class="row my-5">
    <div class="col-xl-12">
      <div class="bd pd-t-30 pd-b-20 pd-x-20"><canvas id="chartArea1" height="130"></canvas></div>
    </div><!-- col-6 -->
  </div>

  <div class="row">
    <table class="table table-hover" style="background-color: #fff; padding: 10px; border-radius: 3px;">
      <thead>
        <th>Lp.</th>
        <th>Zamawiający</th>
        <th>Liczba zamówień</th>
        <th>Łączna kwota zamówień</th>
      </thead>
      <tbody>
        <?php $i=0; foreach ($unique_usr as $value): $i++; ?>
        <tr>
          <td class="align-middle"><?= $i; ?></td>
          <td class="align-middle">
            <?= $this->statistics_m->get_by_email_one('transaction', $value->email)->first_name . '<br>' . $value->email; ?>
          </td>
          <td class="align-middle"><?= count($this->statistics_m->get_by_email('transaction', $value->email)); ?></td>
          <td class="align-middle">
            <?php $pln_amount = 0;
            $pln_orders = $this->statistics_m->get_amount('transaction', $value->email);
            foreach ($pln_orders as $v) {
                $pln_amount += $v->suma;
            }
            echo str_replace(',', ' ', number_format($pln_amount,2)); ?> PLN<br>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php 
foreach ($months as $v) {
  $pln_month[$v->month.$v->year] = 0;
}
$max_amount = 0;
foreach ($char as $value) {
  foreach ($months as $v) {
    if(date('m', strtotime($value->created)) == $v->month) {

        $pln_month[$v->month.$v->year] += $value->suma;
        if($pln_month[$v->month.$v->year] > $max_amount) {
          $max_amount = $pln_month[$v->month.$v->year];
        }
      
    }
  }
}
?>

<script type="text/javascript">
  setTimeout(function(){

  var ctx6 = document.getElementById('chartArea1');
  new Chart(ctx6, {
    type: 'line',
    data: {
      labels: [<?php foreach ($months as $v) { echo '"' . $v->month . '/' . $v->year . '",'; } ?>],
      datasets: [{
        data: [<?php foreach ($months as $v) { echo '"' . $pln_month[$v->month.$v->year] . '",'; } ?>],
        backgroundColor: '#3D449C',
        borderWidth: 1,
        fill: true
      }]
    },
    options: {
      legend: {
        display: false,
          labels: {
            display: false
          }
      },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true,
            fontSize: 10,
            max: <?= $max_amount; ?>
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero:true,
            fontSize: 11
          }
        }]
      }
    }
  });

    new Morris.Donut({
      element: 'morrisDonut1',
      data: [
        {label: "PLN", value: "<?= $pln; ?>"}
      ],
      colors: ['#3D449C'],
      resize: true
    });
  }, 3000);
</script>