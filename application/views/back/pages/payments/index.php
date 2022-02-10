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
                            <th class="wd-15p align-top">Tytuł</th>
                            <th class="wd-5p no-sort">Detal</th>
                            <th class="wd-15p no-sort">Hurt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($rows as $value) : $i++; ?>
                        <tr>
                            <td class="align-middle"><?php echo $i; ?>.</td>
                            <td class="align-middle"><?php echo $value->title; ?></td>
                            <td class="align-middle">
                                <label class="ckbox">
                                    <input type="checkbox" id="checkDetal<?php echo $value->id; ?>"
                                        onchange="activeDetal(<?php echo $value->id; ?>, '<?php echo $this->uri->segment(2); ?>');"
                                        <?php if ($value->active_detal == 1) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td class="align-middle">
                                <label class="ckbox">
                                    <input type="checkbox" id="checkHurt<?php echo $value->id; ?>"
                                        onchange="activeHurt(<?php echo $value->id; ?>, '<?php echo $this->uri->segment(2); ?>');"
                                        <?php if ($value->active_hurt == 1) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?>>
                                    <span></span>
                                </label>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div><!-- table-wrapper -->

            <script type="text/javascript">
            function activeDetal(id, table) {
                value = document.getElementById('checkDetal' + id).checked;
                if (value == true) {
                    value = 1;
                } else {
                    value = 0;
                }
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/active_detal",
                    data: {
                        id: id,
                        value: value,
                        table: table
                    },
                    cache: false,
                    beforeSend: function(html) {
                        console.log(html);
                    },
                    complete: function(html) {
                        console.log(html);
                    }
                });
            }

            function activeHurt(id, table) {
                value = document.getElementById('checkHurt' + id).checked;
                if (value == true) {
                    value = 1;
                } else {
                    value = 0;
                }
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/active_hurt",
                    data: {
                        id: id,
                        value: value,
                        table: table
                    },
                    cache: false,
                    beforeSend: function(html) {
                        console.log(html);
                    },
                    complete: function(html) {
                        console.log(html);
                    }
                });
            }
            </script>