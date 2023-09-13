<!-- SCRIPTS -->
<!-- JQuery -->
<?= $this->asset->js('themes/jquery-3.4.1.min.js'); ?>
<!-- Bootstrap core JavaScript -->
<?= $this->asset->js('themes/bootstrap.js'); ?>
<!-- MDB core JavaScript -->
<?= $this->asset->js('themes/mdb.min.js'); ?>
<!-- Bootstrap tooltips -->
<?= $this->asset->js('themes/popper.min.js'); ?>
<!-- jQuery Custom Scroller -->
<?= $this->asset->js('themes/jquery.nicescroll.min.js'); ?>
<!-- Datatables JS -->
<?= $this->asset->js('addons/datatables.min.js'); ?>
<?= $this->asset->js('addons/datatables-select.min.js'); ?>
<!-- NProgress JS -->
<?= $this->asset->js('plugins/nprogress/nprogress.js'); ?>
<!-- Select2 JS -->
<?= $this->asset->js('plugins/select2/dist/js/select2.min.js'); ?>
<!-- Sweet Alert -->
<?= $this->asset->js('plugins/sweetalert2/dist/sweetalert2.min.js'); ?>
<!-- Waitme JS -->
<?= $this->asset->js('plugins/waitme/waitMe.js'); ?>
<!-- Our Custom JS -->
<?= $this->asset->js('themes/scripts.js'); ?>
<!-- Initializations -->
<script type="text/javascript">
    $(function() {
        $('#footer').css('height', $(window).height() - $('html').height() + 'px');
    });
    // SideNav Initialization
    $(".button-collapse").sideNav();

    var container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });

    // Data Picker Initialization

    $('.datepicker').pickadate({
        monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'Desember'],
        format: 'dd mmmm yyyy',
        formatSubmit: 'yyyy/mm/dd'
    });

    $('.datepickermonth').pickadate({
        selectYears: true,
        selectMonths: true
    });


    // Tooltips Initialization
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })



    function run_waitMe(el) {
        el.waitMe({
            effect: 'facebook',
            text: 'Please wait...',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000',
            maxSize: 100,
            waitTime: -1,
            textPos: 'vertical',
            source: '',
            fontSize: '',
            onClose: function(el) {}
        });
    }

    function formReset(tambahan) {
        $('#status').select2().val('1').trigger("change");
        $('form#formEntry .select-all').select2().val('').trigger("change");
        $('#formEntry').attr('action', site + '/create');
        $('#errEntry').html('');
        $('form#formEntry').trigger('reset');
        $('form#formEntry').removeClass('was-validated');
        tambahan;
    }

    // Material Select Initialization
    $(document).ready(function() {
        $('.mdb-select').materialSelect();
        $('.mdb-select2').materialSelect();
        
    });
</script>

<script type="text/javascript">
    <!--  custom js  -->
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    let csrfName  = '<?php echo $this->security->get_csrf_token_name(); ?>';
    let site      = '<?php echo site_url(isset($siteUri) ? $siteUri : ''); ?>';
    let msg       = new alertMessage();
    const swalAlert = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-danger',
        },
        buttonsStyling: false
    });
</script>

<!-- JS per Page -->
<?= isset($page_js) ? $page_js : ''; ?>