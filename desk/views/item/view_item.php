<body class="page-body  page-fade">
    <div class="page-container">
        <!--Add side bar-->
        <?php require_once MOD_ADMIN_DOC . 'views/_templates/sidebar.php'; ?>
        <!--############-->
        <div class="main-content">
            <!--Add profile bar-->
            <?php require_once MOD_ADMIN_DOC . 'views/_templates/profile.php'; ?>
            <!--############-->
            <ol class="breadcrumb bc-3" >
                <li>
                    <a href="<?php echo MOD_ADMIN_URL ?>"><i class="fa-home"></i>Home</a>
                </li>
                <li>

                    <a href="<?php echo MOD_ADMIN_URL ?>item/">Items</a>
                </li>
                <li>

                    <a href="<?php echo MOD_ADMIN_URL ?>item/viewItem/<?php echo (isset($this->item->ITEM_ID) ? base64_encode($this->item->ITEM_ID) : '') ?>"> View item</a>
                </li>
            </ol>

            <h2>View item</h2>
            <br />
            <?php if (!empty($this->item)) { ?>
                <form role="form" id="form1" method="post" action="<?php echo MOD_ADMIN_URL ?>item/addNewItem" class="validate_sp_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="border:none !important;text-align:right;" class="panel panel-primary">
                                <?php echo (($this->item->ITEM_MODE == 'S' OR $this->item->ITEM_MODE == 'P') ? '<button class="btn btn-green btn-sm" type="submit" type="button">Modify</button>' : '') ?>
                                <?php echo ($this->item->ITEM_MODE == 'S' ? '<button onclick=modifytItemMode("' . $this->item->ITEM_ID . '","P") class="btn btn-gold btn-sm"  type="button">Submit</button>' : '') ?>
                                <?php echo ($this->item->ITEM_MODE == 'P' ? '<button onclick=modifytItemMode("' . $this->item->ITEM_ID . '","A") class="btn btn-blue btn-sm"  type="button">Accept</button>' : '') ?>
                                <input type="hidden" name="old_item_id" value="<?php echo ($this->item->ITEM_ID) ?>" name=""/>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Add New Item&nbsp; &nbsp;
                                <?php
                                if ($this->item->ITEM_MODE == 'S') {
                                    echo '
                                            <button class="btn btn-gold  btn-icon icon-left  btn-xs" type="button">
                                            Draft<i class="entypo-info"></i>
                                            </button>';
                                } else if ($this->item->ITEM_MODE == 'P') {
                                    echo '
                                            <button class="btn btn-blue btn-icon icon-left  btn-xs" type="button">
                                                Submit<i class="entypo-info"></i>
                                            </button>';
                                } else if ($this->item->ITEM_MODE == 'A') {
                                    echo '
                                            <button class="btn btn-green  btn-icon icon-left  btn-xs" type="button">
                                                Accept<i class="entypo-info"></i>
                                            </button>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="panel-body">            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Item Code</label>
                                        <input value="<?php echo $this->item->ITEM_CODE ?>" type="text" class="form-control" name="itm_code"  placeholder="Item code" />
                                    </div>	
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input value="<?php echo $this->item->ITEM_NAME ?>" type="text" class="form-control" name="item_name" data-validate="required" placeholder="Item name" />
                                    </div>	
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Category</label>
                                        <select name="item_cat" onchange="getSubCat(this)" class="select2" data-allow-clear="true" data-placeholder="Select category">
                                            <option></option>
                                            <?php
                                            if (!empty($this->cat)) {
                                                foreach ($this->cat as $cat) {
                                                    ?>
                                                    <option <?php echo ($this->item->ITEM_CATEGORY_ID == $cat->ITEM_CAT_ID ? 'selected' : '') ?> value="<?php echo $cat->ITEM_CAT_ID ?>"><?php echo $cat->ITEM_CAT_NAME ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>	
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Sub category</label>
                                        <select name="item_sub_cat" id="sub_category" class="select2" data-allow-clear="true" data-placeholder="Select sub category">
                                            <option></option>
                                            <?php
                                            if (!empty($this->sub_cat)) {
                                                foreach ($this->sub_cat as $sub_cat) {
                                                    ?>
                                                    <option <?php echo ($this->item->ITEM_SUB_CATEGORY_ID == $sub_cat->ITEM_SUB_CAT_ID ? 'selected' : '') ?> value="<?php echo $sub_cat->ITEM_SUB_CAT_ID ?>"><?php echo $sub_cat->ITEM_SUB_CAT_NAME ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>	
                                </div>             
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Stock Unit</label>
                                        <select name="item_stock_unit"  class="form-control">
                                            <option value="">-Select-</option>
                                            <?php
                                            if (!empty($this->unit)) {
                                                foreach ($this->unit as $unit) {
                                                    ?>
                                                    <option <?php echo ($this->item->ITEM_STOCK_UNIT == $unit->UNIT_CODE ? 'selected' : '') ?> value="<?php echo $unit->UNIT_CODE ?>"><?php echo $unit->UNIT_NAME ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>	
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Issue Unit</label>
                                        <select name="issue_unit"  class="form-control">
                                            <option value="">-Select-</option>
                                            <?php
                                            if (!empty($this->unit)) {
                                                foreach ($this->unit as $unit) {
                                                    ?>
                                                    <option <?php echo ($this->item->ITEM_ISSUE_UNIT == $unit->UNIT_CODE ? 'selected' : '') ?>  value="<?php echo $unit->UNIT_CODE ?>"><?php echo $unit->UNIT_NAME ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>	
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Ratio (Stock unit to Issue unit)</label>
                                        <select name="item_ratio"  class="form-control">
                                            <option value="">-Select-</option>
                                            <option <?php echo ($this->item->ITEM_RATIO == '1' ? 'selected' : '') ?> value="1">1X</option> 
                                            <option <?php echo ($this->item->ITEM_RATIO == '1000' ? 'selected' : '') ?> value="1000">1000X</option>
                                             <option <?php echo ($this->item->ITEM_RATIO == '1000000' ? 'selected' : '') ?> value="1000000">1000000X</option>
                                        </select>                                   
                                    </div>	
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Order Level</label>
                                        <input value="<?php echo $this->item->ITEM_RE_ORDER_LEVEL ?>" type="text" class="form-control" name="item_ord_lvl" data-validate="required,number" placeholder="Numeric Field" />
                                    </div>	
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Near Order Level</label>
                                        <input value="<?php echo $this->item->ITEM_NEAR_RE_ORDER_LEVEL ?>" type="text" class="form-control" name="item_n_ord_lvl" data-validate="required,number" placeholder="Numeric Field" />
                                    </div>	
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="field-6" class="control-label">Location</label>
                                        <input value="<?php echo $this->item->ITEM_LOCATION ?>" type="text" class="form-control" name="item_loc" data-validate="required" placeholder="" />
                                    </div>	
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="field-7" class="control-label">Remark</label>
                                        <textarea name="item_remark" class="form-control autogrow" id="field-7" placeholder="Item Remark"><?php echo $this->item->ITEM_REMARK ?></textarea>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-gray" data-collapsed="0">
                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title">Item History</div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body">
                                <ul class="cbp_tmtimeline">
                                    <ul class="cbp_tmtimeline">
                                        <?php
                                        if (!empty($this->history)) {
                                            foreach ($this->history as $his) {
                                                $dateTime = explode(" ", $his->LOG_DATE);
                                                $time = date('h:i:s A', strtotime($dateTime[1]));
                                                $date = date('Y-M-d', strtotime($dateTime[0]));
                                                ?>
                                                <li>
                                                    <time class="cbp_tmtime" datetime="2014-12-09T03:45"><span><?php echo $time ?></span> <span><?php echo $date ?></span></time>
                                                    <div class="cbp_tmicon">
                                                        <i class="entypo-user"></i>
                                                    </div>

                                                    <div class="cbp_tmlabel">
                                                        <h2><a href="#"><?php echo $his->LOG_USER ?></a></h2>
                                                        <p><?php echo $his->LOG_TASK ?></p>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger"><strong>Oh snap!</strong> Selected item not longer used.</div>
                    </div>
                </div>
            <?php } ?>
            <!--Add footer-->
            <?php require_once MOD_ADMIN_DOC . 'views/_templates/sub_footer.php'; ?>
            <!--############-->
        </div>
    </div>
    <script type="text/javascript">
                                        function getSubCat(e)
                                        {
                                            try {
                                                var param = "cat=" + e.value;
                                                ajaxRequest('<?php echo MOD_ADMIN_URL ?>setting/jsonGetSubCatByCat', param, function(jsonData) {
                                                    var option = '<option value="">-Select-</option>';
                                                    if (jsonData) {
                                                        if (jsonData.success == true) {
                                                            for (var i in jsonData.data) {
                                                                option = option + "<option value='" + jsonData.data[i]['ITEM_SUB_CAT_ID'] + "'>" + jsonData.data[i]['ITEM_SUB_CAT_NAME'] + "</option>";
                                                            }
                                                            document.getElementById('sub_category').innerHTML = option;
                                                        } else {
                                                            errorModal(jsonData.error);
                                                            return false;
                                                        }
                                                    }
                                                });
                                            } catch (err) {
                                                alert(err.message);
                                                return false;
                                            }
                                        }
                                        function submitFrom(form) {
                                            try {
                                                ajaxRequest(form.action, jQuery('#' + form.id).serialize(), function(jsonData) {
                                                    if (jsonData) {
                                                        if (jsonData.success == true) {
                                                            jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>item');
                                                        } else {
                                                            errorModal(jsonData.error);
                                                            return false;
                                                        }
                                                    }
                                                });
                                            } catch (err) {
                                                alert(err.message);
                                                return false;
                                            }
                                        }
                                        function modifytItemMode(val, ststus) {
                                            try {
                                                if (doConfirm('Are you confirm to ' + (ststus == 'P' ? 'submit' : 'accept') + ' item?')) {
                                                    ajaxRequest('<?php echo MOD_ADMIN_URL ?>item/jsonMode/' + val + '/' + ststus + '/', '', function(jsonData) {
                                                        if (jsonData) {
                                                            if (jsonData.success == true) {
                                                                jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>item');
                                                            } else {
                                                                errorModal(jsonData.error);
                                                                return false;
                                                            }
                                                        }
                                                    });
                                                }
                                            }
                                            catch (err) {
                                                alert(err.message);
                                                return false;
                                            }
                                        }
    </script>
    <link rel="stylesheet" href="<?php echo JS_PATH ?>select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo JS_PATH ?>select2/select2.css">
    <link rel="stylesheet" href="<?php echo JS_PATH ?>vertical-timeline/css/component.css">
    <!-- Bottom scripts (common) -->
    <script src="<?php echo JS_PATH ?>gsap/main-gsap.js"></script>
    <script src="<?php echo JS_PATH ?>jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo JS_PATH ?>bootstrap.js"></script>
    <script src="<?php echo JS_PATH ?>joinable.js"></script>
    <script src="<?php echo JS_PATH ?>resizeable.js"></script>
    <script src="<?php echo JS_PATH ?>neon-api.js"></script>


    <!-- Imported scripts on this page -->
    <script src="<?php echo JS_PATH ?>select2/select2.min.js"></script>
    <script src="<?php echo JS_PATH ?>jquery.validate.min.js"></script>
    <script src="<?php echo JS_PATH ?>neon-chat.js"></script>
    <script src="<?php echo JS_PATH ?>bootstrap-datepicker.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo JS_PATH ?>neon-custom.js"></script>


    <!-- Demo Settings -->
    <script src="<?php echo JS_PATH ?>neon-demo.js"></script>