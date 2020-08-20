<!-- Navbar -->
<div class="navbar mega-menu" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="res-container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
                <?php
                $logo_firmy = $this->data['plugin_data']['logo_firmy'];
                $logo_firmy_2 = $this->data['plugin_data']['logo_firmy_2'];
                $logo_firmy_3 = $this->data['plugin_data']['logo_firmy_3'];
                $logo_url = $data['meta_settings']['keys']['logo_url']['value'];
                $logo_url_2 = $data['meta_settings']['keys']['logo_url_2']['value'];
                $logo_url_3 = $data['meta_settings']['keys']['logo_url_3']['value'];
                ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy']['show'] == 1) { ?>
                    <a target="_blank" href="<?php echo $logo_url ?>">
                        <img class="logo" src="<?php echo $logo_firmy; ?>" alt="Logo">
                    </a>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy_2']['show'] == 1) { ?>
                    <a target="_blank" href="<?php echo $logo_url_2; ?>">
                        <img class="logo" src="<?php echo $logo_firmy_2; ?>" alt="Logo">
                    </a>
                <?php } ?>
                <?php if ($data['meta_settings']['keys']['logo_firmy_3']['show'] == 1) { ?>
                    <a target="_blank" href="<?php echo $logo_url_3; ?>">
                        <img class="logo" src="<?php echo $logo_firmy_3; ?>" alt="Logo">
                    </a>
                <?php } ?>
            </div>
        </div>
        <!--/end responsive container-->
        <div class="collapse navbar-collapse navbar-responsive-collapse">
            <div class="res-container">
                <ul class="nav navbar-nav">
                    <!-- Home -->
                    <?php
                    foreach ($data['menu_items'] as $row) {
                        $name_url_1 = WWW_PATH . '' . $row['name_url'];
                        ?>
                        <li class="dropdown home <?php echo ($row['name_url'] == $data['webhook'][1]) ? 'active' : false; ?>">
                            <?php if ($row['name_url'] == "no_url") { ?>
                                <a><?php echo $row['name']; ?></a>
                            <?php } else { ?>
                                <a  href="<?php echo $name_url_1; ?>"><?php echo $row['name']; ?></a>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!--/responsive container-->
        </div>
        <!--/navbar-collapse-->
    </div>
    <!--/end contaoner-->
</div>
<!-- End Navbar -->