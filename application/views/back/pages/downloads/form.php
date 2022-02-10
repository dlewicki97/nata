    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Pliki do pobrania</h4>
            <p class="mg-b-0"><?php echo subtitle(); ?></p>
            <hr>
        </div>

        <div class="br-pagebody mg-t-0 pd-x-30">
            <?php if (isset($_SESSION['flashdata'])) : ?>
            <div id="alert-box"><?php echo $_SESSION['flashdata']; ?></div>
            <?php endif; ?>

            <form class="form-layout form-layout-2"
                action="<?php echo base_url(); ?>panel/<?php echo $this->uri->segment(2); ?>/action/<?php echo $this->uri->segment(4) . '/' . $this->uri->segment(2); ?>/<?php echo @$value->id; ?>"
                method="post" enctype="multipart/form-data">

                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-group">
                                    <label class="form-control-label">Tytuł: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="title"
                                        value="<?php echo @$value->title; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Link (zamiast pliku): </label>
                                    <input class="form-control" type="text" name="link"
                                        value="<?php echo @$value->link; ?>">
                                </div>
                            </div>
                            <div class="col-md-12 pr-0">
                                <div class="form-group bd-t-0-force">
                                    <label class="form-control-label">Kategoria: </label>
                                    <select class="form-control" name="downloads_category_id" id="">
                                        <?php foreach ($downloads_categories as $category) : ?>
                                        <option
                                            <?php if ($category->id == @$value->downloads_category_id) echo 'selected';  ?>
                                            value="<?= $category->id ?>"><?= $category->title ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 pr-0">
                                <div class="form-layout-footer bd pd-20 bd-t-0-force">
                                    <button class="btn btn-info" type="submit">Zapisz</button>
                                    <a href="<?= base_url('panel/downloads') ?>">
                                        <button class="btn btn-secondary">Anuluj</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php if (isset($value) && $value->path) : ?>
                        <div class="col-12">
                            <div class="form-group bd-l-0-force bd-b-0-force">
                                <label class="form-control-label">Wrzucony plik: <a
                                        href="<?= base_url("uploads/$value->path") ?>"><?= $value->name ?></a></label>
                                <a href="<?= base_url("panel/downloads/delete_file/$value->id") ?>"
                                    class="text-danger">Usuń</a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                            <div class="form-group bd-l-0-force">
                                <label id="infoFile" class="form-control-label"></label>
                                <label class="form-control-label">Plik:</label>
                                <input type="hidden" id="name_file_1" name="name_file_1">
                                <label class="custom-file">
                                    <input type="file" id="file_1" class="custom-file-input" name="file_1"
                                        onchange="uploadFile();">
                                    <span class="custom-file-control custom-file-control-inverse"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <script>
            function uploadFile() {
                document.getElementById('infoFile').innerHTML =
                    '<span class="text-center"><i class="fas fa-spinner fa-pulse loader"></i></span>';
                setTimeout(function() {
                    document.getElementById('infoFile').innerHTML =
                        '<span class="text-success"><i class="fas fa-check"></i> Plik został przygotowany do wysłania!</span>';
                }, 200);
            }
            </script>