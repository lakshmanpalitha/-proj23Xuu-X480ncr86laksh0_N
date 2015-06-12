<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. initialize a session
 * 2. check if the user is not logged in anymore (session timeout) but has a cookie
 * 3. create a database connection (that will be passed to all models that need a database connection)
 * 4. create a view object
 */
class controller extends common {

    public $user_active_module = array();

    function __construct($module) {

        //intilize module (backoffice or reservation)
        $this->module = $module;

        session::init();


        // create a view object (that does nothing, but provides the view render() method)

        $this->view = new view($this->module);
        $this->read = new read();
        $this->model = new model();

        $this->userActiveModule();
    }

    /**
     * loads the model with the given name.
     * @param $name string name of the model
     */
    public function loadModel($name, $module = null) {
        $this->module = ($module ? $module : $this->module);
        $path = $this->module . "/" . MODELS_PATH . "model_" . strtolower($name) . '.class.php';
        if (file_exists($path)) {
            require $this->module . "/" . MODELS_PATH . "model_" . strtolower($name) . '.class.php';
            // The "Model" has a capital letter as this is the second part of the model class name,
            // all models have names like "LoginModel"
            $modelName = $name . 'Model';
            return new $modelName();
        }
        return false;
    }

    public function userActiveModule() {
        /* Get user's modules,document type and permission */
        $mod_arrange_array = array();
        $loc_user_active_modules = $this->model->selectUserModule(session::get('user_id'));
        $this->user_active_module = $this->view->user_active_module = $loc_user_active_modules;

        /* Set display module array */
        if (!empty($loc_user_active_modules)) {
            $currunt_mod = '';
            $m = 0;
            $n = 0;
            foreach ($loc_user_active_modules as $mod) {
                if (empty($currunt_mod) OR $currunt_mod != $mod->MODULE_NAME) {
                    $currunt_mod = $mod->MODULE_NAME;
                    $mod_arrange_array[$m]['MOD'] = $currunt_mod;
                    $n = $m;
                    $i = 0;
                    $m++;
                }
                $mod_arrange_array[$n]['DOC'][$i] = $mod->DOC_TYPE_NAME;
                $i++;
            }
        }

        $this->view->display_user_module_array = $mod_arrange_array;
    }

}
