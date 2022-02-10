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
    <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="wd-5p align-top">L.p.</th>
          <th class="wd-40p align-top">Nazwa produktu</th>
          <th class="wd-40p align-top">Wariant i ilość</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=0; foreach (array_reverse($rows) as $value): $i++; ?>
        <tr>
          <td class="align-middle"><?php echo $i; ?>.</td>
          <td class="align-middle">[<?php echo $value->id; ?>] <?php echo $value->name; ?></td>
          <td class="align-middle">
                    <?php $variants = $this->products_m->get_variants('variants', $value->id);
                    foreach ($variants as $v) {
                      if($v->qty >= $value->low_qty){
                        echo '[' . $v->sku. '] ' . $sku . ': <strong>' . $v->qty . '</strong> szt. <br>';
                      } elseif($v->qty != 0) {
                        echo '<span class="text-warning"> [' . $v->sku . '] '. $sku .': <strong>' . $v->qty . '</strong> szt. <br></span>';
                      } else {
                        echo '<span class="text-danger"> [' . $v->sku . '] '. $sku .': <strong>' . $v->qty . '</strong> szt. <br></span>';
                      }
                      } ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
</div>