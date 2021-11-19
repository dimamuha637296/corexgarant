<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

if(strlen($arParams["TYPE_IMG_THUMB"])<=0){
	$arParams["TYPE_IMG_THUMB"] = "BX_RESIZE_IMAGE_EXACT";
}

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
}


$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_LIST_IMG_WIDTH"]) ? intval($arParams["DISPLAY_LIST_IMG_WIDTH"]) : '200';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_LIST_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_LIST_IMG_HEIGHT"]) : '200';

$arFilter = '';
if($arParams["SHARPEN"] != 0)
{
	$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
}

if( strlen($arParams["DISPLAY_IMG_HEIGHT"]) > 0 && strlen($arParams["DISPLAY_IMG_WIDTH"]) > 0){
	foreach ($arResult['SECTIONS'] as $key => $arElement)
	{
		if(intval($arElement['PICTURE']) > 0)
		{
			$arFileTmp_small = CFile::ResizeImageGet(
					$arElement['PICTURE'],
					array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true, $arFilter
			);
			$arResult['SECTIONS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp_small["src"],
					'WIDTH' => $arFileTmp_small["width"],
					'HEIGHT' => $arFileTmp_small["height"],
			);
		}
	}
}
?>
