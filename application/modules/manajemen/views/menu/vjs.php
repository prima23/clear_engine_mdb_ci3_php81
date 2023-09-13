<script type="text/javascript">

    getDataListMenu();

    function getDataListMenu() {
        $.ajax({
            type: 'GET',
            url: site + '/listview',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()},
            dataType: 'json',
            success: function(data) {
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.status == 'RC200') {
                    $('#tblList > tbody').html(data.message);
                } else {
                    $('#tblList > tbody').html('<tr><td colspan="4"></td></td>');
                }
            }
        });
    }
    //panggil form Entri
    $(document).on('click', '.btnAdd', function(e){
        formReset();
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        let id = $(this).data('id');
        $('#parent_id').select2().val(id).trigger('change');
    });
    //close form entri
    $(document).on('click', '.btnClose', function(e) {
        formReset();
        $('#modalEntryForm').modal('toggle');
    });

    $(document).on('change', 'input[type=radio][name=is_parent]', function (e) {
        if ($("#type_1").is(":checked")) {
            document.getElementById("url_menu").value = '#';
            $('input[name="nama_rules"]').removeAttr('required').attr('disabled', '');
        } else if ($("#type_2").is(":checked")) {
            document.getElementById("url_menu").value = '';
            $('input[name="nama_rules"]').attr('required', '').removeAttr('disabled');
        }
    });
    $(document).on('click', '.setModule', function (e) {
        document.getElementById("id_rules").value = $(this).attr('data-id');
        document.getElementById("nama_rules").value = $(this).attr('data-nm');
        $('#modalModuleList').modal('hide');
    });
    $(document).on('submit', '#formEntry', function(e) {
        e.preventDefault();
        let postData = $(this).serialize();
        // get form action url
        let formActionURL = $(this).attr("action");
        $("#save").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#save").addClass('disabled');
        run_waitMe($('#frmEntry'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menyimpan data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: formActionURL,
                    type: "POST",
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    if(data.status == 'RC404') {
                        $('#formEntry').addClass('was-validated');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errEntry').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key,value){
                                    if(key != 'isi')
                                        $('input[name="'+key+'"], select[name="'+key+'"]').closest('div.required').find('div.invalid-feedback').text(value);
                                    else {
                                        $('#pesanErr').html(value);
                                    }
                                });
                                $('#frmEntry').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmEntry').waitMe('hide');
                        $('#modalEntryForm').modal('toggle');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                getDataListMenu();
                            }
                        })
                    }
                }).fail(function() {
                    $('#errEntry').html(msg.error('Harap periksa kembali data yang diinputkan'));
                    $('#frmEntry').waitMe('hide');
                }).always(function() {
                    $("#save").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#save").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel ) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmEntry').waitMe('hide');
                        $("#save").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#save").removeClass('disabled');
                    }
                })
            }
        })
    });
    $(document).on('click', '.btnEdit', function(e){
        formReset();
        $('#formEntry').attr('action', site + '/update');
        let token = $(this).data('id');
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        getDataMenu(token);
    });
    function getDataMenu(token) {
        run_waitMe($('#frmEntry'));
        $.ajax({
            type: 'POST',
            url: site + '/details',
            data: {'token' : token, '<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()},
            dataType: 'json',
            success: function(data) {
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.status == 'RC200') {
                    $('input[name="tokenId"]').val(token);
                    $('#nama_menu').val(data.message.title);
                    $('#parent_id').select2().val(data.message.parent).trigger('change');
                    $('input[type="radio"][value="'+data.message.type+'"]').prop('checked', true);
                    $('#id_rules').val(data.message.rules);
                    $('#url_menu').val(data.message.url);
                    $('#order_menu').val(data.message.order);
                    $('#icon_menu').val(data.message.icon);
                    $('#status').select2().val(data.message.status).trigger('change');
                    if(data.message.type == 'Y') {
                        $('#nama_rules').val('');
                        $('input[name="nama_rules"]').removeAttr('required').attr('disabled', '');
                    } else if (data.message.type == 'N') {
                        $('#nama_rules').val(data.message.access);
                        $('input[name="nama_rules"]').attr('required', '').removeAttr('disabled');
                    }
                }
                $('#frmEntry').waitMe('hide');
            }
        });
    }
    $(document).on('click', '.btnDelete', function(e){
        e.preventDefault();
        let postData = {
            'tokenId': $(this).data('id'),
            '<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()
        };
        $(this).html('<i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i>');
        $(this).addClass('disabled');
        run_waitMe($('#formParent'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin menghapus data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site + '/delete',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    if(data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Hapus',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errSuccess').html(msg.error(data.message));
                            }
                        })
                    } else {
                        swalAlert.fire({
                            title: 'Berhasil Hapus',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                getDataListMenu();
                            }
                        })
                    }
                    $('#formParent').waitMe('hide');
                }).fail(function() {
                    $('#errSuccess').html(msg.error('Harap periksa kembali data yang akan dihapus'));
                    $('#formParent').waitMe('hide');
                }).always(function() {
                    $('.btnDelete').html('<i class="fas fa-trash-alt"></i>');
                    $('.btnDelete').removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel ) {
                swalAlert.fire({
                    title: 'Batal Hapus',
                    text: 'Proses hapus data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#formParent').waitMe('hide');
                        $('.btnDelete').html('<i class="fas fa-trash-alt"></i>');
                        $('.btnDelete').removeClass('disabled');
                    }
                })
            }
        })
    });
    $(document).on('keypress keyup', '.nominal',function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $('#modalModuleList').on('show.bs.modal', function (e) {
        $("#modalEntryForm").modal('hide');
    });

    $('#modalModuleList').on('hide.bs.modal', function (e) {
        $("#modalEntryForm").modal('show');
    });


</script>