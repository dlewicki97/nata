</div><!-- br-pagebody -->
<footer class="br-footer">
    <div class="footer-left">

    </div>
    <div class="footer-right d-flex align-items-center">
        <div class="mg-b-2">Copyright &copy; <?= date('Y'); ?>. AD Awards. Wszystkie prawa zastrzeżone.<br>
            Uważnie i starannie wykonane przez AD Awards.</div>
    </div>
</footer>
</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->

<script src="<?php echo base_url(); ?>assets/back/lib/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/popper.js/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/bootstrap/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/moment/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/jquery-switchbutton/jquery.switchButton.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/peity/jquery.peity.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/chartist/chartist.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/d3/d3.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/rickshaw/rickshaw.min.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/highlightjs/highlight.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/select2/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/jquery-toggles/toggles.min.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/jt.timepicker/jquery.timepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/spectrum/spectrum.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/jquery.maskedinput/jquery.maskedinput.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/datatables-responsive/dataTables.responsive.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/summernote/summernote-bs4.min.js"></script>


<script src="<?php echo base_url(); ?>assets/back/js/bracket.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/ResizeSensor.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/datepicker-pl.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/loadPhoto.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/deletePhoto.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/preloader.js"></script>
<script type="text/javascript" src="https://furgonetka.pl/js/dist/map/map.js"></script>
<script src="https://cdn.tiny.cloud/1/no6be3fmvmbx2b6q28pch51gwxb2vourdipy9rtbpv78od26/tinymce/5/tinymce.min.js">
</script>\


<script src="<?php echo base_url(); ?>assets/back/js/chart.morris.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/bracket.js"></script>
<script src="<?php echo base_url(); ?>assets/back/lib/morris.js/morris.js"></script>

<script src="<?php echo base_url(); ?>assets/back/lib/chart.js/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/bracket.js"></script>
<script src="<?php echo base_url(); ?>assets/back/js/chart.chartjs.js"></script>
<script defer src="<?php echo base_url(); ?>assets/back/js/products/additional_parameters.js"></script>
<script defer src="<?php echo base_url(); ?>assets/back/js/products/related_products.js"></script>
<script defer src="<?php echo base_url(); ?>assets/back/js/scripts/livesearch.js"></script>


<script>
$.fn.dataTable.ext.type.order['priority-asc'] = function(a, b) {
    var aInput = document.createElement('div');
    aInput.innerHTML = a.trim();
    var bInput = document.createElement('div');
    bInput.innerHTML = b.trim();
    return aInput.getElementsByTagName('input')[0].value - bInput.getElementsByTagName('input')[0].value;
};
$.fn.dataTable.ext.type.order['priority-desc'] = function(a, b) {
    var aInput = document.createElement('div');
    aInput.innerHTML = a.trim();
    var bInput = document.createElement('div');
    bInput.innerHTML = b.trim();
    console.log(bInput.getElementsByTagName('input')[0].value, aInput.getElementsByTagName('input')[0].value)
    return bInput.getElementsByTagName('input')[0].value - aInput.getElementsByTagName('input')[0].value;
};

const datable = $('#datatable1').DataTable({
    responsive: true,
    language: {
        "processing": "Przetwarzanie...",
        "search": "Szukaj:",
        "lengthMenu": "Pokaż _MENU_ pozycji",
        "info": "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
        "infoEmpty": "Pozycji 0 z 0 dostępnych",
        "infoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
        "infoPostFix": "",
        "loadingRecords": "Wczytywanie...",
        "zeroRecords": "Nie znaleziono pasujących pozycji",
        "emptyTable": "Brak danych",
        "paginate": {
            "first": "Pierwsza",
            "previous": "Poprzednia",
            "next": "Następna",
            "last": "Ostatnia"
        },
        "aria": {
            "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
            "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
        }
    },
    "columnDefs": [{
        "targets": 'no-sort',
        "orderable": false,
    }, {
        "type": "priority",
        "targets": [2, 3]
    }]
});
</script>

<script>
function initializeOneMoreTime() {

    $('#datatable1').DataTable({
        responsive: true,
        language: {
            "processing": "Przetwarzanie...",
            "search": "Szukaj:",
            "lengthMenu": "Pokaż _MENU_ pozycji",
            "info": "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
            "infoEmpty": "Pozycji 0 z 0 dostępnych",
            "infoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
            "infoPostFix": "",
            "loadingRecords": "Wczytywanie...",
            "zeroRecords": "Nie znaleziono pasujących pozycji",
            "emptyTable": "Brak danych",
            "paginate": {
                "first": "Pierwsza",
                "previous": "Poprzednia",
                "next": "Następna",
                "last": "Ostatnia"
            },
            "aria": {
                "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
                "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
            }
        },
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }, {
            "type": "priority",
            "targets": 2
        }]
    });
}
</script>

<script>
tinymce.init({
    selector: '.summernote',
    paste_as_text: true,
    plugins: 'table print preview fullscreen image imagetools emoticons anchor link lists advlist format wrap autolink charmap code paste',
    advlist_bullet_styles: "square",
    menubar: 'file view insert edit format table',
    toolbar: 'undo redo bold italic forecolor backcolor align lists numlist bullist link image emoticons print preview fullscreen outdent indent',
    valid_elements: '*[*]',
    height: 400,
    setup: function(editor) {
        editor.on('change', function(e) {
            editor.save();
        });
    }
});
// $('.summernote').summernote({
//   height: 250
// })
</script>

<script>
$(function() {
    'use strict'
    $(window).resize(function() {
        minimizeMenu();
    });
    minimizeMenu();

    function minimizeMenu() {
        if (window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)')
            .matches) {
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
        } else if (window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
        }
    }
});
</script>
<script>
$(function() {
    'use strict'

    $('.form-layout .form-control').on('focusin', function() {
        $(this).closest('.form-group').addClass('form-group-active');
    });

    $('.form-layout .form-control').on('focusout', function() {
        $(this).closest('.form-group').removeClass('form-group-active');
    });

    // Select2
    $('#select2-a, #select2-b').select2({
        minimumResultsForSearch: Infinity
    });

    $('#select2-a').on('select2:opening', function(e) {
        $(this).closest('.form-group').addClass('form-group-active');
    });

    $('#select2-a').on('select2:closing', function(e) {
        $(this).closest('.form-group').removeClass('form-group-active');
    });

});
</script>

<script type="text/javascript">
function updateField(field, table) {
    var value = document.getElementsByName(field)[0].value;
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>panel/settings",
        data: {
            field: field,
            value: value,
            table: table
        },
        cache: false,
        beforeSend: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
        },
        complete: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
        }
    });
}

function updateTextarea(field, table) {
    var value = document.getElementById(field).value;
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>panel/settings",
        data: {
            field: field,
            value: value,
            table: table
        },
        cache: false,
        beforeSend: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
        },
        complete: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
        }
    });
}

function updateFieldMap(field, table) {
    var value = document.getElementsByName(field)[0].value;
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>panel/settings",
        data: {
            field: field,
            value: value,
            table: table
        },
        cache: false,
        beforeSend: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
        },
        complete: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
            document.getElementById('googleMap').innerHTML = '<iframe src="' + value +
                '" width="100%" height="150" frameborder="0" style="border:0; margin-top: 20px;" allowfullscreen=""></iframe>';
        }
    });
}

function updateFieldPhoto(field, table) {
    var value = document.getElementById(field);
    var data = new FormData();
    console.log(value.files[0]);
    data.append(value.name, value.files[0]);
    data.append('table', table);
    let endpoint = '';
    if (field === 'favicon') endpoint = 'favicon';
    else if (field === 'logo_mail') endpoint = 'logo_mail';
    else endpoint = 'photo';

    $.ajax({
        type: "post",
        url: `<?php echo base_url(); ?>panel/settings/${endpoint}`,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
        },
        complete: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
        }
    });
}

function updateFieldPrivace(field, table) {
    var value = document.getElementById(field);
    var data = new FormData();
    data.append(value.name, value.files[0]);
    data.append('table', table);
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>panel/settings/privace",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-center pd-y-10 pd-x-25 tx-white"><i class="fas fa-spinner fa-pulse loader"></i></span>';
            document.getElementById('privaceTx').innerHTML =
                'Polityka prywatności <i class="fas fa-spinner fa-pulse loader"></i>';
        },
        complete: function(html) {
            document.getElementsByClassName('change')[0].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
            document.getElementsByClassName('change')[1].innerHTML =
                '<span class="text-success pd-y-10 pd-x-25 tx-white"><i class="fas fa-check"></i> Zmiany zostały wprowadzone!</span>';
            document.getElementById('privaceTx').innerHTML =
                'Polityka prywatności <i class="fas fa-check"></i>';
        }
    });
}
</script>
</body>

</html>