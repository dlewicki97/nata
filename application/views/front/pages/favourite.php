<section class="container">
    <span id="refreshTable">
        <?php if (!isset($_COOKIE['favouriteProducts'])) : echo 'Twoja lista ulubionych jest pusta';
      else :
         $countFavourite = count(json_decode($_COOKIE['favouriteProducts']));
         if ($countFavourite <= 0) : echo 'Twoja lista ulubionych jest pusta';
         else : ?>
        <table class="table table-hover table-fixed table-responsive">
            <thead>
                <tr>
                    <th style="width: 10%">Produkt</th>
                    <th style="width: 50%"></th>
                    <th style="width: 30%">Cena</th>
                    <th style="width: 10%"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (json_decode($_COOKIE['favouriteProducts']) as $k => $v) :
                     if (!empty($favourite_product = $this->back_m->get_one('products', $v))) : ?>
                <tr>
                    <td class="align-middle">
                        <a href="<?= base_url('produkt/' . slug($favourite_product->name) . '/' . $v); ?>">
                            <img src="<?= $favourite_product->photo; ?>" class="img-fluid" width="128">
                        </a>
                    </td>
                    <td class="align-middle">
                        <a href="<?= base_url('produkt/' . slug($favourite_product->name) . '/' . $v); ?>">
                            <h5><?= $favourite_product->name; ?></h5>
                        </a>
                    </td>
                    <td class="align-middle">
                        <?= price_text($favourite_product, $favourite_product->price_brutto); ?>
                    </td>
                    <td class="align-middle">
                        <a href="<?= base_url('usun_z_ulubionych/' . $v); ?>" class="button button--primary button-alt"
                            style="font-size: 1.125rem;" title="Usuń ten produkt z koszyka.">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endif;
                  endforeach;
               endif; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </span>
</section>