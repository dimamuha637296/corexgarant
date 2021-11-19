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
	$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

	switch ($arParams["TYPE_IMG_THUMB"]){
		case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
		default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL;
	}


	$arParams["DISPLAY_LIST_IMG_WIDTH"] = isset($arParams["DISPLAY_LIST_IMG_WIDTH"]) ? intval($arParams["DISPLAY_LIST_IMG_WIDTH"]) : '400';
	$arParams["DISPLAY_LIST_IMG_HEIGHT"] = isset($arParams["DISPLAY_LIST_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_LIST_IMG_HEIGHT"]) : '180';

	$arFilter = '';
	if($arParams["SHARPEN"] != 0)
	{
		$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
	}

	foreach ($arResult['ITEMS'] as $key => $arElement)
	{
		if(intval($arElement['~PREVIEW_PICTURE']) > 0)
		{
			$arFileTmp_small = CFile::ResizeImageGet(
					$arElement['~PREVIEW_PICTURE'],
					array("width" => $arParams["DISPLAY_LIST_IMG_WIDTH"], "height" => $arParams["DISPLAY_LIST_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true, $arFilter
			);
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp_small["src"],
					'WIDTH' => $arFileTmp_small["width"],
					'HEIGHT' => $arFileTmp_small["height"],
					'ALT' => $arElement['PREVIEW_PICTURE']["ALT"],
					'TITLE' => $arElement['PREVIEW_PICTURE']["TITLE"],
			);
		}elseif(intval($arElement['~DETAIL_PICTURE']) > 0 && $arElement['PROPERTIES']['DETAIL_PICTURE_IMG']['VALUE'])
		{
			$arFileTmp_small = CFile::ResizeImageGet(
					$arElement['~DETAIL_PICTURE'],
					array("width" => $arParams["DISPLAY_LIST_IMG_WIDTH"], "height" => $arParams["DISPLAY_LIST_IMG_HEIGHT"]),
					$arParams["TYPE_IMG_THUMB"],
					true, $arFilter
			);
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arFileTmp_small["src"],
					'WIDTH' => $arFileTmp_small["width"],
					'HEIGHT' => $arFileTmp_small["height"],
					'ALT' => $arElement['DETAIL_PICTURE']["ALT"],
					'TITLE' => $arElement['DETAIL_PICTURE']["TITLE"],
			);
		}
	}
}else{
	foreach ($arResult['ITEMS'] as $key => $arElement)
	{
		if(intval($arElement['~PREVIEW_PICTURE']) > 0)
		{
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arElement['PREVIEW_PICTURE']["SRC"],
					'ALT' => $arElement['PREVIEW_PICTURE']["ALT"],
					'TITLE' => $arElement['PREVIEW_PICTURE']["TITLE"],
					'ALT' => $arElement['DETAIL_PICTURE']["ALT"],
					'TITLE' => $arElement['DETAIL_PICTURE']["TITLE"],
			);
		}
		elseif(intval($arElement['~DETAIL_PICTURE']) > 0 && $arElement['PROPERTIES']['DETAIL_PICTURE_IMG']['VALUE'])
		{
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
					'SRC' => $arElement['DETAIL_PICTURE']["SRC"],
					'ALT' => $arElement['DETAIL_PICTURE']["ALT"],
					'TITLE' => $arElement['DETAIL_PICTURE']["TITLE"],
					'ALT' => $arElement['DETAIL_PICTURE']["ALT"],
					'TITLE' => $arElement['DETAIL_PICTURE']["TITLE"],
			);
		}
	}
}



?>
