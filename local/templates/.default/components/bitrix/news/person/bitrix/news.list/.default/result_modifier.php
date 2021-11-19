<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
}


$arParams["DISPLAY_LIST_IMG_WIDTH"] = isset($arParams["DISPLAY_LIST_IMG_WIDTH"]) ? intval($arParams["DISPLAY_LIST_IMG_WIDTH"]) : '180';
$arParams["DISPLAY_LIST_IMG_HEIGHT"] = isset($arParams["DISPLAY_LIST_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_LIST_IMG_HEIGHT"]) : '200';

$arFilter = '';
if($arParams["SHARPEN"] != 0)
{
	$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
}

$flgHasSection = false;
if($arParams["DISPLAY_PICTURE"] != "N"){
	foreach ($arResult['ITEMS'] as $key => $arElement)
	{
		if(intval($arElement['~DETAIL_PICTURE']) > 0)
		{
			$arFileTmp_small = CFile::ResizeImageGet(
				$arElement['~DETAIL_PICTURE'],
				array("width" => $arParams["DISPLAY_LIST_IMG_WIDTH"], "height" => $arParams["DISPLAY_LIST_IMG_HEIGHT"]),
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
		if($arElement['IBLOCK_SECTION_ID'] && !$flgHasSection){
			$flgHasSection = true;
		}

	}
}
//pr($arResult["ITEMS"]);



//pr($arResult);
?>