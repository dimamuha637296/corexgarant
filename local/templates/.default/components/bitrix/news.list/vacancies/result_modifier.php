<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult['SECTIONS'] = array();
$arResult['SECTIONS'][0] = array();
if(count($arResult['ITEMS']) > 0)
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