<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arFiltersProp = array();
if(count($arResult["PROPERTIES"]["FILTERS"]["VALUE"])>0){
    foreach($arResult["PROPERTIES"]["FILTERS"]["VALUE"] as $num => $arFilter){
        $arFiltersProp[] = array($arFilter => $arResult["PROPERTIES"]["FILTERS"]["DESCRIPTION"][$num]);
    }
}

$arFilterId= array(
    array("ID" => $arResult["PROPERTIES"]["ELEMENTS"]["VALUE"]), // filter ID item
    array("SECTION_ID" => $arResult["PROPERTIES"]["SECTIONS"]["VALUE"], "INCLUDE_SUBSECTIONS" =>"Y") // // filter ID section
);

$arFiltersIblock = Array(
    "IBLOCK_ID"=> $arParams["IBLOCK_ID_CATALOG"],
    "ACTIVE"=>"Y"
);

$filter =array_merge($arFiltersIblock, array(
        array_merge(array("LOGIC" => "OR"),$arFiltersProp,$arFilterId)
    )
);

$key=0;
$arResult["FILTER_TAGS"] = $filter;

$arSelect = Array("ID", "NAME","DETAIL_PAGE_URL");

$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $filter, false, false, $arSelect);
while($arFields = $res->GetNext())
{
    if($arFields){
        $key=$key+1;
    }
}


$arResult["COUNT_ITEM"] = $key;
$cp = $this->__component;   /// component_epilog
if (is_object($cp))
{
    $cp->SetResultCacheKeys(array(
        "PROPERTIES",
        "~PREVIEW_TEXT",
        "~DETAIL_TEXT",
        "FILTER_TAGS",
        "COUNT_ITEM"

    ));
}