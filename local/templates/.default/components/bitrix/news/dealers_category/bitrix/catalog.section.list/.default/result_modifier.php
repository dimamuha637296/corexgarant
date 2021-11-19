<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**TREE VIEW*/
foreach($arResult["SECTIONS"] as $key => $arSection){
    if($arSection['DEPTH_LEVEL'] == 1){
        $arResult['SECTIONS_TREE'][$arSection['ID']] = $arSection;
        $arResult['SECTIONS_RELATIONS'][$arSection['ID']]= $arSection['CODE'];
    }elseif($arSection['DEPTH_LEVEL'] == 2){
        $arResult['SECTIONS_TREE'][$arSection['IBLOCK_SECTION_ID']]['SUBSECTIONS'][] = $arSection;
        $arResult['SECTIONS_RELATIONS'][$arSection['ID']]= $arSection['CODE'];
        $arResult['SECTIONS_PARENTS'][$arSection['ID']]= $arSection['IBLOCK_SECTION_ID'];
    }

    if($arSection['CODE'] == $arParams['CUR_SECTION_CODE']){
        if($arSection['DEPTH_LEVEL'] == 1){
            $arParams['PARENT_SECTION'] = $arSection['ID'];
            $arParams['CUR_DEPTH'] = 1;
            $parent = $arSection['ID'];
            $curSectId[$arSection['ID']] = $arSection['ID'];
        }else{
            $arParams['PARENT_SECTION'] = $arSection['IBLOCK_SECTION_ID'];
            $arParams['CUR_DEPTH'] = 2;
            $parent = false;
            $curSectId[$arSection['ID']] = $arSection['ID'];
        }
    }
}
if($parent && $arResult['SECTIONS_PARENTS']){
    foreach($arResult['SECTIONS_PARENTS'] as $key => $val){
        if($val == $parent){
            $curSectId[$key] = $key;
        }
    }
}

$arResult['SECTIONS_RELATIONS'] = array_flip($arResult['SECTIONS_RELATIONS']);

if(!CModule::IncludeModule("iblock"))
    return;

/**SHOP CATEGORIES**/
$arSelect = Array('ID', 'NAME', 'EXTERNAL_ID', 'PROPERTY_CATEGORY_CLASS');
$arFilter = Array("IBLOCK_ID"=> $arParams['IBLOCK_CATEGORIES'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array('SORT' => 'asc'), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext()) {
    $arResult['FILTER'][$ob['EXTERNAL_ID']] = array('CLASS' => $ob['PROPERTY_CATEGORY_CLASS_VALUE'], 'NAME' => $ob['NAME']);
}

/**SHOPS**/
$arSelect = Array('ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_CATEGORY_ATTACH');
$arFilter = Array("IBLOCK_ID"=> $arParams['IBLOCK_ID'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array('SORT' => 'asc'), $arFilter, false, false, $arSelect);
while($ob = $res->GetNext()) {
    if(array_key_exists($ob['PROPERTY_CATEGORY_ATTACH_VALUE'], $arResult['FILTER']) && (array_key_exists($ob['IBLOCK_SECTION_ID'], $curSectId) || empty($curSectId))){
        $arResult['FILTER'][$ob['PROPERTY_CATEGORY_ATTACH_VALUE']]['ITEMS'][$ob['ID']] = $ob['ID'];
    }
}


?>
