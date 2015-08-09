<script>
    var recipe_items = new Array();
</script>
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
                    <a href="<?php echo MOD_ADMIN_URL ?>/recipe">Recipe</a>
                </li>
                <li>
                    <a href="<?php echo MOD_ADMIN_URL ?>/recipe">Add Recipe</a>
                </li>
            </ol>
            <h2>Recipe</h2>
            <br />
            <form role="form" id="form1" method="post"  action="<?php echo MOD_ADMIN_URL ?>recipe/addNewRecipe"  class="validate_sp_form">
                <div class="row">
                    <div class="col-md-12">
                        <div style="border:none !important;text-align:right;" class="panel panel-primary">
                            <button class="btn btn-green btn-sm" type="submit" type="button">Save</button>         
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Add New Recipe &nbsp; &nbsp;
                            <button class="btn btn-gold  btn-icon icon-left  btn-xs" type="button">New<i class="entypo-info"></i></button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="recipe_name" data-validate="required" data-message-required="Product name is required field." placeholder="Required Field" />
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-gray" data-collapsed="0">
                                    <!-- panel head -->
                                    <div class="panel-heading">
                                        <div class="panel-title">Recipe Items</div>
                                    </div>
                                    <!-- panel body -->
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered datatable" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th>Item Name</th>
                                                            <th>Quantity</th>
                                                            <th>Remark</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>           
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a class="btn btn-blue" href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'});">
                                                    <i class="entypo-plus"></i>
                                                    Add New
                                                </a>                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="about">Recipe Remark</label>
                                    <textarea style="border-radius:0 !important;height:70px !important" class="form-control autogrow" name="recipe_remark" id="about" data-validate="" rows="5" placeholder="Product Remark"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--Add footer-->
            <?php require_once MOD_ADMIN_DOC . 'views/_templates/sub_footer.php'; ?>
            <!--############-->
        </div>
    </div>
    <!-- Modal 6 (Long Modal)-->
    <div class="modal fade" id="modal-6">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">New Item</h4>
                </div>
                <form role="form" id="form1" method="post" class="validate">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Item Code</label>
                                    <select name="recipe_item" id="recipe_item" onchange="getItemIssueUnit(this)" class="select2" data-allow-clear="true" data-placeholder="Select item">
                                        <?php
                                        if (!empty($this->items)) {
                                            foreach ($this->items as $item) {
                                                ?>
                                                <option myTag='<?php echo base64_encode( $item->ITEM_ID) ?>' value="<?php echo $item->ITEM_ID ?>" ><?php echo $item->ITEM_NAME ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>                                   
                                </div>	

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Quantity (<span id="stock_unit"></span>)</label>
                                    <input name="recipe_item_qty" id="recipe_item_qty" type="text" class="form-control"  data-validate="required,number" placeholder="Required Numeric Field" />
                                </div>	
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="about">Recipe Item Remark</label>
                                    <textarea style="border-radius:0 !important;height:70px !important" class="form-control autogrow" name="recipe_item_remark" id="recipe_item_remark"  rows="5" placeholder="Item Remark"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    function getItemIssueUnit(e)
    {
        try {
            var param = "item_id=" + e.value;
            ajaxRequest('<?php echo MOD_ADMIN_URL ?>item/jsonGetItemIssueUnit', param, function(jsonData) {

                if (jsonData) {
                    if (jsonData.success == true) {
                        document.getElementById('stock_unit').innerHTML = "<b>" + jsonData.data + "</b>";

                    } else {
                        errorModal(jsonData.error);
                        return false;
                    }
                }
            });
        }
        catch (err) {
            alert(err.message);
            return false;
        }

    }
    function recall(form) {

        try {
            var item_id = jQuery('#recipe_item').val();
            var myTag = jQuery('#recipe_item option:selected').attr('myTag');
            if (typeof recipe_items[item_id] === 'undefined') {
                recipe_items[item_id] = new Array();
                recipe_items[item_id] = {
                    item_id: item_id,
                    item_qty: jQuery('#recipe_item_qty').val(),
                    item_remark: jQuery('#recipe_item_remark').val()
                };
                var row = '<tr>';
                row = row + '<td><a target="_blank" href="<?php echo MOD_ADMIN_URL ?>item/viewItem/' + myTag + '"><u>' + jQuery('#recipe_item option:selected').text() + '</u></a></td>';
                row = row + '<td>' + jQuery('#recipe_item_qty').val() + '&nbsp (' + jQuery('#stock_unit').html() + ')</td>';
                row = row + '<td>' + jQuery('#recipe_item_remark').val() + '</td>';
                //<a href="javascript:;" onclick=viewItem("' + item_id + '",this) class="btn btn-gold btn-xs btn-icon icon-left"><i class="entypo-pencil"></i>View</a> &nbsp 
                row = row + '<td><a href="javascript:;" onclick=deleteItemRow("' + item_id + '",this) class="btn btn-danger btn-xs btn-icon icon-left"><i class="entypo-pencil"></i>Delete</a></td>';
                row = row + '</tr>';
                jQuery("#table-1 tbody").prepend(row);
                jQuery('#modal-6').modal('hide');

            }
            else {
                alert("Item is allredy exist!");
            }
        }
        catch (err) {
            alert(err.message);
            return false;

        }

        return false;
    }
    function deleteItemRow(id, e) {
        try {
            if (typeof recipe_items[id] === 'undefined') {

            } else {
                delete recipe_items[id];
                var tr = jQuery(e).closest('tr');
                tr.remove();
            }
        }
        catch (err) {
            alert(err.message);
            return false;
        }
    }
    function viewItem() {
        try {
            jQuery('#modal-6').modal('show', {backdrop: 'static'});
        }
        catch (err) {
            alert(err.message);
            return false;
        }

    }
    function submitFrom(form) {
        try {
            var data = new Array();
            for (var key in recipe_items) {
                var value = recipe_items[key];
                data.push(value);
            }
            var param = jQuery('#' + form.id).serialize() + "&items=" + (JSON.stringify(data));
            ajaxRequest(form.action, param, function(jsonData) {
                if (jsonData) {
                    if (jsonData.success == true) {
                        jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>recipe');
                    } else {
                        errorModal(jsonData.error);
                        return false;
                    }
                }
            });
        }
        catch (err) {
            alert(err.message);
            return false;
        }
        return false;
    }
    </script>
    <link rel="stylesheet" href="<?php echo JS_PATH ?>select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo JS_PATH ?>select2/select2.css">
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