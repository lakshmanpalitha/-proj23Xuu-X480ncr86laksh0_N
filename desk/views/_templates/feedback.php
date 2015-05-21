<?php
// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = Session::get('feedback_positive');
$feedback_negative = Session::get('feedback_negative');
Session::clear('feedback_positive');
Session::clear('feedback_negative');

// echo out positive messages
$msg = null;
if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback) {
        $msg = "<li>" . $feedback . "</li>";
    }
}

// echo out negative messages
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback) {
        $msg = "<li>" . $feedback . "</li>";
    }
}
if ($msg) {
    ?>

    <div id="error_body">
        <div id="error_msg" class="alert alert-danger">
            <ul>
                <?php echo $msg ?>
            </ul>
        </div>
    </div>
<?php } ?>

