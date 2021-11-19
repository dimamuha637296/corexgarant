<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if($arParams["REDIRECT_FIRST_SECTION"] =="Y"){

	$obCache = new CPHPCache;
	$life_time = 86400*7;
	$cache_id = "redirectNews".$arParams['COMPONENT_TEMPLATE'].$arParams['IBLOCK_ID'];
	$cache_path = "/news-redirect".$arParams['COMPONENT_TEMPLATE'].$arParams['IBLOCK_ID']."/";


	if($obCache->InitCache($life_time, $cache_id, $cache_path)) :
		$vars = $obCache->GetVars();
		$SECTIONS = $vars["SECTION_TITLE"];

	else :
		global $CACHE_MANAGER;
		$CACHE_MANAGER->StartTagCache($cache_path);
		$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams['IBLOCK_ID']);

		$arFilter = array(
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			"DEPTH_LEVEL" => "1",
			"ACTIVE" => "Y"
		);
		$rsSect = CIBlockSection::GetList(array("sort" => "desc"),$arFilter,false,array("SECTION_PAGE_URL"));
		while ($arSect = $rsSect->GetNext())
		{
			$arResult["SECTION_INFO"] = $arSect;
		}

		$CACHE_MANAGER->EndTagCache();
		$SECTIONS = $arResult["SECTION_INFO"];

		if($obCache->StartDataCache()):
			$obCache->EndDataCache(array(
				"SECTION_TITLE" => $SECTIONS
			));

		endif;
	endif;

	if($SECTIONS["SECTION_PAGE_URL"]){
		LocalRedirect($SECTIONS["SECTION_PAGE_URL"], false, '301 Moved permanently');
	}

}

CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$arNavParams = array("nPageSize" => $arParams["COUNT"],	"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],	"bShowAll" => $arParams["PAGER_SHOW_ALL"]);
$arNavigation = CDBResult::GetNavParams($arNavParams);

if(intval($arNavigation['PAGEN']) <= 1):?>
    <?$APPLICATION->IncludeFile(
        $arParams['SEF_FOLDER'].'seo_top_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
        Array(),
        Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO TOP [".intval($arResult["VARIABLES"]["SECTION_ID"]).']'.$arResult["VARIABLES"]["SECTION_CODE"], 'TEMPLATE' => 'default.php')
    );
endif;

	if($_REQUEST["dbAjaxNav"]=="Y" && $_REQUEST["type"]=="html"){
		$APPLICATION->RestartBuffer();
	}
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		Array(
			"SET_TITLE"	=>	"N",
			//"SET_TITLE"	=>	$arParams["SET_TITLE"],
			"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
			"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
			"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
			"SORT_BY1"	=>	$arParams["SORT_BY1"],
			"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
			"SORT_BY2"	=>	$arParams["SORT_BY2"],
			"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
			"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
			"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
			"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],

			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
			"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
			"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
			"DISPLAY_NAME"	=>	$arParams["DISPLAY_ELEMENT_NAME"],
			"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
			"SHARPEN"	=>	$arParams["SHARPEN_LIST"],
			"SEF_FOLDER"	=>	$arParams["SEF_FOLDER"],				
			"TYPE_IMG_THUMB"	=>	$arParams["TYPE_IMG_THUMB_LIST"],
			"DISPLAY_LIST_IMG_WIDTH"	=>	$arParams["DISPLAY_LIST_IMG_WIDTH"],
			"DISPLAY_LIST_IMG_HEIGHT"	=>	$arParams["DISPLAY_LIST_IMG_HEIGHT"],
			"DISPLAY_PICTURE_FULL_WIDTH"	=>	$arParams["DISPLAY_PICTURE_FULL_WIDTH"],
			"DISPLAY_SECTION_NAME"	=>	$arParams["DISPLAY_SECTION_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		),
		$component
	);
	if($_REQUEST["dbAjaxNav"]=="Y" && $_REQUEST["type"]=="html"){
		die();
	}
	?>

<?if(intval($arNavigation['PAGEN']) <= 1):
    $APPLICATION->IncludeFile(
        $arParams['SEF_FOLDER'].'seo_footer_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
        Array(),
        Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER", 'TEMPLATE' => 'default.php')
    );
endif;
?>