<ul class="products_search list-group" style="overflow-y: auto;height: 200px">
    <?php foreach ($all as $v) : ?>
        <a href="<?= base_url('produkt/' . slug($v->name) . '/' . $v->id); ?>" class="text-dark">
            <li class="list-group-item search_item" data-tags="
			<?= $v->name . ' '; ?>
			<?php foreach (explode(',', $v->tags) as $expV) {
                echo $expV . ' ';
            } ?>">
                <div class="d-flex">
                    <div class="w-25">
                        <img width="auto" style="height: 30px" src="<?= $v->photo_min ?>" alt="<?= $v->name; ?>" class="img-fluid rounded" width="100%">
                    </div>
                    <div class="d-none">
                        <?= $v->name . ' '; ?>
                        <?php foreach (explode(',', $v->tags) as $expV) {
                            echo $expV . ' ';
                        } ?>
                    </div>
                    <div class="w-75 d-flex align-items-center text-center">
                        &nbsp;<strong style="font-size: .8rem"><?= $v->name . ' '; ?></strong>
                    </div>
                </div>
            </li>
        </a>
    <?php endforeach ?>
</ul>