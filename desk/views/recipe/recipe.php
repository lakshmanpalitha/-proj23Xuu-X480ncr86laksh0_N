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
                    <a href="<?php echo MOD_ADMIN_URL ?>recipe/">Forms</a>
                </li>
            </ol>

            <h3>Recipes</h3>
            <br />
            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix">
                    <a class="btn btn-blue" href="<?php echo MOD_ADMIN_URL ?>recipe/newRecipe">
                        <i class="entypo-plus"></i>
                        Add New
                    </a>
                    <a class="btn btn-blue" href="javascript:;" onclick="jQuery('#modal-7').modal('show', {backdrop: 'static'});">
                        <i class="entypo-plus"></i>
                        Import Recipe
                    </a>
                </div>
            </div>
            <br />

            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th>Recipe Id</th>
                        <th>Recipe Name</th>
                        <th>Recipe Created</th>
                        <th>Recipe Status</th>
                        <th>Recipe Mode</th>
                        <th>Recipe Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->recipes)) {
                        foreach ($this->recipes as $recipe) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $recipe->RECIPE_ID ?></td>
                                <td><?php echo $recipe->RECIPE_NAME ?></td>
                                <td><?php echo $recipe->RECIPE_CREATE_DATE ?></td>
                                <td>
                                    <?php
                                    echo ($recipe->RECIPE_STATUS == 'A' ? '
                                        <button class="btn btn-green btn-icon icon-left  btn-xs" type="button">
                                            Active<i class="entypo-check"></i>
                                        </button>' :
                                            '<button class="btn btn-gold btn-icon icon-left  btn-xs" type="button">
                                                Inactive<i class="entypo-cancel"></i>
                                         </button>')
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($recipe->RECIPE_MODE == 'S') {
                                        echo '
                                            <button class="btn btn-gold  btn-icon icon-left  btn-xs" type="button">
                                            Draft<i class="entypo-check"></i>
                                            </button>';
                                    } else if ($recipe->RECIPE_MODE == 'o') {
                                        echo '
                                            <button class="btn btn-blue btn-icon icon-left  btn-xs" type="button">
                                                Submit<i class="entypo-cancel"></i>
                                            </button>';
                                    } else {
                                        echo '
                                            <button class="btn btn-green  btn-icon icon-left  btn-xs" type="button">
                                                Accept<i class="entypo-cancel"></i>
                                            </button>';
                                    }
                                    ?>
                                </td>
                                <td class="center">
                                    <a href="<?php echo MOD_ADMIN_URL ?>recipe/viewRecipe/<?php echo base64_encode($recipe->RECIPE_ID) ?>"  class="btn btn-default btn-xs btn-icon icon-left">
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
    <!-- Modal 7 (Long Modal)-->
    <div class="modal fade" id="modal-7">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Import Existing Recipe</h4>
                </div>
                <form role="form" action="<?php echo MOD_ADMIN_URL ?>recipe/importRecipe" id="form_import_recipe" method="GET" class="validate_sp_form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Recipe Code</label>
                                    <select name="recipe_id" id="recipe_id"  class="select2" data-allow-clear="true" data-placeholder="Select recipe">
                                        <?php
                                        if (!empty($this->recipes)) {
                                            foreach ($this->recipes as $recipe) {
                                                ?>
                                                <option value="<?php echo base64_encode($recipe->RECIPE_ID) ?>" > <?php echo $recipe->RECIPE_NAME ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>                                   
                                </div>	
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function submitFrom(form) {
            try {
                jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>recipe/importRecipe/' + form.recipe_id.value + '/');
                return false;
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
    <!-- Imported styles on this page -->
    <link rel="stylesheet" href="<?php echo JS_PATH ?>datatables/responsive/css/datatables.responsive.css">


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
    <script src="<?php echo JS_PATH ?>select2/select2.min.js"></script>
    <script src="<?php echo JS_PATH ?>jquery.validate.min.js"></script>
    <script src="<?php echo JS_PATH ?>neon-chat.js"></script>
    <script src="<?php echo JS_PATH ?>dataTables.bootstrap.js"></script>
    <script src="<?php echo JS_PATH ?>datatables/jquery.dataTables.columnFilter.js"></script>
    <script src="<?php echo JS_PATH ?>datatables/lodash.min.js"></script>
    <script src="<?php echo JS_PATH ?>datatables/responsive/js/datatables.responsive.js"></script>
 

    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo JS_PATH ?>neon-custom.js"></script>

    <!-- Demo Settings -->
    <script src="<?php echo JS_PATH ?>neon-demo.js"></script>
