<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT;
}


$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '150';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '70';

$arFilter = '';
if($arParams["SHARPEN"] != 0)
{
	$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
}

if( strlen($arParams["DISPLAY_IMG_HEIGHT"]) > 0 && strlen($arParams["DISPLAY_IMG_WIDTH"]) > 0){
	foreach ($arResult['ITEMS'] as $key => $arElement)
	{
		if(intval($arElement['~PREVIEW_PICTURE']) > 0)
		{
			$arFileTmp_small = CFile::ResizeImageGet(
					$arElement['~PREVIEW_PICTURE'],
					array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true, $arFilter
			);
			if($arElement['PREVIEW_PICTURE']["DESCRIPTION"]){
				$elemAlt = $arElement['PREVIEW_PICTURE']["DESCRIPTION"];
			}else{
				$elemAlt = $arElement["NAME"];
			}
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp_small["src"],
					'WIDTH' => $arFileTmp_small["width"],
					'HEIGHT' => $arFileTmp_small["height"],
					'ALT' => $elemAlt,
			);
		}elseif(intval($arElement['~DETAIL_PICTURE']) > 0 && $arElement['PROPERTIES']['DETAIL_PICTURE_IMG']['VALUE'])
		{
			$arFileTmp_small = CFile::ResizeImageGet(
					$arElement['~DETAIL_PICTURE'],
					array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true, $arFilter
			);
			if($arElement['DETAIL_PICTURE']["DESCRIPTION"]){
				$elemAlt = $arElement['DETAIL_PICTURE']["DESCRIPTION"];
			}else{
				$elemAlt = $arElement["NAME"];
			}
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp_small["src"],
					'WIDTH' => $arFileTmp_small["width"],
					'HEIGHT' => $arFileTmp_small["height"],
					'ALT' => $elemAlt,
			);
		}
	}
	//pr($arResult['ITEMS']);
}
?>
