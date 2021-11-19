<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->SetPageProperty("SidebarClass", "hide");
$APPLICATION->SetPageProperty("ContentClass", "g-content col-12 clearfix");
$APPLICATION->SetPageProperty("CrumbClass", "col-12");
$this->setFrameMode(true);?>
<?
// 404

$obCache = new CPHPCache;
$life_time = 86400*7;

$cache_id = "404ErorCatalogElementDBShop-".$arResult["VARIABLES"]["SECTION_CODE"];
$cache_path = "/catalog-shop/element/".SITE_ID."/".$arParams['IBLOCK_ID']."/";


if($obCache->InitCache($life_time, $cache_id, $cache_path)) :
	$vars = $obCache->GetVars();
	$SECTIONS = $vars["SECTION_TITLE"];

else :
	global $CACHE_MANAGER;
	$CACHE_MANAGER->StartTagCache($cache_path);
	$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams['IBLOCK_ID']);
	$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], "ACTIVE" => "Y",'DEPTH_LEVEL' => 1);
	$rsSect = CIBlockSection::GetList(false,$arFilter,false,array('ID','NAME','SECTION_PAGE_URL','CODE'));
	while ($arSect = $rsSect->GetNext())
	{
		$arResult["SECTION_INFO"][$arSect['ID']] = $arSect;
	}

	$CACHE_MANAGER->EndTagCache();
		$SECTIONS = $arResult["SECTION_INFO"];

	if($obCache->StartDataCache()):
		$obCache->EndDataCache(array(
			"SECTION_TITLE" => $SECTIONS
		));

	endif;
endif;

if(!$SECTIONS){
	CHTTP::SetStatus("404 Not Found");
	define("ERROR_404", "Y");
}
?>
<div itemscope="" itemtype="http://www.schema.org/Product">
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"",
	array(
		"SECTIONS" => $SECTIONS,
		"DETAIL_TAB" => $arParams["DETAIL_TAB"],
		"DETAIL_CONSULTATION" => $arParams["DETAIL_CONSULTATION"],
		"CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
		"DETAIL_ACORDEON" => $arParams["DETAIL_ACORDEON"],
		"DETAIL_POPUP_IMG_WIDTH" => $arParams["DETAIL_POPUP_IMG_WIDTH"],
		"DETAIL_POPUP_IMG_HEIGHT" => $arParams["DETAIL_POPUP_IMG_HEIGHT"],
		"DETAIL_BIG_IMG_WIDTH" => $arParams["DETAIL_BIG_IMG_WIDTH"],
		"DETAIL_BIG_IMG_HEIGHT" => $arParams["DETAIL_BIG_IMG_HEIGHT"],
		"DETAIL_SMALL_IMG_WIDTH" => $arParams["DETAIL_SMALL_IMG_WIDTH"],
		"DETAIL_SMALL_IMG_HEIGHT" => $arParams["DETAIL_SMALL_IMG_HEIGHT"],
		"NAME_COMPARE_BTN" => $arParams["NAME_COMPARE_BTN"],
        'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
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
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
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
        "SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
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
		'DETAIL_AVAILABILITY' => $arParams['DETAIL_AVAILABILITY'],
		'DETAIL_AVAILABILITY_YES' => $arParams['DETAIL_AVAILABILITY_YES'],
		'DETAIL_AVAILABILITY_NO' => $arParams['DETAIL_AVAILABILITY_NO'],
		'DETAIL_BRAND' => $arParams['DETAIL_BRAND'],
		'DETAIL_BRAND_LINK_TEXT' => $arParams['DETAIL_BRAND_LINK_TEXT'],
        "DETAIL_BRAND_IMG_WIDTH" => $arParams["DETAIL_BRAND_IMG_WIDTH"],
        "DETAIL_BRAND_IMG_HEIGHT" => $arParams["DETAIL_BRAND_IMG_HEIGHT"],
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
		'BRAND_PROP_CODE' => $arParams['DETAIL_BRAND_PROP_CODE'],
        "BTN_PREORDER" => $arParams["BTN_PREORDER"],
        "BUY_ONE_CLICK_SECTION" => $arParams["BUY_ONE_CLICK_SECTION"],
        'BTN_MESS_BUY_ONE_KLICK' => $arParams['BTN_MESS_BUY_ONE_KLICK'],
        'BTN_MESS_BUY' => $arParams['BTN_MESS_BUY'],
        "BTN_NO_AVAILABLE" => $arParams["BTN_NO_AVAILABLE"],
        'USE_QUANTITY_FOR_ORDER' => $arParams['USE_QUANTITY_FOR_ORDER'],
	),
	$component
);?>
</div>
<?//*/?>
<?if($arParams['USE_DETAIL_TITLE_RELATED'] == "Y"):?>
	<div class="catalog catalog-list similar slider-similar hidden-print">
	<?
    $GLOBALS['arrFilterMainItTovar']['SECTION_ID'] = $SECTIONS["ID"];
	$GLOBALS['arrFilterMainItTovar']['!ID'] = $ElementID;
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "block",
        array(
            "ELEMENT_TEMPLATE" => "Y",
            "SHOW_ALL_WO_SECTION" => "Y",
            "DETAIL_TITLE_RECOMMEND" => $arParams["DETAIL_TITLE_RELATED"],
            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
            "CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
            'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            "BLOCK_IMG_WIDTH" => $arParams["BLOCK_IMG_WIDTH"],
            "BLOCK_IMG_HEIGHT" => $arParams["BLOCK_IMG_HEIGHT"],
            "TYPE_IMG_THUMB_LIST" => $arParams["TYPE_IMG_THUMB_LIST"],
            "LIST_IMG_WIDTH" => $arParams["LIST_IMG_WIDTH"],
            "LIST_IMG_HEIGHT" => $arParams["LIST_IMG_HEIGHT"],
            "TABLE_IMG_WIDTH" => $arParams["TABLE_IMG_WIDTH"],
            "TABLE_IMG_HEIGHT" => $arParams["TABLE_IMG_HEIGHT"],
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            'COMPARE_NAME' => $arParams['COMPARE_NAME'],

            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
            "BASKET_URL" => $arParams["BASKET_URL"],
            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
            "SECTION_ID" => $SECTIONS["ID"],
            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
            "FILTER_NAME" => "arrFilterMainItTovar",
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "SET_TITLE" => 'N',
            "SET_BROWSER_TITLE" => "N",
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
            "PAGE_ELEMENT_COUNT" => 3,
            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
            "ADD_SECTIONS_CHAIN" => "N",
            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => 'N',
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => 'N',
            "PAGINATION_COUNT" => $arParams["PAGINATION_COUNT"],
            "SET_META_DESCRIPTION" => $arParams["SET_META_DESCRIPTION"],
            "META_DESCRIPTION" => "",
            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
            "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
            'DISPLAY_LIST_IMG_HEIGHT' => $arParams["DISPLAY_LIST_IMG_HEIGHT"],
            'DISPLAY_LIST_IMG_WIDTH' => $arParams["DISPLAY_LIST_IMG_WIDTH"],

            'LABEL_PROP' => $arParams['LABEL_PROP'],
            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
            'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
            'MESS_BTN_COMPARE' => $arParams['MESS_BTN_COMPARE'],
            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
            "BTN_PREORDER" => $arParams["BTN_PREORDER"],
            "BUY_ONE_CLICK_SECTION" => $arParams["BUY_ONE_CLICK_SECTION"],
            'BTN_MESS_BUY_ONE_KLICK' => $arParams['BTN_MESS_BUY_ONE_KLICK'],
            'BTN_MESS_BUY' => $arParams['BTN_MESS_BUY'],
            "BTN_NO_AVAILABLE" => $arParams["BTN_NO_AVAILABLE"],
            'USE_QUANTITY_FOR_ORDER' => $arParams['USE_QUANTITY_FOR_ORDER'],
        ),
        $component
    );
    ?>
</div>
<?endif;?>

<?

if($arParams['USE_DETAIL_TITLE_RECOMMEND'] == "Y" && is_array($GLOBALS["RECOMMEND"]) && count($GLOBALS["RECOMMEND"])>0):?>
	<div class="catalog catalog-list similar slider-similar hidden-print">
	<?
    $GLOBALS['arrFilterMainItTovarRecommend']['ID'] = $GLOBALS["RECOMMEND"];
	$GLOBALS['arrFilterMainItTovarRecommend']['!ID'] = $ElementID;

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "block",
        array(
            "ELEMENT_TEMPLATE" => "Y",
            "SHOW_ALL_WO_SECTION" => "Y",
            "DETAIL_TITLE_RECOMMEND" => $arParams["DETAIL_TITLE_RECOMMEND"],
            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
            "CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
            'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            "BLOCK_IMG_WIDTH" => $arParams["BLOCK_IMG_WIDTH"],
            "BLOCK_IMG_HEIGHT" => $arParams["BLOCK_IMG_HEIGHT"],
            "TYPE_IMG_THUMB_LIST" => $arParams["TYPE_IMG_THUMB_LIST"],
            "LIST_IMG_WIDTH" => $arParams["LIST_IMG_WIDTH"],
            "LIST_IMG_HEIGHT" => $arParams["LIST_IMG_HEIGHT"],
            "TABLE_IMG_WIDTH" => $arParams["TABLE_IMG_WIDTH"],
            "TABLE_IMG_HEIGHT" => $arParams["TABLE_IMG_HEIGHT"],
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            'COMPARE_NAME' => $arParams['COMPARE_NAME'],

            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
            "BASKET_URL" => $arParams["BASKET_URL"],
            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
            "FILTER_NAME" => "arrFilterMainItTovarRecommend",
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "SET_TITLE" => 'N',
            "SET_BROWSER_TITLE" => "N",
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
            "PAGE_ELEMENT_COUNT" => 3,
            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
            "PRICE_CODE" => $arParams["PRICE_CODE"],
            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
            "ADD_SECTIONS_CHAIN" => "N",
            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => 'N',
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => 'N',
            "PAGINATION_COUNT" => $arParams["PAGINATION_COUNT"],
            "SET_META_DESCRIPTION" => $arParams["SET_META_DESCRIPTION"],
            "META_DESCRIPTION" => "",
            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
            "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
            'DISPLAY_LIST_IMG_HEIGHT' => $arParams["DISPLAY_LIST_IMG_HEIGHT"],
            'DISPLAY_LIST_IMG_WIDTH' => $arParams["DISPLAY_LIST_IMG_WIDTH"],

            'LABEL_PROP' => $arParams['LABEL_PROP'],
            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
            'SHOW_QUANTITY' => $arParams['SHOW_QUANTITY'],
            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
            'MESS_BTN_COMPARE' => $arParams['MESS_BTN_COMPARE'],
            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
            "BTN_PREORDER" => $arParams["BTN_PREORDER"],
            "BUY_ONE_CLICK_SECTION" => $arParams["BUY_ONE_CLICK_SECTION"],
            'BTN_MESS_BUY_ONE_KLICK' => $arParams['BTN_MESS_BUY_ONE_KLICK'],
            'BTN_MESS_BUY' => $arParams['BTN_MESS_BUY'],
            "BTN_NO_AVAILABLE" => $arParams["BTN_NO_AVAILABLE"],
            'USE_QUANTITY_FOR_ORDER' => $arParams['USE_QUANTITY_FOR_ORDER'],
        ),
        $component
    );
    ?>
</div>
<?endif;?>

