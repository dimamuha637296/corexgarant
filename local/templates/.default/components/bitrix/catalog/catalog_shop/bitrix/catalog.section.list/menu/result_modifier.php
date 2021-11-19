<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(is_array($arResult["SECTIONS"]) && count($arResult["SECTIONS"])>0){
	
	$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);
	
	switch ($arParams["TYPE_IMG_THUMB"]){
		case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
		default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL;
	}
	
	
	$arParams["DISPLAY_SECTION_IMG_WIDTH"] = isset($arParams["DISPLAY_SECTION_IMG_WIDTH"]) ? intval($arParams["DISPLAY_SECTION_IMG_WIDTH"]) : '130';
	$arParams["DISPLAY_SECTION_IMG_HEIGHT"] = isset($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) : '130';

	foreach($arResult["SECTIONS"] as $num => $arSect){
		foreach($arResult["SECTIONS"] as $arSect){
			$arResult["NEW_SECTIONS"][$arSect["ID"]] = $arSect;
		}
	}

	//*
	foreach($arResult["NEW_SECTIONS"] as $key => $arSect){
		if($arSect["DEPTH_LEVEL"] && array_key_exists($arSect["IBLOCK_SECTION_ID"], $arResult["NEW_SECTIONS"])){
			$arResult["NEW_SECTIONS"][$arSect["IBLOCK_SECTION_ID"]]["SECTIONS"][] = $arSect;
			unset($arResult["NEW_SECTIONS"][$key]);
			$arResult["MAX_DEPTH_LEVEL"] = $arSect["DEPTH_LEVEL"];
		}
	}
	unset($arResult["SECTIONS"]);
//*/
}

//pr($arResult["NEW_SECTIONS"])
?>