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

            <h2>GRN</h2>
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div style="border:none !important;text-align:right;" class="panel panel-primary">
                        <button type="button" class="btn btn-gold btn-icon icon-left disabled">
                            Pending
                            <i class="entypo-info"></i>
                        </button>
                        <button class="btn btn-green btn-sm" type="button">Save</button>
                        <button class="btn btn-blue btn-sm" type="button">Submit</button>
                        <button class="btn btn-danger btn-sm" type="button">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="panel panel-info">

                <div class="panel-heading">
                    <div class="panel-title">Add New GRN</div>

                    <div class="panel-options">
                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" id="form1" method="post" class="validate">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">GRN Id</label>

                                    <input disabled type="text" class="form-control" name="grn-id"  data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Invoice Id</label>

                                    <input type="text" class="form-control" name="inv-id" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Vendor</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Invoice Date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" data-format="D, dd MM yyyy">
                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" name="title" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                                </div>
                            </div>
                        </div> 
                    </form>
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

                                    <div class="panel-options">
                                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered datatable" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th data-hide="phone">Rendering engine</th>
                                                        <th>Browser</th>
                                                        <th data-hide="phone">Platform(s)</th>
                                                        <th data-hide="phone,tablet">Engine version</th>
                                                        <th>CSS grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td>Trident</td>
                                                        <td>Internet Explorer 4.0</td>
                                                        <td>Win 95+</td>
                                                        <td class="center">4</td>
                                                        <td class="center">X</td>
                                                    </tr>
                                                    <tr class="even gradeC">
                                                        <td>Trident</td>
                                                        <td>Internet Explorer 5.0</td>
                                                        <td>Win 95+</td>
                                                        <td class="center">5</td>
                                                        <td class="center">C</td>
                                                    </tr>
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
                                <textarea style="border-radius:0 !important;height:70px !important" class="form-control autogrow" name="about" id="about" data-validate="minlength[10]" rows="5" placeholder="Could be used also as Motivation Letter"></textarea>
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
                                    <div class="panel-title">GRN Comments</div>

                                    <div class="panel-options">
                                        <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                                        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                                        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                                        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                                    </div>
                                </div>

                                <!-- panel body -->
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label" for="about">New Comment</label>
                                                <textarea style="border-radius:0 !important;height:70px !important" class="form-control autogrow" name="about" id="about" data-validate="minlength[10]" rows="5" placeholder="Could be used also as Motivation Letter"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-blue btn-sm" type="button">Publish</button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>





                </div>
            </div>
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
                <form role="form" id="form1" method="post" class="validate">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Item Code</label>
                                    <select class="form-control">
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                    </select>                                   
                                </div>	

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" disabled placeholder="Item Name" />
                                </div>	

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Amount</label>
                                    <input type="text" class="form-control" name="amount" data-validate="required,number" placeholder="Numeric Field" />
                                </div>	
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Quantity</label>
                                    <input type="text" class="form-control" name="qty" data-validate="required,number" placeholder="Numeric Field" />
                                </div>	
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Exp Date</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datepicker" data-format="D, dd MM yyyy">
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
    <!-- Bottom scripts (common) -->
    <script src="<?php echo JS_PATH ?>gsap/main-gsap.js"></script>
    <script src="<?php echo JS_PATH ?>jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
    <script src="<?php echo JS_PATH ?>bootstrap.js"></script>
    <script src="<?php echo JS_PATH ?>joinable.js"></script>
    <script src="<?php echo JS_PATH ?>resizeable.js"></script>
    <script src="<?php echo JS_PATH ?>neon-api.js"></script>


    <!-- Imported scripts on this page -->
    <script src="<?php echo JS_PATH ?>jquery.validate.min.js"></script>
    <script src="<?php echo JS_PATH ?>neon-chat.js"></script>
    <script src="<?php echo JS_PATH ?>bootstrap-datepicker.js"></script>


    <!-- JavaScripts initializations and stuff -->
    <script src="<?php echo JS_PATH ?>neon-custom.js"></script>


    <!-- Demo Settings -->
    <script src="<?php echo JS_PATH ?>neon-demo.js"></script>