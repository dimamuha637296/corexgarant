<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(is_array($arResult["SECTIONS"]) && count($arResult["SECTIONS"])>0){
	
	$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);
	
	switch ($arParams["TYPE_IMG_THUMB"]){
		case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
		default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL;
	}
	
	
	$arParams["DISPLAY_SECTION_IMG_WIDTH"] = isset($arParams["DISPLAY_SECTION_IMG_WIDTH"]) ? intval($arParams["DISPLAY_SECTION_IMG_WIDTH"]) : '720';
	$arParams["DISPLAY_SECTION_IMG_HEIGHT"] = isset($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) : '460';

	foreach($arResult["SECTIONS"] as $num  => $arSect){
			if($arSect["~DETAIL_PICTURE"]){
				$arResult["SECTIONS"][$num]["PREVIEW_IMG"] = CFile::ResizeImageGet(
					$arSect["~DETAIL_PICTURE"],
					array("width" => $arParams["DISPLAY_SECTION_IMG_WIDTH"], "height" => $arParams["DISPLAY_SECTION_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true
				);

			}


	}

}


?>