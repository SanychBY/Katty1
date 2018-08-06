<?php
namespace core\libs;

class Imagegenerator
{

    public $no_img_path = 'static/480px-No_image_available.svg.png';

    public function get_img($src)
    {
        $fp = fopen($src, 'rb');
        $tmp = explode('.', $src);
        $file_extension = end($tmp);
        $ctype = '';
        switch ($file_extension) {
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg":
                $ctype = "image/jpeg";
                break;
            default:
        }

        header("Content-Type: " . $ctype);
        header("Content-Length: " . filesize($src));

        fpassthru($fp);
        exit;
    }

    public function generate()
    {
        if (!empty($_REQUEST['src']) && isset($_REQUEST['w']) && isset($_REQUEST['h'])) {
            $src = $_REQUEST['src'];
            $w = $_REQUEST['w'];
            $h = $_REQUEST['h'];
            $cache_path = $_SERVER['DOCUMENT_ROOT'] . '/cache/__imgcache/' . $w . '_' . $h . '/' . $src;
            if (file_exists($cache_path)) {
                $this->get_img($cache_path);
            } else {
                if (file_exists($src)) {
                    list($width, $height) = getimagesize($src);
                    $p = 1;
                    $new_width = $w;
                    $new_height = $h;
                    if (!empty($w) && empty($h)) {
                        $p = $width / $w;
                    }
                    if (empty($w) && !empty($h)) {
                        $p = $height / $h;
                    }
                    if (empty($w) && empty($h)) {
                        $new_width = $width;
                        $new_height = $height;
                    }
                    if ($p != 1) {
                        $new_height = $height / $p;
                        $new_width = $width / $p;
                    }
                    $tmp = explode('.', $src);
                    $file_extension = end($tmp);
                    $ctypef = '';
                    switch ($file_extension) {
                        case "gif":
                            $ctypef = "gif";
                            break;
                        case "png":
                            $ctypef = "png";
                            break;
                        case "jpeg":
                        case "jpg":
                            $ctypef = "jpeg";
                            break;
                        default:
                    }
                    $f = 'imagecreatefrom' . $ctypef;
                    if (!function_exists($f)) {
                        $this->get_img($this->no_img_path);
                    }
                    $image_p = imagecreate($new_width, $new_height);
                    $image = $f($src);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                    $dir_path = explode('/', $cache_path);
                    unset($dir_path[count($dir_path) - 1]);
                    $dir_path = implode('/', $dir_path);
                    if (!file_exists($dir_path)) {
                        mkdir($dir_path, 0777, true);
                    }

                    $fimg = 'image' . $ctypef;
                    if (!function_exists($fimg)) {
                        $this->get_img($this->no_img_path);
                    }
                    $fimg($image_p, $cache_path);
                    $this->get_img($cache_path);
                } else {
                    $this->get_img($this->no_img_path);
                }
            }
        }
    }
}
