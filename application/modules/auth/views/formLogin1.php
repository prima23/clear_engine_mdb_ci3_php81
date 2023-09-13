<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="in">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= 'Login | '.(isset($appName) ? $appName : ''); ?></title>
    <meta name="description" content="<?= isset($appDescs) ? $appDescs : ''; ?>">
    <meta name="author" content="<?= isset($appAuthor) ? $appAuthor : ''; ?>">
    <meta name="keywords" content="<?= isset($appKeys) ? $appKeys : ''; ?>" />
    <link rel="icon" type="image/png" href="<?php echo $this->asset->image_path((isset($appFavico) ? $appFavico : '')) ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <?php echo $this->asset->css('themes/bootstrap.min.css'); ?>
    <!-- Material Design Bootstrap -->
    <?php echo $this->asset->css('themes/mdb.min.css'); ?>
    <!-- Our Custom CSS -->
    <?php echo $this->asset->css('themes/sign-style.css'); ?>
</head>
<body>
<!-- Start your project here-->
<main class="main">
    <div class="app-container">
        <div class="app-login">
            <div class="app-screen">
                <div class="app-screen-left"></div>
                <div class="app-screen-right">
                    <div class="app-screen-form">
                        <div class="app-screen-header">
<!--                            --><?php //echo $this->asset->image((isset($appIcon) ? $appIcon: ''), '', array('style'=>'width:40%;', 'alt'=>(isset($appName) ? 'Logo '.$appName : 'Logo Aplikasi'))); ?>
                            <h1 class="text-danger font-weight-bold"><?= isset($appName) ? 'Aplikasi '.$appName : ''; ?></h1>
                            <h5 class="mt-2 text-black font-weight-bold font-smaller">Silahkan login untuk masuk ke akun anda</h5>
                        </div>
                        <div class="app-screen-body">
                            <!-- Material form login -->
                            <?php echo form_open('auth/signin/login', array('id'=>'formLogin', 'novalidate'=>'')); ?>
                            <?php echo form_hidden('authorization', $this->encryption->encrypt('login')); ?>
                            <?php echo $this->session->flashdata('message'); ?>
                            <div id="errLog"></div>
                            <!-- Email -->
                            <div class="md-form form-lg required">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="" required>
                                <div class="invalid-feedback">Username harus diisi</div>
                            </div>
                            <!-- Password -->
                            <div class="md-form form-lg required">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="" required>
                                <div class="invalid-feedback">Password harus diisi</div>
                            </div>
                            <div class="row d-flex align-items-center">
                                <!-- Remember me -->
                                <div class="col-md-6 col-6 text-left">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="rememberme" id="rememberme">
                                        <label class="custom-control-label" for="rememberme">Remember me</label>
                                    </div>
                                </div>
                                <!-- Forgot password -->
                                <div class="col-md-6 col-6">
                                    <a href="javascript:;" class="d-flex justify-content-end">Forgot password ?</a>
                                </div>
                            </div>
                            <!-- Sign in button -->
                            <button class="btn btn-primary btn-block my-4" type="submit" name="submit" id="submit">Sign In</button>
                            <?php echo form_close(); ?>
                            <!-- Don't have Account -->
                            <p class="font-small grey-text app-contact">
                                Don't have an account ?
                                <a href="javascript:;" class="text-danger">Please contact admin</a>
                            </p>
                            <!-- copyright -->
                            <?php $year = isset($appYear) ? $appYear : date('Y'); ?>
                            <p class="font-small grey-text text-center"><?= (isset($appAuthor) ? $appAuthor : '').' &copy; '.(($year == date('Y')) ? $year : $year.' - '.date('Y')).' Aplikasi '.(isset($appName) ? $appName : ''); ?></p>
                            <!-- Material form login -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- /Start your project here-->
<!-- SCRIPTS -->
<!-- jQuery CDN - min version -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- Bootstrap tooltips -->
<?php echo $this->asset->js('themes/popper.min.js'); ?>
<!-- Bootstrap core JavaScript -->
<?php echo $this->asset->js('themes/bootstrap.min.js'); ?>
<!-- MDB core JavaScript -->
<?php echo $this->asset->js('themes/mdb.min.js'); ?>
<!-- JavaScript Custom -->
<script type="text/javascript">
    let csrfName  = '<?php echo $this->security->get_csrf_token_name(); ?>';
    let site      = '<?php echo site_url(); ?>';
    $(function() {
        $(document).on('submit', '#formLogin', function(e) {
            e.preventDefault();
            let postData = $(this).serialize();
            let formActionURL = $(this).attr("action");
            $("#submit").html('<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></span>Loading...');
            $("#submit").addClass('disabled');
            $.ajax({
                url: formActionURL,
                type: "POST",
                data: postData,
                dataType: "json"
            }).done(function(data) {
                $('input[name="'+csrfName+'"]').val(data.csrfHash);
                if(data.status == 0) {
                    $('#formLogin').addClass('was-validated');
                    $('#errLog').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                        '<strong>Error!</strong></br>'+
                                        '<span id="pesanErr"> Silahkan dilengkapi data pada form dibawah</span>'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                        '</button>'+
                                      '</div>');
                    $.each(data.message, function(key,value){
                        if(key != 'isi') {
                            $('#pesanErr').html('Silahkan dilengkapi data pada form dibawah');
                            $('input[name="'+key+'"]').closest('div.required').find('div.invalid-feedback').text(value);
                        } else {
                            $('#pesanErr').html(value);
                        }
                    });
                } else if(data.status == 1) {
                    location.href = data.message.url;
                } else if(data.status == 2) {
                    $('.app-screen-body').html(data.message);
                }
            }).fail(function() {
                $('#errLog').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                    '<strong>Error!</strong></br>Harap periksa kembali data yang diinputkan'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                    '<span aria-hidden="true">&times;</span>'+
                                    '</button>'+
                                  '</div>');
            }).always(function(data) {
                $("#submit").html((data.flag == 2) ? 'NEXT' : 'SIGN IN');
                $("#submit").removeClass('disabled');
            });
        });
    });
</script>
</body>
</html>