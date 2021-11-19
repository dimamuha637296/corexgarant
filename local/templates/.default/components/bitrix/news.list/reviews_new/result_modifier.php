<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '150';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '150';

if(1){
	foreach ($arResult['ITEMS'] as $key => $arElement)
	{
		if(intval($arElement['~DETAIL_PICTURE']) > 0 && strlen($arParams["DISPLAY_IMG_HEIGHT"]) > 0 && strlen($arParams["DISPLAY_IMG_WIDTH"]) > 0)
		{
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = dbResize(array(
                    'FILE_ID' =>  $arElement['~DETAIL_PICTURE'],
                    'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
                    'WIDTH' => $arParams['DISPLAY_IMG_WIDTH'],
                    'HEIGHT' => $arParams['DISPLAY_IMG_HEIGHT'],
                    'ALT' => $arElement['NAME'],
                    'TITLE' => $arElement['NAME']
                )
            );
		}
		
		if(isset($arElement['PROPERTIES']['MORE_FILES']['VALUE']) && count($arElement['PROPERTIES']['MORE_FILES']['VALUE']) > 0){
			$arResult['ITEMS'][$key]["PROPERTIES_EXT"]['MORE_FILES'] = ADBIBlockElement::MORE_FILES($arElement['PROPERTIES']['MORE_FILES']);
		}
		if(isset($arElement['PROPERTIES']['MORE_PHOTOS']['VALUE']) && count($arElement['PROPERTIES']['MORE_PHOTOS']['VALUE']) > 0){
			$arElement['PROPERTIES']['MORE_PHOTOS']['ELEMENT_NAME'] = $arElement['NAME'];
			$arResult['ITEMS'][$key]["PROPERTIES_EXT"]['MORE_PHOTOS'] = ADBIBlockElement::MORE_PHOTOS($arElement['PROPERTIES']['MORE_PHOTOS']);
		}
		if(isset($arElement['PROPERTIES']['VIDEO']['VALUE'][0]) && is_array($arElement['PROPERTIES']['VIDEO']['VALUE'][0])){
			$arResult['ITEMS'][$key]["PROPERTIES_EXT"]['VIDEO'] = ADBIBlockElement::VIDEO($arElement['PROPERTIES']['VIDEO']);
		}
	}
}
?>