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

                    <a href="#">Report</a>
                </li>
                <li>

                    <a href="<?php echo MOD_ADMIN_URL ?>report/stock/">Stock Report</a>
                </li>
            </ol>

            <h3>Stock Report</h3>
            <br />
            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>code</th>
                        <th>Category</th>
                        <th>Sub category</th>
                        <th>Name</th>
                        <th>Currant stock quantity</th>
                        <th>Stock unit</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($this->items)) {
                        foreach ($this->items as $item) {
                            $expiry_item = '';
                            if ($item->QUANTITY <= $item->ITEM_NEAR_RE_ORDER_LEVEL) {
                                $expiry_item = 'background-color: #FF9999;';
                            } else if ($item->QUANTITY <= $item->ITEM_RE_ORDER_LEVEL) {
                                $expiry_item = 'background-color: #FFFF66;';
                            }
                            ?>
                            <tr style="<?php echo ($expiry_item ? $expiry_item : '') ?>" class="odd gradeX">
                                <td><?php echo $item->ITEM_ID ?></td>
                                <td><?php echo $item->ITEM_CODE ?></td>
                                <td><?php echo $item->CAT_NAME ?></td>
                                <td><?php echo $item->SUB_CAT_NAME ?></td>
                                <td><?php echo $item->ITEM_NAME ?></td>
                                <td style="text-align:right;"><?php echo $item->QUANTITY ?></td>
                                <td><?php echo $item->UNIT_NAME ?></td>
                                <td><?php echo $item->ITEM_LOCATION ?></td>
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
