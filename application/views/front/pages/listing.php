<section class="product-listing-container">
    <aside>
        <form id="filters-form" method="POST" action="<?= base_url('filtry') ?>">
            <input id="filters-input" type="hidden" name="filters" value="<?= $_COOKIE['filters'] ?? "" ?>">
            <h5 class="filter-products"><?= $products_desc->filter_title ?></h5>
            <div class="accordion filter-wrapper" id="filters" role="tablist" aria-multiselectable="true">
                <?php foreach ($filters as $i => $filter) : ?>
                    <div id="<?= $filter->id ?>" class="card">
                        <div class="card-header" role="tab" id="heading<?= $i ?>">
                            <a data-toggle="collapse" data-parent="#filters" href="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>">
                                <h5 class="mb-0 d-flex justify-content-between">
                                    <span><?= $filter->title ?></span> <span class="icon">+</span>
                                </h5>
                            </a>
                        </div>
                        <div id="collapse<?= $i ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $i ?>">
                            <div class="card-body">
                                <input type="text" placeholder="<?= $products_desc->filter_input_placeholder ?>" class="header-input">
                                <ul class="filter-list">
                                    <?php foreach ($filter_lists[$filter->id] as $j => $item) : ?>
                                        <li class="pr-2 <?= in_array($item->filter_list_id, explode(',', $_COOKIE['filters'] ?? '')) ? 'active' : '' ?>" style="width: fit-content;" id="<?= $item->filter_list_id ?>">
                                            <?= $item->title ?></li>
                                    <?php endforeach; ?>
                                    <li data-filter-id="<?= $filter->id ?>" data-toggle="modal" data-target="#<?= "allFiltersModal$filter->id" ?>" class="pr-2 show-filters" style="width: fit-content;">Pokaż
                                        wszystkie filtry z grupy: <b><?= $filter->title ?></b></li>
                                </ul>
                            </div>
                            <div class="modal fade all-filters-modal" id="<?= "allFiltersModal$filter->id" ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Filtry: <?= $filter->title ?>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body d-flex align-items-center justify-content-center">
                                            <ul data-filter-id="<?= $filter->id ?>" class="all-filters d-none"></ul>
                                            <div class="loader">
                                                <img class="lazy" data-src="<?= base_url("assets/front/img/listing/filters/loader.svg") ?>" alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" onclick="document.querySelector('#filters-input').value = '';" class="button first-button mt-4 clear-filters">Wyczyść filtry</button>
            <h5 class="filter-products mt-4 mb-3"><?= $products_desc->categories ?></h5>



            <?php foreach ($categories[0] as $i => $main_category) : ?>
            <div class="category-row <?php if ($this->uri->segment(4) == $main_category->id) echo 'active' ?>">
                <a class="category-content d-flex align-items-center"
                    onclick="setCookie('categoryChange', true);setCookie('search', '')"
                    href="<?= base_url($this->uri->segment(4) == $main_category->id ? "sklep" : "sklep/kategoria/$main_category->slug/$main_category->id"); ?>">
                    <img src="<?= base_url('uploads/' . $main_category->photo); ?>" alt="<?= $main_category->alt; ?>"
                        class="category_icon">
                    <?= $main_category->title; ?>
                </a>

                <?php $second_dimension_categories = filter_categories_by_parent_id($categories[1], $main_category->id); ?>
                <?php $show_collapse = show_collapse($main_category->id); ?>

                <?php if (!empty($second_dimension_categories)) : ?>
                <a class="category-collapse-button" data-toggle="collapse" data-target="#category-collapse<?= $i ?>"
                    aria-expanded="false"
                    aria-controls="category-collapse<?= $i ?>"><?= $show_collapse ? '-' : '+' ?></a>
                <?php endif; ?>
            </div>
            <div id="category-collapse<?= $i ?>" class="collapse pl-2 <?= $show_collapse ? "show" : '' ?>">
                <?php foreach ($second_dimension_categories as $j => $subcategory) : ?>
                <?php if ($subcategory->parent_category_id == $main_category->id) : ?>
                <div class="category-row <?php if ($this->uri->segment(4) == $subcategory->id) echo 'active' ?>">
                    <a class="category-content" onclick="setCookie('categoryChange', true);setCookie('search', '')"
                        href="<?= base_url($this->uri->segment(4) == $subcategory->id ? "sklep" : "sklep/kategoria/$subcategory->slug/$subcategory->id"); ?>">

                        <?= $subcategory->title; ?>
                    </a>

                    <?php $second_dimension_categories = filter_categories_by_parent_id($categories[1], $main_category->id); ?>
                    <?php $show_collapse = show_collapse($main_category->id); ?>

                    <?php if (!empty($second_dimension_categories)) : ?>
                        <a class="category-collapse-button" data-toggle="collapse" data-target="#category-collapse<?= $i ?>" aria-expanded="false" aria-controls="category-collapse<?= $i ?>"><?= $show_collapse ? '-' : '+' ?></a>
                    <?php endif; ?>
                </div>
                <div id="category-collapse<?= $i ?>" class="collapse pl-2 <?= $show_collapse ? "show" : '' ?>">
                    <?php foreach ($second_dimension_categories as $j => $subcategory) : ?>
                        <?php if ($subcategory->parent_category_id == $main_category->id) : ?>
                            <div class="category-row <?php if ($this->uri->segment(4) == $subcategory->id) echo 'active' ?>">
                                <a class="category-content" onclick="setCookie('categoryChange', true);setCookie('search', '')" href="<?= base_url($this->uri->segment(4) == $subcategory->id ? "sklep" : "sklep/kategoria/$subcategory->slug/$subcategory->id"); ?>">

                                    <?= remove_subcategory_prefix($subcategory->title); ?>
                                </a>

                                <?php $third_dimension_categories = filter_categories_by_parent_id($categories[2], $subcategory->id); ?>
                                <?php $show_collapse = show_collapse($subcategory->id); ?>

                                <?php if (!empty($third_dimension_categories)) : ?>
                                    <a class="category-collapse-button" data-toggle="collapse" data-target="#subcategory-collapse<?= $j ?>" aria-expanded="false" aria-controls="subcategory-collapse<?= $j ?>"><?= $show_collapse ? '-' : '+' ?></a>
                                <?php endif; ?>
                            </div>
                            <div id="subcategory-collapse<?= $j ?>" class="collapse pl-3 <?= $show_collapse ? "show" : '' ?>">
                                <?php foreach ($third_dimension_categories as $k => $subcategory2) : ?>
                                    <?php if ($subcategory2->parent_category_id == $subcategory->id) : ?>
                                        <div class="category-row <?php if ($this->uri->segment(4) == $subcategory2->id) echo 'active' ?>">
                                            <a class="category-content" onclick="setCookie('categoryChange', true);setCookie('search', '')" href="<?= base_url($this->uri->segment(4) == $subcategory2->id ? "sklep" : "sklep/kategoria/$subcategory2->slug/$subcategory2->id"); ?>">

                                                <?= remove_subcategory_prefix($subcategory2->title); ?>
                                            </a>

                                            <?php $fourth_dimension_categories = filter_categories_by_parent_id($categories[3], $subcategory2->id); ?>
                                            <?php $show_collapse = show_collapse($subcategory2->id); ?>

                                            <?php if (!empty($fourth_dimension_categories)) : ?>
                                                <a class="category-collapse-button" data-toggle="collapse" data-target="#subcategory2-collapse<?= $k ?>" aria-expanded="false" aria-controls="subcategory2-collapse<?= $k ?>"><?= $show_collapse ? '-' : '+' ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <div id="subcategory2-collapse<?= $k ?>" class="collapse pl-4 <?= $show_collapse ? "show" : '' ?>">
                                            <?php foreach ($fourth_dimension_categories as $l => $subcategory3) : ?>
                                                <div class="category-row <?php if ($this->uri->segment(4) == $subcategory3->id) echo 'active' ?>">
                                                    <a class="category-content" onclick="setCookie('categoryChange', true);setCookie('search', '') " href="<?= base_url($this->uri->segment(4) == $subcategory3->id ? "sklep" : "sklep/kategoria/$subcategory3->slug/$subcategory3->id"); ?>">

                                                        <?= remove_subcategory_prefix($subcategory3->title); ?>
                                                    </a>

                                                </div>


                                            <?php endforeach; ?>
                                        </div>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            <?php endforeach ?>



        </form>
    </aside>
    <section id="render-listing" class="product-listing">
        <div class="elements-preloader"><i class="fas fa-spinner fa-pulse"></i></div>
    </section>
</section>