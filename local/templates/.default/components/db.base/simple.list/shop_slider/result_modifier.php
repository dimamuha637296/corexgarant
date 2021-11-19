<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT;
}

$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '1555';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '742';

$arFilter = '';
if($arParams["SHARPEN"] != 0)
{
	$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
}
if(count($arResult['ITEMS']) > 0){
	foreach ($arResult['ITEMS'] as $key => $arElement)
	{
		if(intval($arElement['~DETAIL_PICTURE']) > 0)
		{
			$arFileTmp = CFile::ResizeImageGet(
					$arElement['~DETAIL_PICTURE'],
					array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true, $arFilter
			);
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp["src"],
					'WIDTH' => $arFileTmp["width"],
					'HEIGHT' => $arFileTmp["height"],
			);
		}
	}
} 


?>