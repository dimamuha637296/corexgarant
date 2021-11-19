<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arParams["DISPLAY_PICTURE_FULL_WIDTH"] != 'Y' && $arParams["DISPLAY_DETAIL_PICTURE"] != "N"){

    $arParams["DISPLAY_DETAIL_IMG_WIDTH"] = isset($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) ? intval($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) : '600';
    $arParams["DISPLAY_DETAIL_IMG_HEIGHT"] = isset($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) : '400';

	if( strlen($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) > 0 && strlen($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) > 0){
		if(intval($arResult['~DETAIL_PICTURE']) > 0)
		{
			$arResult['PREVIEW_IMG'] = dbResize(array(
                    'FILE_ID' =>  $arResult['~DETAIL_PICTURE'],
                    'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
                    'WIDTH' => $arParams['DISPLAY_DETAIL_IMG_WIDTH'],
                    'HEIGHT' => $arParams['DISPLAY_DETAIL_IMG_HEIGHT'],
                    'ALT' => $arResult['NAME'],
					'TITLE' => $arResult['NAME']
                )
            );
		}
	}
}

if(count($arResult['PROPERTIES']['MORE_FILES']['VALUE']) > 0){
	$arResult['MORE_FILES'] = ADBIBlockElement::MORE_FILES($arResult['PROPERTIES']['MORE_FILES']);
}
if(isset($arResult['PROPERTIES']['VIDEO']['VALUE'][0]) && is_array($arResult['PROPERTIES']['VIDEO']['VALUE'][0])){
	$arResult['VIDEO'] = ADBIBlockElement::VIDEO($arResult['PROPERTIES']['VIDEO']);
}

?>