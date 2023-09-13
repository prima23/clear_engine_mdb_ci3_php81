
<!-- Sidebar navigation -->
<div id="slide-out" class="side-nav sn-bg-2 fixed">
    <ul class="custom-scrollbar">

        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
            <div class="text-center">
                <?= $this->asset->image((isset($appIcon) ? $appIcon : ''), '', array('alt' => 'logo-provinsi-sumbar', 'class' => 'mr-1 ml-1')); ?>

            </div>
        </li>

        <!-- Search Form -->
        <li>
            <div class="text-center">
                <h4 class="dark-grey-text"><?= 'Aplikasi <i>' . (isset($app_name) ? $app_name : '').'</i>'; ?></h4>
            </div>
        </li>
        <hr>

        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
            <?= $this->app_loader->create_menu(); ?>
            </ul>
        </li>
        <!-- Side navigation links -->

    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
<!-- Sidebar navigation -->