<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["SECTIONS"]) < 1){
        return false;
}

/** From Depth to Tree View**/
foreach($arResult["SECTIONS"] as $key => $arSection){
    if(intval($arSection["IBLOCK_SECTION_ID"]) >0 && $arSection["DEPTH_LEVEL"] == 2) {
        foreach ($arResult["SECTIONS"] as $subKey => $subSect) {
            if ($arSection["IBLOCK_SECTION_ID"] == $subSect['ID']) {
                $arResult["SECTIONS"][$subKey]['SUB_SECTION'][] = $arSection;
                unset($arResult["SECTIONS"][$key]);
                break;
            }
        }
    }
}

?>

