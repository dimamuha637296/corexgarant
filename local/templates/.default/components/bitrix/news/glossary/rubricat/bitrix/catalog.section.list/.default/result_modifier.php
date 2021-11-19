<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);
if(strlen($arParams["TYPE_IMG_THUMB"])<=0){
	$arParams["TYPE_IMG_THUMB"]="BX_RESIZE_IMAGE_EXACT";
}

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT;
}

foreach ($arResult['SECTIONS'] as $key => $arElement)
{
	if(is_array($arElement["PICTURE"]))
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
		}
		
		$arFileTmp = CFile::ResizeImageGet(
			$arElement['PICTURE'],
			array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
			$arParams["TYPE_IMG_THUMB"],
			true, $arFilter
		);

		$arResult['SECTIONS'][$key]['PICTURE_PREVIEW'] = array(
			'SRC' => $arFileTmp["src"],
			'WIDTH' => $arFileTmp["width"],
			'HEIGHT' => $arFileTmp["height"],
		);
	}
}

?>