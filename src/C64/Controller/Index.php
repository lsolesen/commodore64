<?php
class C64_Controller_Index extends k_Controller
{
    function __construct()
    {
        $allowed = array("load", "list", "run", "reset");

        if (isset($this->GET['kommando'])) {
            $this->GET['kommando'] = strip_tags($this->GET['kommando']);
        } else {
            $this->GET['kommando'] = '';
        }

        // finde kommandoen
        $tmp = explode(" ", $_GET['kommando']);
        $c64prompt = trim($tmp[0]);

        // finde det kommandoen skal gøre
        if (isset($tmp[1])) {
            $secondKommando = stripslashes($tmp[1]);
            $tmp = explode('"', $secondKommando);
            $loadWhat = $tmp[1];
        }

        switch($c64prompt) {
            case 'run':
                if ((int)$_GET['site'] > 0) {
                    header("Location: load.php?file=".(int)$_GET['site']);
                    exit;
                }
                $c64prompt = 'run';
                break;

            case 'ci':
                header("Location: /websites/customer/");
                exit;

            case 'manual';
                header("Location: http://www.zimmers.net/cbmpics/cbm/c64/c64ug.txt");
                exit;

            case 'list';
                $c64prompt = 'load';
                $this->GET['kommando'] = 'load "$",8';

            default:

        }
    }
}