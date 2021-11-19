<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** Categories **/
/*
$arSelect = Array('ID', 'NAME', 'IBLOCK_ID',  'DETAIL_PICTURE', 'XML_ID', 'PROPERTY_*');
$arFilter = Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "SECTION_ID" =>$arResult['ID'], "ACTIVE"=>"Y");
$res = CIBlockSection::GetList(Array('SORT' => 'asc'), $arFilter, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arButtons = CIBlock::GetPanelButtons(
        $arFields["IBLOCK_ID"],
        $arFields["ID"],
        0,
        array("SECTION_BUTTONS"=>false, "SESSID"=>false)
    );
    $arFields["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];
    $arFields["DELETE_LINK"] = $arButtons["edit"]["delete_section"]["ACTION_URL"];
    $arResult['DEALERS_CATEGORIES'][$arFields["ID"]] = $arFields;
}


if(is_array($arResult['DEALERS_CATEGORIES']) && is_array($arResult['ITEMS'])) {
    foreach ($arResult['DEALERS_CATEGORIES'] as $arCat){
        foreach ($arResult['ITEMS'] as $key => $arItem) {
            if ($arItem['~IBLOCK_SECTION_ID'] == $arCat['ID']) {
                if(is_array($arItem['PROPERTIES']['COACH']["VALUE"])){
                    foreach($arItem['PROPERTIES']['COACH']["VALUE"] as $arCoach){
                        if(!empty($arCoach)){
                            $arResult['DEALERS_CATEGORIES'][$arCat['ID']]['HAS_COACH'] = true;
                            break;
                        }
                    }
                }else{
                    if(!empty($arItem['PROPERTIES']['COACH']["VALUE"])){
                        $arResult['DEALERS_CATEGORIES'][$arCat['ID']]['HAS_COACH'] = true;
                    }
                }

                $arResult['DEALERS_CATEGORIES'][$arCat['ID']]['ITEMS'][] = $arItem;
            }
        }
    }
}


pr($arResult["ITEMS"])
*/
?>