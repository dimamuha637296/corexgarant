<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID"], "IBLOCK_SECTION_ID" => $arResult["ID"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
 $arFields = $ob->GetFields();
 $arResult["URL"][$arFields["ID"]]= $arFields["DETAIL_PAGE_URL"];
}


///// SEO_PAGEN

if(!$arResult["SECTION_PAGE_URL"] && $arParams["SEF_FOLDER"]){
	$arResult["SECTION_PAGE_URL"] = $arParams["SEF_FOLDER"];
}else{
	$arResult["SECTION_PAGE_URL"] = $GLOBALS['APPLICATION']->GetCurDir();
}
if($arResult["SECTION_PAGE_URL"]){
	$arResult['NAV_INFO']['CUR'] = $arResult['NAV_RESULT']->NavPageNomer;
	$arResult['NAV_INFO']['ALL'] = $arResult['NAV_RESULT']->NavPageCount;
	if($arResult['NAV_INFO']['CUR'] > 0 && $arResult['NAV_INFO']['CUR'] != $arResult['NAV_INFO']['ALL'] && $arResult['NAV_INFO']['ALL'] > 0){
		$arResult['NAV_INFO']['NEXT'] = $arResult['NAV_INFO']['CUR'] + 1;
	}

	if($arResult['NAV_INFO']['CUR'] > 1 && $arResult['NAV_INFO']['ALL'] > 0){
		$arResult['NAV_INFO']['PREV'] = $arResult['NAV_INFO']['CUR'] - 1;
	}

	$this->__component->SetResultCacheKeys(array("NAV_INFO", "SECTION_PAGE_URL"));
}

////COMPARE_CODE/////
foreach($arResult["ITEMS"] as $cell=>$arElement)
{
	$arResult["ITEMS"][$cell]["DELETE_COMPARE_URL"] = htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=DELETE_FROM_COMPARE_LIST&id=".$arElement["ID"], array("action", "id")));
}

$this->__component->arResult["IDS"] = array();
$this->__component->arResult["DELETE_COMPARE_URLS"] = array();

foreach ($arResult["ITEMS"] as $key => $arElement) 
{
	$this->__component->arResult["IDS"][] = $arElement["ID"];
	$this->__component->arResult["DELETE_COMPARE_URLS"][$arElement["ID"]] = $arElement["DELETE_COMPARE_URL"];
}

$this->__component->SetResultCacheKeys(array("IDS"));
$this->__component->SetResultCacheKeys(array("DELETE_COMPARE_URLS"));



?>