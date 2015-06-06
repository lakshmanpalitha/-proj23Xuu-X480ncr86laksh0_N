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
                    <a href="index.html"><i class="fa-home"></i>Home</a>
                </li>
                <li>

                    <a href="forms-main.html">Forms</a>
                </li>
                <li class="active">

                    <strong>Data Validation</strong>
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
                        <th data-hide="phone">Rendering engine</th>
                        <th>Browser</th>
                        <th data-hide="phone">Platform(s)</th>
                        <th data-hide="phone,tablet">Engine version</th>
                        <th>CSS grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd gradeX">
                        <td>Trident</td>
                        <td>Internet Explorer 4.0</td>
                        <td>Win 95+</td>
                        <td class="center">4</td>
                        <td class="center">X</td>
                        <td class="center">
                            <a href="javascript:;" onclick="showAjaxModal();" class="btn btn-default btn-sm btn-icon icon-left">
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>

                            <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                                <i class="entypo-cancel"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                    <tr class="even gradeC">
                        <td>Trident</td>
                        <td>Internet Explorer 5.0</td>
                        <td>Win 95+</td>
                        <td class="center">5</td>
                        <td class="center">C</td>
                        <td class="center">
                            <a href="javascript:;" onclick="showAjaxModal();" class="btn btn-default btn-sm btn-icon icon-left">
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>

                            <a href="#" class="btn btn-danger btn-sm btn-icon icon-left">
                                <i class="entypo-cancel"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
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
                <form role="form" id="form1" method="post" class="validate">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Name</label>

                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>	

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Email</label>

                                    <input type="text" class="form-control" name="email" data-validate="required,email" placeholder="Email Field" />
                                </div>	

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="field-3" class="control-label">Address</label>

                                    <input type="text" class="form-control" name="address" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>	

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="field-6" class="control-label">Contact No:</label>

                                    <input type="text" class="form-control" name="number" data-validate="required,number" placeholder="Numeric Field" />
                                </div>	

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="field-5" class="control-label">Vendor Type</label>
                                    <select class="form-control">
                                        <option>Supplier</option>
                                        <option>Buyer</option>
                                    </select>
                                </div>	

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Remark</label>

                                    <textarea class="form-control autogrow" id="field-7" placeholder="Write something about vendor"></textarea>
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
