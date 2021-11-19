<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="dealers-tabs">
		<div class="tab-body">
		<div class="tab-item mb_4">
			<div class="tab-item-head">
				<div class="tab-item-head_i">
					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section.list",
						"select",
						Array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
							"SECTION_CODE_CUR" => $arResult["VARIABLES"]["SECTION_CODE"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							
							"ADD_SECTIONS_CHAIN" =>	$arParams["ADD_SECTIONS_CHAIN"],
							"TOP_DEPTH" => 1,
							//"TOP_DEPTH" => $arParams["SECTIONS_SUBSEC_ITEMS"] == 'subsection' ? 2 : 1,
					
							"DISPLAY_IMG_WIDTH"	 =>	$arParams["DISPLAY_SECTION_IMG_WIDTH"],
							"DISPLAY_IMG_HEIGHT" =>	$arParams["DISPLAY_SECTION_IMG_HEIGHT"],
							"SHARPEN" =>	$arParams["SHARPEN"],
							"TYPE_IMG_THUMB" => $arParams["TYPE_IMG_THUMB"],
							"COUNT_ELEMENTS" => $arParams["COUNT_ELEMENTS"],
							"SECTIONS_TYPE_TEMPLATE" => $arParams["SECTIONS_TYPE_TEMPLATE"],
							"SECTIONS_SUBSEC_ITEMS" => $arParams["SECTIONS_SUBSEC_ITEMS"],
							'SECTION_USER_FIELDS' => array('UF_*')
						),
						$component
					);?>
					
				</div>
			</div>
			<div class="tab-item-body">
				<div class="b-map-city">
				<div class="b-index-map-info b-map-info _hide" id="map-info-to-show"></div>
					<?$APPLICATION->IncludeComponent("bitrix:map.google.view", "dealers", array(
							"INIT_MAP_TYPE" => $arParams["INIT_MAP_TYPE"],
							"MAP_DATA" => $arParams['~MAP_DATA'],
							"MAP_WIDTH" => $arParams["MAP_WIDTH"],
							"MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
							"CONTROLS" => $arParams["CONTROLS"],
							"MAPS_ICON" => $arParams["MAPS_ICON"],
							"OPTIONS" => $arParams["OPTIONS"],
							"MAP_ID" => $arParams["MAP_ID"],
					),
							$component,
							array(
									"HIDE_ICONS" => "N",
									"ACTIVE_COMPONENT" => "Y"
							)
					);
					?>					
				</div>
			</div>
		</div>
		<div class="tab-item mb_4">
			<div class="tab-item-body">
				<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"simple",
						Array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"ELEMENT_SORT_FIELD" => $sort,//$arParams["ELEMENT_SORT_FIELD"],
							"ELEMENT_SORT_ORDER" => $sort_order,//$arParams["ELEMENT_SORT_ORDER"],
							"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
							"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
							"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
							"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
							"BASKET_URL" => $arParams["BASKET_URL"],
							"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
							"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
							"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
							"FILTER_NAME" => "arrDealerFilter",
							"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_FILTER" => $arParams["CACHE_FILTER"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"SET_TITLE" => 'N',
							"SET_STATUS_404" => $arParams["SET_STATUS_404"],
							"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
							"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
							"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
							"PRICE_CODE" => $arParams["PRICE_CODE"],
							"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
							"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
				
							"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
							"SHOW_ALL_WO_SECTION" => "Y",
							"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
							"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
							"PAGER_TITLE" => $arParams["PAGER_TITLE"],
							"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
							"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
							"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
							"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
							"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				
							"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
							"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
							"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
							"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
							"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
							"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
				
							"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
							"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
							"INCLUDE_SUBSECTIONS" => "Y",
							"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
							"COMPARE_NAME" => $arParams["COMPARE_NAME"],
							
							"DISPLAY_IMG_WIDTH"	 =>	$arParams["DISPLAY_IMG_WIDTH"],
							"DISPLAY_IMG_HEIGHT" =>	$arParams["DISPLAY_IMG_HEIGHT"],
						
							"SHARPEN" => $arParams["SHARPEN"],
							"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
							"USER_FIELDS" => array('PROPERTY_*'),
							"ADD_SECTIONS_CHAIN" => "N",
							'ARAVAILABLEPAGE' => $arAvailablePage
						),
						$component
					);
				?>
			</div>
		</div>
	</div>
</div>
<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>