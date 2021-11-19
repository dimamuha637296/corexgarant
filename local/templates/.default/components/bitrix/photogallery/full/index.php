<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
$APPLICATION->IncludeFile(
	$arParams['SEF_FOLDER'].'seo_top_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
	Array(),
	Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO TOP [".intval($arResult["VARIABLES"]["SECTION_ID"]).']'.$arResult["VARIABLES"]["SECTION_CODE"], 'TEMPLATE' => 'default.php')
);
?>
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
</div>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:photo.sections.top",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_COUNT" => $arParams["SECTION_COUNT"],
		"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
		"SECTION_SORT_FIELD" => $arParams["SECTION_SORT_BY"],
		"SECTION_SORT_ORDER" => $arParams["SECTION_SORT_ORD"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"FIELD_CODE" => $arParams["TOP_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_LIST_IMG_HEIGHT" => $arParams["DISPLAY_LIST_IMG_HEIGHT"],
		"DISPLAY_LIST_IMG_WIDTH" => $arParams["DISPLAY_LIST_IMG_WIDTH"],
		"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
		"SHARPEN" => $arParams["SHARPEN"],
		"DISPLAY_IMG_SECTION_WIDTH" => $arParams["DISPLAY_IMG_SECTION_WIDTH"],
		"DISPLAY_IMG_SECTION_HEIGHT" => $arParams["DISPLAY_IMG_SECTION_HEIGHT"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	),
	$component
);*/
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:photogallery.section.list",
	"sect_pagin",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"PHOTO_LIST_MODE" => $arParams["PHOTO_LIST_MODE"],
		"SHOWN_ITEMS_COUNT" => $arParams["SHOWN_ITEMS_COUNT"],

		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT_SECTION"],

		"PAGE_NAVIGATION_TEMPLATE" => $arParams["PAGE_NAVIGATION_TEMPLATE"],
		"PAGE_ELEMENTS" => $arParams["SECTION_PAGE_ELEMENTS"],
		"SORT_BY" => $arParams["SECTION_SORT_BY"],
		"SORT_ORD" => $arParams["SECTION_SORT_ORD"],

		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SHOW_TAGS" => $arParams["SHOW_TAGS"],

		"SECTION_URL" => $arResult["URL_TEMPLATES"]["section"],
		"SECTION_EDIT_URL" => $arResult["URL_TEMPLATES"]["section_edit"],
		"SECTION_EDIT_ICON_URL" => $arResult["URL_TEMPLATES"]["section_edit_icon"],
		"DETAIL_URL" => $arResult["URL_TEMPLATES"]["detail"],
		"SEARCH_URL" => $arResult["URL_TEMPLATES"]["search"],
		"UPLOAD_URL" => $arResult["URL_TEMPLATES"]["upload"],
		"DETAIL_EDIT_URL" => $arResult["URL_TEMPLATES"]["detail_edit"],

		"ALBUM_PHOTO_THUMBS_SIZE"	=>	$arParams["ALBUM_PHOTO_THUMBS_SIZE"],
		"ALBUM_PHOTO_SIZE"	=>	$arParams["ALBUM_PHOTO_SIZE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],

		"SET_TITLE"	=>	"N",
		"SHOW_RATING" => $arParams["USE_RATING"],
		"SHOW_SHOWS" => $arParams["SHOW_SHOWS"],
		"SHOW_COMMENTS" => $arParams["USE_COMMENTS"],
		"SHOW_TAGS" => $arParams["SHOW_TAGS"],
		"SHOW_DATE" => $arParams["SHOW_DATE"],
		"SHOW_DESRIPTION" => $arParams["SHOW_DESRIPTION"],

		"USE_RATING" => $arParams["USE_RATING"],
		"MAX_VOTE" => $arParams["MAX_VOTE"],
		"VOTE_NAMES" => $arParams["VOTE_NAMES"],
		"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
		"RATING_MAIN_TYPE" => $arParams["RATING_MAIN_TYPE"],

		"USE_COMMENTS" => $arParams["USE_COMMENTS"],
		"COMMENTS_TYPE" => $arParams["COMMENTS_TYPE"],

		"COMMENTS_COUNT" => $arParams["COMMENTS_COUNT"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"URL_TEMPLATES_PROFILE_VIEW" => $arParams["URL_TEMPLATES_PROFILE_VIEW"],
		"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"],
		"PREORDER" => $arParams["PREORDER"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"] == "Y" ? "Y" : "N",

		"BLOG_URL" => $arParams["BLOG_URL"],
		"PATH_TO_BLOG" => $arParams["PATH_TO_BLOG"],

		"PATH_TO_USER" => $arParams["PATH_TO_USER"],
		"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
		"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],

		"DISPLAY_LIST_IMG_HEIGHT" => $arParams["DISPLAY_LIST_IMG_HEIGHT"],
		"DISPLAY_LIST_IMG_WIDTH" => $arParams["DISPLAY_LIST_IMG_WIDTH"],
		"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
		"SHARPEN" => $arParams["SHARPEN"],
		"DISPLAY_IMG_SECTION_WIDTH" => $arParams["DISPLAY_IMG_SECTION_WIDTH"],
		"DISPLAY_IMG_SECTION_HEIGHT" => $arParams["DISPLAY_IMG_SECTION_HEIGHT"],

		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
?>
<?
$APPLICATION->IncludeFile(
		$arParams['SEF_FOLDER'].'seo_footer_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER [".intval($arResult["VARIABLES"]["SECTION_ID"]).']'.$arResult["VARIABLES"]["SECTION_CODE"], 'TEMPLATE' => 'default.php')
);

ob_start();
$APPLICATION->IncludeFile(
		$arParams['SEF_FOLDER'].'insert_left_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "INSERT LEFT [".intval($arResult["VARIABLES"]["SECTION_ID"]).']'.$arResult["VARIABLES"]["SECTION_CODE"], 'TEMPLATE' => 'default.php')
);
$content = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('sidebar-block', $content);
?>
