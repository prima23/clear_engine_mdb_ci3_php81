<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= 'Login | ' . (isset($appName) ? $appName : ''); ?></title>
  <meta name="description" content="<?= isset($appDescs) ? $appDescs : ''; ?>">
  <meta name="author" content="<?= isset($appAuthor) ? $appAuthor : ''; ?>">
  <meta name="keywords" content="<?= isset($appKeys) ? $appKeys : ''; ?>" />
  <link rel="icon" type="image/png" href="<?php echo $this->asset->image_path((isset($appFavico) ? $appFavico : '')) ?>">
  <!-- Font Awesome -->
  <?= $this->asset->css('themes/fontawesome/css/all.css'); ?>
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
  <!-- Bootstrap core CSS -->
  <?php echo $this->asset->css('themes/bootstrap.min.css'); ?>
  <!-- Material Design Bootstrap -->
  <?php echo $this->asset->css('themes/mdb.min.css'); ?>
  <!-- Your custom styles (optional) -->

  <style>
    html,
    body,
    header,
    .view {
      height: 100%;
    }

    @media (min-width: 851px) and (max-width: 1440px) {

      html,
      body,
      header,
      .view {
        height: 850px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .view {
        height: 1000px;
      }
    }

    @media (min-width: 451px) and (max-width: 740px) {

      html,
      body,
      header,
      .view {
        height: 1200px;
      }
    }

    @media (max-width: 450px) {

      html,
      body,
      header,
      .view {
        height: 1400px;
      }
    }
  </style>
  <style>
    .gradient-custom {
      background: rgb(255, 244, 244);
      background: linear-gradient(118deg, rgba(255, 244, 244, 1) 0%, rgba(194, 228, 124, 0.24413515406162467) 20%, rgba(0, 203, 98, 0.2049194677871149) 39%, rgba(85, 148, 255, 0.5858718487394958) 62%, rgba(85, 223, 255, 0.5858718487394958) 86%);
    }

    .hide {
      display: none;
    }
  </style>
</head>

<body class="gradient-custom p-3">
  <div class="container justify-content-center align-items-center">
    <div class="card mt-5 mb-5 p-4">
      <div class="card-body">
        <div class="row mt-5">
          <div class="col-md-5">
            <div class="row pb-4 d-flex justify-content-center mb-4">
              <div class="inline-ul text-center d-flex justify-content-center fadeInUp animated">
                <a class="p-2 m-2 fa-lg tw-ic">
                  <strong class="text-dark"><i class="fas fa-sign-in-alt"> </i> Login | </strong> <i class="indigo-text">Aplikasi xxxxx</i>
                </a>
              </div>
            </div>
            <div class="alert alert-danger mt-n5 hide" id="pesanErr" role="alert">
            </div>
            <div class="app-screen-body">

            </div>
            <?php echo form_open('auth/signin/login', array('id' => 'formLogin', 'novalidate' => '')); ?>
            <?php echo form_hidden('authorization', $this->encryption->encrypt('login')); ?>
            <?php echo $this->session->flashdata('message'); ?>
            <div class="md-form">
              <i class="fas fa-user prefix"></i>
              <input type="text" name="username" id="username" class="form-control">
              <label for="username">Inputkan Username Anda</label>
            </div>
            <div class="md-form mt-5">
              <i class="fas fa-lock prefix"></i>
              <input type="password" name="password" id="password" class="form-control">
              <label for="password">Inputkan Password Anda</label>
            </div>
            <div class="text-center">
              <button class="btn btn-indigo btn-rounded mt-3 pulse animated"><i class="fas fa-sign-in-alt mr-2"></i> LOGIN</button>
            </div>
            <?php echo form_close(); ?>

          </div>
          <div class="col-md-6 ml-lg-5 ml-md-3 border-left pl-5">

            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="<?= image_url('background/b1.svg') ?>" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h5 style="text-shadow: 2px 2px 4px #000000;">Aplikasi xxxxx</h5>
                    <p style="text-shadow: 2px 2px 4px #000000;">Aplikasi ini terhubung dengan Simpeg, Abon dan E-kinerja</p>
                  </div>
                </div>
                <div class="carousel-item active">
                  <img src="<?= image_url('background/b2.svg') ?>" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Aplikasi xxxxx</h5>
                    <p>Aplikasi ini terhubung dengan Simpeg, Abon dan E-kinerja</p>
                  </div>
                </div>
                <div class="carousel-item active">
                  <img src="<?= image_url('background/b3.svg') ?>" alt="...">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Aplikasi xxxxx</h5>
                    <p>Aplikasi ini terhubung dengan Simpeg, Abon dan E-kinerja</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--  SCRIPTS  -->
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!-- Bootstrap tooltips -->
  <?php echo $this->asset->js('themes/popper.min.js'); ?>
  <!-- Bootstrap core JavaScript -->
  <?php echo $this->asset->js('themes/bootstrap.min.js'); ?>
  <!-- MDB core JavaScript -->
  <?php echo $this->asset->js('themes/mdb.min.js'); ?>

  <!-- Custom scripts -->
  <script>
    new WOW().init();
  </script>
  <script type="text/javascript">
    let csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    let site = '<?php echo site_url(); ?>';
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
          console.log(data);
          $('input[name="' + csrfName + '"]').val(data.csrfHash);
          if (data.status == 0) {
            $('#formLogin').addClass('was-validated');
            $('#errLog').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
              '<strong>Error!</strong></br>' +
              '<span id="pesanErr"> Silahkan dilengkapi data pada form dibawah</span>' +
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
              '<span aria-hidden="true">&times;</span>' +
              '</button>' +
              '</div>');
            $.each(data.message, function(key, value) {
              if (key != 'isi') {
                $('#pesanErr').html('Silahkan dilengkapi data pada form dibawah');
                $('input[name="' + key + '"]').closest('div.required').find('div.invalid-feedback').text(value);
              } else {
                $('#pesanErr').html(value);
                $('#pesanErr').fadeIn('slow');
                $('#username').addClass('invalid');

              }
            });
          } else if (data.status == 1) {
            location.href = data.message.url;
          } else if (data.status == 2) {
            $('.app-screen-body').html(data.message);
          }
        }).fail(function() {
          $('#errLog').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            '<strong>Error!</strong></br>Harap periksa kembali data yang diinputkan' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
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