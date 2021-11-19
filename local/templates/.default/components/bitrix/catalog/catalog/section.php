<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$sections = false;
if($_REQUEST["display"] || $_REQUEST["sort"] || $_REQUEST["order"] || $_REQUEST["order"]){
	$APPLICATION->AddHeadString('<link rel="canonical" href="http://'.$_SERVER["SERVER_NAME"].$APPLICATION->GetCurPage(false).'" />',true);
}

CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$arNavParams = array("nPageSize" => $arParams["COUNT"],	"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],	"bShowAll" => $arParams["PAGER_SHOW_ALL"]);
$arNavigation = CDBResult::GetNavParams($arNavParams);


$obCache = new CPHPCache;
$life_time = 86400*7;

$cache_id = "404catalogSection-".str_replace("/","_",$arResult["VARIABLES"]["SECTION_CODE_PATH"]).$arResult["VARIABLES"]["SECTION_ID"];
$cache_path = "/catalog/section/".SITE_ID."/".$arParams['IBLOCK_ID']."/";

if($obCache->InitCache($life_time, $cache_id, $cache_path)) :
	$vars = $obCache->GetVars();
	$SECTIONS = $vars["SECTION_TITLE"];

else :
	global $CACHE_MANAGER;
	$CACHE_MANAGER->StartTagCache($cache_path);
	$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams['IBLOCK_ID']);

	$arSectionSelect = array("ID","NAME","UF_*");
	$arFilter = array(
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		"CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"ACTIVE" => "Y",
		"ELEMENT_SUBSECTIONS" => "N",
	);
	$rsSect = CIBlockSection::GetList(false,$arFilter,true,$arSectionSelect);
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

if(!$SECTIONS){
	CHTTP::SetStatus("404 Not Found");
	define("ERROR_404", "Y");
}elseif(intval($SECTIONS["ELEMENT_CNT"])==0){
	$sections = true;
}

if(intval($arNavigation['PAGEN']) <= 1):?>
<?$APPLICATION->IncludeFile(
		$arParams['SEF_FOLDER'].'seo_top_'.$SECTIONS["ID"].'-'.$arResult["VARIABLES"]["SECTION_CODE"].'.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO TOP", 'TEMPLATE' => 'default.php')
	);
endif;

if($sections && $arParams["VIEW_SUBSECTION"] == "Y"):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"subsection",
		array(

			"SECTION_ID" => $SECTIONS["ID"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
			"PAGINATION_COUNT" => $arParams["PAGINATION_COUNT"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"DISPLAY_SECTION_IMG_WIDTH" => $arParams["DISPLAY_SECTION_IMG_WIDTH"],
			"DISPLAY_SECTION_IMG_HEIGHT" => $arParams["DISPLAY_SECTION_IMG_HEIGHT"],
			"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
			'SECTION_USER_FIELDS' => array('UF_*'),
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"]
		),
		$component
	);
	?>
<?elseif($sections && $arParams["VIEW_SUBSECTION_ITEMS"] == "Y"):?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"sub_items",
		array(

			"SECTION_ID" => $SECTIONS["ID"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
			"PAGINATION_COUNT" => $arParams["PAGINATION_COUNT"],
			"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"LIST_IMG_WIDTH" => $arParams["LIST_IMG_WIDTH"],
			"LIST_IMG_HEIGHT" => $arParams["LIST_IMG_HEIGHT"],
			"LIST_ELEMENT_COUNT" => $arParams["LIST_ELEMENT_COUNT"],

			"DEFAULT_IMG" => $arParams["DEFAULT_IMG"],
			"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
			'SECTION_USER_FIELDS' => array('UF_*'),
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"]
		),
		$component
	);
	?>
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		Array(

			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SORT_BY1" => $arParams["SORT_BY1"],
			"SORT_ORDER1" => $arParams["SORT_ORDER1"],
			"SORT_BY2" => $arParams["SORT_BY2"],
			"SORT_ORDER2" => $arParams["SORT_ORDER2"],
			"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
			"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"BTN_NAME" => $arParams["BTN_NAME"],
			"BTNDEFAULT_LIST_TEMPLATE_NAME" => $arParams["DEFAULT_LIST_TEMPLATE"],
			"CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
			"BLOCK_IMG_WIDTH" => $arParams["BLOCK_IMG_WIDTH"],
			"BLOCK_IMG_HEIGHT" => $arParams["BLOCK_IMG_HEIGHT"],
			"DEFAULT_IMG" => $arParams["DEFAULT_IMG"],
			"LIST_IMG_WIDTH" => $arParams["LIST_IMG_WIDTH"],
			"LIST_IMG__HEIGHT" => $arParams["LIST_IMG__HEIGHT"],
			"TABLE_IMG__WIDTH" => $arParams["TABLE_IMG__WIDTH"],
			"TABLE_IMG__HEIGHT" => $arParams["TABLE_IMG__HEIGHT"],
			"SET_STATUS_404" => "Y",
			"SHOW_404" => "Y",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"SET_META_DESCRIPTION" => "Y",
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"TYPE_IMG_THUMB_LIST" => $arParams["TYPE_IMG_THUMB_LIST"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
			"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
			"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
			"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
			"IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
		),
		$component
	); ?>
	<?else:?>

	<?

	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);

	if(0 < intval($arResult["VARIABLES"]["SECTION_ID"])) {
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	} elseif('' != $arResult["VARIABLES"]["SECTION_CODE"]) {
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
	}

	$rsSections = CIBlockSection::GetList(array(), $arFilter);
	if($arSection = $rsSections->Fetch()) {
		$arCurSection["ID"] = $arSection["ID"];
		$arCurSection["NAME"] = $arSection["NAME"];
	}
	//pr($arResult);
	?>
	<?$this->SetViewTarget('sidebar-block');?>

	<?
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.smart.filter",
		//".default_old",
		"visual_vertical",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arCurSection['ID'],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			// "PRICE_CODE" => $arParams["PRICE_CODE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SAVE_IN_SESSION" => "N",
			"INCLUDE_JQUERY" => "N",
			"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
			"XML_EXPORT" => "Y",
			"SECTION_TITLE" => "NAME",
			"SECTION_DESCRIPTION" => "",
			'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
			//'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			//'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			"SEF_MODE" => "N",
			// "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
			"SEF_RULE" => "/catalog/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
			"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		),
		$component,
		array('HIDE_ICONS' => 'N')
	);?>
	<?$this->EndViewTarget();?>

	<?
	/////  sorting
	$arAvailableSort = array(
		"SORT" => array("SORT", "desc"),
		"NAME" => array("NAME", "asc"),
		"PRICE" => array("PRICE", "asc"),
	);

	if ($_REQUEST["sort"]){
		$sort=ToUpper($_REQUEST["sort"]);
		$_SESSION["sort"]=ToUpper($_REQUEST["sort"]);
	}elseif($_SESSION["sort"]){
		$sort=ToUpper($_SESSION["sort"]);
	}else{
		$sort=ToUpper($arParams["SORT_BY1"]);
	}
	$sort_order=$arAvailableSort[$sort][1];
	if((array_key_exists("order", $_REQUEST) && in_array(ToLower($_REQUEST["order"]), Array("asc", "desc")) ) ||
		(array_key_exists("order", $_SESSION) && in_array(ToLower($_SESSION["order"]), Array("asc", "desc")) ))
	{
		if ($_REQUEST["order"]){
			$sort_order=$_REQUEST["order"];
			$_SESSION["order"]=$_REQUEST["order"];
		}elseif($_SESSION["order"]){
			$sort_order=$_SESSION["order"];
		}else{
			$sort_order=ToLower($arParams["SORT_ORDER1"]);
		}
	}

	///// tempalate

	if (array_key_exists("display", $_REQUEST) || (array_key_exists("display", $_SESSION)) || $arParams["DEFAULT_LIST_TEMPLATE"]){
		if($_REQUEST["display"]&&((trim($_REQUEST["display"])=="list")||(trim($_REQUEST["display"])=="table")||(trim($_REQUEST["display"])=="block"))){
			$display=trim($_REQUEST["display"]);
			$_SESSION["display"]=trim($_REQUEST["display"]);
		}elseif($_SESSION["display"]&&(($_SESSION["display"]=="list")||($_SESSION["display"]=="table"))){
			$display=$_SESSION["display"];
		}else{
			$display=$arParams["DEFAULT_LIST_TEMPLATE"];
		}
	}else{
		$display = $arParams["DEFAULT_LIST_TEMPLATE"]?$arParams["DEFAULT_LIST_TEMPLATE"]:"block";   // default template (block, list, table)
	}
	?>

	<div class="catalog-sort drop clearfix">
		<div class="names">
			<?foreach ($arAvailableSort as $key => $val):
				$newSort = $sort_order == 'desc' ? 'asc' : 'desc';?>
				<div class="item <?=($sort == $key && $sort_order == "asc"?"top":"bottom")?>">
					<a <?=($sort == $key?'class="active"':"")?> href="<?=$APPLICATION->GetCurPageParam('sort='.$key.'&order='.$newSort,	array('sort', 'order',))?>">
						<span class="dash"><?=GetMessage("DB_SORT_".$key)?></span>
					</a>
				</div>
			<?endforeach;?>
		</div>

	</div>
	<?if($sort == "PRICE"){
		$sort = "PROPERTY_PRICE";
	}
	?>


	<?$intSectionID = $APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		$display,
		array(
			"ELEMENT_SORT_FIELD" => $sort,
			"ELEMENT_SORT_ORDER" => $sort_order,
			"CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
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
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
			"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
			"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
			"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

			"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["PAGER_TITLE"],
			"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
			"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"PAGINATION_COUNT" => $arParams["PAGINATION_COUNT"],
			"SET_META_DESCRIPTION" => "Y",
			"META_DESCRIPTION" => "",
			"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
			"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
			"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
			"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
			"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
			"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
			"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
			"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

			"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
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
			'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
			'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
			'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
			'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
			'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
		),
		$component
	);
	?>
	<?/// form?>
	<?$APPLICATION->IncludeFile(
		SITE_DIR.'include/form_catalog.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => false, "NAME" => "form_catalog", 'TEMPLATE' => 'default.php')
	);?>
	<?// END form?>

	<?

//*/
endif;

$GLOBALS['arrFilterTagList']['PROPERTY_LINK_SECTIONS'] = $SECTIONS["ID"];
$GLOBALS['arrFilterTagList']['!PROPERTY_SHOW_IN_TAGS'] = false;
$APPLICATION->IncludeComponent("db.base:simple.list", "catalog_tag_list", array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID_TAGS"],
	"BLOCK_TITLE" => $arParams["TAGS_BLOCK_TITLE"],
	"NEWS_COUNT" => "100",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "ACTIVE_FROM",
	"SORT_ORDER2" => "DESC",
	"FILTER_NAME" => "arrFilterTagList",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600000",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "N",

),
	false
);?>
<?if(intval($arNavigation['PAGEN']) <= 1):
	$APPLICATION->IncludeFile(
		$arParams['SEF_FOLDER'].'seo_footer_'.$SECTIONS["ID"].'-'.$arResult["VARIABLES"]["SECTION_CODE"].'.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER", 'TEMPLATE' => 'default.php')
	);
endif;
?>