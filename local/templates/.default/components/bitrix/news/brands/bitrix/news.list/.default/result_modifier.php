<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
}


$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '200';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '70';

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
					array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true, $arFilter
			);
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp_small["src"],
					'WIDTH' => $arFileTmp_small["width"],
					'HEIGHT' => $arFileTmp_small["height"],
			);
		}
		if($arElement['IBLOCK_SECTION_ID'] && !$flgHasSection){
			$flgHasSection = true;
		}
		
	}
}
//pr($arResult["ITEMS"]);

$arResult['SECTIONS'] = array();
$arResult['SECTIONS'][0] = array();
if(count($arResult['ITEMS']) > 0 && $flgHasSection)
{
	$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y');
	$arSelect = Array('ID', 'NAME', 'DESCRIPTION');
	$rsSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true, $arSelect);
	while ($arSect = $rsSect->GetNext())
	{
		$arResult['SECTIONS'][$arSect['ID']]['NAME'] = $arSect['NAME'];
		$arResult['SECTIONS'][$arSect['ID']]['DESCRIPTION'] = $arSect['DESCRIPTION'];
	}
}

if(count($arResult['ITEMS']) > 0)
{
	foreach ($arResult['ITEMS'] as $key => $arElement){
		if($arElement['IBLOCK_SECTION_ID']){
			$arResult['SECTIONS'][$arElement['IBLOCK_SECTION_ID']]['ITEMS'][] = $arElement;
		}else{
			$arResult['SECTIONS'][0]['ITEMS'][] = $arElement;
		}
	}
	if(empty($arResult['SECTIONS'][0])){
		unset($arResult['SECTIONS'][0]);
	}
}
//pr($arResult);
?>