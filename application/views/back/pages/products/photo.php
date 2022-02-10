<div class="row no-gutters">
    <div class="col-md-12">
        <div id="photoViewer_1" class="form-group text-center delete_photo cursor" onclick="clear_box(1);">
            <?= @$value->photo ? "<img class=\"img-fluid img-thumbnail\" src=\"$value->photo\" width=75%>" : '<img class="img-fluid img-thumbnail" src="http://via.placeholder.com/64x64" alt="">' ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group bd-t-0-force">
            <label class="form-control-label">Zdjęcie główne (link):</label>
            <input type="text" id="main-photo" class="form-control" value="<?= @$value->photo ?>" name="photo">
            </label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group bd-t-0-force">
            <label class="form-control-label">Tekst alternatywny zdjęcia głównego:</label>
            <input class="form-control" type="text" name="alt" value="<?php echo @$value->alt; ?>">
        </div>
    </div>
    <div class="col-md-12">
        <div id="photoViewer_2" class="form-group bd-t-0-force text-center delete_photo cursor" onclick="clear_box(2);">
            <?php if (@$value->photo_min != '') {
            echo "<img class=\"img-fluid img-thumbnail\" src=\"$value->photo_min\" width=75%>";
         } else {
            echo '<img class="img-fluid img-thumbnail" src="http://via.placeholder.com/64x64" alt="">';
         } ?>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group bd-t-0-force">
            <label class="form-control-label">Zdjęcie miniaturowe (link):</label>
            <input type="text" id="photo_min" class="form-control" value="<?= @$value->photo_min ?>" name="photo_min">
            </label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group bd-t-0-force">
            <label class="form-control-label">Tekst alternatywny zdjęcia miniaturowego:</label>
            <input class="form-control" type="text" name="alt2" value="<?php echo @$value->alt2; ?>">
        </div>
    </div>

</div>

<script>
let photoViewer = document.querySelector('#photoViewer_1');
let photoMinViewer = document.querySelector('#photoViewer_2');
let photoInput = document.querySelector('#main-photo');
let photoMinInput = document.querySelector('#photo_min');

setEventListener(photoViewer, photoInput);
setEventListener(photoMinViewer, photoMinInput);

function setEventListener(viewer, input) {
    let img = viewer.querySelector('img');
    input.addEventListener('keyup', () => img.src = input.value || "http://via.placeholder.com/64x64");
}
</script>