<?php

class recipe extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $login_model = $this->loadModel('recipe');
        $this->view->recipes = $login_model->getAllRecipe();
        $this->view->render('recipe/recipe', true, true, $this->module);
    }

    function newRecipe() {
        $login_model = $this->loadModel('recipe');
        $login_model_item = $this->loadModel('item');
        $this->view->items = $login_model_item->getAllActiveItem();
        $this->view->render('recipe/add_recipe', true, true, $this->module);
    }

    function addNewRecipe() {
        $valid = true;
        $data = array();
        $recipe = array();
        $login_model = $this->loadModel('recipe');
        if (!$recipe_name = $this->read->get("recipe_name", "POST", 'NUMERIC', 250, false))
            $valid = false;
        if (!$recipe_status = $this->read->get("recipe_status", "POST", 'STRING', 1, true))
            $valid = false;
        if (!$recipe_remark = $this->read->get("recipe_remark", "POST", '', 1500, false))
            $valid = false;
        if (!$recipe_items = $this->read->get("items", "POST", '', '', true))
            $valid = false;
        $item_array = (array) json_decode($recipe_items);
        if ($valid) {
            if (!empty($item_array)) {
                array_push($recipe, $recipe_name);
                array_push($recipe, $recipe_status);
                array_push($recipe, $recipe_remark);
                array_push($recipe, $item_array);
                
                $res = $login_model->saveNewRecipe($recipe);
                if ($res) {
                    $data = array('success' => true, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_GRN_ITEMS);
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>