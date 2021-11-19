<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if($_REQUEST["display"] || $_REQUEST["sort"] || $_REQUEST["order"]){
    $APPLICATION->AddHeadString('<link rel="canonical" href="http://'.$_SERVER["SERVER_NAME"].$APPLICATION->GetCurPage(false).'" />',true);
}

/// 404
if($APPLICATION->GetCurPage() != $arParams["SEF_FOLDER"] ){
    CHTTP::SetStatus("404 Not Found");
    define("ERROR_404", "Y");
}

//$APPLICATION->SetPageProperty("HideTitle", "Y");
//$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
//$APPLICATION->SetPageProperty("g-content-count-grid", "12");
//$APPLICATION->SetPageProperty("body_class", "b-production container_12");
$APPLICATION->SetPageProperty("SidebarClass", "hide");
$APPLICATION->SetPageProperty("CrumbClass", "col-sm-12 col-12 col-offset-0");
$APPLICATION->SetPageProperty("ContentClass", "g-content col-sm-12 col-12 pull-right clearfix");

//$APPLICATION->SetPageProperty("GmainClass", "wide");
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
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "",
    array(
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
<?if(intval($arNavigation['PAGEN']) <= 1):
    $APPLICATION->IncludeFile(
        $arParams['SEF_FOLDER'].'seo_footer_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
        Array(),
        Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER", 'TEMPLATE' => 'default.php')
    );
endif;
?>
