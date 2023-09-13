<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?= (isset($page_name) ? $page_name : ''). ' | ' .(isset($app_name) ? $app_name : '');?></title>
<link rel="icon" type="image/png" href="<?php echo $this->asset->image_path((isset($app_favico) ? $app_favico : '')) ?>">
<!-- Font Awesome -->
<?= $this->asset->css('themes/fontawesome/css/all.css'); ?>
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
<!-- Bootstrap core CSS -->
<?= $this->asset->css('themes/bootstrap.min.css'); ?>

<!-- Material Design Bootstrap -->
<?= $this->asset->css('themes/mdb.min.css'); ?>
<!-- Datatables CSS-->
<?= $this->asset->css('addons/datatables.min.css'); ?>
<?= $this->asset->css('addons/datatables-select.min.css'); ?>
<!-- NProgress CSS -->
<?= $this->asset->css('plugins/nprogress/nprogress.css'); ?>
<!-- Select2 CSS -->
<?= $this->asset->css('plugins/select2/dist/css/select2.css'); ?>
<!-- Sweet Alert -->
<?= $this->asset->css('plugins/sweetalert2/dist/sweetalert2.min.css'); ?>
<!-- Waitme CSS -->
<?= $this->asset->css('plugins/waitme/waitMe.css'); ?>
<!-- Animated CSS -->
<?= $this->asset->css('modules/animations-extended.min.css'); ?>
<!-- Our Custom CSS -->
<?= $this->asset->css('themes/style.css'); ?>
<!-- CSS per Page -->
<?= isset($page_css) ? $page_css : ''; ?>