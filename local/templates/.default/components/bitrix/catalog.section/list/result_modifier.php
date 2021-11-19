<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//// проверка на урл элемента(что бы элемент открывался только по одному урлу)
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID"], "IBLOCK_SECTION_ID" => $arResult["ID"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arResult["URL"][$arFields["ID"]]= $arFields["DETAIL_PAGE_URL"];
}


/// resize
if($arParams["DISPLAY_PICTURE"]!="N"){
    switch ($arParams["TYPE_IMG_THUMB_LIST"]){
        case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_EXACT; break;
        case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
        case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
        default: $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
    }

    $arParams["LIST_IMG_WIDTH"] = isset($arParams["LIST_IMG_WIDTH"]) ? intval($arParams["LIST_IMG_WIDTH"]) : '210';
    $arParams["LIST_IMG_WIDTH"] = isset($arParams["LIST_IMG_WIDTH"]) ? intval($arParams["LIST_IMG_WIDTH"]) : '400';

    foreach ($arResult['ITEMS'] as $key => $arElement)
    {
        if(intval($arElement['~DETAIL_PICTURE']) > 0)
        {
            $arFileTmp_small = CFile::ResizeImageGet(
                $arElement['~DETAIL_PICTURE'],
                array("width" => $arParams["BLOCK_IMG_WIDTH"], "height" => $arParams["BLOCK_IMG_HEIGHT"]),
                $arParams["TYPE_IMG_THUMB_LIST"],
                true, array()
            );
            if($arElement['DETAIL_PICTURE']['DESCRIPTION']){
                $alt = $arElement['DETAIL_PICTURE']["DESCRIPTION"];
            }else{
                $alt = $arElement['DETAIL_PICTURE']["ALT"];
            }
            $arResult['ITEMS'][$key]['PREVIEW_IMG'] = array(
                'SRC' => $arFileTmp_small["src"],
                'WIDTH' => $arFileTmp_small["width"],
                'HEIGHT' => $arFileTmp_small["height"],
                'ALT' => $alt,
                'TITLE' => $alt,
            );
        }
    }
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
/// component_epilog

$cp = $this->__component;
if (is_object($cp))
{
    $cp->SetResultCacheKeys(array("NAV_INFO"));
}



?>