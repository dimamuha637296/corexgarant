<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!CModule::IncludeModule("iblock"))
    return;
/**SHOP CATEGORIES**/
$arSelect = Array('ID', 'NAME', 'EXTERNAL_ID', 'PROPERTY_MARKER_DEFAULT', 'PROPERTY_MARKER_ACTIVE');
$arFilter = Array("IBLOCK_ID"=> $arParams['IBLOCK_CATEGORIES'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array('SORT' => 'asc'), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext()) {
    if($ob['PROPERTY_MARKER_DEFAULT_VALUE']){
        $arShopCategories[$ob['EXTERNAL_ID']]['marker_default'] = CFile::GetFileArray($ob['PROPERTY_MARKER_DEFAULT_VALUE']);
    }
    if($ob['PROPERTY_MARKER_ACTIVE_VALUE']){
        $arShopCategories[$ob['EXTERNAL_ID']]['marker_active'] = CFile::GetFileArray($ob['PROPERTY_MARKER_ACTIVE_VALUE']);
    }
    $arShopCategories[$ob['EXTERNAL_ID']]['NAME'] = $ob['NAME'];
}


/**SHOPS**/
$arSelect = Array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_*', 'IBLOCK_SECTION_ID');
$arFilter = Array("IBLOCK_ID"=> $arParams['IBLOCK_ID'], "ACTIVE"=>"Y");
if(strlen($arParams['CUR_SECTION_CODE']) > 1){
    $arFilter['SECTION_CODE'] = $arParams['CUR_SECTION_CODE'];
    $arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
}
$res = CIBlockElement::GetList(Array('SORT' => 'asc'), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
//    if($arProps['CATEGORY_ATTACH']['VALUE']){
        $tempArr = array();
        $tempArr['id'] = $arFields['ID'];
        $tempArr['filter_id'] = 'ex_'.$arProps['CATEGORY_ATTACH']['VALUE'];

        $tempArr['marker'] = $arShopCategories[$arProps['CATEGORY_ATTACH']['VALUE']]['marker_default']['SRC'];
        $gPos = explode(',', $arProps['LAN_LAT']['VALUE']);
        if(is_array($gPos) && count($gPos) > 1){
            $tempArr['lat'] = $gPos[0];
            $tempArr['lon'] = $gPos[1];
        }

        $tempArr['name'] = $arFields['NAME'];
        if($arProps['ADRESS']['VALUE']){
            $tempArr['address'] = $arProps['ADRESS']['VALUE'];
        }
//    } else {
//        continue;
//    }
    $arResult['PLACEMARKS'][$arFields['ID']] = $tempArr;
}

?>
