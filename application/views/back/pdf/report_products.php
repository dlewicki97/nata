<?php $status[0] = 'Wstrzymane';
$status[1] = 'W trakcie realizacji';
$status[2] = 'Anulowane przez administratora';
$status[3] = 'Anulowane przez klienta';
$status[4] = 'Wysłane';
$status[5] = 'Zrealizowane';
?>

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
	.header_logo {
		text-align: center;
		background-color: #225d93;
		padding: 30px;
		color: white;
	}
	.text_center {
		text-align: center;
	}
	.body_table {
		margin-top: 30px;
	}
	table {
		width: 100%;
		border-spacing: 0;
	}
	td, th {
		border: 1px solid black;
	}
</style>
<div class="header_logo">
	<h1><?= $contact->company; ?></h1>
	<img src="<?= base_url('uploads/'.$settings->logo); ?>">
</div>
<div class="body_table">
	<div class="text_center">
		<h3>Sprzedane produkty w okresie od <strong><?= date('d.m.Y', strtotime($start)); ?></strong> do <strong><?= date('d.m.Y', strtotime($end)); ?></strong></h3>
	</div>
	<table id="table">
		<tr>
            <th>Lp</th>
            <th>Id produktu</th>
            <th>Nazwa produktu</th>
            <th>Ilość sprzedanych</th>
            <th>Cena jedn. netto</th>
            <th>Wartość netto</th>
            <th>Całościowa wartość brutto</th>
		</tr>
		<?php $i=0; $sumaQty=0; $sumaPLNBrutto=0; $sumaPLNNetto=0; foreach ($product as $k => $v): $i++; ?>
		<tr>
				<td><?= $i; ?>.</td>
				<th><?= $k; ?></th>
				<td><?= $this->back_m->get_one('products', $k)->name; ?></td>
				<th>
					<?= $v; ?> szt.
                    <?php $sumaQty += $v; ?>
                </th>
				<td><?= number_format($this->back_m->get_one('products', $k)->price_netto,2); ?> PLN</td>
				<td>
					<?= number_format($this->back_m->get_one('products', $k)->price_netto * $v,2); ?> PLN
                    <?php $sumaPLNNetto += $this->back_m->get_one('products', $k)->price_netto * $v; ?>
				</td>
				<td>
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
          <td><?= number_format($sumaPLNNetto,2); ?>&nbsp;PLN</td>
          <td><?= number_format($sumaPLNBrutto,2); ?>&nbsp;PLN</td>
        </tr>
	</table>
</div>