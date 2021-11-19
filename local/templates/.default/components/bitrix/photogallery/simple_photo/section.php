<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="photo-page-section">
<?$result = $APPLICATION->IncludeComponent(
	"bitrix:photogallery.section",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
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
		"RETURN_SECTION_INFO" => "Y",
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"SET_TITLE" => $arParams["SET_TITLE"],
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
		"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
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