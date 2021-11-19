<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '150';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '150';

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