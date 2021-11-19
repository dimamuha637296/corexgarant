<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$obCache = new CPHPCache;
$life_time = 86400*7;
$cache_id = "404ErrorPressRoomSection-".$arResult["VARIABLES"]["SECTION_CODE"];

if($obCache->InitCache($life_time, $cache_id, "/")) :
    $vars = $obCache->GetVars();
    $SECTIONS = $vars["SECTION_TITLE"];

else :
    $arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"], "ACTIVE" => "Y");
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

if(!$_REQUEST["PAGEN_1"]){
	$APPLICATION->AddHeadString('<link rel="canonical" href="https://'.$_SERVER["SERVER_NAME"].$APPLICATION->GetCurPage(false).'" />',true);
}

?>
<?
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

$IBLOCK_ID = $arParams["IBLOCK_ID"];
$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"TYPE"));
while($enum_fields = $property_enums->GetNext())
{
    $arResult["FILTER_NEWS"][$enum_fields["XML_ID"]] = $enum_fields;
}

$CurPage = $APPLICATION->GetCurPage();
?>
<?if($arResult["FILTER_NEWS"]):?>
    <div class="news-menu">
        <ul class="list-reset">
            <li class="item <?=($arParams["SEF_FOLDER"] == $CurPage?" active":"")?>">
                <?if(!$_GET["filter"]):?>
                    <span>Все</span>
                <?else:?>
                    <a href="<?=$APPLICATION->GetCurPage()?>"><span class="lnk-pseudo">Все</span></a>
                <?endif;?>
            </li>
            <?foreach($arResult["FILTER_NEWS"] as $arFilter):?>
                <?if($_GET["filter"] == $arFilter["XML_ID"]):?>
                    <?$active = true;?>
                <?else:?>
                    <?$active = false;?>
                <?endif;?>
                <li class="item<?=($active?" active":"")?>">
                    <?if(!$active):?>
                        <a href="<?=$CurPage?>?filter=<?=$arFilter["XML_ID"]?>"><span class="lnk-pseudo"><?=$arFilter["VALUE"]?></span></a>
                    <?else:?>
                        <span><?=$arFilter["VALUE"]?></span>
                    <?endif;?>
                </li>
            <?endforeach;?>
        </ul>
    </div>
<?endif;?>

<?
if($_GET["filter"] && array_key_exists ($_GET["filter"], $arResult["FILTER_NEWS"])){
    $GLOBALS['arrFilterNewsSection']['PROPERTY_TYPE_VALUE'] = $arResult["FILTER_NEWS"][$_GET["filter"]]["VALUE"];
}


if($_REQUEST["dbAjaxNav"]=="Y" && $_REQUEST["type"]=="html"){
    $APPLICATION->RestartBuffer();
}
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "",
    Array(
        "FILTER_NAME"	=>	"arrFilterNewsSection",
        "ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
        "IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
        "IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
        "NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
        "SORT_BY1"	=>	$arParams["SORT_BY1"],
        "SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
        "SORT_BY2"	=>	$arParams["SORT_BY2"],
        "SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
        "FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
        "PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
        "DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
        "SET_TITLE"	=>	$arParams["SET_TITLE"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],

        "CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
        "CACHE_TIME"	=>	$arParams["CACHE_TIME"],
        "CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
        "PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
        "PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
        "PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
        "PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
        "PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
        "DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
        "DISPLAY_NAME"	=>	$arParams["DISPLAY_ELEMENT_NAME"],
        "DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
        "DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
        "PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
        "ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
        "USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
        "GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],

        "SET_META_DESCRIPTION" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
        "CHECK_DATES"	=>	$arParams["CHECK_DATES"],
        "SEF_FOLDER"	=>	$arParams["SEF_FOLDER"],
        "PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
        "PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
        "DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
        "SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
        "SHARPEN"	=>	$arParams["SHARPEN_LIST"],
        "SEF_FOLDER"	=>	$arParams["SEF_FOLDER"],
        "TYPE_IMG_THUMB"	=>	$arParams["TYPE_IMG_THUMB_LIST"],
        "DISPLAY_PICTURE_FULL_WIDTH"	=>	$arParams["DISPLAY_PICTURE_FULL_WIDTH"],
        "HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
        "DISPLAY_LIST_IMG_WIDTH" =>	$arParams["DISPLAY_LIST_IMG_WIDTH"],
        "DISPLAY_SECTION_NAME"	=>	$arParams["DISPLAY_SECTION_NAME"],
        "DISPLAY_LIST_IMG_HEIGHT" => $arParams["DISPLAY_LIST_IMG_HEIGHT"]
    ),
    $component
);
if($_REQUEST["dbAjaxNav"]=="Y" && $_REQUEST["type"]=="html"){
    die();
}
?>


<?if(intval($arNavigation['PAGEN']) <= 1):
    $APPLICATION->IncludeFile(
        $arParams['SEF_FOLDER'].'seo_footer_'.intval($arResult["VARIABLES"]["SECTION_ID"]).$arResult["VARIABLES"]["SECTION_CODE"].'.php',
        Array(),
        Array("MODE"=>"html", "SHOW_BORDER" => true, "NAME" => "SEO FOOTER", 'TEMPLATE' => 'default.php')
    );
endif;


?>