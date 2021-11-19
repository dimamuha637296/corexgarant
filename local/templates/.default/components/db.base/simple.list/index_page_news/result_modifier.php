<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



/*
если используется несколько ИБ
if(is_array($arResult['ITEMS']) && count($arResult['ITEMS'])>0){
	foreach ($arResult['ITEMS'] as $key => $arElement){
		$arResult["ID_IBLOCK"][] = $arElement["IBLOCK_ID"];
	}
	$res = CIBlock::GetList(
		Array(),
		Array(
			'ID'=> $arResult["ID_IBLOCK"],
			'ACTIVE'=>'Y',
		), true
	);
	while($ar_res = $res->Fetch())
	{
		$arResult["SECTION_INFO"][$ar_res['ID']]['NAME'] = $ar_res['NAME'];
		$arResult["SECTION_INFO"][$ar_res['ID']]['LIST_PAGE_URL'] = $ar_res['LIST_PAGE_URL'];
	}
}
*/

$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE'=>'Y');
$arSelect = Array('ID', 'NAME', 'SECTION_PAGE_URL');
$rsSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true, $arSelect);
while ($arSect = $rsSect->GetNext())
{
	$arResult['SECTION_INFO'][$arSect['ID']]['NAME'] = $arSect['NAME'];
	$arResult['SECTION_INFO'][$arSect['ID']]['SECTION_PAGE_URL'] = $arSect['SECTION_PAGE_URL'];
}


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
