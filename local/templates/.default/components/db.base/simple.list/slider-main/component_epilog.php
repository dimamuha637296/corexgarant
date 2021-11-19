<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
    $GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/js/libs/slick.min.js"));
    $GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/js/libs/jquery.touchSwipe.min.js"));
?>