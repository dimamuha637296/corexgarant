<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$arNavParams = array("nPageSize" => $arParams["COUNT"],	"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],	"bShowAll" => $arParams["PAGER_SHOW_ALL"]);
$arNavigation = CDBResult::GetNavParams($arNavParams);
if(intval($arNavigation['PAGEN']) <= 1):?>
<?$APPLICATION->IncludeFile(
		$arParams['SEF_FOLDER'].'seo_top_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO TOP [".intval($arResult["VARIABLES"]["SECTION_ID"]).']'.$arResult["VARIABLES"]["SECTION_CODE"], 'TEMPLATE' => 'default.php')
	);
endif;?>
<div class="b-categories">
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			
		"SECTION_ID" => 0,
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"CUR_SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		
		"ADD_SECTIONS_CHAIN" =>	'N',
		"TOP_DEPTH" => 2,
		//"TOP_DEPTH" => $arParams["SECTIONS_SUBSEC_ITEMS"] == 'subsection' ? 2 : 1,

		"DISPLAY_IMG_WIDTH"	 =>	$arParams["DISPLAY_SECTION_IMG_WIDTH"],
		"DISPLAY_IMG_HEIGHT" =>	$arParams["DISPLAY_SECTION_IMG_HEIGHT"],
		"SHARPEN" =>	$arParams["SHARPEN"],
		"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
		"COUNT_ELEMENTS" => $arParams["COUNT_ELEMENTS"],
		"SECTIONS_TYPE_TEMPLATE" => $arParams["SECTIONS_TYPE_TEMPLATE"],
		"SECTIONS_SUBSEC_ITEMS" => $arParams["SECTIONS_SUBSEC_ITEMS"],
	),
	$component
);?>
<div class="b-result clearfix" id="rubricator-elems-list">
<?$APPLICATION->IncludeComponent("db.base:iblock.list", "simple", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"COUNT" => $arParams["COUNT"],
	"SORT_BY1" => $arParams["SORT_BY1"],
	"SORT_ORDER1" => $arParams["SORT_ORDER1"],
	"SORT_BY2" => $arParams["SORT_BY2"],
	"SORT_ORDER2" => $arParams["SORT_ORDER2"],
	"FILTER_NAME" => $arParams["FILTER_NAME"],
		
	"CHECK_DATES" => $arParams["CHECK_DATES"],
	"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
	"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	"INCLUDE_SUBSECTIONS" =>  'N',

	"AJAX_MODE" => $arParams["AJAX_MODE"],
	"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
	"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
	"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_FILTER" => $arParams["CACHE_FILTER"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
	"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
	"SET_TITLE" => 'N',
	"SET_STATUS_404" => $arParams["SET_STATUS_404"],
	"INCLUDE_IBLOCK_INTO_CHAIN" => 'N',
	"ADD_SECTIONS_CHAIN" => 'N',
	"META_KEYWORDS" => $arParams["META_KEYWORDS"],
	"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
	"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
	"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

	"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
	"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
	"PAGER_TITLE" => $arParams["PAGER_TITLE"],
	"PAGER_SHOW_ALWAYS" =>  $arParams["PAGER_SHOW_ALWAYS"],
	"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
	"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
	"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
	"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		
	"DISPLAY_IMG_WIDTH" => $arParams["DISPLAY_LIST_IMG_WIDTH"],
	"DISPLAY_IMG_HEIGHT" => $arParams["DISPLAY_LIST_IMG_HEIGHT"],
	"SHARPEN" => $arParams["SHARPEN"],
	"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
	"USE_SHARE" => $arParams["USE_SHARE"],
		
	"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
	"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
	"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		
	"AJAX_OPTION_ADDITIONAL" => $arParams["AJAX_OPTION_ADDITIONAL"]
	),
	$component
);
?>
</div>
</div>

<?$APPLICATION->IncludeComponent("db.base:iblock.list", "rubricator_elements", array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"COUNT" => $arParams["COUNT"],
	"SORT_BY1" => $arParams["SORT_BY1"],
	"SORT_ORDER1" => $arParams["SORT_ORDER1"],
	"SORT_BY2" => $arParams["SORT_BY2"],
	"SORT_ORDER2" => $arParams["SORT_ORDER2"],
	"FILTER_NAME" => $arParams["FILTER_NAME"],
		
	"CHECK_DATES" => $arParams["CHECK_DATES"],
	"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
	"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	"INCLUDE_SUBSECTIONS" =>  'N',

	"AJAX_MODE" => $arParams["AJAX_MODE"],
	"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
	"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
	"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_FILTER" => $arParams["CACHE_FILTER"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
	"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
	"SET_TITLE" => 'N',
	"SET_STATUS_404" => $arParams["SET_STATUS_404"],
	"INCLUDE_IBLOCK_INTO_CHAIN" => 'N',
	"ADD_SECTIONS_CHAIN" => 'N',
	"META_KEYWORDS" =>'',
	"META_DESCRIPTION" => '',
	"BROWSER_TITLE" => '',
	"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

	"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
	"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
	"PAGER_TITLE" => $arParams["PAGER_TITLE"],
	"PAGER_SHOW_ALWAYS" =>  $arParams["PAGER_SHOW_ALWAYS"],
	"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
	"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
	"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
	"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		
	"DISPLAY_IMG_WIDTH" => $arParams["DISPLAY_LIST_IMG_WIDTH"],
	"DISPLAY_IMG_HEIGHT" => $arParams["DISPLAY_LIST_IMG_HEIGHT"],
	"SHARPEN" => $arParams["SHARPEN"],
	"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
	"USE_SHARE" => $arParams["USE_SHARE"],
		
	"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
	"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
	"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		
	"AJAX_OPTION_ADDITIONAL" => $arParams["AJAX_OPTION_ADDITIONAL"]
	),
	$component
);
?>

<?if(intval($arNavigation['PAGEN']) <= 1):
$APPLICATION->IncludeFile(
	$arParams['SEF_FOLDER'].'seo_footer_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
	Array(),
	Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER [".intval($arResult["VARIABLES"]["SECTION_ID"]).']'.$arResult["VARIABLES"]["SECTION_CODE"], 'TEMPLATE' => 'default.php')
);
endif;?>