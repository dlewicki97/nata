    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
        <p class="mg-b-0"><?php echo subtitle(); ?></p>
        <hr>
      </div><!-- d-flex -->
      <div class="br-pagebody mg-t-0 pd-x-30">
        <?php if (isset($_SESSION['flashdata'])) : ?>
          <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
        <?php endif; ?>
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-5p align-top">L.p.</th>
                <th class="wd-45p align-top">Tytuł</th>
                <th class="wd-50p text-right no-sort">
                  <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/insert" class="btn btn-sm btn-info"><i class="fa fa-plus mg-r-10"></i> Dodaj</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 0;
              foreach (array_reverse($rows) as $value) : $i++; ?>
                <tr>
                  <td class="align-middle"><?php echo $i; ?>.</td>
                  <td class="align-middle"><?php echo $value->title; ?></td>
                  <td class="text-right tx-white">
                    <?php if($this->back_m->count_users_in_group('clients', $value->id) > 0): ?>
                    <a data-toggle="modal" data-target="#modaldemo<?php echo $value->id; ?>" class="btn btn-sm btn-secondary"><i class="icon fas fa-envelope-open-text mg-r-10"></i> Wiadomość</a>
                    <?php else: ?>
                    <button class="btn btn-sm btn-secondary"><i class="icon fas fa-envelope-open-text mg-r-10"></i> Brak klientów w grupie</button>
                    <?php endif; ?>
                    <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/update/<?php echo $value->id; ?>" class="btn btn-sm btn-info"><i class="icon ion-compose mg-r-10"></i> Edytuj</a>
                    <a href="<?php echo base_url(); ?>panel/settings/delete/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>" class="btn btn-sm btn-secondary" onclick="return confirm('Czy na pewno chcesz usunąć <?php echo $value->title; ?>? #<?php echo $value->id; ?>')">
                      <i class="fa fa-close mg-r-10"></i> Usuń
                    </a>
                  </td>
                </tr>
                <!-- Wiadomość do grupy -->
                <div id="modaldemo<?php echo $value->id; ?>" class="modal fade">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content bd-0 tx-14">
                      <div class="modal-header pd-y-20 pd-x-25">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Wyślij wiadomość do grupy: <?php echo $value->title; ?></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body pd-25">
                        <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/mails/send_group_message/<?php echo $value->id; ?>" method="post" enctype="multipart/form-data">

                          <div class="row no-gutters">
                            <div class="col-md-12">
                              <div class="row">

                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="form-control-label">Temat: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="subject" required>
                                  </div>
                                </div>
                              </div>
                              <div class="row">

                                <div class="col-md-12">
                                  <div class="form-group bd-t-0-force bd-b-0-force">
                                    <label class="form-control-label">Treść wiadomości:</label>
                                    <textarea class="summernote" name="message" required></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-layout-footer bd pd-20">
                                    <button class="btn btn-info" type="submit">Wyślij</button>
                                    <button class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Wiadomość do grupy -->
              <?php endforeach; ?>
            </tbody>
          </table>
        </div><!-- table-wrapper -->