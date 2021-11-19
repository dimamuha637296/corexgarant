<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
$obCache = new CPHPCache;
$life_time = 86400*7;

$cache_id = "404catalogSection-".str_replace("/","_",$arResult["VARIABLES"]["SECTION_CODE_PATH"]).$arResult["VARIABLES"]["SECTION_ID"];
$cache_path = "/catalog/section/".SITE_ID."/".$arParams['IBLOCK_ID']."/";

if($obCache->InitCache($life_time, $cache_id, $cache_path)) :
	$vars = $obCache->GetVars();
	$SECTIONS = $vars["SECTION_TITLE"];

else :
	global $CACHE_MANAGER;
	$CACHE_MANAGER->StartTagCache($cache_path);
	$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams['IBLOCK_ID']);

	$arSectionSelect = array("ID","NAME","UF_*","DESCRIPTION");
	$arFilter = array(
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		"CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"ACTIVE" => "Y",
		"ELEMENT_SUBSECTIONS" => "N",
	);
	$rsSect = CIBlockSection::GetList(false,$arFilter,true,$arSectionSelect);
	while ($arSect = $rsSect->GetNext())
	{
		$arResult["SECTION_INFO"] = $arSect;
	}
	$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], "ACTIVE" => "Y",'DEPTH_LEVEL' => 1);
	$rsSect = CIBlockSection::GetList(false,$arFilter,false,array('ID','NAME','SECTION_PAGE_URL','CODE'));
	while ($arSect = $rsSect->GetNext())
	{
		$arResult["PARENT_SECTIONS"][$arSect['ID']] = $arSect;
	}


	$CACHE_MANAGER->EndTagCache();
	$SECTIONS = $arResult["SECTION_INFO"];
	$PARENT_SECTIONS = $arResult["PARENT_SECTIONS"];

	if($obCache->StartDataCache()):
		$obCache->EndDataCache(array(
			"SECTION_TITLE" => $SECTIONS
		));

	endif;
endif;

?>

<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"",
	array(
		"SECTIONS" => $PARENT_SECTIONS,
		"CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
		"DETAIL_ACORDEON" => $arParams["DETAIL_ACORDEON"],
		"DETAIL_POPUP_IMG_WIDTH" => $arParams["DETAIL_POPUP_IMG_WIDTH"],
		"DETAIL_POPUP_IMG_HEIGHT" => $arParams["DETAIL_POPUP_IMG_HEIGHT"],
		"DETAIL_BIG_IMG_WIDTH" => $arParams["DETAIL_BIG_IMG_WIDTH"],
		"DETAIL_BIG_IMG_HEIGHT" => $arParams["DETAIL_BIG_IMG_HEIGHT"],
		"DETAIL_SMALL_IMG_WIDTH" => $arParams["DETAIL_SMALL_IMG_WIDTH"],
		"DETAIL_SMALL_IMG_HEIGHT" => $arParams["DETAIL_SMALL_IMG_HEIGHT"],
		"DETAIL_BRAND_IMG_WIDTH" => $arParams["DETAIL_BRAND_IMG_WIDTH"],
		"DETAIL_BRAND_IMG_HEIGHT" => $arParams["DETAIL_BRAND_IMG_HEIGHT"],
		"DETAIL_LONG_TEXT" => $arParams["DETAIL_LONG_TEXT"],
		"DETAIL_PROPERTY_NO_CHAR" => $arParams["DETAIL_PROPERTY_NO_CHAR"],
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
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
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
		"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
		"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],
		"LIST_PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],

		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
		'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
		'DISPLAY_LIST_IMG_HEIGHT' => $arParams["DISPLAY_LIST_IMG_HEIGHT"],
		'DISPLAY_LIST_IMG_WIDTH' => $arParams["DISPLAY_LIST_IMG_WIDTH"],
			'DISPLAY_DETAIL_IMG_WIDTH' => $arParams["DISPLAY_DETAIL_IMG_WIDTH"],
			'DISPLAY_DETAIL_IMG_HEIGHT' => $arParams["DISPLAY_DETAIL_IMG_HEIGHT"],
			'DISPLAY_DETAIL_DOP_IMG_WIDTH' => $arParams["DISPLAY_DETAIL_DOP_IMG_WIDTH"],
			'DISPLAY_DETAIL_DOP_IMG_HEIGHT' => $arParams["DISPLAY_DETAIL_DOP_IMG_HEIGHT"],

		'LABEL_PROP' => $arParams['LABEL_PROP'],
		'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
		'COMPARE_NAME' => $arParams['COMPARE_NAME'],
		'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
		'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
		'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
		'SHOW_MAX_QUANTITY' => $arParams['DETAIL_SHOW_MAX_QUANTITY'],
		'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
		'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
		'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
		'MESS_BTN_COMPARE' => $arParams['MESS_BTN_COMPARE'],
		'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
		'USE_VOTE_RATING' => $arParams['DETAIL_USE_VOTE_RATING'],
		'VOTE_DISPLAY_AS_RATING' => (isset($arParams['DETAIL_VOTE_DISPLAY_AS_RATING']) ? $arParams['DETAIL_VOTE_DISPLAY_AS_RATING'] : ''),
		'USE_COMMENTS' => $arParams['DETAIL_USE_COMMENTS'],
		'BLOG_USE' => (isset($arParams['DETAIL_BLOG_USE']) ? $arParams['DETAIL_BLOG_USE'] : ''),
		'VK_USE' => (isset($arParams['DETAIL_VK_USE']) ? $arParams['DETAIL_VK_USE'] : ''),
		'VK_API_ID' => (isset($arParams['DETAIL_VK_API_ID']) ? $arParams['DETAIL_VK_API_ID'] : 'API_ID'),
		'FB_USE' => (isset($arParams['DETAIL_FB_USE']) ? $arParams['DETAIL_FB_USE'] : ''),
		'FB_APP_ID' => (isset($arParams['DETAIL_FB_APP_ID']) ? $arParams['DETAIL_FB_APP_ID'] : ''),
		'BRAND_USE' => $arParams['DETAIL_BRAND_USE'],
		'USE_COMPARE' => $arParams['USE_COMPARE'],
		'BRAND_PROP_CODE' => $arParams['DETAIL_BRAND_PROP_CODE']
	),
	$component
);?>
</div>

<?$GLOBALS['arrFilterDopItem']['ID'] = $GLOBALS["IT_TOVAR"];
$APPLICATION->IncludeComponent(
	"db.base:simple.list",
	"catalog_dop_item",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
		"DEFAULT_IMG" => $arParams["DEFAULT_IMG"],
		"NEWS_COUNT" => "3",
		"PARENT_SECTION" => "",
		"SORT_BY1" => "RAND",
		"SORT_ORDER1" => "",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arrFilterDopItem",
		"CHECK_DATES" => "N",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"TEXT_DOP_ITEMS" => $arParams["TEXT_DOP_ITEMS"],
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"TEXT_DOP_ITEMS" => $arParams["TEXT_DOP_ITEMS"],
		"PREVIEW_TRUNCATE_LEN" => "250",
		"ACTIVE_DATE_FORMAT" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_IMG_WIDTH" => $arParams["BLOCK_IMG_WIDTH"],
		"DISPLAY_IMG_HEIGHT" => $arParams["BLOCK_IMG_HEIGHT"],
		"SHARPEN" => "100",
		"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB_LIST"],
	)
);?>

<?/// form?>

<?$APPLICATION->IncludeFile(
	SITE_DIR.'include/form_catalog.php',
	Array(),
	Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "form_catalog", 'TEMPLATE' => 'default.php')
);?>
<?// END form?>
