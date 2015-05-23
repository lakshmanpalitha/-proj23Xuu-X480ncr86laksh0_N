
<body class="page-body login-page login-form-fall">
    <div class="login-container">

        <div class="login-header login-caret">

            <div class="login-content">

                <a href="index.html" class="logo">
                    <img src="<?php echo IMAGE_PATH ?>logo@2x.png" width="120" alt="" />
                </a>

                <p class="description">Dear user, log in to access the admin area!</p>

                <!-- progress bar indicator -->
                <div class="login-progressbar-indicator">
                    <h3>43%</h3>
                    <span>logging in...</span>
                </div>
            </div>

        </div>

        <div class="login-progressbar">
            <div></div>
        </div>

        <div class="login-form">

            <div class="login-content">

                <div class="form-login-error">
                    <h3>Invalid login</h3>
                    <p></p>
                </div>

                <form method="post" role="form" action="<?php URL ?>login/doLogin/" id="form_login">

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-user"></i>
                            </div>

                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" />
                        </div>

                    </div>

                    <div class="form-group">

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="entypo-key"></i>
                            </div>

                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                        </div>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-login">
                            <i class="entypo-login"></i>
                            Login In
                        </button>
                    </div>

                    <!-- Implemented in v1.1.4 -->
                    <!--                        <div class="form-group">
                                                <em>- or -</em>
                                            </div>
                    
                                            <div class="form-group">
                    
                                                <button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left facebook-button">
                                                    Login with Facebook
                                                    <i class="entypo-facebook"></i>
                                                </button>
                    
                                            </div>-->

                    <!-- 
                    
                    You can also use other social network buttons
                    <div class="form-group">
                    
                            <button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left twitter-button">
                                    Login with Twitter
                                    <i class="entypo-twitter"></i>
                            </button>
                            
                    </div>
                    
                    <div class="form-group">
                    
                            <button type="button" class="btn btn-default btn-lg btn-block btn-icon icon-left google-button">
                                    Login with Google+
                                    <i class="entypo-gplus"></i>
                            </button>
                            
                    </div> -->

                </form>


                <div class="login-bottom-links">

                    <a href="extra-forgot-password.html" class="link">Forgot your password?</a>

                    <br />

                    <a href="#">ToS</a>  - <a href="#">Privacy Policy</a>

                </div>

            </div>

        </div>

    </div>


    <!-- Bottom scripts (common) -->
    <script src="<?php echo JS_PATH ?>gsap/main-gsap.js"></script>
    <script src="<?php echo JS_PATH ?>jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo JS_PATH ?>bootstrap.js"></script>
    <script src="<?php echo JS_PATH ?>joinable.js"></script>
    <script src="<?php echo JS_PATH ?>resizeable.js"></script>
    <script src="<?php echo JS_PATH ?>neon-api.js"></script>
    <script src="<?php echo JS_PATH ?>jquery.validate.min.js"></script>
    <script src="<?php echo JS_PATH ?>neon-login.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo JS_PATH ?>neon-custom.js"></script>


    <!-- Demo Settings -->
    <script src="<?php echo JS_PATH ?>neon-demo.js"></script>
