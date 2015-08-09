<script>
    var grn_items = new Array();
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

                    <a href="<?php echo MOD_ADMIN_URL ?>grn/">Grn</a>
                </li>
                <li>

                    <a href="<?php echo MOD_ADMIN_URL ?>grn/newGrn/">Add Grn</a>
                </li>
            </ol>

            <h2>Add GRN </h2>
            <br />
            <form role="form" id="form1" method="post"  action="<?php echo MOD_ADMIN_URL ?>grn/addNewGrn"  class="validate_sp_form">
                <div class="row">
                    <div class="col-md-12">
                        <div style="border:none !important;text-align:right;" class="panel panel-primary">
                            <button class="btn btn-green btn-sm" type="submit" type="button">Save</button>          
                        </div>
                    </div>
                </div>
                <div class="panel panel-info">

                    <div class="panel-heading">
                        <div class="panel-title">Add New GRN &nbsp; &nbsp;  
                            <button class="btn btn-gold  btn-icon icon-left  btn-xs" type="button">New<i class="entypo-info"></i></button>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Invoice Number</label>
                                    <input type="text" class="form-control" name="grn_inv_id" data-validate="required" data-message-required="Invoice id is required field." placeholder="Required Field" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Vendor</label>
                                    <select name="grn_vendor" class="select2" data-allow-clear="true" data-placeholder="Select vendor">
                                        <option></option>
                                        <?php
                                        if (!empty($this->vendors)) {
                                            foreach ($this->vendors as $vendor) {
                                                ?>
                                                <option value="<?php echo $vendor->VENDOR_ID ?>" ><?php echo $vendor->VENDOR_NAME ?></option>
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
                                    <label class="control-label">Invoice Date</label>
                                    <div class="input-group">
                                        <input name="grn_inv_date" type="text" class="form-control datepicker" placeholder="Required Field" data-format="yyyy-mm-dd">
                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" name="grn_title"  placeholder="Title" />
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
                                        <div class="panel-title">GRN Items</div>
                                    </div>

                                    <!-- panel body -->
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered datatable" id="table-1">
                                                    <thead>
                                                        <tr>
                                                            <th>Item name</th>
                                                            <th>Unit Price(Rs)</th>
                                                            <th>Quantity</th>   
                                                            <th>Total Amount(Rs)</th>
                                                            <th>Expire Date</th>
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
                                    <label class="control-label" for="about">GRN Remark</label>
                                    <textarea style="border-radius:0 !important;height:70px !important" class="form-control autogrow" name="grn_remark" id="about" data-validate="" rows="5" placeholder="GRN Remark"></textarea>
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
                <form role="form" id="form1" class="validate">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="control-label">Item Name</label>
                                    <select onchange="getItemStockUnit(this)" name="item_id" id="item_id"  class="select2" data-allow-clear="true" data-placeholder="Item Name">
                                        <option></option>                             
                                        <?php
                                        if (!empty($this->items)) {
                                            foreach ($this->items as $item) {
                                                ?>
                                                <option myTag='<?php echo base64_encode($item->ITEM_ID) ?>' value="<?php echo $item->ITEM_ID ?>" ><?php echo $item->ITEM_NAME ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>                                   
                                </div>	

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Unit Price</label>
                                    <input type="text" class="form-control" id="item_unit_price" name="item_unit_price" data-validate="required,number" placeholder="Required Numeric Field" />
                                </div>	
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Quantity (<span id="stock_unit"></span>)</label>
                                    <input type="text" class="form-control" id="item_qty" name="item_qty" data-validate="required,number" placeholder="Required Numeric Field" />
                                </div>	
                            </div>  
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Total Amount</label>
                                    <input readonly type="text" class="form-control" id="item_tot_amount" name="item_tot_amount" data-validate="required,number" placeholder="Required Numeric Field" />
                                </div>	
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Exp Date</label>
                                    <div class="input-group">
                                        <input name="item_exp" id="item_exp" type="text" class="form-control datepicker" placeholder="Required Field"  data-format="yyyy-mm-dd">
                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Remark</label>
                                    <textarea class="form-control autogrow" name="item_remark" id="item_remark" placeholder="Item Remark"></textarea>
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
    function getItemStockUnit(e)
    {
        try {
            var param = "item_id=" + e.value;
            ajaxRequest('<?php echo MOD_ADMIN_URL ?>item/jsonGetItemStockUnit', param, function(jsonData) {

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
            var item_id = jQuery('#item_id').val();
            var myTag =  jQuery('#item_id option:selected').attr('myTag');
            if (typeof grn_items[item_id] === 'undefined') {
                grn_items[item_id] = new Array();
                grn_items[item_id] = {
                    item_id: item_id,
                    item_qty: jQuery('#item_qty').val(),
                    item_amt: jQuery('#item_unit_price').val(),
                    item_tot: jQuery('#item_tot_amount').val(),
                    item_exp: jQuery('#item_exp').val(),
                    item_remark: jQuery('#item_remark').val()
                };
                var row = '<tr id="' + item_id + '">';
                row = row + '<td><a target="_blank" href="<?php echo MOD_ADMIN_URL ?>item/viewItem/'+myTag+'"><u>' + jQuery('#item_id option:selected').text() + '</u></a></td>';
                row = row + '<td>' + jQuery('#item_unit_price').val() + '</td>';
                row = row + '<td>' + jQuery('#item_qty').val() + '&nbsp (' + jQuery('#stock_unit').html() + ')</td>';
                row = row + '<td>' + jQuery('#item_tot_amount').val() + '</td>';
                row = row + '<td>' + jQuery('#item_exp').val() + '</td>';
                row = row + '<td>' + jQuery('#item_remark').val() + '</td>';
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
            if (typeof grn_items[id] === 'undefined') {
            } else {
                delete grn_items[id];
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
            for (var key in grn_items) {
                var value = grn_items[key];
                data.push(value);
            }
            var param = jQuery('#' + form.id).serialize() + "&items=" + (JSON.stringify(data));
            ajaxRequest(form.action, param, function(jsonData) {
                if (jsonData) {
                    if (jsonData.success == true) {
                        jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>grn');
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

    function calTotAmount() {
        jQuery('#item_tot_amount').val(jQuery('#item_qty').val() * jQuery('#item_unit_price').val())
    }
    jQuery(document).on(" keyup", '#item_qty', function(event) {
        calTotAmount();
    });
    jQuery(document).on(" keyup", '#item_unit_price', function(event) {
        calTotAmount();
    });
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