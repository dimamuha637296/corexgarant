<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetPageProperty("HideTitle", "Y");
if($arResult["IMAGES"]){
	$GLOBALS['APPLICATION']->AddHeadScript("/local/templates/.default/js/libs/jquery.carouFredSel-6.2.1.min.js");
	$GLOBALS['APPLICATION']->SetAdditionalCSS(('/local/templates/.default/css/libs/magnific-popup.min.css'));
	$GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/js/libs/jquery.magnific-popup.min.js"));
}
/*
if($arResult["URL"] != $arResult["DETAIL_PAGE_URL"]){
	LocalRedirect($arResult["URL"], false, '301 Moved permanently');
}
*/
if($arResult["PROPERTIES"]["IT_TOVAR"]["VALUE"]){
    $GLOBALS["IT_TOVAR"] = $arResult["PROPERTIES"]["IT_TOVAR"]["VALUE"];
}
//*
if($arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]){
    $arDescription = $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"];
}else{
    $arDescription = substr(strip_tags($arResult["PREVIEW_TEXT"]), 0, 155);
}
$APPLICATION->SetPageProperty("description", $arDescription);
?>
<?
/*
$num_img = array_shift($arResult["IMAGES"]);
$APPLICATION->AddHeadString('<meta property="og:title" content="'.$arResult["NAME"].'" /> ',true);
$APPLICATION->AddHeadString('<meta property="og:description" content="'.substr(strip_tags($arResult["PREVIEW_TEXT"]), 0, 30).'" /> ',true);
$APPLICATION->AddHeadString('<meta property="og:image" content="http://'.$_SERVER["SERVER_NAME"].$num_img["IMG"]["src"].'" /> ',true);
$APPLICATION->AddHeadString('<meta property="og:url" content="'.$_SERVER["HTTP_REFERER"].'" /> ',true);

*/
//*/
//$APPLICATION->SetPageProperty("og:title", $arResult["NAME"]);
//$APPLICATION->SetPageProperty("hide_sedebar", "Y");
//$APPLICATION->SetPageProperty("catalog_top_class", "main");
//$APPLICATION->SetPageProperty("g-content-count-grid", "none");
//$APPLICATION->SetPageProperty("body_class", "container_12");
//$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>