<section class="my-orders">
    <h2 class="page-title"><?= $current_subpage->title ?></h2>

    <div class="col-12">

        <table>
            <thead>
                <tr>
                    <td><?= $my_orders_desc->date ?></td>
                    <td><?= $my_orders_desc->client_data ?></td>
                    <td><?= $my_orders_desc->products ?></td>
                    <td><?= $my_orders_desc->status ?></td>
                    <td><?= $my_orders_desc->shipping ?></td>
                    <td><?= $my_orders_desc->sum ?></td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?= $transaction->created ?></td>
                    <td><?= "$transaction->first_name $transaction->last_name<br>$transaction->street $transaction->housenumber/$transaction->flatnumber $transaction->city $transaction->zipcode<br>$transaction->phone<br>$transaction->email" ?>
                    </td>
                    <td>
                        <?php $names = explode('|', $transaction->name);
                            $quantitites = explode('|', $transaction->qty);
                            $prices = explode('|', $transaction->price);
                            $barcodes = explode('|', $transaction->barcode);
                            $ids = explode('|', $transaction->product_id); ?>
                        <?php for ($i = 0; $i < count($names); $i++) : ?>
                        <?= "<span class=\"bold\">{$quantitites[$i]}szt.</span> <a href=\"", base_url("produkt/" . slug($names[$i]) . "/{$ids[$i]}"), "\">{$names[$i]}</a> <span class=\"bold ml-2\">Cena:</span> ", number_format($prices[$i], 2, '.', ','), "zł" ?>
                        <br>
                        <?php endfor; ?>
                    </td>
                    <?php $status = getTransactionStatus($transaction->status); ?>
                    <td class="<?= $status['color'] ?>"><?= $status['message'] ?></td>
                    <td><?= getTransactionDelivery($transaction->delivery) ?>
                        (<?= number_format((float)$transaction->delivery_cost, 2, '.', ',') ?> zł)</td>
                    <td>
                        <?= number_format($transaction->suma, 2, '.', ',') ?> zł
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</section>