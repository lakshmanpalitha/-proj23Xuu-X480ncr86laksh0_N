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

                    <a href="<?php echo MOD_ADMIN_URL ?>user/">Users</a>
                </li>
            </ol>

            <h3>Users</h3>
            <br />
            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix">
                    <a class="btn btn-blue" href="javascript:;" onclick="showAjaxAddModal()">
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
                        <th>Last Login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->users)) {
                        foreach ($this->users as $users) {
                            ?>
                            <tr style="<?php echo ($users->USER_STATUS == 'I' ? 'background-color: mistyrose;' : '') ?>" class="odd gradeX">
                                <td><?php echo $users->USER_NAME ?></td>
                                <td><?php echo $users->USER_EMAIL ?></td>
                                <td><?php echo $users->USER_LAST_LOG ?></td>
                                <td class="center">
                                    <a href="javascript:;" onclick="showAjaxViewModal('<?php echo $users->USER_ID ?>');" class="btn btn-default btn-xs btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        View
                                    </a>
                                    <a href="javascript:;" onclick="modifyStatus('<?php echo ($users->USER_ID) ?>', 'D')" class="btn btn-danger btn-xs btn-icon icon-left">
                                        <i class="entypo-pencil"></i>Delete
                                    </a>
                                    <a href="javascript:;" onclick="modifyStatus('<?php echo ($users->USER_ID) ?>', '<?php echo ($users->USER_STATUS == 'A') ? 'I' : 'A' ?>')" class="btn btn-<?php echo ($users->USER_STATUS == 'A') ? 'green' : 'gold' ?> btn-xs btn-icon icon-left">
                                        <i class="entypo-pencil"></i><?php echo ($users->USER_STATUS == 'A') ? 'Active' : 'Inactive' ?>
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
                function showAjaxViewModal(val)
                {
                    try {
                        document.getElementById("form1").reset();
                        jQuery('#user_id').val(val);
                        jQuery('#modal-6').modal('show', {backdrop: 'static'});
                        ajaxRequest('<?php echo MOD_ADMIN_URL ?>user/jsonUsers/' + val + '/', '', function(jsonData) {
                            if (jsonData) {
                                if (jsonData.success == true) {
                                    jQuery('#user_name').val(jsonData.data.USER_NAME);
                                    jQuery('#user_email').val(jsonData.data.USER_EMAIL);
                                    jQuery('#status').val(jsonData.data.USER_STATUS);
                                    var user_role = jsonData.data.user_role.split(",");
                                    var role = '';
                                    if (user_role) {
                                        role = "<ul>";
                                        for (var i = 0; i < user_role.length; i++) {
                                            role = role + "<li>" + user_role[i] + "</li>";
                                        }
                                        var role = role + "</ul>";
                                    }
                                    jQuery('#usersRoles').html(role);
                                }
                            }
                        });
                    } catch (err) {
                        alert(err.message);
                    }
                }
                function showAjaxAddModal()
                {
                    try {
                        document.getElementById("form1").reset();
                        jQuery('#user_id').val('');
                        jQuery('#modal-6').modal('show', {backdrop: 'static'});
                    } catch (err) {
                        alert(err.message);
                    }
                }

                function modifyStatus(val, ststus) {
                    try {
                        var str = '';
                        if (ststus == 'A') {
                            str = 'active';
                        } else if (ststus == 'I') {
                            str = 'inactive';
                        } else if (ststus == 'D') {
                            str = 'delete';
                        }
                        if (doConfirm('Are you confirm to ' + str + ' user?')) {
                            ajaxRequest('<?php echo MOD_ADMIN_URL ?>user/jsonStatus/' + val + '/' + ststus + '/', '', function(jsonData) {
                                if (jsonData) {
                                    if (jsonData.success == true) {
                                        jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>user');
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
                    <h4 class="modal-title">New User</h4>
                </div>
                <form  role="form" id="form1" method="post" action="<?php echo MOD_ADMIN_URL ?>user/addNewUser" class="validate_sp_form">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">User Name</label>

                                    <input type="text" class="form-control" id="user_name" name="user_name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>	

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Email</label>

                                    <input type="text" class="form-control" id="user_email" name="user_email" data-validate="required,email" placeholder="Email Field" />
                                </div>	

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Password</label>

                                    <input type="password" class="form-control" id="pwd" name="pwd" data-validate="required" placeholder="Numeric Field" />
                                </div>	
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Re-Password</label>
                                    <input type="password" class="form-control" id="re_pwd" name="re_pwd" data-validate="required" placeholder="Numeric Field" />
                                </div>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Add / Modify Role(s)</label>
                                    <select id="user_role" multiple="multiple" name="user_role[]" class="form-control multi-select">
                                        <?php
                                        if (!empty($this->role)) {
                                            foreach ($this->role as $rol) {
                                                ?>
                                                <option value="<?php echo $rol->ROLE_ID ?>" ><?php echo $rol->ROLE_NAME ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">User's assigned role(s)</label>
                                    <span id='usersRoles'></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                        <input type="hidden" id="user_id" name="user_id" value=""/>
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
                            jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>user');
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
