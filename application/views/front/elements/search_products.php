<div class="form-inline mr-sm-2 mb-3 mb-xl-0" style="position: relative;">
    <input id="inputSearch" class="header-input" data-filter="productsSearch" type="text" placeholder="Szukaj..."
        <?php if ($_COOKIE['search'] ?? null) : ?> value="<?= $_COOKIE['search']; ?>" <?php endif; ?> />
    <div class="magnify-container">
        <?php if ($_COOKIE['search'] ?? null) : ?>
        <a href="<?= base_url('usun-wyszukiwanie'); ?>" style="color: #000;">x</a>
        <?php else : ?>
        <img onclick="searchProducts()" data-src="<?= file_url($icons['magnify-black']->photo) ?>"
            alt="<?= $icons['magnify-black']->alt ?>" class="lazy">
        <?php endif; ?>
    </div>
    <nav id="productsSearch"></nav>
</div>

<script>
function searchProducts() {
    var d = new Date();
    d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = `search=${document.querySelector('#inputSearch').value};${expires};path=/`;
    document.cookie = `filters=${document.querySelector('#inputSearch').value};${expires};path=/`;

    window.location.href = "<?= base_url('sklep') ?>";
}

document.querySelector('#inputSearch').addEventListener('keyup', e => e.key == 'Enter' ? searchProducts() : true)
</script>