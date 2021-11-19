<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arFilter = Array('IBLOCK_ID'=> $arParams['IBLOCK_ID'], 'ID' => $arResult["ID"], 'GLOBAL_ACTIVE'=>'Y');
$arSelect = Array('ID', 'NAME', 'SECTION_PAGE_URL', 'DETAIL_PICTURE', 'UF_*');
$rsSect = CIBlockSection::GetList(Array("sort"=>"ascs"), $arFilter, true, $arSelect);
while ($arSect = $rsSect->GetNext())
{
	$arResult['SECTION_INFO']['UF_GOOGLE_SCALE'] = $arSect['UF_GOOGLE_SCALE'];
	$arResult['SECTION_INFO']['UF_GOOGLE_LON'] = $arSect['UF_GOOGLE_LON'];
	$arResult['SECTION_INFO']['UF_GOOGLE_LAT'] = $arSect['UF_GOOGLE_LAT'];
}
?>