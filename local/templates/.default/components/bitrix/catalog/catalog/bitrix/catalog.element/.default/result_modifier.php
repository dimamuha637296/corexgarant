<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();



$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

if(strlen($arParams["TYPE_IMG_THUMB"])<=0){
	$arParams["TYPE_IMG_THUMB"] = "BX_RESIZE_IMAGE_PROPORTIONAL_ALT";
}

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
}


$arParams["DETAIL_POPUP_IMG_WIDTH"] = isset($arParams["DETAIL_POPUP_IMG_WIDTH"]) ? intval($arParams["DETAIL_POPUP_IMG_WIDTH"]) : '1000';
$arParams["DETAIL_POPUP_IMG_HEIGHT"] = isset($arParams["DETAIL_POPUP_IMG_HEIGHT"]) ? intval($arParams["DETAIL_POPUP_IMG_HEIGHT"]) : '1000';
$arParams["DETAIL_BIG_IMG_WIDTH"] = isset($arParams["DETAIL_BIG_IMG_WIDTH"]) ? intval($arParams["DETAIL_BIG_IMG_WIDTH"]) : '500';
$arParams["DETAIL_BIG_IMG_HEIGHT"] = isset($arParams["DETAIL_BIG_IMG_HEIGHT"]) ? intval($arParams["DETAIL_BIG_IMG_HEIGHT"]) : '250';
$arParams["DETAIL_SMALL_IMG_WIDTH"] = isset($arParams["DETAIL_SMALL_IMG_WIDTH"]) ? intval($arParams["DETAIL_SMALL_IMG_WIDTH"]) : '60';
$arParams["DETAIL_SMALL_IMG_HEIGHT"] = isset($arParams["DETAIL_SMALL_IMG_HEIGHT"]) ? intval($arParams["DETAIL_SMALL_IMG_HEIGHT"]) : '60';
$arParams["DETAIL_BRAND_IMG_WIDTH"] = isset($arParams["DETAIL_BRAND_IMG_WIDTH"]) ? intval($arParams["DETAIL_BRAND_IMG_WIDTH"]) : '130';
$arParams["DETAIL_BRAND_IMG_HEIGHT"] = isset($arParams["DETAIL_BRAND_IMG_HEIGHT"]) ? intval($arParams["DETAIL_BRAND_IMG_HEIGHT"]) : '150';

$arFilter = '';
if($arParams["SHARPEN"] != 0)
{
	$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
}



if($arResult['DETAIL_PICTURE'] || $arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']){
	if($arResult['DETAIL_PICTURE']){
		if($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']){
			$detail_img = array($arResult['DETAIL_PICTURE']["ID"]);
			$arResult['PHOTOS'] = array_merge($detail_img, $arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']);
		}else{
			$arResult['PHOTOS'][] = $arResult['DETAIL_PICTURE']["ID"];
		}
	}elseif($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']){
		$arResult['PHOTOS'] = $arResult['PROPERTIES']['MORE_PHOTOS']['VALUE'];
	}

	if(is_array($arResult['PHOTOS'])){
		foreach($arResult['PHOTOS'] as $key => $arImg){
			$arResult['IMAGES'][$arImg]['IMG'] = CFile::ResizeImageGet(
				$arImg,
				array("width" => $arParams["DETAIL_BIG_IMG_WIDTH"], "height" => $arParams["DETAIL_BIG_IMG_HEIGHT"]),
				$arParams["TYPE_IMG_THUMB"],
				true, $arFilter
			);
			$arResult['IMAGES'][$arImg]['SMALL_IMG'] = CFile::ResizeImageGet(
				$arImg,
				array("width" => $arParams["DETAIL_SMALL_IMG_WIDTH"], "height" => $arParams["DETAIL_SMALL_IMG_HEIGHT"]),
				$arParams["TYPE_IMG_THUMB"],
				true, $arFilter
			);
			$arResult['IMAGES'][$arImg]['BIG_IMG'] = CFile::ResizeImageGet(
				$arImg,
				array("width" => $arParams["DETAIL_POPUP_IMG_WIDTH"], "height" => $arParams["DETAIL_POPUP_IMG_HEIGHT"]),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true, $arFilter
			);
			$arResult['IMAGES'][$arImg]['NAME'] = CFile::MakeFileArray($arImg, false ,false);
			if(empty($arResult['IMAGES'][$arImg]['NAME']['description'])){
				$arResult['IMAGES'][$arImg]['NAME']['description'] = $arResult["NAME"];
			}
		}

	}
}

if($arResult["PROPERTIES"]["BRAND"]["VALUE"]){  ///  BRAND
	$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["BRAND"]["LINK_IBLOCK_ID"], "ID" => $arResult["PROPERTIES"]["BRAND"]["VALUE"], "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($arFields = $res->GetNext())
	{
		$arResult["BRAND"] = $arFields;
		if($arFields["DETAIL_PICTURE"]){
			$arResult["BRAND"]["IMG"] = CFile::ResizeImageGet(
				$arFields["DETAIL_PICTURE"],
				array("width" => $arParams["DETAIL_BRAND_IMG_WIDTH"], "height" => $arParams["DETAIL_BRAND_IMG_HEIGHT"]),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true, $arFilter
			);
		}

	}
}


// CHARACTERISTICS

if(is_array($arParams['PROPERTY_CODE']) && count($arParams['PROPERTY_CODE']) > 0){
	$arResult['CHARACTERISTICS'] = array();
	$arResult['CHARACTERISTICS_COUNT'] = 0;
	if(is_array($arResult['PROPERTIES'])){
		foreach ($arResult['PROPERTIES']  as $arProp){
			if(!in_array($arProp['CODE'], $arParams['DETAIL_PROPERTY_NO_CHAR']) && strlen($arProp['VALUE']) > 0){
				$arResult['CHARACTERISTICS'][$arProp['CODE']] = $arProp;
				$arResult['CHARACTERISTICS_COUNT']++;
			}
		}
	}
}

/*
$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> $arParams["IBLOCK_ID"], "ID"=> $arResult["ID"], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arFields = $res->GetNext())
{
	$arResult["URL"] = $arFields["DETAIL_PAGE_URL"];
}
*/

//////////Open Graph//////////
//OG:IMAGE
$arTmpImages = $arResult['IMAGES'];
$og_image = array_shift($arTmpImages);
if($og_image["SMALL_IMG"]["src"]){
    $og_image = "https://".$_SERVER["SERVER_NAME"].$og_image["SMALL_IMG"]["src"];
}
unset($arTmpImages);

//OG:DESCRIPTION
if($arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']){
    $og_descr = $arResult['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION'];
}elseif($arResult['PREVIEW_TEXT']){
    $og_descr = cutString(strip_tags($arResult['PREVIEW_TEXT']), 160);
}elseif($arResult['DETAIL_TEXT']){
    $og_descr = cutString(strip_tags($arResult['DETAIL_TEXT']), 160);
}

//OG:TITLE
if($arResult['IPROPERTY_VALUES']['ELEMENT_META_TITLE']){
    $og_title = $arResult['IPROPERTY_VALUES']['ELEMENT_META_TITLE'];
}elseif($arResult['NAME']){
    $og_title = $arResult['NAME'];
}

//OG:URL
$og_url = "https://".$_SERVER["SERVER_NAME"].$arResult['DETAIL_PAGE_URL'];

$arResult['OG'] = array(
    "OG_TITLE" => $og_title,
    "OG_DESCRIPTION" => $og_descr,
    "OG_URL" => $og_url,
    "OG_IMAGE"  => $og_image
);
//////////Open Graph//////////

$this->__component->SetResultCacheKeys(array("NAME","URL","DETAIL_PAGE_URL", "IMAGES","PROPERTY","IPROPERTY_VALUES","PREVIEW_TEXT",'OG'));


if(count($arResult['PROPERTIES']['MORE_FILES']['VALUE']) > 0){
	$arResult['MORE_FILES'] = ADBIBlockElement::MORE_FILES($arResult['PROPERTIES']['MORE_FILES']);
}
if(isset($arResult['PROPERTIES']['VIDEO']['VALUE'][0]) && is_array($arResult['PROPERTIES']['VIDEO']['VALUE'][0])){
	$arResult['VIDEO'] = ADBIBlockElement::VIDEO($arResult['PROPERTIES']['VIDEO']);
}


foreach($arParams['SECTIONS'] as $k => $sect){
	if(array_search($sect['CODE'], explode('/',$arResult['DETAIL_PAGE_URL'])) && $arResult['DETAIL_PAGE_URL'] != $sect['SECTION_PAGE_URL'].$arResult['CODE'].'/'){
		$arResult['CAN_URL'] = $sect['SECTION_PAGE_URL'].$arResult['CODE'].'/';
		$this->__component->SetResultCacheKeys(array("CAN_URL"));
	}
}
?>