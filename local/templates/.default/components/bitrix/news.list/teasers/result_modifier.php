<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '44';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '44';

foreach ($arResult['ITEMS'] as $key => $arItem) {
    $arResult['ITEMS'][$key]['PREVIEW_IMG'] = dbResize(array(
            'FILE_ID' =>  $arItem['~PREVIEW_PICTURE'],
            'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
            'WIDTH' => $arParams['DISPLAY_IMG_WIDTH'],
            'HEIGHT' => $arParams['DISPLAY_IMG_HEIGHT'],
            'ALT' => $arItem['NAME'],
            'TITLE' => $arItem['NAME']
        )
    );
}