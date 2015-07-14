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

                    <a href="<?php echo MOD_ADMIN_URL ?>role/">Role</a>
                </li>              
            </ol>

            <h3>Role</h3>
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
                        <th data-hide="phone">Role Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->role)) {
                        foreach ($this->role as $rol) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $rol->ROLE_NAME ?></td>
                                <td class="center">
                                    <a href="javascript:;" onclick="showAjaxModal();" class="btn btn-default btn-xs btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        View
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
                    <h4 class="modal-title">New Role</h4>
                </div>
                <form  role="form" id="form1" method="post" action="<?php echo MOD_ADMIN_URL ?>role/addNewRole" class="validate_sp_form">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="role-name" data-validate="required" placeholder="Role name Field" />
                                </div>	

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-invert" data-collapsed="0"><!-- setting the attribute data-collapsed="1" will collapse the panel -->

                                    <!-- panel head -->
                                    <div class="panel-heading">
                                        <div class="panel-title">Document type & Privileges</div>
                                    </div>

                                    <!-- panel body -->
                                    <div id="panel_privileges" class="panel-body">
                                        <div class="scrollable" data-height="200" data-scroll-position="right" data-rail-color="#fff" data-rail-opacity=".9" data-rail-width="8" data-rail-radius="10" data-autohide="0">
                                            <table class="table table-bordered" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>Document Type</th>
                                                        <th>Privileges</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td>	
                                                            <div style="margin:0 !important;" class="checkbox">
                                                                <label>
                                                                    <input onclick="selectAllRol(this);" type="checkbox">All
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select onchange="selectAllPrv(this);" style="border-radius: 0 !important;font-size: 10px !important;height: 23px !important;padding: 0 !important;width: 54px !important;" class="form-control">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    if (!empty($this->sys_doc_types)) {
                                                        foreach ($this->sys_doc_types as $doc_typ) {
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td>	
                                                                    <div style="margin:0 !important;" class="checkbox">
                                                                        <label>
                                                                            <input class="role-doc" name="role-doc-typ[]" value="<?php echo $doc_typ->DOC_TYPE_ID ?>" type="checkbox"><?php echo $doc_typ->DOC_TYPE_NAME ?>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <select class="role-doc-prv" name="role-doc-prv[]" style="border-radius: 0 !important;font-size: 10px !important;height: 23px !important;padding: 0 !important;width: 54px !important;" class="form-control">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>		
                                    </div>

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
                function selectAllRol(e) {
                    if (e.checked) {
                        jQuery('.role-doc').prop('checked', true);
                    } else {
                        jQuery('.role-doc').prop('checked', false);
                    }
                }
                function selectAllPrv(e) {
                    jQuery('.role-doc-prv').val(e.value);

                }

                function submitFrom(form) {
                    try {
                        ajaxRequest(form.action, jQuery('#' + form.id).serialize(), function(jsonData) {
                            if (jsonData) {
                                if (jsonData.success == true) {
                                    jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>role');
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



