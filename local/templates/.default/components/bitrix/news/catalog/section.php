<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($_REQUEST["display"] || $_REQUEST["sort"] || $_REQUEST["order"]){
    $APPLICATION->AddHeadString('<link rel="canonical" href="http://'.$_SERVER["SERVER_NAME"].$APPLICATION->GetCurPage(false).'" />',true);
}

CPageOption::SetOptionString("main", "nav_page_in_session", "N");
$arNavParams = array("nPageSize" => $arParams["COUNT"],	"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],	"bShowAll" => $arParams["PAGER_SHOW_ALL"]);
$arNavigation = CDBResult::GetNavParams($arNavParams);
if(intval($arNavigation['PAGEN']) <= 1):?>
    <?$APPLICATION->IncludeFile(
        $arParams['SEF_FOLDER'].'seo_top_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
        Array(),
        Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO TOP", 'TEMPLATE' => 'default.php')
    );
endif;


$obCache = new CPHPCache;
$life_time = 86400*7;
$cache_id = "404ErrorCatalogSection-".$arResult["VARIABLES"]["SECTION_CODE"];

if($obCache->InitCache($life_time, $cache_id, "/")) :
    $vars = $obCache->GetVars();
    $SECTIONS = $vars["SECTION_TITLE"];

else :
    $arSectionSelect = array("ID","NAME","UF_*");
    $arFilter = array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        "CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "ACTIVE" => "Y"
    );
    $rsSect = CIBlockSection::GetList(false,$arFilter,false,$arSectionSelect);
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
///END 404
$APPLICATION->SetPageProperty("HideTitle", "Y");
?>
<h1><?=($SECTIONS["UF_TITLE"]?$SECTIONS["UF_TITLE"]:$SECTIONS["NAME"])?></h1>

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
       (array_key_exists("order", $_REQUEST) && in_array(ToLower($_REQUEST["order"]), Array("asc", "desc")) ) || $arParams["SORT_ORDER1"])
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
        $display = $arParams["DEFAULT_LIST_TEMPLATE"];   // default template (block, list, table)
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
<?if($sort == "PRICE"){
    $sort = "PROPERTY_PRICE";
}?>
<?

$APPLICATION->IncludeComponent(
	"bitrix:news.list",
    $display,
	Array(
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
		"SORT_BY1"	=>	$sort,
		"SORT_ORDER1"	=>	$sort_order,
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],

		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	$arParams["SET_TITLE"],
		"BTN_NAME"	=>	$arParams["BTN_NAME"],
		"BTNDEFAULT_LIST_TEMPLATE_NAME"	=>	$arParams["DEFAULT_LIST_TEMPLATE"],
		"CATALOG_CURRENCY"	=>	$arParams["CATALOG_CURRENCY"],
		"BLOCK_IMG_WIDTH"	=>	$arParams["BLOCK_IMG_WIDTH"],
		"BLOCK_IMG_HEIGHT"	=>	$arParams["BLOCK_IMG_HEIGHT"],
		"DEFAULT_IMG"	=>	$arParams["DEFAULT_IMG"],
		"LIST_IMG_WIDTH"	=>	$arParams["LIST_IMG_WIDTH"],
		"LIST_IMG__HEIGHT"	=>	$arParams["LIST_IMG__HEIGHT"],
		"TABLE_IMG__WIDTH"	=>	$arParams["TABLE_IMG__WIDTH"],
		"TABLE_IMG__HEIGHT"	=>	$arParams["TABLE_IMG__HEIGHT"],
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
        "FILE_404"	=>	"/catalog/",
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"SET_META_DESCRIPTION"	=>	"N",
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"TYPE_IMG_THUMB_LIST"	=>	$arParams["TYPE_IMG_THUMB_LIST"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	"Y",
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
	),
	$component
);?>
<?if(intval($arNavigation['PAGEN']) <= 1):
    $APPLICATION->IncludeFile(
        $arParams['SEF_FOLDER'].'seo_footer_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
        Array(),
        Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER", 'TEMPLATE' => 'default.php')
    );
endif;
?>

<?/// form?>

<?$APPLICATION->IncludeFile(
    SITE_DIR.'include/form_catalog.php',
    Array(),
    Array("MODE"=>"html", "SHOW_BORDER" => false, "NAME" => "form_catalog", 'TEMPLATE' => 'default.php')
);?>
<?// END form?>
