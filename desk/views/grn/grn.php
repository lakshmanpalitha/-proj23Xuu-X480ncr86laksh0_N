<?php
$this->renderFeedbackMessages();
var_dump($this->users)
?>

<div class="main-content">

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

    <h2>Form Validation</h2>
    <br />

    <div class="panel panel-primary">

        <div class="panel-heading">
            <div class="panel-title">All fields have validation rules <small><code>data-validate="rule1,rule2,...,ruleN"</code></small></div>

            <div class="panel-options">
                <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
            </div>
        </div>

        <div class="panel-body">

            <form role="form" id="form1" method="post" class="validate">

                <div class="form-group">
                    <label class="control-label">Required Field + Custom Message</label>

                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="This is custom message for required field." placeholder="Required Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">Email Field</label>

                    <input type="text" class="form-control" name="email" data-validate="email" placeholder="Email Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">Input Min Field</label>

                    <input type="text" class="form-control" name="min_field" data-validate="number,minlength[4]" placeholder="Numeric + Minimun Length Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">Input Max Field</label>

                    <input type="text" class="form-control" name="max_field" data-validate="maxlength[2]" placeholder="Maximum Length Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">Numeric Field</label>

                    <input type="text" class="form-control" name="number" data-validate="number" placeholder="Numeric Field" />
                </div>

                <div class="form-group">
                    <label class="control-label">URL Field</label>

                    <input type="text" class="form-control" name="url" data-validate="required,url" placeholder="URL" />
                </div>

                <div class="form-group">
                    <label class="control-label">Credit Card Field</label>

                    <input type="text" class="form-control" name="creditcard" data-validate="required,creditcard" placeholder="Credit Card" />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Validate</button>
                    <button type="reset" class="btn">Reset</button>
                </div>

            </form>

        </div>

    </div>
    <!-- Footer -->
    <footer class="main">

        &copy; 2014 <strong>Neon</strong> Admin Theme by <a href="http://laborator.co" target="_blank">Laborator</a>

    </footer>
</div>