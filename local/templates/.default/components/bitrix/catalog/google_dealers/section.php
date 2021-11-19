<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arParams['MAP_DATA'] = array(
'google_lat' => '53.8747',
'google_lon' => '27.643',
'google_scale' => '7',
'PLACEMARKS' => array(),

);
$arParams['MAP_DATA'] = serialize($arParams['MAP_DATA']);
?>
<div class="b-map" id="map">
    <? $APPLICATION->IncludeComponent("bitrix:map.google.view", "dealers", array(
        "INIT_MAP_TYPE" => $arParams["INIT_MAP_TYPE"],
        "MAP_DATA" => $arParams['MAP_DATA'],
        "MAP_WIDTH" => $arParams["MAP_WIDTH"],
        "MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
        "CONTROLS" => $arParams["CONTROLS"],
        "MAPS_ICON" => $arParams["MAPS_ICON"],
        "OPTIONS" => $arParams["OPTIONS"],
        "MAP_ID" => $arParams["MAP_ID"],
        'MARKERS' => $arResult['MARKERS']
    ),
        $component,
        array(
            "HIDE_ICONS" => "N",
            "ACTIVE_COMPONENT" => "Y"
        )
    );
    ?>
</div>
<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"simple",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
			"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
			"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
			"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
			"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
			"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
			"FILTER_NAME" => $arParams['FILTER_NAME'],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SET_TITLE" => 'N',
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"GET_CATEGORIES" => $_GET['category'],

			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

			"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
			"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"INCLUDE_SUBSECTIONS" => "Y",
			"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
			"COMPARE_NAME" => $arParams["COMPARE_NAME"],

			"DISPLAY_IMG_WIDTH"	 =>	$arParams["DISPLAY_IMG_WIDTH"],
			"DISPLAY_IMG_HEIGHT" =>	$arParams["DISPLAY_IMG_HEIGHT"],

			"SHARPEN" => $arParams["SHARPEN"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"USER_FIELDS" => array('PROPERTY_*'),
			'SECTION_USER_FIELDS' => array('UF_*'),
			"ADD_SECTIONS_CHAIN" => "N",
			'ARAVAILABLEPAGE' => $arAvailablePage,

			"MAPS_ICON" => $arParams["MAPS_ICON"],
			"INIT_MAP_TYPE" => $arParams["INIT_MAP_TYPE"],
			"MAP_DATA" => $arParams["MAP_DATA"],
			"MAP_WIDTH" => $arParams["MAP_WIDTH"],
			"MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
			"CONTROLS" => $arParams["CONTROLS"],
			"OPTIONS" => $arParams["OPTIONS"],
			"MAP_ID" => $arParams["MAP_ID"],
		),
		$component
	);
?>


