<?php
function toonAfbeelding($afbeelding, $attributen = '') {
    $CI = & get_instance();
    $CI->load->helper('url');

    return "<img src=\"" . base_url("assets/images/" . $afbeelding) .
            "\"" . _stringify_attributes($attributen) . " />";
}

function toonVideo($video, $attributen = '') {
    $CI = & get_instance();
    $CI->load->helper('url');

    return "<video controls " . _stringify_attributes($attributen) . "><source src=\"" . base_url("assets/images/videos/" . $video) .
            "\" type'video/mp4' >Your browser does not support the video tag.</video>";
}

function haalJavascriptOp($js) {
    $CI = & get_instance();
    $CI->load->helper('url');

    return "<script src=\"" . base_url("assets/js/" . $js) . "\"></script>";
}

function pasStylesheetAan($css) {
    $CI = & get_instance();
    $CI->load->helper('url');

    return "<link rel=\"stylesheet\" type=\"text/css\" href=\"" .
            base_url("assets/css/" . $css) .
            "\" />";
}
