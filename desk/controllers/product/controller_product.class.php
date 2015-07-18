<?php

class product extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $login_model = $this->loadModel('product');
        $this->view->products = $login_model->getAllProduct();
        $this->view->render('product/product', true, true, $this->module);
    }

    function newProduct() {
        $login_model = $this->loadModel('product');
        $login_model_item = $this->loadModel('item');
        $login_model_recipe = $this->loadModel('recipe');
        $this->view->items = $login_model_item->getAllActiveItem();
        $this->view->recipes = $login_model_recipe->getAllActiveRecipe();
        $this->view->units = $login_model_item->getAllUnit();
        $this->view->render('product/add_product', true, true, $this->module);
    }

    function viewProduct($product_id) {
        if (!empty($product_id)) {
            $login_model = $this->loadModel('product');
            $login_model_item = $this->loadModel('item');
            $login_model_recipe = $this->loadModel('recipe');
            $this->view->items = $login_model_item->getAllActiveItem();
            $this->view->product_recipes = $login_model->getRecipeSelectProduct(base64_decode($product_id));
            $this->view->product = $login_model->getSelectProduct(base64_decode($product_id));
            $this->view->product_mats = $login_model->getRecipeSelectMaterial(base64_decode($product_id));
            $this->view->recipes = $login_model_recipe->getAllActiveRecipe();
            $this->view->units = $login_model_item->getAllUnit();
            $this->view->render('product/view_product', true, true, $this->module);
        } else {
            header('Location: ' . MOD_ADMIN_URL . "product");
        }
    }

    function jsonGetProductUnit() {
        $data = array();
        $valid = true;
        if (!$product_id = $this->read->get("product_id", "POST", 'NUMERIC', 6, true)) {
            $valid = false;
        }
        if ($valid) {
            $login_model = $this->loadModel('product');
            $data = array('success' => true, 'data' => $login_model->getProductUnit($product_id), 'error' => '');
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function addNewProduct() {
        $valid = true;
        $data = array();
        $product = array();
        $login_model = $this->loadModel('product');
        if (!$product_name = $this->read->get("product_name", "POST", 'NUMERIC', 250, true))
            $valid = false;
        if (!$product_status = $this->read->get("product_status", "POST", 'STRING', 1, true))
            $valid = false;
        if (!$product_remark = $this->read->get("product_remark", "POST", '', 1500, false))
            $valid = false;
        if (!$product_items = $this->read->get("items", "POST", '', '', false))
            $valid = false;
        if (!$product_recipe = $this->read->get("recipes", "POST", '', '', true))
            $valid = false;
        if (!$product_unit_quantity = $this->read->get("product_quantity", "POST", 'DOUBLE', '', true))
            $valid = false;
        if (!$product_quantity_unit = $this->read->get("product_unit", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$old_product_id = $this->read->get("old_product_id", "POST", '', '', false))
            $valid = false;
        $old_product_id = (is_bool($old_product_id) ? '' : ($old_product_id));

        $item_array = (array) json_decode($product_items);
        $recipe_array = (array) json_decode($product_recipe);
        if ($valid) {
            if (!empty($recipe_array)) {
                array_push($product, $product_name);
                array_push($product, $product_status);
                array_push($product, is_bool($product_remark) ? '' : $product_remark);
                array_push($product, $item_array);
                array_push($product, $recipe_array);
                array_push($product, $product_unit_quantity);
                array_push($product, $product_quantity_unit);
                if ($old_product_id) {
                    $status = $login_model->getSelectProduct($old_product_id);
                    if ($status->PRODUCT_MODE == 'S' OR $status->PRODUCT_MODE == 'P') {//Status save  or submit 
                        $res = $login_model->modifyProduct($old_product_id, $product);
                    } else {
                        $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_PRODUCT_UPDATE_FAILED);
                        exit(json_encode($data));
                    }
                } else {
                    $res = $login_model->saveNewProduct($product);
                }
                if ($res) {
                    $data = array('success' => true, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_PRODUCT_RECIPE);
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>