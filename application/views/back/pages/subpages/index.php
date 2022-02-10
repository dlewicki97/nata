    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Podstrony</h4>
            <p class="mg-b-0"><?php echo subtitle(); ?></p>
            <hr>
        </div><!-- d-flex -->
        <div class="br-pagebody mg-t-0 pd-x-30">
            <?php if (isset($_SESSION['flashdata'])) : ?>
            <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
            <?php endif; ?>
            <div class="table-wrapper">
                <span id="refreshSend">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th class="wd-5p align-top">L.p.</th>
                                <th class="wd-45p align-top">Tytuł</th>
                                <th class="wd-10p align-top">Kolejność</th>
                                <th class="wd-30p text-right no-sort">
                                    <!-- <a href="<?php echo base_url(); ?>panel/subpages/form/insert" class="btn btn-sm btn-info"><i class="fa fa-plus mg-r-10"></i> Dodaj</a> -->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($subpages as $value) : $i++; ?>
                            <tr>
                                <td class="align-middle"><?php echo $i; ?>.</td>
                                <td class="align-middle"><?php echo $value->title; ?></td>
                                <td class="align-middle">
                                    <input class="form-control" id="getOrder<?php echo $value->id; ?>" name="priority"
                                        onchange="changeOrder(<?php echo $value->id; ?>)"
                                        value="<?php echo $value->priority; ?>">
                                </td>
                                <td class="text-right">
                                    <!-- <a href="<?php echo base_url(); ?>panel/subpage_lists/list/<?php echo $value->id; ?>"
                                        class="btn btn-sm btn-secondary"><i class="fas fa-list mg-r-10"></i> Lista</a> -->
                                    <a href="<?php echo base_url(); ?>panel/subpages/form/update/<?php echo $value->id; ?>"
                                        class="btn btn-sm btn-info"><i class="icon ion-compose mg-r-10"></i> Edytuj</a>
                                    <!-- <a href="<?php echo base_url(); ?>panel/settings/delete/subpages/<?php echo $value->id; ?>" class="btn btn-sm btn-secondary" 
                        onclick="return confirm('Czy na pewno chcesz usunąć <?php echo $value->title; ?>? #<?php echo $value->id; ?>')" >
                          <i class="fa fa-close mg-r-10"></i> Usuń
                        </a> -->
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </span>
            </div><!-- table-wrapper -->


            <script type="text/javascript">
            function changeOrder(id) {
                var id = id;
                var priority = document.getElementById('getOrder' + id).value;
                console.log(priority);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>panel/subpages/priority",
                    data: {
                        id: id,
                        priority: priority
                    },
                    cache: false,
                    complete: function(html) {
                        console.log(html);
                        $('#refreshSend').load(document.URL + ' #refreshSend', function() {
                            initializeOneMoreTime();
                        });
                    }
                });
            }
            </script>