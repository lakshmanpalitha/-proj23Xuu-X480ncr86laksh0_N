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

                    <a href="<?php echo MOD_ADMIN_URL ?>vendor/">Vendors</a>
                </li>                
            </ol>

            <h3>Vendors</h3>
            <br />
            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix">
                    <a class="btn btn-blue" href="javascript:;" onclick="jQuery('#modal-6').modal('show', {backdrop: 'static'});">
                        <i class="entypo-plus"></i>
                        Add New
                    </a>
                </div>
            </div>
            <br />

            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact No:</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->vendors)) {
                        foreach ($this->vendors as $vendor) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $vendor->VENDOR_NAME ?></td>
                                <td><?php echo $vendor->VENDOR_EMAIL ?></td>
                                <td><?php echo $vendor->VENDOR_ADDRESS ?></td>
                                <td><?php echo $vendor->VENDOR_CONTACT_NO ?></td>
                                <td><?php
                                    echo ($vendor->VENDOR_TYPE == 'S' ? '
                                        <button class="btn btn-default btn-icon btn-xs icon-left" type="button">
                                            Supplier
                                            <i class="entypo-user-add"></i>
                                        </button>' :
                                            '<button class="btn btn-default btn-icon btn-xs icon-left" type="button">
                                            Buyer
                                            <i class="entypo-user-add"></i>
                                        </button>')
                                    ?></td>
                                <td><?php
                                    echo ($vendor->VENDOR_STATUS == 'A' ? '
                                        <button class="btn btn-green btn-icon icon-left  btn-xs" type="button">
                                            Active<i class="entypo-check"></i>
                                        </button>' :
                                            '<button class="btn btn-gold btn-icon icon-left  btn-xs" type="button">
                                                Inactive<i class="entypo-cancel"></i>
                                         </button>')
                                    ?></td>
                                <td class="center">
                                    <a href="javascript:;" onclick="showAjaxModal();" class="btn btn-default btn-xs btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        Edit
                                    </a>

                                    <a href="#" class="btn btn-danger btn-xs btn-icon icon-left">
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
                            tableContainer = $("#table-1");

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
                function showAjaxModal()
                {
                    jQuery('#modal-6').modal('show', {backdrop: 'static'});

                    jQuery.ajax({
                        url: "data/ajax-content.txt",
                        success: function(response)
                        {
                            jQuery('#modal-7 .modal-body').html(response);
                        }
                    });
                }
            </script>
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
                    <h4 class="modal-title">New Vendor</h4>
                </div>
                <form  role="form" id="form1" method="post" action="<?php echo MOD_ADMIN_URL ?>vendor/addNewVendor" class="validate_sp_form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="vendor_name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>	
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" class="form-control" name="vendor_email" data-validate="required,email" placeholder="Email Field" />
                                </div>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Address</label>

                                    <input type="text" class="form-control" name="vendor_address" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Contact No:</label>

                                    <input type="text" class="form-control" name="vendor_cno" data-validate="required,number" placeholder="Numeric Field" />
                                </div>	
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Vendor Type</label>
                                    <select name="vendor_typ" class="form-control">
                                        <option value="S">Supplier</option>
                                        <option value="B">Buyer</option>
                                    </select>
                                </div>	
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-0 control-label">Status</label>
                                    <div>
                                        <select name="status" class="form-control">
                                            <option value="A">Active</option>
                                            <option value="I">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Remark</label>
                                    <textarea name="vendor_remark" class="form-control autogrow" id="field-7" placeholder="Write something about vendor"></textarea>
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
    <script>
        function submitFrom(form) {
            try {
                ajaxRequest(form.action, jQuery('#' + form.id).serialize(), function(jsonData) {
                    if (jsonData) {
                        if (jsonData.success == true) {
                            jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>vendor');
                        } else {
                            alert(jsonData.error)
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

    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo JS_PATH ?>neon-custom.js"></script>

    <!-- Demo Settings -->
    <script src="<?php echo JS_PATH ?>neon-demo.js"></script>
