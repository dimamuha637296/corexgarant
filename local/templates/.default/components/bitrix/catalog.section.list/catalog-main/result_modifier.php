<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '69';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '69';

	foreach($arResult["SECTIONS"] as $arSect){
		$arResult["NEW_SECTIONS"][$arSect["ID"]] = $arSect;
		if($arSect["DEPTH_LEVEL"] == 1){
            $arResult["NEW_SECTIONS"][$arSect["ID"]]["PREVIEW_IMG"] = dbResize(array(
                    'FILE_ID' =>  $arSect["~PICTURE"],
                    'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
                    'WIDTH' => $arParams['DISPLAY_IMG_WIDTH'],
                    'HEIGHT' => $arParams['DISPLAY_IMG_HEIGHT'],
                    'ALT' => $arSect['NAME'],
                    'TITLE' => $arSect['NAME']
                )
			);
		}
	}
	foreach($arResult["NEW_SECTIONS"] as $key => $arSect){
		if($arSect["DEPTH_LEVEL"] == 2){
			$arResult["NEW_SECTIONS"][$arSect["IBLOCK_SECTION_ID"]]["SECTIONS"][] = $arSect;
			unset($arResult["NEW_SECTIONS"][$key]);
		}
	}
?>