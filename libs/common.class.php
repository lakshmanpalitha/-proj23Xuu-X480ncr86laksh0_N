<?php

class common {

    function __construct(Database $db) {
        
    }

    function getMonths($date1, $date2) {
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $my = date('mY', $time2);
        $months = array();
        if (!in_array(date('Y-m-d', $time1), $months)) {
            $months[] = date('Y-m-d', $time1);
        }
        $f = '';

        while ($time1 < $time2) {
            $time1 = strtotime((date('Y-m-d', $time1) . ' +15days'));
            if (date('F', $time1) != $f) {
                $f = date('F', $time1);
                if (date('mY', $time1) != $my && ($time1 < $time2)) {
                    if (!in_array(date('Y-m-d', $time1), $months)) {
                        $months[] = date('Y-m-d', $time1);
                    }
                }
            }
        }

        if (!in_array(date('Y-m-d', $time2), $months)) {
            $months[] = date('Y-m-d', $time2);
        }
        return $months;
    }

    function diffDate($date1, $date2) {
        $tmp1 = explode("-", $date1);
        $tmp2 = explode("-", $date2);
        if (strlen($tmp1[0]) == 4) {
            $d1 = mktime(0, 0, 0, $tmp1[1], $tmp1[2], $tmp1[0]);
            $d2 = mktime(0, 0, 0, $tmp2[1], $tmp2[2], $tmp2[0]);
            $d3 = $d2 - $d1;
            $diff_days = ($d3 / (60 * 60 * 24));
        } else {
            $d1 = mktime(0, 0, 0, $tmp1[1], $tmp1[0], $tmp1[2]);
            $d2 = mktime(0, 0, 0, $tmp2[1], $tmp2[0], $tmp2[2]);
            $d3 = $d2 - $d1;
            $diff_days = ($d3 / (60 * 60 * 24));
        }
        return $diff_days;
    }

    function formatDate($reqDate) {
        return date('Y-m-d', strtotime($reqDate));
    }

    function getLastDayOfSelectedMonth($reqDate) {
        if ($reqDate) {
            $date = new DateTime($reqDate);
            $nbrDay = $date->format('t');
            return $lastDay = $date->format('Y-m-t');
        }
        return null;
    }

    public function deleteFile($filename) {
        if (is_dir($filename)) {
            foreach (scandir($filename) as $file) {
                if ('.' === $file || '..' === $file)
                    continue;
                if (is_dir("$filename/$file"))
                    $this->deleteFile("$filename/$file");
                else {
                    try {
                        if (!unlink("$filename/$file")) {
                            throw new Exception("Unlink fail");
                        }
                    } catch (Exception $e) {
                        session::setError("feedback_negative", FEEDBACK_IMAGE_VEHICLE_ERROR);
                        return false;
                    }
                }
            }
            rmdir($filename);
            return true;
        } else {

            if (file_exists($filename)) {
                try {
                    if (!unlink($filename)) {
                        throw new Exception("Unlink fail");
                    }
                } catch (Exception $e) {
                    session::setError("feedback_negative", FEEDBACK_IMAGE_VEHICLE_ERROR);
                    return false;
                }
            } else {
                return false;
            }
        }
        return false;
    }

}

?>