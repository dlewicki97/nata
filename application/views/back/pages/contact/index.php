    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))); ?></h4>
        <p class="mg-b-0"><?php echo subtitle(); ?></p>
        <hr>
      </div><!-- d-flex -->
      <div class="br-pagebody mg-t-0 pd-x-30">
        <?php if(isset($_SESSION['flashdata'])): ?>
        <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
        <?php endif; ?>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-5p align-top">L.p.</th>
                  <th class="wd-45p align-top">Tytuł</th>
                  <th class="wd-50p text-right no-sort">
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; foreach (array_reverse($rows) as $value): $i++; ?>
                <tr>
                  <td class="align-middle"><?php echo $i; ?>.</td>
                  <td class="align-middle"><?php echo $value->title; ?></td>
                  <td class="text-right">
                      <a href="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/form/update/<?php echo $value->id; ?>" class="btn btn-sm btn-info"><i class="icon ion-compose mg-r-10"></i> Edytuj</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div><!-- table-wrapper -->