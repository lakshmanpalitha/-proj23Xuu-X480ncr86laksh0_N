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

                    <a href="<?php echo MOD_ADMIN_URL ?>setting/">Settings</a>
                </li>
            </ol>

            <h3>Setting</h3>
            <br />

            <div class="row">

                <div class="col-md-12">

                    <div class="tabs-vertical-env">

                        <ul class="nav tabs-vertical"><!-- available classes "right-aligned" -->
                            <li class="active"><a href="#v-home" data-toggle="tab">Item Category</a></li>
                            <li><a href="#v-profile" data-toggle="tab">Item Sub Category</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="v-home">
                                <div class="row">
                                    <div class="col-md-6 col-sm-8 clearfix">
                                        <a class="btn btn-blue" href="javascript:;" onclick="jQuery('#modal-1').modal('show', {backdrop: 'static'}, jQuery('#cat_id').val(''));">
                                            <i class="entypo-plus"></i>
                                            Add Category
                                        </a>
                                    </div>
                                </div>
                                <br />

                                <table class="table table-bordered datatable" id="table-1">
                                    <thead>
                                        <tr>
                                            <th data-hide="phone">Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($this->cat)) {
                                            foreach ($this->cat as $cat) {
                                                ?>
                                                <tr style="<?php echo ($cat->ITEM_CAT_STATUS == 'I' ? 'background-color: mistyrose;' : '') ?>" class="odd gradeX">
                                                    <td><?php echo $cat->ITEM_CAT_NAME ?></td>
                                                    <td class="center">
                                                        <a href="javascript:;" onclick="showAjaxModalCat('<?php echo base64_encode($cat->ITEM_CAT_ID) ?>', '<?php echo $cat->ITEM_CAT_NAME ?>');" class="btn btn-default btn-xs btn-icon icon-left">
                                                            <i class="entypo-pencil"></i>
                                                            View
                                                        </a>
                                                        <a href="javascript:;" onclick="modifyCatStatus('<?php echo ($cat->ITEM_CAT_ID) ?>', '<?php echo ($cat->ITEM_CAT_STATUS == 'A') ? 'I' : 'A' ?>')" class="btn btn-<?php echo ($cat->ITEM_CAT_STATUS == 'A') ? 'green' : 'gold' ?> btn-xs btn-icon icon-left">
                                                            <i class="entypo-pencil"></i><?php echo ($cat->ITEM_CAT_STATUS == 'A') ? 'Active' : 'Inactive' ?>
                                                        </a>
                                                        <a href="javascript:;" onclick="modifyCatStatus('<?php echo ($cat->ITEM_CAT_ID) ?>', 'D')" class="btn btn-danger btn-xs btn-icon icon-left">
                                                            <i class="entypo-cancel"></i>
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>           
                            </div>
                            <div class="tab-pane" id="v-profile">
                                <div class="row">
                                    <div class="col-md-6 col-sm-8 clearfix">
                                        <a class="btn btn-blue" href="javascript:;" onclick="jQuery('#modal-2').modal('show', {backdrop: 'static'}, jQuery('#sub_cat_id').val(''));">
                                            <i class="entypo-plus"></i>
                                            Add Sub Category
                                        </a>
                                    </div>
                                </div>
                                <br />

                                <table class="table table-bordered datatable" id="table-2">
                                    <thead>
                                        <tr>
                                            <th data-hide="phone">Category</th>
                                            <th data-hide="phone">Sub Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($this->sub_cat)) {
                                            foreach ($this->sub_cat as $sub_cat) {
                                                ?>
                                                <tr style="<?php echo ($sub_cat->ITEM_SUB_CAT_STATUS == 'I' ? 'background-color: mistyrose;' : '') ?>" class="odd gradeX">
                                                    <td><?php echo $sub_cat->ITEM_CAT_NAME ?></td>
                                                    <td><?php echo $sub_cat->ITEM_SUB_CAT_NAME ?></td>                                                  
                                                    <td class="center">
                                                        <a href="javascript:;" onclick="showAjaxModalSubCat('<?php echo base64_encode($sub_cat->ITEM_SUB_CAT_ID) ?>', '<?php echo $sub_cat->ITEM_CAT_ID ?>', '<?php echo $sub_cat->ITEM_SUB_CAT_NAME ?>');" class="btn btn-default btn-xs btn-icon icon-left">
                                                            <i class="entypo-pencil"></i>
                                                            View
                                                        </a>
                                                        <a href="javascript:;" onclick="modifySubCatStatus('<?php echo ($sub_cat->ITEM_SUB_CAT_ID) ?>', '<?php echo ($sub_cat->ITEM_SUB_CAT_STATUS == 'A') ? 'I' : 'A' ?>')" class="btn btn-<?php echo ($sub_cat->ITEM_SUB_CAT_STATUS == 'A') ? 'green' : 'gold' ?> btn-xs btn-icon icon-left">
                                                            <i class="entypo-pencil"></i><?php echo ($sub_cat->ITEM_SUB_CAT_STATUS == 'A') ? 'Active' : 'Inactive' ?>
                                                        </a>
                                                        <a href="javascript:;" onclick="modifySubCatStatus('<?php echo ($sub_cat->ITEM_SUB_CAT_ID) ?>', 'D')" class="btn btn-danger btn-xs btn-icon icon-left">
                                                            <i class="entypo-cancel"></i>
                                                            Delete
                                                        </a>

                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <script type="text/javascript">
                                            var responsiveHelper;
                                            var breakpointDefinition = {
                                                tablet: 1024,
                                                phone: 480
                                            };
                                            var tableContainer;

                                            jQuery(document).ready(function($)
                                            {
                                                tableContainer = $("#table-2");

                                                tableContainer.dataTable({
                                                    "sPaginationType": "bootstrap",
                                                    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                                    "bStateSave": true,
                                                    // Responsive Settings
                                                    bAutoWidth: false,
                                                    fnPreDrawCallback: function() {
                                                        // Initialize the responsive datatables helper once.
                                                        if (!responsiveHelper) {
                                                            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
                                                        }
                                                    },
                                                    fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                                                        responsiveHelper.createExpandIcon(nRow);
                                                    },
                                                    fnDrawCallback: function(oSettings) {
                                                        responsiveHelper.respond();
                                                    }
                                                });


                                                $(".dataTables_wrapper select").select2({
                                                    minimumResultsForSearch: -1
                                                });
                                            });
                                </script>
                                <script type="text/javascript">
                                    function showAjaxModalSubCat(sub_cat_id, cat_id, name)
                                    {
                                        jQuery('#modal-2').modal('show', {backdrop: 'static'});
                                        jQuery('#cat').val(cat_id);
                                        jQuery('#sub_cat_name').val(name);
                                        jQuery('#sub_cat_id').val(sub_cat_id);
                                    }
                                    function showAjaxModalCat(id, name)
                                    {
                                        jQuery('#modal-1').modal('show', {backdrop: 'static'});
                                        jQuery('#cat_id').val(id);
                                        jQuery('#cat_name').val(name);
                                    }
                                    function modifyCatStatus(val, ststus) {
                                        try {
                                            var str = '';
                                            if (ststus == 'A') {
                                                str = 'active';
                                            } else if (ststus == 'I') {
                                                str = 'inactive';
                                            } else if (ststus == 'D') {
                                                str = 'delete';
                                            }
                                            if (doConfirm('Are you confirm to ' + str + ' category?')) {
                                                ajaxRequest('<?php echo MOD_ADMIN_URL ?>setting/jsonCatStatus/' + val + '/' + ststus + '/', '', function(jsonData) {
                                                    if (jsonData) {
                                                        if (jsonData.success == true) {
                                                            jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>setting');
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
                                    function modifySubCatStatus(val, ststus) {
                                        try {
                                            var str = '';
                                            if (ststus == 'A') {
                                                str = 'active';
                                            } else if (ststus == 'I') {
                                                str = 'inactive';
                                            } else if (ststus == 'D') {
                                                str = 'delete';
                                            }
                                            if (doConfirm('Are you confirm to ' + str + ' sub category ?')) {
                                                ajaxRequest('<?php echo MOD_ADMIN_URL ?>setting/jsonSubCatStatus/' + val + '/' + ststus + '/', '', function(jsonData) {
                                                    if (jsonData) {
                                                        if (jsonData.success == true) {
                                                            jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>setting');
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
                            </div>
                        </div>

                    </div>	

                </div>
            </div>


            <!-- Modal 1 (Category)-->
            <div class="modal fade" id="modal-1">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">New Category</h4>
                        </div>
                        <form  role="form" id="form1" method="post" action="<?php echo MOD_ADMIN_URL ?>setting/addNewCategory" class="validate_sp_form">
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" name="cat_name" id="cat_name" data-validate="required" data-message-required="" placeholder="Required Field" />
                                        </div>	
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="cat_id" id="cat_id" value=""/>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal 2 (sub category)-->
            <div class="modal fade" id="modal-2">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">New Sub Category</h4>
                        </div>
                        <form  role="form" id="form2" method="post" action="<?php echo MOD_ADMIN_URL ?>setting/addNewSubCategory" class="validate_sp_form">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-0 control-label">Category</label>
                                            <div>
                                                <select name="cat" id="cat" class="form-control">
                                                    <option value="">-Select-</option>
                                                    <?php
                                                    if (!empty($this->cat)) {
                                                        foreach ($this->cat as $cat) {
                                                            ?>
                                                            <option value="<?php echo $cat->ITEM_CAT_ID ?>"><?php echo $cat->ITEM_CAT_NAME ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" id="sub_cat_name" name="sub_cat_name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                        </div>	
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="sub_cat_id" id="sub_cat_id" value=""/>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Add footer-->
            <?php require_once MOD_ADMIN_DOC . 'views/_templates/sub_footer.php'; ?>
            <!--############-->
        </div>
    </div>
    <script>
        function submitFrom(form) {
            try {
                ajaxRequest(form.action, jQuery('#' + form.id).serialize(), function(jsonData) {
                    if (jsonData) {
                        if (jsonData.success == true) {
                            jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>setting');
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
    </script>


    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="<?php echo JS_PATH ?>datatables/responsive/css/datatables.responsive.css">
    <link rel="stylesheet" href="<?php echo JS_PATH ?>select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo JS_PATH ?>select2/select2.css">

    <!-- Bottom scripts (common) -->
    <script src="<?php echo JS_PATH ?>gsap/main-gsap.js"></script>
    <script src="<?php echo JS_PATH ?>jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo JS_PATH ?>bootstrap.js"></script>
    <script src="<?php echo JS_PATH ?>joinable.js"></script>
    <script src="<?php echo JS_PATH ?>resizeable.js"></script>
    <script src="<?php echo JS_PATH ?>neon-api.js"></script>
    <script src="<?php echo JS_PATH ?>jquery.dataTables.min.js"></script>
    <script src="<?php echo JS_PATH ?>datatables/TableTools.min.js"></script>

    <!-- Imported scripts on this page -->
    <script src="<?php echo JS_PATH ?>jquery.validate.min.js"></script>
    <script src="<?php echo JS_PATH ?>neon-chat.js"></script>
    <script src="<?php echo JS_PATH ?>dataTables.bootstrap.js"></script>
    <script src="<?php echo JS_PATH ?>datatables/jquery.dataTables.columnFilter.js"></script>
    <script src="<?php echo JS_PATH ?>datatables/lodash.min.js"></script>
    <script src="<?php echo JS_PATH ?>datatables/responsive/js/datatables.responsive.js"></script>
    <script src="<?php echo JS_PATH ?>select2/select2.min.js"></script>
    <script src="<?php echo JS_PATH ?>selectboxit/jquery.selectBoxIt.min.js"></script>
    <script src="<?php echo JS_PATH ?>jquery.multi-select.js"></script>

    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo JS_PATH ?>neon-custom.js"></script>

    <!-- Demo Settings -->
    <script src="<?php echo JS_PATH ?>neon-demo.js"></script>
