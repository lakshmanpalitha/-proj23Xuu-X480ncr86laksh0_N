<!-- Modal 6 (Long Modal)-->
<div class="modal fade" id="error_display">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Error</h4>
            </div>
            <form role="form" id="form1" class="validate">
                <div class="modal-body">
                    <div class="row">
                        <div style="color: red;" id="error_display_container" class="col-md-12">
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div style='display:none;' id='waitingDiv'>
    <img src='<?php echo URL ?>assets/images/loader-1.gif'/>
    <span id='waitingText'>Please Wait...</span>
</div>
</body>
</html>