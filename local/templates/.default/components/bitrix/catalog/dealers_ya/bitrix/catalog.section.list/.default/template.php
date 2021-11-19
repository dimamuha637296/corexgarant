<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if($arResult["SECTION"] != 0){
	$arParams['MAP_DATA'] = array(
			'google_lat' => strlen($arResult["SECTION"]['UF_GOOGLE_LAT']) > 0 ? $arResult["SECTION"]['UF_GOOGLE_LAT'] : '53.908788',
			'google_lon' => strlen($arResult["SECTION"]['UF_GOOGLE_LON']) > 0 ? $arResult["SECTION"]['UF_GOOGLE_LON'] : '29.508714',
			'google_scale' => strlen($arResult["SECTION"]['UF_GOOGLE_SCALE']) > 0 ? $arResult["SECTION"]['UF_GOOGLE_SCALE'] : '6',
			'PLACEMARKS' => array(),
	);
	$arParams['MAP_DATA'] = serialize($arParams['MAP_DATA']);
}
?>

<div class="b-map" id="map">
<div class="b-index-map-info b-map-info _hide" id="map-info-to-show"></div>
	<?$APPLICATION->IncludeComponent("bitrix:map.google.view", "dealers", array(
		"INIT_MAP_TYPE" => $arParams["INIT_MAP_TYPE"],
		"MAP_DATA" => $arParams['MAP_DATA'],
		"MAP_WIDTH" => $arParams["MAP_WIDTH"],
		"MAP_HEIGHT" => $arParams["MAP_HEIGHT"],
		"CONTROLS" => $arParams["CONTROLS"],
		"MAPS_ICON" => $arParams["MAPS_ICON"],
		"OPTIONS" => $arParams["OPTIONS"],
		"MAP_ID" => "google_map_main_page"
		),
		$component->GetParent(),
		array(
		"HIDE_ICONS" => "N",
		"ACTIVE_COMPONENT" => "Y"
		)
	);
?>
</div>

<?/*/?><pre><?var_dump($arParams['MAP_DATA'])?></pre><?//*/?>