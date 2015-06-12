
<div class="sidebar-menu">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <!--                <a href="index.html">
                                    <img src="<?php echo IMAGE_PATH ?>logo@2x.png" width="120" alt="" />
                                </a>-->
                <h2>Biotech</h2>
            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>


            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

        </header>


        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

            <?php
            if (!empty($this->display_user_module_array)) {
                foreach ($this->display_user_module_array as $mod) {
                    
                    ?>

                    <li>
                        <a href="index.html">
                            <i class="entypo-gauge"></i>
                            <span class="title"><?php echo $mod['MOD'] ?></span>
                        </a>

                        <ul>
                            <?php
                            if (is_array($mod['DOC'])) {
                                foreach ($mod['DOC'] as $doc) {
                                    ?>
                                    <li class="active">
                                        <a href="<?php echo MOD_ADMIN_URL . strtolower($doc) ?>">
                                            <span class="title"><?php echo $doc ?></span>
                                        </a>
                                    </li>
                                <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>

    </div>

</div>