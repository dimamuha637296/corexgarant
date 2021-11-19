<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$fullUrl = $arParams['SEF_FOLDER'].$arResult["VARIABLES"]["SECTION_CODE_PATH"]."/";

$GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/js/libs/jquery.formstyler.min.js"));



$sections = false;
if($_REQUEST["display"] || $_REQUEST["sort"] || $_REQUEST["order"] || $_REQUEST["set_filter"]){
	$APPLICATION->AddHeadString('<link rel="canonical" href="http://'.$_SERVER["SERVER_NAME"].$fullUrl.'" />',true);
}

CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$arNavParams = array("nPageSize" => $arParams["COUNT"],	"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],	"bShowAll" => $arParams["PAGER_SHOW_ALL"]);
$arNavigation = CDBResult::GetNavParams($arNavParams);


$obCache = new CPHPCache;
$life_time = 86400*7;
$cache_id = "404ShopCatalogSection-".str_replace("/","_",$arResult["VARIABLES"]["SECTION_CODE_PATH"]).$arResult["VARIABLES"]["SECTION_ID"];
$cache_path = "/catalog-shop/section/".SITE_ID."/".$arParams['IBLOCK_ID']."/";

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
		//"ELEMENT_SUBSECTIONS" => "N",
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

//$APPLICATION->SetPageProperty("HideTitle", "Y");
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
);?><?if(intval($arNavigation['PAGEN']) <= 1):?>
	<?$APPLICATION->IncludeFile(
		$arParams['SEF_FOLDER'].'seo_top_'.$SECTIONS["ID"].'-'.$arResult["VARIABLES"]["SECTION_CODE"].'.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO TOP", 'TEMPLATE' => 'default.php')
	);
endif;
?>
<?
$viewSubsectionTempalate = false;
if($arParams["VIEW_SUBSECTION_ITEMS"] == "Y"){
    $viewSubsectionTempalate = "sub_items";
}elseif($arParams["VIEW_SUBSECTION"] == "Y"){
    $viewSubsectionTempalate = "subsection";
}
//var_dump($viewSubsectionTempalate);
if($sections && $viewSubsectionTempalate != false):?>

	<?
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
        $viewSubsectionTempalate,
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
			"VIEW_SUBSECTION_IMG" => $arParams["VIEW_SUBSECTION_IMG"],
			"DISPLAY_SECTION_IMG_WIDTH" => $arParams["SUBSECTION_IMG_WIDTH"],
			"DISPLAY_SECTION_IMG_HEIGHT" => $arParams["SUBSECTION_IMG_HEIGHT"],
			"VIEW_SUBSECTION_ITEMS" => $arParams["VIEW_SUBSECTION_ITEMS"],
			"TYPE_IMG_THUMB" => $arParams["SUBSECTION_TYPE_IMG_THUMB"],
			'SECTION_USER_FIELDS' => array('UF_*'),
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"]

		),
		$component
	);
	?>

	<?//компонент для уствновки сео-полей, временно
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"empty",
		Array(

			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NEWS_COUNT" => $arParams["NEWS_COUNT"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_FILTER" => $arParams["CACHE_FILTER"],
			"SET_META_DESCRIPTION" => $arParams["SET_META_DESCRIPTION"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
			"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
			"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
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
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.smart.filter",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],

			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => $arCurSection['ID'],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SAVE_IN_SESSION" => "N",
			"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
			"XML_EXPORT" => "Y",
			"SECTION_TITLE" => "NAME",
			"SECTION_DESCRIPTION" => "DESCRIPTION",
			'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			"SEF_MODE" => $arParams["SEF_MODE"],
			"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
			"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);?>

	<?$this->EndViewTarget();?>

	<?
	/*/
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"menu",
		array(

			"SECTION_ID" => $SECTIONS["ID"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => "2",
			"ADD_SECTIONS_CHAIN" => "N",
			"PAGINATION_COUNT" => $arParams["PAGINATION_COUNT"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"VIEW_SUBSECTION_IMG" => $arParams["VIEW_SUBSECTION_IMG"],
			"DISPLAY_SECTION_IMG_WIDTH" => $arParams["SUBSECTION_IMG_WIDTH"],
			"DISPLAY_SECTION_IMG_HEIGHT" => $arParams["SUBSECTION_IMG_HEIGHT"],
			"VIEW_SUBSECTION_ITEMS" => $arParams["VIEW_SUBSECTION_ITEMS"],
			"TYPE_IMG_THUMB" => $arParams["SUBSECTION_TYPE_IMG_THUMB"],
			'SECTION_USER_FIELDS' => array('UF_*'),
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"]
		),
		$component
	);
	//*/
	?>


	<?
	//pr($SECTIONS);
	/** СОРТИРОВКА **/
	if(intval($SECTIONS["ELEMENT_CNT"])>0 || $arResult["VARIABLES"]["SMART_FILTER_PATH"]):

		$arAvailableSort = array(
			"SORT" => array("SORT", "desc"),
			"NAME" => array("NAME", "asc"),
			"PRICE" => array("PRICE", "asc"),
		);

		if(!empty($arParams['DISPLAY_SORT_LIST']) && is_array($arParams['DISPLAY_SORT_LIST'])){
			$arAvailableSort =  array_intersect_key($arAvailableSort, array_flip($arParams['DISPLAY_SORT_LIST']));
		}

		if ($_REQUEST["sort"]){
			$sort=ToUpper($_REQUEST["sort"]);
			$_SESSION["sort"]=ToUpper($_REQUEST["sort"]);
		}elseif($_SESSION["sort"]){
			$sort=ToUpper($_SESSION["sort"]);
		}else{
			$sort=ToUpper($arParams["ELEMENT_SORT_FIELD"]);
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

		/** ВИД ВЫВОДА**/

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


	<div class="catalog-sort clearfix">
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
        <?if(!empty($arParams["DISPLAY_VIEW_LIST"])):?>
            <?$viewClass = array('block' => 'blocks', 'list' => 'lines', 'table' => 'tables');?>
            <div class="view">
                <?foreach($arParams["DISPLAY_VIEW_LIST"] as $arView):?>
                    <?if($display == $arView):?>
                        <span class="view-item <?=$viewClass[$arView]?> active"></span>
                    <?else:?>
                        <a title="<?=$arView?>" class="view-item <?=$viewClass[$arView]?>" href="<?=$APPLICATION->GetCurPageParam('display='.$arView, array('display', 'mode'))?>"></a>
                    <?endif;?>
                <?endforeach;?>
            </div>
        <?endif;?>
	</div>

	<?if($sort == "PRICE"){
		//$sort = "PROPERTY_PRICE";
		$sort = "CATALOG_PRICE_1";
	}
	$display = "shop_".$display;
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
			'NAME_COMPARE_BTN' => $arParams['NAME_COMPARE_BTN'],

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
			"SET_META_DESCRIPTION" => $arParams["SET_META_DESCRIPTION"],
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
			'USE_QUANTITY_FOR_ORDER' => $arParams['USE_QUANTITY_FOR_ORDER'],
			'BTN_MESS_BUY_ONE_KLICK' => $arParams['BTN_MESS_BUY_ONE_KLICK'],
			'BTN_MESS_BUY' => $arParams['BTN_MESS_BUY'],
            "BUY_ONE_CLICK_SECTION" => $arParams["BUY_ONE_CLICK_SECTION"],
            "BTN_NO_AVAILABLE" => $arParams["BTN_NO_AVAILABLE"],
			'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
			'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'SHOW_QUANTITY' => $arParams['SHOW_QUANTITY'],
			'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
			'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
			'NAME_COMPARE_BTN' => $arParams['NAME_COMPARE_BTN'],
			'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
			'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
			'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
            "BTN_PREORDER" => $arParams["BTN_PREORDER"],

		),
		$component
	);
	?>
	<?endif;?>
	<?/// form?>
	<?/*$APPLICATION->IncludeFile(
		SITE_DIR.'include/form_catalog.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => false, "NAME" => "form_catalog", 'TEMPLATE' => 'default.php')
	);//*/?>
	<?// END form?>

	<?

//*/
endif;?>
<?if(intval($arNavigation['PAGEN']) <= 1):
	$APPLICATION->IncludeFile(
		$arParams['SEF_FOLDER'].'seo_footer_'.$SECTIONS["ID"].'-'.$arResult["VARIABLES"]["SECTION_CODE"].'.php',
		Array(),
		Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER", 'TEMPLATE' => 'default.php')
	);
endif;

?>