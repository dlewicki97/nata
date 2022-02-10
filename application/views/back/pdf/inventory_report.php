<?php
ini_set('date.timezone', 'Europe/London');
$now = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>Raport stanu magazynowego z dnia - <?= $now ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,900&display=swap" rel="stylesheet">

<body>

    <h3>Raport stanu magazynowego z dnia - <?= $now ?></h3>

    <div class="mt-10">

        <table class="minimalistBlack">
            <thead>
                <tr>
                    <th class="w-1">ID</th>
                    <th style="padding-left: .5rem">Nazwa produktu</th>
                    <th style="text-align: right;">Stan magazynowy</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 0;
                foreach ($rows as $value) : $i++;
                    $data['inventory'] = $this->db->query("SELECT * FROM variants where product_id=$value->id")->unbuffered_row();
                ?>
                <tr class="text-center">
                    <td class="w-1"><?= $value->id ?></td>
                    <td style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap; padding-left: 2rem">
                        <?php echo $value->name; ?></td>
                    <td style="text-align: right;"><?php echo $data['inventory']->qty; ?></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
            </tr>
        </table>

    </div>