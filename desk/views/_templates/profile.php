<div class="row">
    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">
        <ul class="user-info pull-left pull-none-xsm">
            <!-- Profile Info -->
            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<!--                    <img src="<?php echo IMAGE_PATH ?>thumb-1@2x.png" alt="" class="img-circle" width="44" />-->
                    <?php echo session::get('user_email'); ?>
                </a>
            </li>
        </ul>
    </div>
    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">
        <ul class="list-inline links-list pull-right">
            <li class="sep"></li>
            <li>
                <a href="<?php echo MOD_ADMIN_URL ?>login/logout/">
                    Log Out <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>