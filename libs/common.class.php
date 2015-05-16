<?php

class common {

    private $filename;
    private $tempName;
    private $size;
    private $maxImgSize;
    private $thumbWidth;
    private $thumbheight;
    private $mediumWidth;
    private $mediumHeight;
    private $largeimgpath;
    private $thumbpath;
    private $midthumbpath;
    private $isAllowThumb;
    private $isAllowMedium;

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

    function setImage($imageArray = null) {
        if (empty($imageArray))
            return false;
        $this->filename = $imageArray['filename'];
        $this->tempName = $imageArray['tempname'];
        $this->size = $imageArray['size'];
        $this->maxImgSize = $imageArray['maximagesize'];
        $this->thumbWidth = $imageArray['thumbwidth'];
        $this->thumbheight = $imageArray['thumbheight'];
        $this->mediumWidth = $imageArray['mediumwidth'];
        $this->mediumHeight = $imageArray['mediumheight'];
        $this->largeimgpath = $imageArray['largeimguploadpath'];
        $this->thumbpath = $imageArray['thumbimaguploadpath'];
        $this->midthumbpath = $imageArray['mediumimageuploadpath'];
        $this->isAllowThumb = $imageArray['isallowthumb'];
        $this->isAllowMedium = $imageArray['isallowmedium'];
    }

    function imageUpload() {

        $tmp_name = $this->tempName;
        $size = $this->size;

        if (!$this->filename || !$tmp_name) {# make sure that the file is not empty to avoid error
            return false;
        }


        $uploadedfile = $tmp_name;
        $file_name = $this->filename;


        #get the file extension
        $boss = explode(".", strtolower($file_name));
        $extension = strtolower(end($boss)); #make it lowercase with strtower


        $array = array('jpg', 'jpeg', 'png', 'gif'); # store all allowed file type in array

        if (!in_array($extension, $array)) {
            #see if file type is in array else stop execution
            session::setError("feedback_negative", FEEDBACK_IMAGE_TYPE_ERROR);
            return false;
        }


        if ($size > $this->maxImgSize) { # check file size in kilobits
            session::setError("feedback_negative", FEEDBACK_IMAGE_SIZE_ERROR);
            return false;
        }

#image processing start
        if ($extension == "jpg" || $extension == "jpeg") {
            $src = imagecreatefromjpeg($uploadedfile);
        } else
        if ($extension == "png") {
            $src = imagecreatefrompng($uploadedfile);
        } else {
            $src = imagecreatefromgif($uploadedfile);
        }

        list($width, $height) = getimagesize($uploadedfile); # get the width and height of our image
        //Upload original

        $tmp_original_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp_original_image, $src, 0, 0, 0, 0, $width, $height, $width, $height);
        if (!is_dir($this->largeimgpath)) {
            if (!mkdir($this->largeimgpath, 0777, true)) {
                session::setError("feedback_negative", FEEDBACK_ORI_IMAGE_UPLOAD_PARH_ERROR);
                return false;
            }
        }
        if (!imagejpeg($tmp_original_image, $this->largeimgpath . "/" . $file_name, 100))
            return false;
        imagedestroy($tmp_original_image);


        //Upload thumb
        if ($this->isAllowThumb) {
            //set thumb image width 
            $thumb_width = ($this->thumbWidth ? $this->thumbWidth : $width);
            //set thumb image height
            if ($this->thumbheight) {
                $thumb_height = $this->thumbheight;
            } else {
                $thumb_height = ($height / $width) * $thumb_width;
            }

            $tmp_thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);
            imagecopyresampled($tmp_thumb_image, $src, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
            if (!is_dir($this->thumbpath)) {
                if (!mkdir($this->thumbpath, 0777, true)) {
                    session::setError("feedback_negative", FEEDBACK_THUMB_IMAGE_UPLOAD_PARH_ERROR);
                    return false;
                }
            }

            if (!imagejpeg($tmp_thumb_image, $this->thumbpath . "/thumb_" . $file_name, 100))
                return fale;
            imagedestroy($tmp_thumb_image);
        }

//Upload medium
        if ($this->isAllowMedium) {
            $medium_width = ($this->mediumWidth ? $this->mediumWidth : $width);

            //set medium image height
            if ($this->mediumHeight) {
                $medium_height = $this->mediumHeight;
            } else {
                $medium_height = ($height / $width) * $medium_width;
            }
            $tmp_medium_image = imagecreatetruecolor($medium_width, $medium_height);
            imagecopyresampled($tmp_medium_image, $src, 0, 0, 0, 0, $medium_width, $medium_height, $width, $height);
            if ($this->midthumbpath) {
                if (!is_dir($this->midthumbpath)) {
                    if (!mkdir($this->midthumbpath, 0777, true)) {
                        session::setError("feedback_negative", FEEDBACK_MEDIUM_IMAGE_UPLOAD_PARH_ERROR);
                        return false;
                    }
                }
            }

            if (!imagejpeg($tmp_medium_image, $this->midthumbpath . "/medium_" . $file_name, 100))
                return false;
            imagedestroy($tmp_medium_image);
        }

        imagedestroy($src);
        return true;
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