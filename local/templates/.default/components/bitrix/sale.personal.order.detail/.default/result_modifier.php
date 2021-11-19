<?
foreach($arResult["BASKET"] as $key => $arItem){
    $arId[] = $arItem["PRODUCT_ID"];
    $arRelate[$arItem["PRODUCT_ID"]] = $key;
}

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("ID" => $arId);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arProp = $ob->GetProperties();
    $arResult["URL"][$arFields["ID"]]= $arFields["DETAIL_PAGE_URL"];

    if(!empty($arParams['OFFERS_PROPS'])){
        foreach($arProp as $key => $prop){
            if(in_array($key, $arParams['OFFERS_PROPS'])){
                $arResult["BASKET"][$arRelate[$arFields["ID"]]]['PROPERTIES'][$key] = $prop;
            }
        }
    }
}


?>