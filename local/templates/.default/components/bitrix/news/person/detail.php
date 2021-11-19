<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
// 404
if(strlen($arResult["VARIABLES"]["SECTION_CODE"]) > 0){
	$obCache = new CPHPCache;
	$life_time = 86400*7;
	$cache_id = "404ErorNews".$arResult["VARIABLES"]["SECTION_CODE"];


	if($obCache->InitCache($life_time, $cache_id, "/")) :
		$vars = $obCache->GetVars();
		$SECTIONS = $vars["SECTION_TITLE"];

	else :
		$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"],"ACTIVE" => "Y");
		$rsSect = CIBlockSection::GetList(false,$arFilter);
		while ($arSect = $rsSect->GetNext())
		{
			$arResult["SECTION_INFO"] = $arSect;
		}
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
}
?>
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
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
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
		"TYPE_IMG_THUMB"	=>	$arParams["TYPE_IMG_THUMB_DETAIL"],
		"SHARPEN"	=>	$arParams["TYPE_IMG_THUMB_DETAIL"],
		"DISPLAY_PICTURE_FULL_WIDTH"	=>	$arParams["DISPLAY_PICTURE_FULL_WIDTH"],
		"DISPLAY_SECTION_NAME"	=>	$arParams["DISPLAY_SECTION_NAME"],
		"DISPLAY_DETAIL_IMG_WIDTH" => $arParams["DISPLAY_DETAIL_IMG_WIDTH"],
		"DISPLAY_DETAIL_IMG_HEIGHT" => $arParams["DISPLAY_DETAIL_IMG_HEIGHT"],
		"DISPLAY_DETAIL_DOP_IMG_WIDTH" => $arParams["DISPLAY_DETAIL_DOP_IMG_WIDTH"],
		"DISPLAY_DETAIL_DOP_IMG_HEIGHT" => $arParams["DISPLAY_DETAIL_DOP_IMG_HEIGHT"],
		"COLUMN_COUNT_FOR_MORE_PHOTOS" => $arParams["COLUMN_COUNT_FOR_MORE_PHOTOS"],
		"COLUMN_COUNT_FOR_MORE_FILES" => $arParams["COLUMN_COUNT_FOR_MORE_FILES"],
		"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
	),
	$component
);
ob_start();
	$APPLICATION->IncludeFile(
			$arParams['SEF_FOLDER'].'insert_left_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
			Array(),
			Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "INSERT LEFT", 'TEMPLATE' => 'default.php')
		);
$content = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('sidebar-block', $content);
?>