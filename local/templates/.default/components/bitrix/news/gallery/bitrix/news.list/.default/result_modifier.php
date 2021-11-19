<?
$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

switch ($arParams["TYPE_IMG_THUMB"]){
	case 'BX_RESIZE_IMAGE_EXACT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL; break;
	case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT': $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT; break;
	default: $arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT;
}


$arParams["DISPLAY_IMG_WIDTH"] = isset($arParams["DISPLAY_IMG_WIDTH"]) ? intval($arParams["DISPLAY_IMG_WIDTH"]) : '270';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '180';

$arParams["POPUP_IMG_WIDTH"] = isset($arParams["POPUP_IMG_WIDTH"]) ? intval($arParams["POPUP_IMG_WIDTH"]) : '1000';
$arParams["DISPLAY_IMG_HEIGHT"] = isset($arParams["DISPLAY_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_IMG_HEIGHT"]) : '1000';

$arFilter = '';
if($arParams["SHARPEN"] != 0)
{
	$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
}

foreach($arResult["ITEMS"] as $key => $arItem){

	if($arItem["PREVIEW_PICTURE"]){
		$idPrevImg = $arItem['~PREVIEW_PICTURE'];
	}elseif(is_array($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && count($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])>0){
		$idPrevImg = $arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0];
		unset($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"][0]);
	}
	$arResult["ITEMS"][$key]["PREVIEW_IMG"] = CFile::ResizeImageGet(
		$idPrevImg,
		array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
		$arParams["TYPE_IMG_THUMB"],
		true, $arFilter
	);
	$arResult["ITEMS"][$key]["POPUP_IMG"] = CFile::ResizeImageGet(
		$idPrevImg,
		array("width" => $arParams["POPUP_IMG_WIDTH"], "height" => $arParams["POPUP_IMG_HEIGHT"]),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
		true, $arFilter
	);
	foreach($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $img =>  $arImg){
		$arResult["ITEMS"][$key]["IMAGES"][$img]["IMG"] = CFile::ResizeImageGet(
			$arImg,
			array("width" => $arParams["POPUP_IMG_WIDTH"], "height" => $arParams["POPUP_IMG_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
			true, $arFilter
		);

		if($arItem["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$img]){
			$arResult["ITEMS"][$key]["IMAGES"][$img]["NAME"] = $arItem["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$img];
		}else{
			$arResult["ITEMS"][$key]["IMAGES"][$img]["NAME"] = $arItem["~NAME"];
		}
	}

}

//pr($arResult["ITEMS"]);
?>