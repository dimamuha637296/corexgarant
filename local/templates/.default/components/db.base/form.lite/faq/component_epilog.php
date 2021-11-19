<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    $GLOBALS['APPLICATION']->AddHeadScript((DEFAULT_SITE_DIR."/js/libs/jquery.validate.min.js"));
    $GLOBALS['APPLICATION']->AddHeadScript((DEFAULT_SITE_DIR."/js/libs/jquery.validate_".ToLower(LANGUAGE_ID).".min.js"));
    $GLOBALS['APPLICATION']->AddHeadScript((DEFAULT_SITE_DIR."/js/libs/jquery.maskedinput.min.js"));
?>