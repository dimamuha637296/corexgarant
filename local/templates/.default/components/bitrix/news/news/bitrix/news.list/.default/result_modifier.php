<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(count($arResult['ITEMS']) > 0 && $arParams["DISPLAY_SECTION_NAME"] == 'Y')
{
  $arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y');
  $arSelect = Array('ID', 'NAME', 'SECTION_PAGE_URL');
  $rsSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true, $arSelect);
	while ($arSect = $rsSect->GetNext())
   {
       $arResult['SECTION_INFO'][$arSect['ID']]['NAME'] = $arSect['NAME'];
       $arResult['SECTION_INFO'][$arSect['ID']]['SECTION_PAGE_URL'] = $arSect['SECTION_PAGE_URL'];
   }
}
////RESIZE/////
if($arParams["DISPLAY_PICTURE_FULL_WIDTH"] != 'Y' && $arParams["DISPLAY_PICTURE"]!="N"){

	$arParams["DISPLAY_LIST_IMG_WIDTH"] = isset($arParams["DISPLAY_LIST_IMG_WIDTH"]) ? intval($arParams["DISPLAY_LIST_IMG_WIDTH"]) : '400';
	$arParams["DISPLAY_LIST_IMG_HEIGHT"] = isset($arParams["DISPLAY_LIST_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_LIST_IMG_HEIGHT"]) : '180';

	foreach ($arResult['ITEMS'] as $key => $arItem)
	{
		if(intval($arItem['~PREVIEW_PICTURE']) > 0)
		{
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = dbResize(array(
					'FILE_ID' =>  $arItem['~PREVIEW_PICTURE'],
					'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
					'WIDTH' => $arParams['DISPLAY_LIST_IMG_WIDTH'],
					'HEIGHT' => $arParams['DISPLAY_LIST_IMG_HEIGHT'],
					'ALT' => $arItem['NAME'],
					'TITLE' => $arItem['NAME']
				)
			);
		}elseif(intval($arElement['~DETAIL_PICTURE']) > 0 && $arItem['PROPERTIES']['DETAIL_PICTURE_IMG']['VALUE'])
		{
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = dbResize(array(
					'FILE_ID' =>  $arItem['~DETAIL_PICTURE'],
					'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
					'WIDTH' => $arParams['DISPLAY_LIST_IMG_WIDTH'],
					'HEIGHT' => $arParams['DISPLAY_LIST_IMG_HEIGHT'],
					'ALT' => $arItem['NAME'],
					'TITLE' => $arItem['NAME']
				)
			);
		}
	}
}
?>
