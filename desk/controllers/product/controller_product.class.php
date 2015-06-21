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
        $this->view->render('product/add_product', true, true, $this->module);
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
        $item_array = (array) json_decode($product_items);
        $recipe_array = (array) json_decode($product_recipe);
        if ($valid) {
            if (!empty($recipe_array)) {
                array_push($product, $product_name);
                array_push($product, $product_status);
                array_push($product, $product_remark);
                array_push($product, $item_array);
                array_push($product, $recipe_array);

                $res = $login_model->saveNewProduct($product);
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