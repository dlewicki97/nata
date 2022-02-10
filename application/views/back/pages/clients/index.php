<?php $typeClient[0] = 'Detaliczny';
$typeClient[1] = 'Hurtowy'; ?>
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
            <th class="wd-5p align-top">Zaznacz</th>
            <th class="wd-10p align-top">Tytuł</th>
            <th class="wd-10p align-top">Data utworzenia</th>
            <th class="wd-10p align-top">Dane kontaktowe</th>
            <th class="wd-10p align-top">Typ klienta</th>
            <th class="wd-10p align-top">Rabat</th>
            <th class="wd-5p text-right no-sort">
            <a  class="btn btn-sm btn-secondary"><i class="fas fa-envelope-open-text mg-r-10 tx-white"></i> <span class="tx-white" onclick="getEmailsChecked()">Do zaznaczonych</span></a>
            <a data-toggle="modal" data-target="#modaldemoAll" class="btn btn-sm btn-info"><i class="fas fa-envelope-open-text mg-r-10 tx-white"></i> <span class="tx-white">Do wszystkich</span></a>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0;
          foreach (array_reverse($rows) as $value) : $i++; ?>
            <tr style="background-color: 
              <?php if ($value->active == '0') {
                echo '#ff4444';
              } elseif ($value->type_client == '0') {
                echo '#00C851';
              } elseif ($value->type_client == '1') {
                echo '#33b5e5';
              } ?>;">
              <td class="align-middle"><?php echo $i; ?>.</td>
              <td class="align-middle"><label class="ckbox">
                <input type="checkbox" name="sendMany[]" value="<?php echo $value->email; ?>">
                <span></span>
              </label></td>
              <td class="align-middle tx-white"><?php echo $value->first_name; ?> <?php echo $value->last_name; ?></td>
              <td class="align-middle tx-white"><?= date('H:i:s', strtotime($value->created)) . '<br>' . date('d.m.y', strtotime($value->created)); ?></td>
              <td class="align-middle tx-white"><?php echo $value->email; ?><br><?php echo $value->phone; ?></td>
              <td class="align-middle tx-white"><?php echo $typeClient[$value->type_client]; ?></td>
              <td class="align-middle tx-white"><?php echo $value->discount; ?>%</td>
              <td class="text-right tx-white">
                <a data-toggle="modal" data-target="#modaldemo<?php echo $value->id; ?>" class="btn btn-sm btn-secondary" style="color: #fff"><i class="icon fas fa-envelope-open-text mg-r-10"></i> Wiadomość</a>
                <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/update/<?php echo $value->id; ?>" class="btn btn-sm btn-info"><i class="icon ion-compose mg-r-10"></i> Edytuj</a>
                <a href="<?php echo base_url(); ?>panel/settings/delete/<?php echo $this->uri->segment(2); ?>/<?php echo $value->id; ?>" class="btn btn-sm btn-secondary" onclick="return confirm('Czy na pewno chcesz usunąć <?php echo $value->first_name . ' ' . $value->last_name; ?>? #<?php echo $value->id; ?>')">
                  <i class="fa fa-close mg-r-10"></i> Usuń
                </a>
              </td>
            </tr>
            <!-- Wiadomość do pojedynczego klienta -->
            <div id="modaldemo<?php echo $value->id; ?>" class="modal fade">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content bd-0 tx-14">
                  <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Wyślij wiadomość do: <?php echo $value->first_name . ' ' . $value->last_name; ?></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body pd-25">
                    <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/mails/send_message/<?php echo $value->id; ?>" method="post" enctype="multipart/form-data">

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
            <!-- Wiadomość do pojedynczego klienta -->
          <?php endforeach; ?>
        </tbody>
      </table>
    </div><!-- table-wrapper -->


    <!-- Wiadomość do wszsytkich klientów -->
    <div id="modaldemoAll" class="modal fade">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Wyślij wiadomość do wszystkich klientów</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-25">
            <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/mails/send_message" method="post" enctype="multipart/form-data">

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

    <!-- Wiadomość do wybranych klientów -->
    <div id="modaldemoChecked" class="modal fade">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Wyślij wiadomość do wybranych klientów</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-25">
          <form class="form-layout form-layout-2" action="<?php echo base_url(); ?>panel/mails/send_to_chosen_users" method="post" enctype="multipart/form-data">
              <div class="row no-gutters">
                <div class="col-md-12">
                <div id="emailList" class="mb-3"></div>
                  <div class="row">
                    <div class="col-md-12">
  
                      <div class="form-group">
                        <label class="form-control-label">Temat: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="subject" required>
                        <input id="mails" class="form-control" type="hidden" name="mails" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">

                    <div class="col-md-12">
                      <div class="form-group bd-t-0-force bd-b-0-force">
                        <label class="form-control-label">Treść wiadomości:</label>
                        <textarea id="message" class="summernote" name="message" required></textarea>
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


    <script>

        function getEmailsChecked() {
          var checkboxes = $('input[name="sendMany[]"]');
          var $checked = checkboxes.filter(":checked"),
          checkedValues = $checked.map(function () {
            return this.value;
          }).get();
          if (checkedValues != '') {
            $("#modaldemoChecked").modal()
            document.getElementById('emailList').innerHTML = checkedValues;
            document.getElementById('mails').value = checkedValues;
          } else {
            alert('Nie wybrałeś żadnego pola.');
          }
        }


    </script>