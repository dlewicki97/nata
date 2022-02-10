<div id="refreshOpinions">
    <div class="d-flex flex-wrap">
        <div class="col-12 col-md-6 d-flex align-items-center flex-wrap">
            <div
                class="d-flex flex-wrap align-items-center w-100 w-lg-unset justify-content-between justify-content-md-start">
                <div class="actual-rating">
                    <div class="number"><?= number_format($avg_grade, 2); ?>/5</div>
                    <div class="stars">
                        <?php for ($i = 1; $i <= round($avg_grade); $i++) : ?>
                        <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                            class="lazy star ">
                        <?php endfor; ?>
                    </div>
                    <div class="opinions-counter">
                        <?= str_replace('{ilosc}', $num_grades, $products_desc->opinions_amount) ?></div>
                </div>
                <div class="rating-stats">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stars">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                            </div>
                            <div class="track">
                                <?php if ($grade_5 > 0) : ?>
                                <div class="line" style="width: 100%"></div>
                                <?php else :  ?>
                                <div class="line" style="width: 0%"></div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="each-opinion-counter"><?= $grade_5 ?></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stars">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star ">
                            </div>
                            <div class="track">
                                <?php if ($grade_4 > 0) : ?>
                                <div class="line" style="width: 100%"></div>
                                <?php else :  ?>
                                <div class="line" style="width: 0%"></div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="each-opinion-counter"><?= $grade_4 ?></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stars">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star ">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star ">
                            </div>
                            <div class="track">
                                <?php if ($grade_3 > 0) : ?>
                                <div class="line" style="width: 100%"></div>
                                <?php else :  ?>
                                <div class="line" style="width: 0%"></div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="each-opinion-counter"><?= $grade_3 ?></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stars">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star">
                            </div>
                            <div class="track">
                                <?php if ($grade_2 > 0) : ?>
                                <div class="line" style="width: 100%"></div>
                                <?php else :  ?>
                                <div class="line" style="width: 0%"></div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="each-opinion-counter"><?= $grade_2 ?></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stars">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star">
                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                    class="lazy star">
                            </div>
                            <div class="track">
                                <?php if ($grade_1 > 0) : ?>
                                <div class="line" style="width: 100%"></div>
                                <?php else :  ?>
                                <div class="line" style="width: 0%"></div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="each-opinion-counter"><?= $grade_1 ?></div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($_SESSION['id'] ?? null) :
            if (!$user_opinions) :
        ?>
        <div class="col-12 col-md-6 add-opinion-col">
            <div class="add-opinion-container">
                <div>
                    <h5><?= $products_desc->got_this_product ?></h5>
                    <div class="text-black"><?= $products_desc->help_others ?></div>
                </div>
                <div class="d-flex flex-column align-items-md-center align-items-start add-opinion-content">
                    <div class="stars outer-stars mb-2">
                        <img data-src="<?= assets(); ?>img/single-product/rating/star-grey.svg" alt=""
                            class="lazy star ">
                        <img data-src="<?= assets(); ?>img/single-product/rating/star-grey.svg" alt=""
                            class="lazy star ">
                        <img data-src="<?= assets(); ?>img/single-product/rating/star-grey.svg" alt=""
                            class="lazy star ">
                        <img data-src="<?= assets(); ?>img/single-product/rating/star-grey.svg" alt=""
                            class="lazy star ">
                        <img data-src="<?= assets(); ?>img/single-product/rating/star-grey.svg" alt=""
                            class="lazy star ">
                    </div>
                    <button class="button first-button" data-toggle="modal"
                        data-target="#add-opinion-modal"><?= $products_desc->add_opinion_button_name ?></button>
                    <div class="modal fade" id="add-opinion-modal" tabindex="-1" role="dialog"
                        aria-labelledby="add-opinion-label" aria-hidden="true">
                        <div class="modal-dialog modal-bottom" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="d-flex align-items-center justify-content-center mb-4">
                                        <h3 class="section-title"><?= $products_desc->opinion_modal_title ?></h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <img class="lazy modal-main-photo" data-src="<?= $product->photo; ?>">
                                        <div class="d-flex justify-content-center flex-column">
                                            <h4 class="product-cat">
                                                <?php foreach ($categories as $i => $category) echo $category->title . ($i == count($categories) - 1 ? '' : ', '); ?>
                                            </h4>
                                            <h3 class="product-name"><?= $product->name; ?></h3>
                                        </div>
                                        <form method="post" action="<?= base_url('wyslij_opinie'); ?>"
                                            class="modal-form w-100">
                                            <div id="validationGrd"></div>
                                            <div class="stars modal-stars">
                                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg"
                                                    alt="" class="lazy star">
                                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg"
                                                    alt="" class="lazy star">
                                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg"
                                                    alt="" class="lazy star">
                                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg"
                                                    alt="" class="lazy star">
                                                <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg"
                                                    alt="" class="lazy star">
                                            </div>
                                            <input type="hidden" name="product_id" value="<?= $product->id; ?>">
                                            <input id="stars-value" type="hidden" value="0" name="grade">
                                            <textarea placeholder="<?= $products_desc->opinion_placeholder ?>"
                                                class="modal-input" rows="4" type="text" name="message"></textarea>
                                            <div class="d-flex justify-content-center">
                                                <?php
                                                        if ($_SESSION['id'] ?? null) {
                                                            $user_id = $_SESSION['id'];
                                                            $user_name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
                                                        } ?>
                                                <button type="submit" class="button first-button">
                                                    <?= $products_desc->opinion_send_button_name ?>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;
        endif; ?>
        <div class="col-12 mt-5">
            <h5 class="desc-title"><?= $products_desc->users_opinions ?></h5>
            <div class="users-opinions">
                <?php foreach ($product_opinions as $product_opinion) : if ($product_opinion->active == 1) : ?>
                <div class="opinion">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="name"><?= $product_opinion->name ?></div>
                        <div class="stars">
                            <?php for ($i = 1; $i <= $product_opinion->grade; $i++) : ?>
                            <img data-src="<?= assets(); ?>img/single-product/rating/star-filled.svg" alt=""
                                class="lazy star ">
                            <?php endfor ?>
                            <?php for ($i = 1; $i <= (5 - $product_opinion->grade); $i++) : ?>
                            <img data-src="<?= assets(); ?>img/single-product/rating/star-outline.svg" alt=""
                                class="lazy star ">
                            <?php endfor ?>
                        </div>
                        <div class="date"><?= date("d.m.Y", strtotime($product_opinion->created)) ?></div>
                    </div>
                    <div class="description"><?= $product_opinion->message ?></div>
                </div>
                <?php endif;
                endforeach ?>

            </div>
        </div>
    </div>
</div>