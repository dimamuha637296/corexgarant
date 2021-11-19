<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");
	$this->arResult['JSCORE'][] = 'fx';
	
$GLOBALS['APPLICATION']->AddHeadScript((SITE_TEMPLATE_PATH."/js/libs/jquery.magnific-popup.min.js"));
	$GLOBALS['APPLICATION']->SetAdditionalCSS((SITE_TEMPLATE_PATH.'/css/libs/magnific-popup.min.css'));	
?>