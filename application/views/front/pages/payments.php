<section class="payments">
    <h2 class="page-title"><?= $current_subpage->title ?></h2>

    <ul>
        <?php foreach ($payments as $payment) : ?>
        <li><?= $payment->title ?></li>
        <?php endforeach; ?>
    </ul>
</section>