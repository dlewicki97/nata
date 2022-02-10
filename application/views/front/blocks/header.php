  <header>

      <nav class="navbar navbar-expand-xl navbar-light">

          <a class="navbar-brand logo-bg" href="<?= base() ?>"><img class="lazy logo"
                  data-src="<?= file_url($settings->logo) ?>" alt="" /></a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mb-3 mb-xl-0 pl-0 pl-lg-0 mr-auto">
                  <?php foreach ($subpages as $subpage) : ?>
                  <?php if ($subpage->link == 'uslugi') : ?>
                  <li class="nav-item dropdown <?php if ($subpage->link == $this->uri->segment(1)) echo 'active' ?>">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false"><?= $subpage->title ?></a>
                      <div class="dropdown-menu dropdown-primary" aria-labelledby="production-dropdown">
                          <?php foreach ($services as $service) : ?>
                          <a class="dropdown-item"
                              href="<?= base("uslugi/$service->id/" . slug($service->title)) ?>"><?= $service->title ?></a>
                          <?php endforeach; ?>
                          <style>
                          .handmade-dropdown.show .dropdown-menu {
                              display: block;
                          }

                          @media(max-width: 1200px) {
                              .dropdown-menu {
                                  width: 100%;

                              }
                          }
                          </style>
                          <div
                              class="dropdown handmade-dropdown <?php if ($subpage->link == $this->uri->segment(1)) echo 'active' ?>">
                              <a class="dropdown-toggle dropdown-item " data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">Produkcja własna</a>

                              <div class="dropdown-menu dropdown-primary pl-3" aria-labelledby="production-dropdown">
                                  <?php foreach ($header_handmades as $header_handmade) : ?>
                                  <a class="dropdown-item"
                                      href="<?= base("produkcja-wlasna/$header_handmade->id/" . slug($header_handmade->title)) ?>"><?= $header_handmade->title ?></a>
                                  <?php endforeach; ?>
                              </div>
                          </div>

                          <script>
                          let handmadeDropdown = document.querySelector('.handmade-dropdown');
                          handmadeDropdown.addEventListener('click', () => {
                              handmadeDropdown.classList.toggle('show');
                          })
                          </script>
                      </div>
                  </li>

                  <?php elseif ($subpage->link == 'produkcja-wlasna') : continue;  ?>
                  <?php elseif ($subpage->link == 'nata') : ?>
                  <li class="nav-item dropdown <?php if ($subpage->link == $this->uri->segment(1)) echo 'active' ?>">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false"><?= $subpage->title ?></a>
                      <div class="dropdown-menu dropdown-primary" aria-labelledby="production-dropdown">
                          <?php foreach (array_filter($subpage_lists, function ($item) {
                                        return $item->subpage_id == 25;
                                    }) as $list_item) : ?>
                          <a class="dropdown-item" href="<?= base($list_item->link) ?>"><?= $list_item->title ?></a>
                          <?php endforeach; ?>
                      </div>
                  </li>
                  <?php else : ?>

                  <li class="nav-item <?php if ($subpage->link == $this->uri->segment(1)) echo 'active' ?>">
                      <a class="nav-link" href="<?= base($subpage->link) ?>"><?= $subpage->title ?></a>
                  </li>
                  <?php endif; ?>
                  <?php endforeach; ?>
                  <script>
                  let dropdownMenus = document.querySelectorAll('.dropdown-menu');
                  for (let i = 0; i < dropdownMenus.length; i++) {
                      dropdownMenus[0].addEventListener('click', e => {
                          e.stopPropagation();
                      })
                  }
                  </script>
                  <li class="nav-item">
                      <a class="nav-link" style="background-color: unset !important" href="<?= $settings->fb_link ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="18px" viewBox="0 0 25 25">
                              <g>
                                  <g>
                                      <path fill="#383d47"
                                          d="M24.64 12.574c0-6.806-5.514-12.32-12.32-12.32S0 5.768 0 12.574c0 6.15 4.505 11.247 10.395 12.172v-8.61h-3.13v-3.562h3.13V9.86c0-3.088 1.838-4.793 4.654-4.793 1.348 0 2.758.24 2.758.24v3.03h-1.554c-1.53 0-2.008.95-2.008 1.925v2.312h3.417l-.546 3.562h-2.87v8.61c5.89-.925 10.395-6.022 10.395-12.172z">
                                      </path>
                                  </g>
                              </g>
                          </svg></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" style="background-color: unset !important" href="<?= $settings->inst_link ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" width="27" height="18px" viewBox="0 0 27 24">
                              <g>
                                  <g>
                                      <g>
                                          <path fill="#383d47"
                                              d="M.467 12c0-6.627 5.82-12 13-12s13 5.373 13 12-5.82 12-13 12-13-5.373-13-12z">
                                          </path>
                                      </g>
                                      <g>
                                          <path class="ig-contour" fill="#fff"
                                              d="M16.336 7.835a.78.78 0 1 0 0 1.562.78.78 0 0 0 0-1.562zm-3.472 6.42a2.167 2.167 0 1 1-.002-4.335 2.167 2.167 0 0 1 .002 4.334zm0-5.508a3.34 3.34 0 1 0 0 6.679 3.34 3.34 0 0 0 0-6.68zm0-1.994c1.736 0 1.943.009 2.628.039.634.03.979.135 1.207.225.305.117.52.258.75.485.226.228.367.444.485.749.089.228.195.573.224 1.207.03.686.038.892.038 2.628 0 1.737-.008 1.943-.04 2.629-.033.634-.14.978-.229 1.207-.12.305-.26.52-.487.749a2.03 2.03 0 0 1-.748.486c-.227.089-.577.195-1.211.223-.69.031-.894.038-2.634.038-1.74 0-1.943-.008-2.633-.04-.635-.033-.984-.138-1.212-.228a2.014 2.014 0 0 1-.747-.487 1.975 1.975 0 0 1-.488-.748c-.09-.228-.195-.577-.228-1.211-.024-.683-.033-.894-.033-2.626 0-1.732.009-1.943.033-2.634.033-.635.138-.984.228-1.211.114-.31.26-.52.488-.749.227-.227.439-.373.747-.486.228-.09.57-.196 1.204-.229.69-.024.894-.032 2.633-.032l.025.016zm0-1.17c-1.767 0-1.988.008-2.682.039-.692.032-1.164.141-1.578.302-.428.166-.791.389-1.153.75a3.173 3.173 0 0 0-.75 1.152c-.16.415-.27.886-.302 1.58-.033.693-.04.913-.04 2.68 0 1.767.009 1.988.04 2.682.032.692.141 1.164.302 1.578.166.427.389.791.75 1.153a3.18 3.18 0 0 0 1.153.75c.415.16.886.27 1.578.302.694.033.915.04 2.682.04s1.987-.009 2.68-.04c.693-.032 1.165-.142 1.58-.302.427-.166.79-.39 1.152-.75.36-.362.585-.724.75-1.153.16-.414.27-.886.302-1.578.033-.694.04-.915.04-2.682s-.009-1.987-.04-2.68c-.032-.693-.142-1.166-.302-1.58a3.192 3.192 0 0 0-.75-1.152 3.169 3.169 0 0 0-1.152-.75c-.415-.161-.887-.27-1.58-.302-.693-.033-.913-.04-2.68-.04z">
                                          </path>
                                      </g>
                                  </g>
                              </g>
                          </svg></a>
                  </li>
              </ul>

              <?php $this->load->view('front/elements/search_products'); ?>

              <div class="header-icons mb-3 mb-xl-0">
                  <a href="<?= base_url('ulubione'); ?>">
                      <div class="header-icon-container">
                          <?php if (isset($_COOKIE['favouriteProducts']) && count(json_decode($_COOKIE['favouriteProducts'])) > 0) : ?>
                          <div class="notifications"><?= count(json_decode($_COOKIE['favouriteProducts'])); ?></div>
                          <?php endif; ?>
                          <img data-src="<?= file_url($icons['heart-outline-black']->photo) ?>"
                              alt="<?= $icons['heart-outline-black']->alt ?>" class="lazy" />
                      </div>
                  </a>
                  <a href="<?= base_url(); ?>koszyk">
                      <div class="header-icon-container">
                          <?php if (count($this->cart->contents()) > 0) : ?>
                          <div class="notifications"><?= count($this->cart->contents()); ?></div>
                          <?php endif; ?>
                          <img data-src="<?= file_url($icons['cart-black']->photo) ?>"
                              alt="<?= $icons['cart-black']->alt ?>" class="lazy" />
                      </div>
                  </a>
              </div>
              <?php if (!$this->session->userdata('client')) : ?>
              <a href="<?= base_url('logowanie') ?>">
                  <button class="button first-button">Zaloguj się</button>
              </a>
              <?php else : ?>
              <div class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><button
                          class="button first-button">Moje konto</button></a>
                  <div class="dropdown-menu dropdown-primary" aria-labelledby="production-dropdown">
                      <a class="dropdown-item" href="<?= base_url('moje-zamowienia') ?>">Moje zamówienia</a>
                      <a class="dropdown-item" href="<?= base_url('ustawienia-konta') ?>">Ustawienia konta</a>
                      <a class="dropdown-item" href="<?= base_url('wyloguj') ?>">Wyloguj</a>
                  </div>
              </div>
              <?php endif; ?>
          </div>
      </nav>
  </header>
  <main>
      <?php if ($this->uri->segment(1)) : ?>
      <section class="breadcrumb">
          <div class="item"><a href="<?= base(); ?>"><?= $breadcrumb->title ?></a></div>
          <div class="item"><?= $breadcrumb->separator_tag ?></div>
          <?php if ($this->uri->segment(1) == 'produkt') : ?>
          <?php foreach ($categories as $i => $category) : ?>
          <div class="item"><a
                  href="<?= base_url("sklep/kategoria/" . slug(remove_subcategory_prefix($category->title)) . "/$category->id") ?>"><?= remove_subcategory_prefix($category->title); ?></a>
          </div>
          <div class="item"><?= $i == count($categories) - 1 ? $breadcrumb->separator_tag : ', ' ?></div>
          <?php endforeach; ?>
          <div class="item"><a href=""><?= $product->name; ?></a></div>
          <?php else : ?>
          <div class="item"><a href="<?= base($current_subpage->link); ?>"><?= $current_subpage->title ?></a></div>
          <?php endif; ?>
          <?php if (isset($breadcrumb_title)) : ?>
          <div class="item"><?= $breadcrumb->separator_tag ?></div>
          <div class="item"><?= $breadcrumb_title ?>
          </div>

          <?php endif; ?>
      </section>

      <?php endif; ?>