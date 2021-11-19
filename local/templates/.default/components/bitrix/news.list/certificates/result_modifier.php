<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '130';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '185';

$flgHasSection = false;
if($arParams["DISPLAY_PICTURE"] != "N"){
	foreach ($arResult['ITEMS'] as $key => $arElement)
	{
		if(intval($arElement['~DETAIL_PICTURE']) > 0)
		{
			$arResult['ITEMS'][$key]['PREVIEW_IMG'] = dbResize(array(
                    'FILE_ID' =>  $arElement['~DETAIL_PICTURE'],
                    'TYPE_IMG_THUMB' => $arParams['TYPE_IMG_THUMB'],
                    'WIDTH' => $arParams['DISPLAY_IMG_WIDTH'],
                    'HEIGHT' => $arParams['DISPLAY_IMG_HEIGHT'],
                    'ALT' => $arElement['NAME'],
                    'TITLE' => $arElement['NAME']
                )
            );
		}
		if($arElement['IBLOCK_SECTION_ID'] && !$flgHasSection){
			$flgHasSection = true;
		}
		
		if($arElement["PROPERTIES"]["MORE_PHOTOS"]["VALUE"]){
			foreach($arElement["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $arPhoto){
				$arFileTmp_dop_img = CFile::ResizeImageGet(
						$arPhoto,
						array("width" => 1000, "height" => 1000),
						BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
						true, $arFilter
				);
				$arResult['ITEMS'][$key]['PREVIEW_IMG']["DOP_IMG"][$arPhoto]["IMG"] = array(
						'SRC' => $arFileTmp_dop_img["src"],
						'WIDTH' => $arFileTmp_dop_img["width"],
						'HEIGHT' => $arFileTmp_dop_img["height"],
				);
				$arResult['ITEMS'][$key]['PREVIEW_IMG']["DOP_IMG"][$arPhoto]["DESC"] = CFile::MakeFileArray($arPhoto,false,false);
			}
			
		}
		
	}
}
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
?>