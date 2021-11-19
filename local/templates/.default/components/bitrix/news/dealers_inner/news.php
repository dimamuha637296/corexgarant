<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if($arParams["REDIRECT_FIRST_SECTION"] =="Y"){

    $obCache = new CPHPCache;
    $life_time = 86400*7;
    $cache_id = "redirectDealers-".$arParams['COMPONENT_TEMPLATE'].$arParams['IBLOCK_ID'];
    $cache_path = "/redirect_dealers".$arParams['COMPONENT_TEMPLATE'].$arParams['IBLOCK_ID']."/";


    if($obCache->InitCache($life_time, $cache_id, $cache_path)) :
        $vars = $obCache->GetVars();
        $SECTIONS = $vars["SECTION_TITLE"];

    else :
        global $CACHE_MANAGER;
        $CACHE_MANAGER->StartTagCache($cache_path);
        $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams['IBLOCK_ID']);

        $arFilter = array(
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            "DEPTH_LEVEL" => "1",
            "ACTIVE" => "Y"
        );
        $rsSect = CIBlockSection::GetList(array("sort" => "desc"),$arFilter,false,array("SECTION_PAGE_URL"));
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

    if($SECTIONS["SECTION_PAGE_URL"]){
        LocalRedirect($SECTIONS["SECTION_PAGE_URL"], false, '301 Moved permanently');
    }
    }
?>
<div id="ws_map" class="map">
    <?if($arParams['MAP_HAS_CATEGORIES'] == 'Y'):?>
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.section.list",
            "",
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "MAP_HAS_CATEGORY_FILTER" => $arParams["MAP_HAS_CATEGORY_FILTER"],
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_URL" => "",
                "COUNT_ELEMENTS" => "Y",
                "TOP_DEPTH" => "2",
                "SECTION_FIELDS" => array(
                    0 => "ID",
                    1 => "NAME",
                    2 => "SORT",
                    3 => "",
                ),
                "SECTION_USER_FIELDS" => array(
                    0 => "UF_YANDEX_LAT",
                    1 => "UF_YANDEX_LON",
                    2 => "UF_YANDEX_SCALE",
                    3 => "",
                ),
                "ADD_SECTIONS_CHAIN" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "N",
                "CUR_SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
                "IBLOCK_CATEGORIES" => $arParams["IBLOCK_CATEGORIES"],
            ),
            $component
        ); ?>
    <?endif;?>
    <? $APPLICATION->IncludeComponent(
        "db.base:ymap.dealer.view",
        ".default",
        array(
            "MAP_HAS_CATEGORY_FILTER" => $arParams["MAP_HAS_CATEGORY_FILTER"],
            "MAP_WIDTH" => $arParams["MAP_WIDTH"],
            "MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
            "MAPS_ICON_SRC" => $arParams["MAPS_ICON_SRC"],
            "MAPS_ICON_MAIN_WIDTH" => $arParams["MAPS_ICON_MAIN_WIDTH"],
            "MAPS_ICON_MAIN_HEIGHT" => $arParams["MAPS_ICON_MAIN_HEIGHT"],
            "MAPS_ICON_CLUSTER_SRC" => $arParams["MAPS_ICON_CLUSTER_SRC"],
            "MAPS_ICON_CLUSTER_WIDTH" => $arParams["MAPS_ICON_CLUSTER_WIDTH"],
            "MAPS_ICON_CLUSTER_HEIGHT" => $arParams["MAPS_ICON_CLUSTER_HEIGHT"],
            "MAPS_ICON_CLUSTER_BIG_SRC" => $arParams["MAPS_ICON_CLUSTER_BIG_SRC"],
            "MAPS_ICON_CLUSTER_BIG_WIDTH" => $arParams["MAPS_ICON_CLUSTER_BIG_WIDTH"],
            "MAPS_ICON_CLUSTER_BIG_HEIGHT" => $arParams["MAPS_ICON_CLUSTER_BIG_HEIGHT"],
            "PLACEMARKS" => $arResult["PLACEMARKS"],
            "IBLOCK_TYPE" => "dealers",
            "IBLOCK_SHOPS" => "25",
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "IBLOCK_CATEGORIES" => $arParams["IBLOCK_CATEGORIES"],
            "CUR_SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE']
        ),
        $component,
        array(
            "HIDE_ICONS" => "N",
            "ACTIVE_COMPONENT" => "Y"
        )
    );
    ?>
    <?if($arParams['MAP_HAS_LIST_ELEMENTS'] == 'Y'):?>
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            ".default",
            Array(
                "SET_TITLE" => "N",
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "IBLOCK_CATEGORIES" => $arParams["IBLOCK_CATEGORIES"],
                "NEWS_COUNT" => $arParams["NEWS_COUNT"],
                "SORT_BY1" => $arParams["SORT_BY1"],
                "SORT_ORDER1" => $arParams["SORT_ORDER1"],
                "SORT_BY2" => $arParams["SORT_BY2"],
                "SORT_ORDER2" => $arParams["SORT_ORDER2"],
                "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                //"SET_TITLE" => $arParams["SET_TITLE"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                "DISPLAY_NAME" => $arParams["DISPLAY_ELEMENT_NAME"],
                "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
                "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                "PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
                "PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
                "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                "FILTER_NAME" => "",
                "SHARPEN" => $arParams["SHARPEN_LIST"],
                "SEF_FOLDER" => $arParams["SEF_FOLDER"],
                "DISPLAY_PICTURE_FULL_WIDTH" => $arParams["DISPLAY_PICTURE_FULL_WIDTH"],
                "DISPLAY_SECTION_NAME" => $arParams["DISPLAY_SECTION_NAME"],
                "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                "CHECK_DATES" => $arParams["CHECK_DATES"],
                "MAP_DATA" => $arParams['MAP_DATA'],
                "MAP_WIDTH" => $arParams["MAP_WIDTH"],
                "MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
                "CONTROLS" => $arParams["CONTROLS"],
                "MAPS_ICON" => $arParams["MAPS_ICON"],
                "OPTIONS" => $arParams["OPTIONS"],
            ),
            $component
        );
        ?>
    <?endif;?>
</div>