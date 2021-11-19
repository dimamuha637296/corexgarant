<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arParams["DISPLAY_DETAIL_PICTURE"] != "N"){
	$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);
	
	switch ($arParams["TYPE_IMG_THUMB"]){
		case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
		default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
	}
	
	
	$arParams["DISPLAY_DETAIL_IMG_WIDTH"] = isset($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) ? intval($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) : '300';
	$arParams["DISPLAY_DETAIL_IMG_HEIGHT"] = isset($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) : '200';
	
	$arFilter = '';
	if($arParams["SHARPEN"] != 0)
	{
		$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
	}
	
	if( strlen($arParams["DISPLAY_DETAIL_IMG_HEIGHT"]) > 0 && strlen($arParams["DISPLAY_DETAIL_IMG_WIDTH"]) > 0){
		if(intval($arResult['~DETAIL_PICTURE']) > 0)
		{
			$arFileTmp = CFile::ResizeImageGet(
					$arResult['~DETAIL_PICTURE'],
					array("width" => $arParams["DISPLAY_DETAIL_IMG_WIDTH"], "height" => $arParams["DISPLAY_DETAIL_IMG_HEIGHT"]),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true, $arFilter
			);
			$arResult['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp["src"],
					'WIDTH' => $arFileTmp["width"],
					'HEIGHT' => $arFileTmp["height"],
					'ALT' => $arResult['DETAIL_PICTURE']["ALT"],
					'TITLE' => $arResult['DETAIL_PICTURE']["TITLE"],
			);
		}
	}
}else{
	if(intval($arResult['~DETAIL_PICTURE']) > 0)
	{
		$arResult['PREVIEW_IMG'] = array(
				'SRC' => $arResult['DETAIL_PICTURE']["SRC"],
				'ALT' => $arResult['DETAIL_PICTURE']["ALT"],
				'TITLE' => $arResult['DETAIL_PICTURE']["TITLE"],
		);
	}
}


?>