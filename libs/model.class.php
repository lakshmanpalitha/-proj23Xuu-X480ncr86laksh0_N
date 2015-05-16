<?php

class model extends common {

    function __construct() {

        // create database connection
        try {
            $this->db = new database();
        } catch (Exception $e) {
            die('Database connection could not be established.');
        }

        $this->read = new read();
        $this->session = new session();
        $this->email = new PHPMailer();
        $this->arr = array();
    }

    function sendMail($Message, $Subject, $ToEmail) {

        $FromEmail = 'lakmalwimaladasa@yahoo.com';
        $FromName = 'OVRS';
        $this->email->From = $FromEmail;
        $this->email->FromName = $FromName;

        $this->email->IsSMTP();

        $this->email->SMTPAuth = true;     // turn of SMTP authentication
        $this->email->Username = "lakmalwimaladasa@yahoo.com";  // SMTP username  (Ex: sumithnets@yahoo.com)
        $this->email->Password = "123456"; // SMTP password  (Ex: yahoo email password)
        $this->email->SMTPSecure = "ssl";

        $this->email->Host = "smtp.mail.yahoo.com";
        $this->email->Port = 465;

        $this->email->SMTPDebug = 2; // Enables SMTP debug information (for testing, remove this line on production mode)
        // 1 = errors and messages
        // 2 = messages only

        $this->email->Sender = $FromEmail; // $bounce_email;
        $this->email->ConfirmReadingTo = $FromEmail;

        $this->email->AddReplyTo($FromEmail);
        $this->email->IsHTML(true); //turn on to send html email
        $this->email->Subject = $Subject;

        $this->email->Body = $Message;
        $this->email->AltBody = "ALTERNATIVE MESSAGE FOR TEXT WEB BROWSER LIKE SQUIRRELMAIL";

        $this->email->AddAddress($ToEmail, $ToEmail);

        if ($this->email->Send()) {
            $this->email->ClearAddresses();
            return true;
        } else {
            session::setError("feedback_negative", "Mailer Error: " . $this->email->ErrorInfo);
            return false;
        }
    }

    function sms($msg, $no) {

        $user = "lakmal";
        $password = "R1okGUCy";
        $api_id = "3397131";
        $baseurl = "http://api.clickatell.com";

        $text = urlencode($msg);
        $to = $no;


        // auth call
        $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";

        // do auth call
        $ret = file($url);

        // explode our response. return string is on first line of the data returned
        $sess = explode(":", $ret[0]);
        if ($sess[0] == "OK") {

            $sess_id = trim($sess[1]); // remove any whitespace
            $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";

            // do sendmsg call
            $ret = file($url);
            $send = explode(":", $ret[0]);

            if ($send[0] == "ID") {
                session::setError("feedback_positive", "successnmessage ID: " . $send[1]);
                return true;
            } else {
                session::setError("feedback_negative", "Massage sending failed");
                return false;
            }
        } else {
            session::setError("feedback_negative", "Authentication failure: " . $ret[0]);
            return false;
        }
    }

}

?>