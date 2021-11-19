<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//pr($arParams);
$this->setFrameMode(true);
?>
<?/*
global $USER;
if($USER->IsAdmin()){
	$templateName = 'new';
}else{
	$templateName = '';
}*/
$templateName = 'new';
$ElementID=$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	$templateName,
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],

		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
		"USE_COMPARE" => $arParams["USE_COMPARE"],
		"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"COMPARE_NAME" => $arParams["COMPARE_NAME"],

		"DISPLAY_MORE_PHOTO_WIDTH"	 =>	$arParams["DISPLAY_MORE_PHOTO_WIDTH"],
		"DISPLAY_MORE_PHOTO_HEIGHT" =>	$arParams["DISPLAY_MORE_PHOTO_HEIGHT"],
		"SHARPEN" => $arParams["SHARPEN"],
"IBLOCK_ID_VAC" => $arParams["IBLOCK_ID_VAC"],

	),
	$component
);?>
<div class="return"><a href="<?=str_replace('#SECTION_CODE#', $arResult["VARIABLES"]["SECTION_CODE"], $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"]);?>">&larr;&nbsp;<span><?=GetMessage("T_DETAIL_BACK")?></span></a></div>