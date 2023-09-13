<!DOCTYPE html>
<html lang="in">

<head>
    <?= isset($template['partials']['header']) ? $template['partials']['header'] : ''; ?>
</head>

<body class="fixed-sn white-skin" id="body">

        <!-- Dark Overlay element -->
        <div class="overlay"></div>
        <!------------------------- Header  ------------------------>
        <header>
            <!-- Title -->
            <?= isset($template['partials']['title']) ? $template['partials']['title'] : ''; ?>
            <!-- Title -->
            <!-- Navigation -->
            <?= isset($template['partials']['navigation']) ? $template['partials']['navigation'] : ''; ?>
            <!-- Navigation -->
        </header>
        <!----------------------- Header End ----------------------->
        <main class="pt-5 pb-3 mx-lg-3">
            <div class="container-fluid mt-5 mb-5 pt-2">
                <section class="page-header">
                    <div class="row mt-n3">
                        <div class="col-md-7">
                            <h5 class="font-weight-bolder border-bottom text-center darkmode p-2 fadeInLeft animated">
                                <a href="<?= base_url('home'); ?>"><i class="fas fa-home"> </i></a>
                                <span class="text-muted">|</span>
                                <span class="text-muted"><?= isset($page_name) ? $page_name : ''; ?></span>
                            </h5>
                        </div>
                        <div class="col-md-5 text-center">
                            <!-- Breadcrumb -->
                            <!-- <div class="page-header-breadcrumb float-end">
                            <?= $this->breadcrumb->output(); ?>
                        </div> -->
                            <!-- Breadcrumb -->
                            <button id="jam" class="btn blue-gradient btn-rounded btn-sm waves-effect waves-light text-center fadeInRight animated"></button>
                        </div>
                        <br class="d-block d-sm-none">
                    </div>
                </section>
                <!-- Content Wrapper. Contains page content -->
                <?= isset($template['body']) ? $template['body'] : ''; ?>
            </div>
        </main>
        <!------------------------- Footer  ------------------------>
        <!-- page-content -->
        <?= isset($template['partials']['footer']) ? $template['partials']['footer'] : ''; ?>
        <!------------------------- Footer  ------------------------>
        <?= isset($template['partials']['javascript']) ? $template['partials']['javascript'] : ''; ?>

</body>

</html>