<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$arTransParams = array(
    "MAP_HAS_CATEGORY_FILTER" => $arParams["MAP_HAS_CATEGORY_FILTER"],
    'MAP_WIDTH' => $arParams['MAP_WIDTH'],
    'MAP_HEIGHT' => $arParams['MAP_HEIGHT'],
    'MAPS_ICON_SRC' => $arParams['MAPS_ICON_SRC'],
    'MAPS_ICON_MAIN_WIDTH' => $arParams['MAPS_ICON_MAIN_WIDTH'],
    'MAPS_ICON_MAIN_HEIGHT' => $arParams['MAPS_ICON_MAIN_HEIGHT'],
    'MAPS_ICON_CLUSTER_SRC' => $arParams['MAPS_ICON_CLUSTER_SRC'],
    'MAPS_ICON_CLUSTER_WIDTH' => $arParams['MAPS_ICON_CLUSTER_WIDTH'],
    'MAPS_ICON_CLUSTER_HEIGHT' => $arParams['MAPS_ICON_CLUSTER_HEIGHT'],
    'MAPS_ICON_CLUSTER_BIG_SRC' => $arParams['MAPS_ICON_CLUSTER_BIG_SRC'],
    'MAPS_ICON_CLUSTER_BIG_WIDTH' => $arParams['MAPS_ICON_CLUSTER_BIG_WIDTH'],
    'MAPS_ICON_CLUSTER_BIG_HEIGHT' => $arParams['MAPS_ICON_CLUSTER_BIG_HEIGHT'],
);
?>

<div class="map">
    <div class="map__map" id="map" style="height: <?echo $arParams['MAP_HEIGHT'];?>px; width: <?echo $arParams['MAP_WIDTH']?>"></div>
    <div class="map__msg"><?=GetMessage("DB_MSG_NO_POINTS")?></div>
</div>

<script type="text/javascript">
    'use strict';
    var WS_MAP = WS_MAP || {};
    WS_MAP.points = <?=json_encode($arResult['PLACEMARKS'])?>;
    WS_MAP.param = <?=json_encode($arTransParams)?>;
</script>