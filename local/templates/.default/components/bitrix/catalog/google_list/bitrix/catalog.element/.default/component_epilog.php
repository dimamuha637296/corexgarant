<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(CModule::IncludeModule("iblock")){
	CIBlockElement::CounterInc($arResult["ID"]);
}

	$GLOBALS['APPLICATION']->AddHeadScript(SITE_TEMPLATE_PATH."/js/".ToLower(LANGUAGE_ID)."/jquery.fancybox.pack.js");
	$GLOBALS['APPLICATION']->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jquery.fancybox.css'); 
if (!defined('BX_GMAP_SCRIPT_LOADED'))
{
	CUtil::InitJSCore();
	
	if ($arParams['DEV_MODE'] != 'Y')
	{
		$GLOBALS['APPLICATION']->AddHeadString('<script src="http://maps.google.com/maps/api/js?sensor=false&language='.LANGUAGE_ID.'" charset="utf-8"></script>');
		
		define('BX_GMAP_SCRIPT_LOADED', 1);
	}
}
?>