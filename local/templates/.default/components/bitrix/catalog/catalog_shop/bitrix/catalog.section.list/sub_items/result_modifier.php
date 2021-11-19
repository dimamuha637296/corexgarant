<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


$arParams['LIST_ELEMENT_COUNT'] = ($arParams['LIST_ELEMENT_COUNT']?$arParams['LIST_ELEMENT_COUNT']:"3");

$arSectionId = array();

if (is_array($arResult["SECTIONS"]) && count($arResult["SECTIONS"]) > 0) {

	$arParams["TYPE_IMG_THUMB"] = trim($arParams["TYPE_IMG_THUMB"]);

	switch ($arParams["TYPE_IMG_THUMB"]) {
		case 'BX_RESIZE_IMAGE_EXACT':
			$arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_EXACT;
			break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL':
			$arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL;
			break;
		case 'BX_RESIZE_IMAGE_PROPORTIONAL_ALT':
			$arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL_ALT;
			break;
		default:
			$arParams["TYPE_IMG_THUMB"] = BX_RESIZE_IMAGE_PROPORTIONAL;
	}

	$arParams["DISPLAY_SECTION_IMG_WIDTH"] = isset($arParams["DISPLAY_SECTION_IMG_WIDTH"]) ? intval($arParams["DISPLAY_SECTION_IMG_WIDTH"]) : '130';
	$arParams["DISPLAY_SECTION_IMG_HEIGHT"] = isset($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) ? intval($arParams["DISPLAY_SECTION_IMG_HEIGHT"]) : '130';

	$arResult["MAX_LEVEL"] = "1";

	foreach ($arResult["SECTIONS"] as $key => $arSect) {
		if ($arSect["PICTURE"]) {
			$arResult["SECTIONS"][$key]["PREVIEW_IMG"] = CFile::ResizeImageGet(
				$arSect["~PICTURE"],
				array("width" => $arParams["DISPLAY_SECTION_IMG_WIDTH"], "height" => $arParams["DISPLAY_SECTION_IMG_HEIGHT"]),
				$arParams["TYPE_IMG_THUMB"],
				true
			);
		}

		$arSectionId[] = $arSect['ID'];

		if($arResult["MAX_LEVEL"] > $arSect["DEPTH_LEVEL"]){
			$arResult["MAX_LEVEL"] = $arSect["DEPTH_LEVEL"];
		}
	}
}

//Собираем элементы разделов

if ($arParams["SHARPEN"] != 0) {
	$arResFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
}

$arSort = array('SORT' => 'ASC');
$arSelect = Array("ID", "NAME", "SECTION_ID", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PREVIEW_TEXT", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", 'SECTION_ID' => $arSectionId, );

$res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
$arElems = array();
$arImageId = false;
while ($arFields = $res->GetNext()) {
	if(count($arElems[$arFields['IBLOCK_SECTION_ID']]) < $arParams['LIST_ELEMENT_COUNT']){
		// Собрираем id файлов картинок
		if ($arFields['PREVIEW_PICTURE'] > 0) {
			$arImageId = $arFields['PREVIEW_PICTURE'];
		} elseif ($arFields['DETAIL_PICTURE'] > 0) {
			$arImageId = $arFields['DETAIL_PICTURE'];
		}

		if($arImageId > 0){
			$arFileTmp_small = CFile::ResizeImageGet(
				$arImageId,
				array(
					"width" => $arParams["LIST_IMG_WIDTH"],
					"height" => $arParams["LIST_IMG_HEIGHT"]
				),
				$arParams["TYPE_IMG_THUMB"],
				true, $arResFilterq
			);
		}else{
			$arFileTmp_small['src'] = $arParams['DEFAULT_IMG']; //поставить заглушку
		}

		$arImageId = "";

		$arFields['PREVIEW_IMG'] = $arFileTmp_small;
		$arElems[$arFields['IBLOCK_SECTION_ID']][$arFields["ID"]] = $arFields;
	}
}


$arResult["SECTION_ELEMENTS"] = $arElems;

?>