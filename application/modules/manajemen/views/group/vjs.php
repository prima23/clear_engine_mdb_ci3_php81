<script type="text/javascript">

    getDataListGroup();

    function getDataListGroup() {
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
                    "className":'lblGroup'
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
                                getDataListGroup();
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
    $(document).on('click', '.btnEdit', function(e) {
        formReset();
        $('#formEntry').attr('action', site + '/update');
        let token = $(this).data('id');
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        getDataGroup(token);
    });
    function getDataGroup(token) {
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
                    $('#nama_group').val(data.message.nama);
                    $('#level_akses').select2().val(data.message.akses).trigger("change");
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
                                getDataListGroup();
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
    //panggil form privilege
    $(document).on('click', '.btnPrivilage', function(e) {
        $('#modalRulesForm').modal({
            backdrop: 'static'
        });
        let token = $(this).data('id');
        let label = $(this).closest('tr').find('td.lblGroup').text();
        $('input[name="tokenGroup"]').val(token);
        $('.lblNameGroup').text(label);
        getDataListPrivilage(token);
    });
    //panggil data privilege
    function getDataListPrivilage(token) {
        let html = '';
        $.ajax({
            type: 'GET',
            url: site + '/privileges',
            data: {'token' : token, '<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()},
            dataType: 'json',
            success: function(data) {
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.status = 'RC200') {
                    if(Object.keys(data.message).length > 0) {
                        $.each(data.message, function(listmodule, module){
                            let m_class = 'm_'+ listmodule.toLowerCase().replace(' ', '');
                            html += '<div class="card mt-3 py-3 px-3 blue-grey lighten-5">';
                                html += '<div class="row">';
                                    html += '<div class="col-12 col-md-12">';
                                        html += '<div class="custom-control custom-checkbox">';
                                            html += '<input type="checkbox" class="custom-control-input checkall" id="'+m_class+'">';
                                            html += '<label class="custom-control-label font-weight-bold text-danger" for="'+m_class+'">Module '+listmodule+'</label>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                                html += '<div class="row">';
                                    let i=0;
                                    $.each(module, function(listkontrol, kontrol){
                                        i++;
                                        let k_class = m_class+'_'+'k_'+ listkontrol.toLowerCase().replace(' ', '');
                                        html += '<div class="col-6 col-sm-3 col-md-3">';
                                            html += '<div class="custom-control custom-checkbox">';
                                                html += '<input type="checkbox" class="custom-control-input checkall '+m_class+'" id="'+k_class+'">';
                                                html += '<label class="custom-control-label font-weight-bolder" for="'+k_class+'">'+listkontrol+'</label>';
                                            html += '</div>';
                                            $.each(kontrol, function(fungsi, row){
                                                let f_class = k_class+'_'+'f_'+ row['title_fungsi'].toLowerCase().replace(' ', '');
                                                html += '<div class="custom-control custom-checkbox">';
                                                    html += '<input type="checkbox" class="custom-control-input checkall '+m_class+' '+k_class+'" id="'+f_class+'" name="prvlg[]" value="'+row.id_rules+'" '+row.checked+'>';
                                                    html += '<label class="custom-control-label" for="'+f_class+'">'+row.title_fungsi+'</label>';
                                                html += '</div>';
                                            });
                                        html += '</div>';
                                        if(i==4) html += '</div><div class="row mt-2">';
                                    });
                                html += '</div>';
                            html += '</div>';
                        });
                    } else
                        html = '';
                } else
                    html = '';
                $('#listRules').html(html);
                checkedParent();
            }
        });
    }
    function checkedParent() {
        $.each($('input[name="prvlg[]"]:checked'), function(){
            let classNames = $(this).attr('class').split(' ');
            for (index = classNames.length - 1; index > 0; --index) {
                let lenAll = $('.' + classNames[index]).length;
                //hitung semua chekbox yang di ckelist
                let lenIsChecked = $('.' + classNames[index] + ':checked').length;
                //jika hasilnya sama maka lakukan checklis
                $.each($('#' + classNames[index]), function () {
                    if (lenAll === lenIsChecked)
                        this.checked = true;
                    else
                        this.checked = false;
                });
            }
        });
    }
    // Handle click on "checked" control
    $(document).on('change', 'input[type="checkbox"]', function () {
        //cek ke bawah
        let id = $(this).attr('id');
        if($('#'+id).is(':checked')){
            $('.'+id).prop('checked', 'checked');
        } else {
            $('.'+id).prop('checked', '');
        }
        //cek ke atas
        let classNames = $(this).attr('class').split(' ');
        for (index = classNames.length - 1; index > 0; --index) {
            let lenAll = $('.' + classNames[index]).length;
            //hitung semua chekbox yang di ckelist
            let lenIsChecked = $('.' + classNames[index] + ':checked').length;
            //jika hasilnya sama maka lakukan checklis
            $.each($('#' + classNames[index]), function () {
                if (lenAll === lenIsChecked)
                    this.checked = true;
                else
                    this.checked = false;
            });
        }
    });
    //btn save rules
    $(document).on('click', '#btnSaveRules', function (e){
        e.preventDefault();
        let token = $('input[name="tokenGroup"]').val();
        let rules = [];
        $.each($('#listRules input[type="checkbox"][name="prvlg[]"]:checked'), function(){
            rules.push($(this).val());
        });
        console.log(rules);
        const postData = {
            'tokenId': token,
            'rulesId': rules,
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        // get form action url
        $(this).html('<i class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></i> DIPROSES...');
        $(this).addClass('disabled');
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
                    url: site + '/privileges/save-access',
                    type: 'POST',
                    data: postData,
                    dataType: "json",
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    if(data.status == 'RC404') {
                        swalAlert.fire({
                            title: 'Gagal Simpan',
                            text: 'Proses simpan data gagal, silahkan diperiksa kembali',
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
                        $('#modalRulesForm').modal('toggle');
                        swalAlert.fire({
                            title: 'Berhasil Simpan',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: '<i class="fas fa-check"></i> Oke',
                        }).then((result) => {
                            if (result.value) {
                                getDataListGroup();
                            }
                        })
                    }
                }).fail(function() {
                    $('#errRules').html(msg.error('Harap periksa kembali data yang disimpan'));
                    $('#frmRules').waitMe('hide');
                }).always(function() {
                    $("#btnSaveRules").html('<i class="fas fa-check"></i> SAVE PRIVILEGE');
                    $("#btnSaveRules").removeClass('disabled');
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
                        $("#btnSaveRules").html('<i class="fas fa-check"></i> SAVE PRIVILEGE');
                        $("#btnSaveRules").removeClass('disabled');
                    }
                })
            }
        })
    });
</script>