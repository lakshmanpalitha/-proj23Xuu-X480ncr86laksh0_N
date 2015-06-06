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
            <li class="active opened active">
                <a href="index.html">
                    <i class="entypo-gauge"></i>
                    <span class="title">Grn</span>
                </a>
                <ul>
                    <li class="active">
                        <a href="<?php echo MOD_ADMIN_URL . "grn" ?>">
                            <span class="title">Grn</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="<?php echo MOD_ADMIN_URL . "grn/newGrn" ?>">
                            <span class="title">Add Grn</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="">
                    <i class="entypo-layout"></i>
                    <span class="title">Recipe</span>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo MOD_ADMIN_URL . "recipe" ?>">
                            <span class="title">Recipe</span>
                        </a>
                    </li> 
                    <li>
                        <a href="<?php echo MOD_ADMIN_URL . "recipe/newRecipe" ?>">
                            <span class="title">Add Recipe</span>
                        </a>
                    </li>        
                </ul>
            </li>
            <li>
                <a href="">
                    <i class="entypo-layout"></i>
                    <span class="title">Product</span>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo MOD_ADMIN_URL . "product" ?>">
                            <span class="title">Product</span>
                        </a>
                    </li>  
                    <li>
                        <a href="<?php echo MOD_ADMIN_URL . "product/newProduct" ?>">
                            <span class="title">Add Product</span>
                        </a>
                    </li>        
                </ul>
            </li>
            <li>
                <a href="<?php echo MOD_ADMIN_URL . "report" ?>">
                    <i class="entypo-newspaper"></i>
                    <span class="title">Reports</span>
                </a>
            </li>
            <li>
                <a href="<?php echo MOD_ADMIN_URL . "user" ?>">
                    <i class="entypo-chart-bar"></i>
                    <span class="title">Users</span>
                </a>
            </li>
            <li>
                <a href="<?php echo MOD_ADMIN_URL . "vendor" ?>">
                    <i class="entypo-chart-bar"></i>
                    <span class="title">Vendors</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="entypo-layout"></i>
                    <span class="title">Stock</span>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo MOD_ADMIN_URL . "stock" ?>">
                            <span class="title">Stock</span>
                        </a>
                    </li>  
                    <li>
                        <a href="<?php echo MOD_ADMIN_URL . "stock/item" ?>">
                            <span class="title">Add Item</span>
                        </a>
                    </li>        
                </ul>
            </li>
        </ul>

    </div>

</div>