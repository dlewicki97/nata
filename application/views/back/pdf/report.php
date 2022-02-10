<?php $status[0] = 'Wstrzymane';
$status[1] = 'W trakcie realizacji';
$status[2] = 'Anulowane przez administratora';
$status[3] = 'Anulowane przez klienta';
$status[4] = 'Wysłane';
$status[5] = 'Zrealizowane';
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
		<h3>Liczba sprzedanych produktów w okresie od <strong><?= date('d.m.Y', strtotime($start)); ?></strong> do <strong><?= date('d.m.Y', strtotime($end)); ?></strong></h3>
	</div>
	<table id="table">
		<tr>
            <th>Lp</th>
            <th>Data</th>
            <th>Status</th>
            <th>Nazwa produktu</th>
            <th>Ilość</th>
            <th>Cena jedn. netto / brutto</th>
            <th>Wartość netto / brutto</th>
            <th>VAT [%]</th>
            <th>Kwota podatku</th>
            <th>Całościowa wartość brutto</th>
		</tr>
		<?php $i=0; foreach ($report as $v): $i++; ?>
		<tr>
				<td><?= $i; ?>.</td>
				<td><?= date('d.m', strtotime($v->created)) . '<br>' . date('Y', strtotime($v->created)); ?></td>
				<td><?= $status[$v->status]; ?></td>
				<td><?= str_replace('|', '<hr>', $v->name); ?></td>
				<td>
					<?php 
						$ex_qty = explode('|', $v->qty);
						foreach ($ex_qty as $k_ex => $v_ex) {
							echo $v_ex . ' szt.<hr>';
						}
					 ?>
				</td>
				<td>
					<?php 
						$ex_netto = explode('|', $v->price_netto);
						$prod_id = explode('|', $v->product_id);
						$j = 0;
						foreach ($ex_netto as $k_ex => $v_ex) {
							echo $v_ex.'&nbsp;PLN<br>';
							echo $this->back_m->get_one('products', $prod_id[$j])->price_brutto . '&nbsp;PLN' . '<hr>';
							$j++;
						}
					 ?>
				</td>
				<td>
					<?php 
						$ex_qty = explode('|', $v->qty);
						$ex_netto = explode('|', $v->price_netto);
						$prod_id = explode('|', $v->product_id);
						$j = 0;
						foreach ($ex_netto as $k_ex => $v_ex) {
							echo $v_ex * $ex_qty[$k_ex].'&nbsp;PLN<br>';
							echo $this->back_m->get_one('products', $prod_id[$j])->price_brutto * $ex_qty[$k_ex].'&nbsp;PLN<hr>';
							$j++;
						}
					 ?>
				</td>
				<td>
					<?php 
						$ex_vat = explode('|', $v->qty);
						foreach ($ex_vat as $k_ex => $v_ex) {
							echo 23 . '%<hr>';
						}
					 ?>
				</td>
				<td>
					<?php 
						$ex_qty = explode('|', $v->qty);
						$ex_brutto = explode('|', $v->price);
						$ex_netto = explode('|', $v->price_netto);
						$j = 0;
						foreach ($ex_netto as $k_ex => $v_ex) {
							echo ($this->back_m->get_one('products', $prod_id[$j])->price_brutto - $v_ex)*$ex_qty[$k_ex].'&nbsp;PLN<hr>';
							$j++;
						}
					 ?>
				</td>
				<td>
					<?php 
						$ex_qty = explode('|', $v->qty);
						$ex_brutto = explode('|', $v->price);
						foreach ($ex_brutto as $k_ex => $v_ex) {
							echo $v_ex*$ex_qty[$k_ex].'&nbsp;PLN<hr>';;
						}
					 ?>
				</td>
		</tr>
		<?php endforeach ?>
	</table>
</div>