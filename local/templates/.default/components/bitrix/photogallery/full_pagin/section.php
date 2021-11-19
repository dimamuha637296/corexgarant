<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
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
		"SET_NAV_CHAIN" => "Y",
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"]
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
//pr($result);
?><?

$APPLICATION->IncludeComponent("db.base:gallery.list", "gallery", array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
		"DISPLAY_IMG_WIDTH" => $arParams["DISPLAY_IMG_WIDTH"],
		"DISPLAY_IMG_HEIGHT" => $arParams["DISPLAY_IMG_HEIGHT"],
		"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
		"TYPE_IMG_THUMB_POP_UP" => $arParams["TYPE_IMG_THUMB_POP_UP"],
		"DISPLAY_IMG_WIDTH_POP_UP" => $arParams["DISPLAY_IMG_WIDTH_POP_UP"],
		"DISPLAY_IMG_HEIGHT_POP_UP" => $arParams["DISPLAY_IMG_HEIGHT_POP_UP"],
		"COUNT" => $arParams["SHOWN_ITEMS_COUNT"],
		"SORT_BY1" =>  $arParams["ELEMENT_SORT_FIELD"],
		"SORT_ORDER1" => $arParams["ELEMENT_SORT_ORDER"],
		"FILTER_NAME" => "",
		"CACHE_TYPE" =>  $arParams["CACHE_TYPE"],
		"CACHE_TIME" =>  $arParams["CACHE_TIME"],
		"CACHE_FILTER" =>  $arParams["CACHE_FILTER"],
),
		false
);


?>
</div>