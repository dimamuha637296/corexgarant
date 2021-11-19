<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(is_array($arResult["SECTIONS"]) && count($arResult["SECTIONS"])>0){
	if($arParams["DISPLAY_SECTION_IMG"] == "Y"){
        $arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

        switch ($arParams["TYPE_IMG_THUMB"]){
            case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
            case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
            case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
            default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL;
        }


        $arParams["DISPLAY_SECTION_IMG_WIDTH"] = isset($arParams["DISPLAY_SECTION_IMG_WIDTH"]) ? intval($arParams["DISPLAY_SECTION_IMG_WIDTH"]) : '100';
        $arParams["DISPLAY_SECTION_IMG_HEIGHT"] = isset($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) : '100';

        $arFilter = '';
        if($arParams["SHARPEN"] != 0)
        {
            $arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
        }
    }

	
	foreach($arResult["SECTIONS"] as $arSect){

		if($arSect["DEPTH_LEVEL"] == 1){
            $arResult["NEW_SECTIONS"][$arSect["ID"]] = $arSect;
            if($arParams["DISPLAY_SECTION_IMG"] == "Y"){
                $arResult["NEW_SECTIONS"][$arSect["ID"]]["PREVIEW_IMG"] = CFile::ResizeImageGet(
                        $arSect["~PICTURE"],
                        array("width" => $arParams["DISPLAY_SECTION_IMG_WIDTH"], "height" => $arParams["DISPLAY_SECTION_IMG_HEIGHT"]),
                        $arParams["TYPE_IMG_THUMB"],
                        true
                );
            }
		}elseif($arSect["DEPTH_LEVEL"] == 2){
            $arResult["NEW_SECTIONS"][$arSect["IBLOCK_SECTION_ID"]]["SECTIONS"][$arSect["ID"]] = $arSect;
        }
	}
//	foreach($arResult["NEW_SECTIONS"] as $key => $arSect){
//		if($arSect["DEPTH_LEVEL"] == 2){
//			$arResult["NEW_SECTIONS"][$arSect["IBLOCK_SECTION_ID"]]["SECTIONS"][] = $arSect;
//			unset($arResult["NEW_SECTIONS"][$key]);
//		}
//	}
}

//pr($arResult["NEW_SECTIONS"])
?>