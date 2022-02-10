<nav id="productsSearch">
  <ul class="products_search list-group">
    <?php foreach ($rows as $k_p => $v_p) : ?>
      <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/update/<?php echo $v_p->id; ?>" class="text-dark">
        <li class="list-group-item" data-tags="<?= $v_p->name; ?>">
          <span><?= $v_p->name; ?></span>
          &nbsp;<strong><?php echo '#' . $v_p->id . ' ' . $v_p->name; ?></strong>
        </li>
      </a>
    <?php endforeach ?>
  </ul>
</nav>
<script src="<?php echo base_url(); ?>assets/back/js/scripts/livesearch.js"></script>