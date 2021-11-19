<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//// проверка на урл элемента(что бы элемент открывался только по одному урлу)
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID"], "IBLOCK_SECTION_ID" => $arResult["ID"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arFields= $res->GetNext())
{
    $arResult["URL"][$arFields["ID"]]= $arFields["DETAIL_PAGE_URL"];
}


/// resize
if($arParams["DISPLAY_PICTURE"]!="N"){
   // $arParams["TYPE_IMG_THUMB_LIST"] = trim($arParams["TYPE_IMG_THUMB"]);
    switch ($arParams["TYPE_IMG_THUMB_LIST"]){
        case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_EXACT; break;
        case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
        case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
        default: $arParams["TYPE_IMG_THUMB_LIST"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
    }


    $arParams["BLOCK_IMG_WIDTH"] = isset($arParams["BLOCK_IMG_WIDTH"]) ? intval($arParams["BLOCK_IMG_WIDTH"]) : '50';
    $arParams["BLOCK_IMG_HEIGHT"] = isset($arParams["BLOCK_IMG_HEIGHT"]) ? intval($arParams["BLOCK_IMG_HEIGHT"]) : '150';

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



?>