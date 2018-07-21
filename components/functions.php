<?php
    function validate_email($email) {
        $validate_email = trim($email);
        $re = '/(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/m';
        preg_match_all($re, $validate_email, $matches, PREG_SET_ORDER, 0);
        if(!$matches) {
            return 'error';
        } else {
            return $validate_email;
        }
    }

    /*Транслит названия изображения*/
    function correct_filename($filename) {
        $ru = explode('-', "А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я");
        $en = explode('-', "A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch---Y-y---E-e-YU-yu-YA-ya");

        $res = str_replace($ru, $en, $filename);
        $res = preg_replace("/[\s]+/ui", '-', $res);
        $res = preg_replace("/[^a-zA-Z0-9\.\-\_]+/ui", '', $res);
        $res = strtolower($res);
        return $res;
    }

    /*Загрузка изображения*/
    function upload_image($filename, $name, $dir, $new_width, $new_heignt) {
        $quality = 75; //Качество изображения jpg
        // Имя оригинального файла
        $name = preg_replace('~(.+)\.([0-9]*)x([0-9]*)(w)?\.([^\.\?]+)$~', '${1}.${5}', $name);
        $name = correct_filename($name);
        $uploaded_file = $new_name = pathinfo($name, PATHINFO_BASENAME);
        $base = pathinfo($uploaded_file, PATHINFO_FILENAME);
        /*Тип файла*/
        $type = set_type($filename);
        /*Функция ресайза. На выходе ресурс*/
        $resize_image = resize($filename, $new_width, $new_heignt, $type);


        while(file_exists(dirname(dirname(__FILE__)).$dir.$new_name)) {
            $new_base = pathinfo($new_name, PATHINFO_FILENAME);
            if(preg_match('/_([0-9]+)$/', $new_base, $parts)) {
                $new_name = $base.'_'.($parts[1]+1).'.'.$type;
            } else {
                $new_name = $base.'_1.'.$type;
            }
        }
        $save_path = dirname(dirname(__FILE__)).$dir.$new_name;
        switch($type) {
            case 'jpg':
                if (!is_numeric($quality) || $quality < 0 || $quality > 100) {
                    $quality = 100;
                }
                imagejpeg($resize_image, $save_path, $quality);
                return $new_name;
            case 'png':
                imagepng($resize_image, $save_path);
                return $new_name;
            case 'gif':
                imagegif($resize_image, $save_path);
                return $new_name;
            default:
                return false;
        }

        return false;
    }

    function set_type($file) {
        $mime = mime_content_type($file);
        switch($mime) {
            case 'image/jpeg':
                return "jpg";
            case 'image/png':
                return "png";
            case 'image/gif':
                return "gif";
            default:
                return false;
        }
    }

    function open_image($file, $type) {
        switch($type) {
            case 'jpg':
                return @imagecreatefromjpeg($file);
                break;
            case 'png':
                return @imagecreatefrompng($file);
                break;
            case 'gif':
                return @imagecreatefromgif($file);
                break;
            default:
                exit("File is not an image");
        }
    }

    function resize($filename, $width, $height, $type) {

        $filename = open_image($filename, $type);
        $old_width = imagesx($filename);
        $old_height = imagesy($filename);

        if(is_numeric($width) && is_numeric($height) && $width > 0 && $height > 0) {
            $newSize = getSizeByFramework($width, $height, $old_width, $old_height);
        }

        $newImage = imagecreatetruecolor($newSize[0], $newSize[1]);

        //завернуть в отдельную функцию, сжимающую изображение поэтапно
        imagecopyresampled($newImage, $filename, 0, 0, 0, 0, $newSize[0], $newSize[1], $old_width, $old_height);


        $filename = $newImage;

        return $filename;
    }

    function getSizeByFramework($width, $height, $old_width, $old_height) {
        if($old_width <= $width && $old_height <= $height) {
            return array($old_width, $old_height);
        }
        if($old_width / $width > $old_height / $height) {
            $newSize[0] = $width;
            $newSize[1] = round($old_height * $width / $old_width);
        } else {
            $newSize[1] = $height;
            $newSize[0] = round($old_width * $height / $old_height);
        }
        return $newSize;
    }
?>