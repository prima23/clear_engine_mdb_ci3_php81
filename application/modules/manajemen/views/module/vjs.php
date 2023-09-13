<script type="text/javascript">

    getDataListModule();

    function getDataListModule() {
        $('#tblList').dataTable({
            "pagingType": "full_numbers",
            "destroy": true,
            "processing":true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": 'Loading data...'
            },
            "serverSide": true,
            "stateSave" : true,
            "ordering": false,
            "ajax": {
                "url": site + '/listview',
                "type": "POST",
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>" : $('input[name="'+csrfName+'"]').val()
                },
            },
            "columnDefs": [
                {
                    "targets": [ 0 ], //first column
                    "orderable": false, //set not orderable
                    "className":'text-center'
                },
                {
                    "targets": [ 1 ], //second column
                    "className":'lblModule'
                },
                {
                    "targets": [ -1, -2 ], //last column
                    "orderable": false, //set not orderable
                    "className":'text-center'
                },
            ],
        });
        $('#tblList_filter input').addClass('form-control').attr('placeholder','Search Data');
        $('#tblList_length select').addClass('form-control');
    }
    //panggil form Entri
    $(document).on('click', '#btnAdd', function(e){
        formReset();
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
    });
    //close form entri
    $(document).on('click', '.btnClose', function(e) {
        //get modal id
        let id = $(this).closest('div.modal').attr('id');
        formReset();
        $('#'+id).modal('toggle');
        if(id == 'modalRulesForm') {
            $('#formSettingRules').hide();
        }
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
                                getDataListModule();
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
        getDataModule(token);
    });
    function getDataModule(token) {
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
                    $('#label_module').val(data.message.label);
                    $('#nama_module').val(data.message.nama);
                    $('#url_module').val(data.message.url);
                    $('#deskripsi_module').val(data.message.ket);
                    $('#status').select2().val(data.message.status).trigger("change");
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
                                getDataListModule();
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
    //panggil form Rule
    $(document).on('click', '.btnRules', function(e) {
        formReset();
        $('#modalRulesForm').modal({
            backdrop: 'static'
        });
        let token = $(this).data('id');
        let label = $(this).closest('tr').find('td.lblModule').text();
        $('input[name="tokenRules"]').val(token);
        $('.lblMod').text(label);
        getDataListRules(token);
    });
    $(document).on('click', '.btnSetting', function (e) {
        $('#formSettingRules').slideToggle('slow');
        $('#formEntry').attr('action', site + '/set-rules');
        $('form#formRules .select-all').select2().val('').trigger("change");
        $('form#formRules #status_rules').select2().val('1').trigger("change");
        $('form#formRules').trigger('reset');
    });
    $(document).on('submit', '#formRules', function(e) {
        e.preventDefault();
        let postData = $(this).serialize();
        // get form action url
        let formActionURL = $(this).attr("action");
        $("#saveRules").html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $("#saveRules").addClass('disabled');
        run_waitMe($('#frmRules'));
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
                    url: formActionURL + '/new-rules',
                    type: "POST",
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    if(data.status == 'RC404') {
                        $('#formRules').addClass('was-validated');
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errRules').html(msg.error('Silahkan dilengkapi data pada form inputan dibawah'));
                                $.each(data.message, function(key,value){
                                    if(key != 'isi')
                                        $('input[name="'+key+'"], select[name="'+key+'"]').closest('div.required').find('div.invalid-feedback').text(value);
                                    else {
                                        $('#pesanErr').html(value);
                                    }
                                });
                                $('#frmRules').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmRules').waitMe('hide');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#formSettingRules').slideToggle();
                                getDataListRules(data.kode);
                            }
                        })
                    }
                }).fail(function() {
                    $('#errRules').html(msg.error('Harap periksa kembali data yang diinputkan'));
                    $('#frmRules').waitMe('hide');
                }).always(function() {
                    $("#saveRules").html('<i class="fas fa-check"></i> SUBMIT');
                    $("#saveRules").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel ) {
                swalAlert.fire({
                    title: 'Batal Simpan',
                    text: 'Proses simpan data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmRules').waitMe('hide');
                        $("#saveRules").html('<i class="fas fa-check"></i> SUBMIT');
                        $("#saveRules").removeClass('disabled');
                    }
                })
            }
        })
    });
    function getDataListRules(token) {
        let html = '';
        $.ajax({
            type: 'GET',
            url: site + '/rules',
            data: {'token' : token, '<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()},
            dataType: 'json',
            success: function(data) {
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.status = 'RC200') {
                    if(Object.keys(data.message).length > 0) {
                        $.each(data.message, function(key, val){
                            html += ' <tr class="table-info"><td colspan="4"><strong>Nama Kontrol : '+key+'</strong></td></tr>';
                            let no = 1;
                            $.each(val, function(row, v) {
                                html += '<tr>';
                                    html += '<td class="text-center">'+
                                                '<div class="custom-control custom-checkbox ml-2">'+
                                                    '<input type="checkbox" class="custom-control-input" name="checkid[]" id="checkid_'+key.toLowerCase().replace(' ','_')+'_'+no+'" class="checkid" value="'+v['id_rules']+'">'+
                                                    '<label class="custom-control-label" for="checkid_'+key.toLowerCase().replace(' ','_')+'_'+no+'"></label>'+
                                                '</div>'+
                                            '</td>';
                                    html += '<td class="text-center">'+no+'.</td>';
                                    html += '<td>'+v['label_fungsi']+'</td>';
                                    html += '<td class="text-center">'+v['status']+'</td>';
                                html += '</tr>';
                                no++;
                            });
                        });
                    } else
                        html = '<tr><td colspan="4"><i>Tidak Ada Data Rules</i></td></tr>';
                } else
                    html = '<tr><td colspan="4"><i>Tidak Ada Data Rules</i></td></tr>';
                $('#tblRules > tbody').html(html);
            }
        });
    }
    // Handle click on "check all" control
    $(document).on('click', '#checkAll', function(){
        $('#tblRules > tbody input[type="checkbox"]').prop('checked', this.checked).trigger('change');
    });
    // Handle click on "checked" control
    $(document).on('change', '#tblRules > tbody input[type="checkbox"]', function (e) {
        let rowCount = $('#tblRules > tbody input[type="checkbox"]').length;
        let n = $('#tblRules > tbody input[type="checkbox"]').filter(':checked').length;
        if(n > 0) {
            $('#eventRules').show();
            $('#btnDeleteRules').removeAttr('disabled');
            $('#btnAktifRules').removeAttr('disabled');
            $('#btnNonaktifRules').removeAttr('disabled');
        } else {
            $('#eventRules').hide();
            $('#btnDeleteRules').attr('disabled', '');
            $('#btnAktifRules').attr('disabled', '');
            $('#btnNonaktifRules').attr('disabled', '');
        }
        $(this).is(':checked') ? $(this).closest('tr').addClass('table-active') : $(this).closest('tr').removeClass('table-active');
        if(rowCount !== n)
            $('#checkAll').prop('checked', '');
        else
            $('#checkAll').prop('checked', 'checked');
    });
    // Handle click on "tr" control
    $(document).on('click', '#tblRules > tbody > tr', function(){
        let n = $(this).find('input[type="checkbox"]');
        n.prop('checked', (n.is(':checked')) ? false : true).trigger('change');
    });
    //btn delete rules
    $(document).on('click', '#btnDeleteRules', function (e){
        e.preventDefault();
        let token = $('input[name="tokenRules"]').val();
        let rules = [];
        $.each($('#tblRules > tbody input[type="checkbox"]:checked'), function(){
            rules.push($(this).val());
        });
        const postData = {
            'tokenId': token,
            'rulesId': rules,
            'flag'   : '<?= $this->encryption->encrypt('DR'); ?>',
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        // get form action url
        $(this).html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $(this).addClass('disabled');
        run_waitMe($('#frmRules'));
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
                    url: site + '/rules/set-rules',
                    type: 'POST',
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    if(data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Hapus',
                            text: 'Proses hapus data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errRules').html(msg.error(data.message));
                                $('#frmRules').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmRules').waitMe('hide');
                        swalAlert.fire({
                            title: 'Berhasil Hapus',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errRules').html(msg.success(data.message));
                                getDataListRules(data.kode);
                            }
                        })
                    }
                }).fail(function() {
                    $('#errRules').html(msg.error('Harap periksa kembali data yang dihapus'));
                    $('#frmRules').waitMe('hide');
                }).always(function() {
                    $("#btnDeleteRules").html('<i class="fas fa-trash-alt"></i> DELETE RULES');
                    $("#btnDeleteRules").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel ) {
                swalAlert.fire({
                    title: 'Batal Hapus',
                    text: 'Proses hapus data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmRules').waitMe('hide');
                        $("#btnDeleteRules").html('<i class="fas fa-trash-alt"></i> DELETE RULES');
                        $("#btnDeleteRules").removeClass('disabled');
                    }
                })
            }
        })
    });
    //btn update status aktif
    $(document).on('click', '#btnAktifRules', function (e){
        e.preventDefault();
        let token = $('input[name="tokenRules"]').val();
        let rules = [];
        $.each($('#tblRules > tbody input[type="checkbox"]:checked'), function(){
            rules.push($(this).val());
        });
        const postData = {
            'tokenId': token,
            'rulesId': rules,
            'flag'   : '<?= $this->encryption->encrypt('AR'); ?>',
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        // get form action url
        $(this).html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $(this).addClass('disabled');
        run_waitMe($('#frmRules'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin merubah data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site + '/rules/set-rules',
                    type: 'POST',
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    if(data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Update',
                            text: 'Proses update status data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errRules').html(msg.error(data.message));
                                $('#frmRules').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmRules').waitMe('hide');
                        swalAlert.fire({
                            title: 'Berhasil Update',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errRules').html(msg.success(data.message));
                                getDataListRules(data.kode);
                            }
                        })
                    }
                }).fail(function() {
                    $('#errRules').html(msg.error('Harap periksa kembali data yang diupdate'));
                    $('#frmRules').waitMe('hide');
                }).always(function() {
                    $("#btnAktifRules").html('<i class="fas fa-check"></i> AKTIFKAN RULES');
                    $("#btnAktifRules").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel ) {
                swalAlert.fire({
                    title: 'Batal Update',
                    text: 'Proses update status data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmRules').waitMe('hide');
                        $("#btnAktifRules").html('<i class="fas fa-check"></i> AKTIFKAN RULES');
                        $("#btnAktifRules").removeClass('disabled');
                    }
                })
            }
        })
    });
    //btn update status non aktif
    $(document).on('click', '#btnNonaktifRules', function (e){
        e.preventDefault();
        let token = $('input[name="tokenRules"]').val();
        let rules = [];
        $.each($('#tblRules > tbody input[type="checkbox"]:checked'), function(){
            rules.push($(this).val());
        });
        const postData = {
            'tokenId': token,
            'rulesId': rules,
            'flag'   : '<?= $this->encryption->encrypt('NR'); ?>',
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        // get form action url
        $(this).html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $(this).addClass('disabled');
        run_waitMe($('#frmRules'));
        swalAlert.fire({
            title: 'Konfirmasi',
            text: 'Apakah anda ingin merubah data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-check"></i> Ya, lanjutkan',
            cancelButtonText: '<i class="fas fa-times"></i> Tidak, batalkan',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: site + '/rules/set-rules',
                    type: 'POST',
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    if(data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Update',
                            text: 'Proses update status data gagal, silahkan diperiksa kembali',
                            icon: 'error',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errRules').html(msg.error(data.message));
                                $('#frmRules').waitMe('hide');
                            }
                        })
                    } else {
                        $('#frmRules').waitMe('hide');
                        swalAlert.fire({
                            title: 'Berhasil Update',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                $('#errRules').html(msg.success(data.message));
                                getDataListRules(data.kode);
                            }
                        })
                    }
                }).fail(function() {
                    $('#errRules').html(msg.error('Harap periksa kembali data yang diupdate'));
                    $('#frmRules').waitMe('hide');
                }).always(function() {
                    $("#btnNonaktifRules").html('<i class="fas fa-times"></i> NON AKTIFKAN RULES');
                    $("#btnNonaktifRules").removeClass('disabled');
                });
            } else if (result.dismiss === Swal.DismissReason.cancel ) {
                swalAlert.fire({
                    title: 'Batal Update',
                    text: 'Proses update status data telah dibatalkan',
                    icon: 'error',
                    confirmButtonText: '<i class="fas fa-check"></i> Oke',
                }).then((result) => {
                    if (result.value) {
                        $('#frmRules').waitMe('hide');
                        $("#btnNonaktifRules").html('<i class="fas fa-times"></i> NON AKTIFKAN RULES');
                        $("#btnNonaktifRules").removeClass('disabled');
                    }
                })
            }
        })
    });
</script>