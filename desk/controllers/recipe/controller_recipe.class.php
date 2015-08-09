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

    function viewRecipe($recipe_id) {
        $login_model = $this->loadModel('recipe');
        $login_model_item = $this->loadModel('item');
        $this->view->recipe = $login_model->getSpecificRecipe(base64_decode($recipe_id));
        $this->view->recipe_items = $login_model->getItemsSpecificrecipe(base64_decode($recipe_id));
        $this->view->items = $login_model_item->getAllActiveItem();
        $this->view->history = $login_model->history(base64_decode($recipe_id));
        $this->view->render('recipe/view_recipe', true, true, $this->module);
    }

    function addNewRecipe() {
        $valid = true;
        $data = array();
        $recipe = array();
        $login_model = $this->loadModel('recipe');
        if (!$recipe_name = $this->read->get("recipe_name", "POST", 'NUMERIC', 250, false))
            $valid = false;
        if (!$recipe_remark = $this->read->get("recipe_remark", "POST", '', 1500, false))
            $valid = false;
        if (!$recipe_items = $this->read->get("items", "POST", '', '', true))
            $valid = false;
        if (!$old_recipe_id = $this->read->get("old_recipe_id", "POST", '', '', false))
            $valid = false;
        $old_recipe_id = (is_bool($old_recipe_id) ? '' : ($old_recipe_id));

        $item_array = (array) json_decode($recipe_items);
        if ($valid) {
            if (!empty($item_array)) {
                array_push($recipe, $recipe_name);
                array_push($recipe, 'A');
                array_push($recipe, $recipe_remark);
                array_push($recipe, $item_array);
                if ($old_recipe_id) {
                    $status = $login_model->getSpecificRecipe($old_recipe_id);
                    if ($status->RECIPE_MODE == 'S' OR $status->RECIPE_MODE == 'P') {//Status save  or submit 
                        $res = $login_model->modifyRecipe($old_recipe_id, $recipe);
                    } else {
                        $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_RECIPE_UPDATE_FAILED);
                        exit(json_encode($data));
                    }
                } else {
                    $res = $login_model->saveNewRecipe($recipe);
                }
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

    function importRecipe($recipe_id) {
        $valid = true;
        $data = array();
        $recipe_id = base64_decode($recipe_id);
        if ($recipe_id) {
            $login_model = $this->loadModel('recipe');
            $login_model_item = $this->loadModel('item');
            $this->view->items = $login_model_item->getAllActiveItem();
            $this->view->recipe = $login_model->getSpecificRecipe($recipe_id);
            $this->view->recipe_items = $login_model->getItemsSpecificrecipe($recipe_id);
            $this->view->render('recipe/import_recipe', true, true, $this->module);
        } else {
            header('Location: ' . MOD_ADMIN_URL . "recipe");
        }
    }

    function jsonStatus($recipe_id = null, $stsus = null) {
        $data = '';
        if ($recipe_id && ($stsus == 'D' OR $stsus == 'A' OR $stsus == 'I')) {
            $login_model = $this->loadModel('recipe');
            $count = $login_model->recipeUsed($recipe_id);
            if ($count > 0 && $stsus == 'D') {
                 $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_RECIPE_DELETE_FAILED);
            } else {
                $item = $login_model->modifyStatus($recipe_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_RECIPE_ID);
        }
        echo json_encode($data);
    }

    function jsonMode($recipe_id = null, $stsus = null) {
        $data = '';
        $login_model = $this->loadModel('recipe');
        $mode = $login_model->getSpecificRecipe($recipe_id);
        if ($mode->RECIPE_MODE == 'A' && $stsus == 'P') {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_INVALID_ACTION);
        } else {
            if ($recipe_id && ($stsus == 'P' OR $stsus == 'A')) {
                $item = $login_model->modifyMode($recipe_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_RECIPE_ID);
            }
        }

        echo json_encode($data);
    }

}

?>