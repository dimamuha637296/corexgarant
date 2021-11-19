<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '180';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '200';

$flgHasSection = false;
foreach ($arResult['ITEMS'] as $key => $arElement){
		if($arElement['PROPERTIES']['TOP']['VALUE_XML_ID'] == "Y"){
			$width = '200';
			$height = '320';
		}else{
			$width = $arParams["DISPLAY_IMG_WIDTH"];
			$height = $arParams["DISPLAY_IMG_HEIGHT"];

		}

	$arResult['ITEMS'][$key]['PREVIEW_IMG'] = dbResize(array(
            'FILE_ID' =>  $arElement['~DETAIL_PICTURE'],
            'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
            'WIDTH' => $width,
            'HEIGHT' => $height,
            'ALT' => $arElement['NAME'],
            'TITLE' => $arElement['NAME']
        )
    );
}
?>