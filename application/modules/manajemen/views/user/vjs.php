<script type="text/javascript">
    let load      = 0;
    let unit_id   = 0;
    getDataListUser();
    $(document).on('click', '.btnFilter', function(e){
        $('#formFilter').slideToggle('slow');
        $('form#formFilter').trigger('reset');
        $('form#formFilter .select-all').select2().val('').trigger("change");
    });

    $(document).on('click', '#cancel', function(e){
        e.preventDefault();
        $('#formFilter').slideToggle('slow');
        $('form#formFilter').trigger('reset');
        $('form#formFilter .select-all').select2().val('').trigger("change");
        getDataListUser();
    });
    $('#formFilter').submit(function(e){
        e.preventDefault();
        getDataListUser();
    });
    function getDataListUser() {
        $('#tblList').dataTable({
            "pagingType": "full_numbers",
            "destroy": true,
            "processing":true,
            "language": {
                "loadingRecords": '&nbsp;',
                "processing": 'Loading data...'
            },
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": site + '/listview',
                "type": "POST",
                "data": {
                    "param" : $('#formFilter').serializeArray(),
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
                    "targets": [ -1, -2, -3 ], //last column
                    "orderable": false, //set not orderable
                    "className":'text-center'
                },
            ],
        });
        $('#tblList_filter input').addClass('form-control').attr('placeholder','Search Data');
        $('#tblList_length select').addClass('form-control');
    }
    // Handle click on "check all" control
    $(document).on('click', '#checkAll', function(){
        $('#tblList > tbody input[type=checkbox]').prop('checked', this.checked).trigger('change');
    });
    // Handle click on "checked" control
    $(document).on('change', '#tblList > tbody input[type=checkbox]', function (e) {
        const rowCount = $('#tblList > tbody input[type=checkbox]').length;
        const n = $('#tblList > tbody input[type=checkbox]').filter(':checked').length;
        if(n > 0)
            $('#btnDelete').show();
        else
            $('#btnDelete').hide();

        if(rowCount == n)
            $('#checkAll').prop('checked', 'checked');
        else
            $('#checkAll').prop('checked', '');
    });
    $(document).on('click', '#tblList > tbody > tr', function(){
        let n = $(this).find('input[type=checkbox]');
        n.prop('checked', (n.is(':checked')) ? false : true).trigger('change');
    });
    //panggil form Entri
    $(document).on('click', '#btnAdd', function(e){
        formReset2();
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
    });


    //close form entri
    $(document).on('click', '.btnClose', function(e) {
        //get modal id
        let id = $(this).closest('div.modal').attr('id');
        formReset2();
        $('#'+id).modal('toggle');
    });
    function formReset2() {
        $('#status').select2().val('1').trigger("change");
        $('#blokir').select2().val('0').trigger("change");
        $('#status').select2().val('1').trigger("change");
        $('form#formEntry .select-all').select2().val('').trigger("change");
        $('#formEntry').attr('action', site + '/create');
        $('#errEntry').html('');
        $('#errSuccess').html('');
        $('form#formEntry').trigger('reset');
        $('form#formEntry').removeClass('was-validated');
        $('.lblPass').text('*');
        $('.progress-title').text('');
        $('.contextual-progress').hide();
        $("#fopd").hide('slow');
    }
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
                    data: postData + '&unit_id_name='+$("#opd option:selected").text(),
                    dataType: "json",
                    success: function(){

                    },error: function(e){
                        console.log(e);
                    }
                }).done(function(data) {
                    $('input[name="'+csrfName+'"]').val(data.csrfHash);
                    console.log(data);
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
                                    if(key != 'isi'){
                                        if(key == 'password'){
                                            $('input[name="'+key+'"]').val('');
                                            $('input[name="conf_password"]').val('');
                                        }
                                        $('input[name="'+key+'"], select[name="'+key+'"]').closest('div.required').find('div.invalid-feedback').text(value);
                                    }
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
                                $('#errSuccess').html(msg.success(data.message)).delay(1600).fadeOut('slow');
                                getDataListUser();
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
        e.stopPropagation();
        formReset2();
        $('#formEntry').attr('action', site + '/update');
        let token = $(this).data('id');
        $('.lblPass').text('');
        $('#modalEntryForm').modal({
            backdrop: 'static'
        });
        getDataUser(token);

    });
    
    function getDataUser(token) {
        run_waitMe($('#frmEntry'));
        $.ajax({
            type: 'POST',
            url: site + '/details',
            data: {'tokenId' : token, '<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()},
            dataType: 'json',
            success: function(data) {
                $('#frmEntry').waitMe('hide');
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.status == 'RC200') {
                    unit_id = data.message.unit_id;
                    $('input[name="tokenId"]').val(token);
                    $('#fullname').val(data.message.fullname);
                    $('#username').val(data.message.username);
                    $('#blokir').select2().val(data.message.blokir).trigger("change");
                    $('#status').select2().val(data.message.status).trigger("change");
                    $('#opd').select2().val(data.message.unit_id).trigger("change");
                    $.each(data.message.groupid, function(key, g){
                        $('input[type="checkbox"][name="groupid[]"]#groupid_'+g).prop('checked', true);
                    });
                    if($("#groupid_3").is(':checked')){
                        if(load == 0){
                            getOpd();
                            $("#fopd").show('slow');
                        }else{
                            $("#fopd").show();
                        }
                    }else{
                        $("#fopd").hide('slow');
                    }
                }
                
            }
        });
    }
    $(document).on('click', '#btnDelete', function(e){
        e.preventDefault();
        let token = [];
        $.each($('#tblList > tbody input[type=checkbox]:checked'), function(){
            token.push($(this).val());
        });
        const postData = {
            'tokenId': token,
            '<?php echo $this->security->get_csrf_token_name(); ?>': $('input[name="' + csrfName + '"]').val()
        };
        $(this).html('<i class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></i> DIPROSES...');
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
                                $('#errSuccess').html(msg.error(data.message)).delay(1600).fadeOut('slow');
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
                                $('#errSuccess').html(msg.success(data.message)).delay(1600).fadeOut('slow');
                                getDataListUser();
                                $('#btnDelete').hide();
                            }
                        })
                    }
                    $('#formParent').waitMe('hide');
                }).fail(function() {
                    $('#errSuccess').html(msg.error('Harap periksa kembali data yang akan dihapus')).delay(1600).fadeOut('slow');
                    $('#formParent').waitMe('hide');
                }).always(function() {
                    $('#btnDelete').html('<i class="fas fa-trash-alt"></i> Delete User');
                    $('#btnDelete').removeClass('disabled');
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
                        $('#btnDelete').html('<i class="fas fa-trash-alt"></i> Delete User');
                        $('#btnDelete').removeClass('disabled');
                    }
                })
            }
        })
    });

    $("#groupid_3").on('click checked',function(){
        if($(this).is(':checked')){
            if(load == 0){
                getOpd();
            }
            $("#fopd").show('slow');
        }else{
            $("#fopd").hide('slow');
        }
    });

    function getOpd(){
        $.ajax({
            url: site+'/getOptionOpd',
            type: "POST",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()
            },
            dataType: "json",
            beforeSend: function(){
                $(".loading-simpeg-opd").fadeIn('slow');
            },
            success: function(data) {
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.status == 'RC200') {
                    $(".loading-simpeg-opd > span").html("Conection success...");
                    $("#opd").html(data.dataOption);
                    load = 1;
                }else{
                    $("#label_jabatan").html('<span class="text-danger">* Data Tidak Ditemukan</span>');
                }
            },
            error: function(e){
                $(".loading-simpeg-opd > span").html("Conection API Simpeg error...");
            },            
            complete: function(){
                $('.loading-simpeg-opd').fadeOut('slow');
                $("#text-opd").fadeIn('slow');
                $('#opd').select2().val(unit_id).trigger("change");
            }
        });
    }

    $(document).on('keyup', '#username', function() {
        const name = $(this).val();
        if(name.length > 0)
            checkUsername(name);
    });
    function checkUsername(text='') {
        $.ajax({
            type: 'GET',
            url: site + '/searching',
            data: {'username' : text, '<?php echo $this->security->get_csrf_token_name(); ?>' : $('input[name="'+csrfName+'"]').val()},
            dataType: 'json',
            success: function(data) {
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.message > 0)
                    $('#username').closest('div.required').find('div.valid-username').html('<span class="text-danger">Username sudah ada!</span>');
                else
                    $('#username').closest('div.required').find('div.valid-username').html('');
            }
        });
    }
    const defaults = {minimumChars: 8};
    const progressHtml = "<div class='contextual-progress mt-1'>" +
                            "<div class='clearfix'>" +
                                "<div class='progress-title grey-text font-weight-bolder font-small'></div>" +
                            "</div>" +
                            "<div class='progress' style='height: 3px;'>" +
                                "<div id='password-progress' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%;'></div>" +
                            "</div>" +
                         "</div>";
    $(progressHtml).insertAfter($('input[type=password]:first').closest('div.input-group'));
    $('.progress-title').text('');
    $('.contextual-progress').hide();
    $('#password').keyup(function (event) {
        $('.contextual-progress').show();
        const element = $(event.target);
        const password = element.val();
        if (password.length == 0) {
            $('.progress-title').html('');
            $('.contextual-progress').hide();
        } else {
            const score = calculatePasswordScore(password, defaults);
            $('.progress-bar').css('width', score + '%').attr('aria-valuenow', score);
            if(score == 0) {
                $('.progress-title').html('Too short')
            } else if (score < 50) {
                $('.progress-title').html('Weak password');
                $('#password-progress').removeClass();
                $('#password-progress').addClass('progress-bar bg-warning');
            } else if (score >= 50 && score <= 60) {
                $('.progress-title').html('Normal password');
                $('#password-progress').removeClass();
                $('#password-progress').addClass('progress-bar bg-primary');
            } else if (score > 60 && score <= 80) {
                $('.progress-title').html('Good password');
                $('#password-progress').removeClass();
                $('#password-progress').addClass('progress-bar bg-success');
            } else if(score > 80) {
                $('.progress-title').html('Strong password');
                $('#password-progress').removeClass();
                $('#password-progress').addClass('progress-bar bg-danger');
            }
        }
    });
    $('#conf_password').keyup(function (event) {
        $('.progress-title').html('');
        $('.contextual-progress').hide();
        let password = $('#password').val();
        let confirm  = $(this).val();
        if(password !==  confirm && confirm.length > 0)
            $(this).closest('div.required').parent('div').find('div.valid-password').html('<span class="text-danger">Password tidak cocok!</span>');
        else
            $(this).closest('div.required').parent('div').find('div.valid-password').html('');
    });
    $(document).on('click', '.showPass', function(e) {
        let div = $(this).closest('div.input-group');
        let id  = div.find('input').attr('id');
        if($(this).hasClass('open')) {
            div.find('#'+id).attr('type', 'password');
            $(this).removeClass('open').addClass('closed').html('<i class="fa fa-eye"></i>');
        } else {
            div.find('#'+id).attr('type', 'text');
            $(this).removeClass('closed').addClass('open').html('<i class="fa fa-eye-slash"></i>');
        }
    });

    

    function calculatePasswordScore(password, options) {
        let count;
        let score = 0;
        let hasNumericChars = false;
        let hasSpecialChars = false;
        let hasMixedCase = false;
        if (password.length < 1)
            return score;
        if (password.length < options.minimumChars)
            return score;
        //match numbers
        if (/\d+/.test(password)) {
            hasNumericChars = true;
            score += 20;
            count = (password.match(/\d+?/g)).length;
            if (count > 1) {
                //apply extra score if more than 1 numeric character
                score += 10;
            }
        }
        //match special characters including spaces
        if (/[\W]+/.test(password)) {
            hasSpecialChars = true;
            score += 20;
            count = (password.match(/[\W]+?/g)).length;
            if (count > 1) {
                //apply extra score if more than 1 special character
                score += 10;
            }
        }
        //mixed case
        if ((/[a-z]/.test(password)) && (/[A-Z]/.test(password))) {
            hasMixedCase = true;
            score += 20;
        }
        if (password.length >= options.minimumChars && password.length < 12) {
            score += 10;
        } else if (!hasMixedCase && password.length >= 12) {
            score += 10;
        }
        if ((password.length >= 12 && password.length <= 15) && (hasMixedCase && (hasSpecialChars || hasNumericChars))) {
            score += 20;
        } else if (password.length >= 12 && password.length <= 15) {
            score += 10;
        }
        if ((password.length > 15 && password.length <= 20) && (hasMixedCase && (hasSpecialChars || hasNumericChars))) {
            score += 30;
        } else if (password.length > 15 && password.length <= 20) {
            score += 10;
        }
        if ((password.length > 20) && (hasMixedCase && (hasSpecialChars || hasNumericChars))) {
            score += 40;
        } else if (password.length > 20) {
            score += 20;
        }
        if (score > 100) score = 100;
        return score;
    }
</script>