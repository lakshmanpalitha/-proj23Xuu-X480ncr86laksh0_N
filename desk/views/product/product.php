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
                    <a href="<?php echo MOD_ADMIN_URL ?>product">Product</a>
                </li>
            </ol>

            <h3>Products</h3>
            <br />
            <div class="row">
                <div class="col-md-6 col-sm-8 clearfix">
                    <a class="btn btn-blue" href="<?php echo MOD_ADMIN_URL ?>product/newProduct">
                        <i class="entypo-plus"></i>
                        Add New
                    </a>
                </div>
            </div>
            <br />

            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>Product Created Date</th>
                        <th>Product Status</th>
                        <th>Product Mode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->products)) {
                        foreach ($this->products as $product) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $product->PRODUCT_ID ?></td>
                                <td><?php echo $product->PRODUCT_NAME ?></td>
                                <td><?php echo $product->PRODUCT_CREATE_DATE ?></td>
                                <td>
                                    <?php
                                    echo ($product->PRODUCT_STATUS == 'A' ? '
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
                                    if ($product->PRODUCT_MODE == 'S') {
                                        echo '
                                            <button class="btn btn-gold  btn-icon icon-left  btn-xs" type="button">
                                            Draft<i class="entypo-check"></i>
                                            </button>';
                                    } else if ($product->PRODUCT_MODE == 'o') {
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
                                <td>
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
                        <?php }
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
