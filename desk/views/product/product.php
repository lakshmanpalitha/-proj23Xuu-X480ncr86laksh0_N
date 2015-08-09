
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
                        <th>Product Quantity</th>
                        <th>Product Quantity Unit</th>
                        <th>Product Created Date</th>
                        <th>Product Mode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->products)) {
                        foreach ($this->products as $product) {
                            ?>
                            <tr style="<?php echo ($product->PRODUCT_STATUS == 'I' ? 'background-color: mistyrose;' : '') ?>" class="odd gradeX">
                                <td><?php echo $product->PRODUCT_ID ?></td>
                                <td><?php echo $product->PRODUCT_NAME ?></td>
                                <td><?php echo $product->PRODUCT_QUANTITY ?></td>
                                <td><?php echo $product->UNIT_NAME ?></td>
                                <td><?php echo $product->PRODUCT_CREATE_DATE ?></td>
                                <td>
                                    <?php
                                    if ($product->PRODUCT_MODE == 'S') {
                                        echo '
                                            <button class="btn btn-gold  btn-icon icon-left  btn-xs" type="button">
                                            Draft<i class="entypo-check"></i>
                                            </button>';
                                    } else if ($product->PRODUCT_MODE == 'P') {
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
                                    <a href="<?php echo MOD_ADMIN_URL ?>product/viewProduct/<?php echo base64_encode($product->PRODUCT_ID) ?>" class="btn btn-default btn-xs btn-icon icon-left">
                                        <i class="entypo-pencil"></i>
                                        View
                                    </a>
                                    <a href="javascript:;" onclick="modifyStatus('<?php echo ($product->PRODUCT_ID) ?>', 'D')" class="btn btn-danger btn-xs btn-icon icon-left">
                                        <i class="entypo-pencil"></i>Delete
                                    </a>
                                    <?php if ($product->PRODUCT_MODE == 'A') { ?>
                                        <a href="javascript:;" onclick="modifyStatus('<?php echo ($product->PRODUCT_ID) ?>', '<?php echo ($product->PRODUCT_STATUS == 'A') ? 'I' : 'A' ?>')" class="btn btn-<?php echo ($product->PRODUCT_STATUS == 'A') ? 'green' : 'gold' ?> btn-xs btn-icon icon-left">
                                            <i class="entypo-pencil"></i><?php echo ($product->PRODUCT_STATUS == 'A') ? 'Active' : 'Inactive' ?>
                                        </a>
                                    <?php } ?>
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
                        if (doConfirm('Are you confirm to ' + str + ' product?')) {
                            ajaxRequest('<?php echo MOD_ADMIN_URL ?>product/jsonStatus/' + val + '/' + ststus + '/', '', function(jsonData) {
                                if (jsonData) {
                                    if (jsonData.success == true) {
                                        jQuery(location).attr('href', '<?php echo MOD_ADMIN_URL ?>product');
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
