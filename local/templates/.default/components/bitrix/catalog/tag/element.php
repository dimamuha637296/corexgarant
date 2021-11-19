<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);


$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"",
	array(

		"IBLOCK_ID_CATALOG" => $arParams["IBLOCK_ID_CATALOG"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "",
		"BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],

		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],

		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],

	),
	$component
);

CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$arNavParams = array("nPageSize" => $arParams["COUNT"],	"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],	"bShowAll" => $arParams["PAGER_SHOW_ALL"]);
$arNavigation = CDBResult::GetNavParams($arNavParams);


if(intval($arNavigation['PAGEN']) <= 1 && $GLOBALS["PREVIEW_TEXT"]):?>
	<?=$GLOBALS["PREVIEW_TEXT"];?>
<?endif;?>


<?if(intval($GLOBALS['COUNT_ITEM'])>0):

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
		<div class="view">
			<?if($display == "block"):?>
				<span class="view-item blocks active"></span>
			<?else:?>
				<a title="block" class="view-item blocks" href="<?=$APPLICATION->GetCurPageParam('display=block', array('display', 'mode'))?>"></a>
			<?endif;?>
			<?if($display == "list"):?>
				<span class="view-item lines active"></span>
			<?else:?>
				<a title="list" class="view-item lines" href="<?=$APPLICATION->GetCurPageParam('display=list', array('display', 'mode'))?>"></a>
			<?endif;?>
			<?if($display == "table"):?>
				<span class="view-item tables active"></span>
			<?else:?>
				<a title="table" class="view-item tables" href="<?=$APPLICATION->GetCurPageParam('display=table', array('display', 'mode'))?>"></a>
			<?endif;?>
		</div>
	</div>
<?endif;?>

<?if($sort == "PRICE"){
	$sort = "PROPERTY_PRICE";
}


if($arParams["COMPONENT_SHOP"] =="Y"){
	$display = "shop_".$display;
}


$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	$display,
	array(
		"FILTER_NAME" => "arrFilterTagList",
		"SHOW_ALL_WO_SECTION" => "Y",
		"TAG_LIST" => "Y",

		"IBLOCK_ID" => $arParams["IBLOCK_ID_CATALOG"],
		"TAG_ID" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],

		"ELEMENT_SORT_FIELD" => $sort,
		"ELEMENT_SORT_ORDER" =>	$sort_order,
		"CATALOG_CURRENCY" => $arParams["CATALOG_CURRENCY"],
		"BLOCK_IMG_WIDTH" => $arParams["BLOCK_IMG_WIDTH"],
		"BLOCK_IMG_HEIGHT" => $arParams["BLOCK_IMG_HEIGHT"],
		"TYPE_IMG_THUMB_LIST" => $arParams["TYPE_IMG_THUMB_LIST"],
		"LIST_IMG_WIDTH" => $arParams["LIST_IMG_WIDTH"],
		"LIST_IMG_HEIGHT" => $arParams["LIST_IMG_HEIGHT"],
		"TABLE_IMG_WIDTH" => $arParams["TABLE_IMG_WIDTH"],
		"TABLE_IMG_HEIGHT" => $arParams["TABLE_IMG_HEIGHT"],

		'COMPARE_NAME' => $arParams['COMPARE_NAME'],

		"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => "N",
		"BROWSER_TITLE" => "N",

		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		//"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],

		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
		"NAME_COMPARE_BTN" => $arParams["NAME_COMPARE_BTN"],
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
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "N",
		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

		//"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
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


		'USE_COMPARE' => $arParams['USE_COMPARE'],
		'BRAND_PROP_CODE' => $arParams['DETAIL_BRAND_PROP_CODE'],
		"BTN_PREORDER" => $arParams["BTN_PREORDER"],
		"BUY_ONE_CLICK_SECTION" => $arParams["BUY_ONE_CLICK_SECTION"],
		'BTN_MESS_BUY_ONE_KLICK' => $arParams['BTN_MESS_BUY_ONE_KLICK'],
		'BTN_MESS_BUY' => $arParams['MESS_BTN_ADD_TO_BASKET'],
		"BTN_NO_AVAILABLE" => $arParams["BTN_NO_AVAILABLE"],
		'USE_QUANTITY_FOR_ORDER' => $arParams['USE_QUANTITY_FOR_ORDER'],
	),
	$component
);

if(intval($arNavigation['PAGEN']) <= 1 && $GLOBALS["DETAIL_TEXT"]):?>
	<?=$GLOBALS["DETAIL_TEXT"];?>
<?endif;?>



<?$APPLICATION->IncludeFile(
	SITE_DIR.'include/form_catalog.php',
	Array(),
	Array("MODE"=>"html", "SHOW_BORDER" => false, "NAME" => "form_catalog", 'TEMPLATE' => 'default.php')
);?>