<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" 			=> $arParams["USE_SHARE"],
		"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
		"TYPE_IMG_THUMB"	=>	$arParams["TYPE_IMG_THUMB_DETAIL"],
		"SHARPEN"	=>	$arParams["TYPE_IMG_THUMB_DETAIL"],
		"DISPLAY_PICTURE_FULL_WIDTH"	=>	$arParams["DISPLAY_PICTURE_FULL_WIDTH"],
		"DISPLAY_SECTION_NAME"	=>	$arParams["DISPLAY_SECTION_NAME"],
		"DISPLAY_DETAIL_IMG_WIDTH" => $arParams["DISPLAY_DETAIL_IMG_WIDTH"],
		"DISPLAY_DETAIL_IMG_HEIGHT" => $arParams["DISPLAY_DETAIL_IMG_HEIGHT"],
		"DISPLAY_DETAIL_DOP_IMG_WIDTH" => $arParams["DISPLAY_DETAIL_DOP_IMG_WIDTH"],
		"DISPLAY_DETAIL_DOP_IMG_HEIGHT" => $arParams["DISPLAY_DETAIL_DOP_IMG_HEIGHT"],
		"COLUMN_COUNT_FOR_MORE_PHOTOS" => $arParams["COLUMN_COUNT_FOR_MORE_PHOTOS"],
		"COLUMN_COUNT_FOR_MORE_FILES" => $arParams["COLUMN_COUNT_FOR_MORE_FILES"],
		"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
        "IBLOCK_SHOPS" => $arParams['IBLOCK_SHOPS'],
	),
	$component
);

?>
<div class="c_map" id="transfer">
    <div class="accordion">
        <div class="acc-group">
            <div class="panel">
                <div class="acc-heading">
                    <a class="link collapsed" data-toggle="collapse" href="#accordion-210">
                            <span class=" closer">
                                <?=GetMessage("SH_HIDE_MAP")?>
                            </span>
                            <span class=" opener">
                                <?=GetMessage("SH_SHOW_MAP")?>
                            </span>
                    </a>
                </div>

                <div id="accordion-210" class="collapse">
                    <div class="acc-body">
                        <div class="map">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:map.google.view",
                            "shop_detail",
                            array(
                                "INIT_MAP_TYPE" => "ROADMAP",
                                "MAP_DATA" => unserialize($arParams["~MAP_DATA"]),
                                "MAP_WIDTH" => $arParams["MAP_WIDTH"],
                                "MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
                                "CONTROLS" => $arParams["CONTROLS"],
                                "MAPS_ICON" => $arParams["MAPS_ICON"],
                                "OPTIONS" => $arParams["OPTIONS"],
                                "MAP_ID" => $arParams["MAP_ID"],
                                "MARKERS" => $arResult["MARKERS"],
                                "IBLOCK_SHOPS" => $arParams['IBLOCK_SHOPS'],
                                "IBLOCK_SHOPS_CATEGORIES" => $arParams['IBLOCK_SHOPS_CATEGORIES']
                            ),
                            $component
                        );
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
