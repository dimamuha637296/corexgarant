<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["VARIABLES"]["SECTION_ID"] = $arParams['PARENT_SECTION'];
/*


*/
?>
<?if($arParams['PARENT_SECTION']):?>
	<div class="photo-page-section">
	<?$result = $APPLICATION->IncludeComponent(
		"bitrix:photogallery.section",
		"",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arParams['PARENT_SECTION'],
			"USER_ALIAS" => "",
			"BEHAVIOUR" => "SIMPLE",
			"PERMISSION" => "",
			"GALLERY_URL" => "",
			"DETAIL_SLIDE_SHOW_URL"	=>	$arResult["URL_TEMPLATES"]["detail_slide_show"],
			"INDEX_URL" => $arResult["URL_TEMPLATES"]["index"],
			"SECTION_URL" => $arResult["URL_TEMPLATES"]["section"],
			"SECTION_EDIT_URL" => $arResult["URL_TEMPLATES"]["section_edit"],
			"SECTION_EDIT_ICON_URL" => $arResult["URL_TEMPLATES"]["section_edit_icon"],
			"UPLOAD_URL" => $arResult["URL_TEMPLATES"]["upload"],
			"DETAIL_URL" => $arResult["URL_TEMPLATES"]["detail"],
			"ALBUM_PHOTO_SIZE"	=>	$arParams["ALBUM_PHOTO_SIZE"],
			"ALBUM_PHOTO_THUMBS_SIZE"	=>	$arParams["ALBUM_PHOTO_THUMBS_SIZE"],
			"GALLERY_SIZE"	=>	$arParams["GALLERY_SIZE"],
			"RETURN_SECTION_INFO" => "N",
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"SET_TITLE" => "N",
			"SET_NAV_CHAIN" => "N",
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"]
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);
	//pr($result);
	?><?
	
	$APPLICATION->IncludeComponent("db.base:gallery.list", ".default", array(
			"IBLOCK_TYPE" => "wys",
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"PARENT_SECTION" => $arParams['PARENT_SECTION'],
			"DISPLAY_IMG_WIDTH" => "200",
			"DISPLAY_IMG_HEIGHT" => "200",
			"SHARPEN" => "100",
			"TYPE_IMG_THUMB" => "BX_RESIZE_IMAGE_EXACT",
			"DISPLAY_IMG_WIDTH_BIG" => "800",
			"DISPLAY_IMG_HEIGHT_BIG" => "800",
			"COLUM" => "4",
			"COLUM_MAX" => "12",
			"COUNT" => "20",
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "ASC",
			"FILTER_NAME" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "N"
	),
			false
	);
	?>
	</div>
<?else:?>
<? 
$URL_NAME_DEFAULT = array(
		"section_edit" => "PAGE_NAME=section_edit&SECTION_ID=#SECTION_ID#&ACTION=#ACTION#",
		"upload" => "PAGE_NAME=upload&SECTION_ID=#SECTION_ID#&ACTION=upload"
);

foreach ($URL_NAME_DEFAULT as $URL => $URL_VALUE)
{
	$arParams[strToUpper($URL)."_URL"] = trim($arResult["URL_TEMPLATES"][strToLower($URL)]);
	if (empty($arParams[strToUpper($URL)."_URL"]))
		$arParams[strToUpper($URL)."_URL"] = $APPLICATION->GetCurPageParam($URL_VALUE, array("PAGE_NAME", "SECTION_ID", "ELEMENT_ID", "ACTION", "sessid", "edit", "order"));
	$arParams["~".strToUpper($URL)."_URL"] = $arParams[strToUpper($URL)."_URL"];
	$arParams[strToUpper($URL)."_URL"] = htmlspecialcharsbx($arParams["~".strToUpper($URL)."_URL"]);
}

$arRes = array();
?><div class="photo-page-main"><?
if ($arParams["PERMISSION"] >= "U" || $arParams["SHOW_TAGS"] == "Y" || !empty($arRes))
{
	if ($arParams["PERMISSION"] >= "U")
	{
	?>
	<div class="photo-controls photo-controls-buttons">
				<a rel="nofollow" href="<?=CComponentEngine::MakePathFromTemplate($arParams["UPLOAD_URL"], array("SECTION_ID" => "0"))?>">
					<span><?=GetMessage("P_UPLOAD")?></span></a>
		<div class="empty-clear"></div>
	</div>
	<?
	}
}
?>
<?endif;?>
<? /*/?></div><? //*/?>