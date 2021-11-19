<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div itemscope="" itemtype="http://www.schema.org/Product">
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"DETAIL_PROPERTY_NO_CHAR" => $arParams["DETAIL_PROPERTY_NO_CHAR"],
		"CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
		"BTN_NAME" => $arParams["BTN_NAME"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],

		"DETAIL_POPUP_IMG_WIDTH" => $arParams["DETAIL_POPUP_IMG_WIDTH"],
		"DETAIL_POPUP_IMG_HEIGHT" => $arParams["DETAIL_POPUP_IMG_HEIGHT"],
		"DETAIL_BIG_IMG_WIDTH" => $arParams["DETAIL_BIG_IMG_WIDTH"],
		"DETAIL_BIG_IMG_HEIGHT" => $arParams["DETAIL_BIG_IMG_HEIGHT"],
		"DETAIL_SMALL_IMG_WIDTH" => $arParams["DETAIL_SMALL_IMG_WIDTH"],
		"DETAIL_SMALL_IMG_HEIGHT" => $arParams["DETAIL_SMALL_IMG_HEIGHT"],
		"DETAIL_BRAND_IMG_WIDTH" => $arParams["DETAIL_BRAND_IMG_WIDTH"],
		"DETAIL_BRAND_IMG_HEIGHT" => $arParams["DETAIL_BRAND_IMG_HEIGHT"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DETAIL_LONG_TEXT" => $arParams["DETAIL_LONG_TEXT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" 			=> $arParams["USE_SHARE"],
		"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : '')
	),
	$component
);
//pr($GLOBALS["IT_TOVAR"]);
?>
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
        "DISPLAY_IMG_WIDTH" => $arParams["CACHE_TIME"],
        "DISPLAY_IMG_HEIGHT" => $arParams["CACHE_TIME"],
        "SHARPEN" => "100",
        "TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB_LIST"],
    )
);?>
<?/*$GLOBALS['arrFilterDopItem']['ID'] = $GLOBALS["IT_TOVAR"];
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"block",
	Array(
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
		"SORT_BY1"	=>	$sort,
		"SORT_ORDER1"	=>	$sort_order,
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	$arParams["SET_TITLE"],
		"BTN_NAME"	=>	$arParams["BTN_NAME"],
		"BTNDEFAULT_LIST_TEMPLATE_NAME"	=>	$arParams["DEFAULT_LIST_TEMPLATE"],
		"CATALOG_CURRENCY"	=>	$arParams["CATALOG_CURRENCY"],
		"BLOCK_IMG_WIDTH"	=>	$arParams["BLOCK_IMG_WIDTH"],
		"BLOCK_IMG_HEIGHT"	=>	$arParams["BLOCK_IMG_HEIGHT"],
		"DEFAULT_IMG"	=>	$arParams["DEFAULT_IMG"],
		"LIST_IMG_WIDTH"	=>	$arParams["LIST_IMG_WIDTH"],
		"LIST_IMG__HEIGHT"	=>	$arParams["LIST_IMG__HEIGHT"],
		"TABLE_IMG__WIDTH"	=>	$arParams["TABLE_IMG__WIDTH"],
		"TABLE_IMG__HEIGHT"	=>	$arParams["TABLE_IMG__HEIGHT"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"SET_META_DESCRIPTION"	=>	"N",
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"TYPE_IMG_THUMB_LIST"	=>	$arParams["TYPE_IMG_THUMB_LIST"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	"Y",
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	"arrFilterDopItem",
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
	),
	$component
);*/?>

<?/// form?>

<?$APPLICATION->IncludeFile(
    SITE_DIR.'include/form_catalog.php',
    Array(),
    Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "form_catalog", 'TEMPLATE' => 'default.php')
);?>
<?// END form?>
