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

<div id="ws_map" class="map-wide map-with-block">
    <?if($arParams['MAP_HAS_CATEGORIES'] == 'Y'):?>
        <div class="map-block-wrap">
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
        </div>
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
</div>