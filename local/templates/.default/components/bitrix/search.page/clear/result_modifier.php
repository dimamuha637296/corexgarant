<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["TAGS_CHAIN"] = array();
$arParams["SHOW_ITEM_PATH"] = "Y";
if($arResult["REQUEST"]["~TAGS"])
{
	$res = array_unique(explode(",", $arResult["REQUEST"]["~TAGS"]));
	$url = array();
	foreach ($res as $key => $tags)
	{
		$tags = trim($tags);
		if(!empty($tags))
		{
			$url_without = $res;
			unset($url_without[$key]);
			$url[$tags] = $tags;
			$result = array(
				"TAG_NAME" => htmlspecialcharsex($tags),
				"TAG_PATH" => $APPLICATION->GetCurPageParam("tags=".urlencode(implode(",", $url)), array("tags")),
				"TAG_WITHOUT" => $APPLICATION->GetCurPageParam((count($url_without) > 0 ? "tags=".urlencode(implode(",", $url_without)) : ""), array("tags")),
			);
			$arResult["TAGS_CHAIN"][] = $result;
		}
	}
}
$arResult['CATALOG'] = array();
foreach($arResult["SEARCH"] as $arItem){
	if($arItem['MODULE_ID'] == 'iblock' && in_array($arItem['PARAM2'], $arParams['IMGFOR'])  && $arItem['ITEM_ID'] > 0){
		$arResult['CATALOG']['IDS'][$arItem['ITEM_ID']] = $arItem['ITEM_ID'];
	}
}
if(count($arResult['CATALOG']['IDS']) > 0){
	CModule::IncludeModule("iblock");
	$arFilter = Array(
			"IBLOCK_ID" => $arParams['IMGFOR'],
			"ID" => $arResult['CATALOG']['IDS']
	);

	$res = CIBlockElement::GetList(Array("ID" => "ASC"), $arFilter, false, false,
			array('IBLOCK_ID', 'ID', 'DETAIL_PICTURE', 'PREVIEW_PICTURE', 'IBLOCK_SECTION_ID')
	);
	while($arItem = $res->GetNext())
	{
		if($arItem['DETAIL_PICTURE'] > 0){
			$arFileTmp = CFile::ResizeImageGet(
					$arItem['DETAIL_PICTURE'],
					array("width" => $arParams['IMG_WIDTH'], "height" => $arParams['IMG_HEIGHT']),
					BX_RESIZE_IMAGE_EXACT,
					true
			);
			$arResult['CATALOG']['IMG'][$arItem['ID']] = array(
					"SRC" => $arFileTmp["src"],
					'WIDTH' => $arFileTmp["width"],
					'HEIGHT' => $arFileTmp["height"],
			);
		}elseif($arItem['PREVIEW_PICTURE'] > 0){
            $arFileTmp = CFile::ResizeImageGet(
                $arItem['PREVIEW_PICTURE'],
                array("width" => $arParams['IMG_WIDTH'], "height" => $arParams['IMG_HEIGHT']),
                BX_RESIZE_IMAGE_EXACT,
                true
            );
            $arResult['CATALOG']['IMG'][$arItem['ID']] = array(
                "SRC" => $arFileTmp["src"],
                'WIDTH' => $arFileTmp["width"],
                'HEIGHT' => $arFileTmp["height"],
            );
        }
			
		if($arItem['IBLOCK_SECTION_ID'] > 0){
			$arResult['CATALOG']['IDS_SECTION'][$arItem['IBLOCK_SECTION_ID']] = $arItem['IBLOCK_SECTION_ID'];
			$arResult['CATALOG']['IDS_SECTION_ELEMENTS'][$arItem['ID']] = $arItem['IBLOCK_SECTION_ID'];
		}
	}

	if(count($arResult['CATALOG']['IDS_SECTION']) > 0){
		$arFilter = Array(
				"IBLOCK_ID" => $arParams['IBLOCK_CATALOG'],
				"ID" => $arResult['CATALOG']['IDS_SECTION']
		);
		$res = CIBlockSection::GetList(array("ID" => "ASC"), $arFilter, false,
				array('IBLOCK_ID', 'ID', 'NAME')
		);
		while($arItem = $res->GetNext())
		{
			$arResult['CATALOG']['SECTION'][$arItem['ID']] = $arItem['NAME'];
		}
	}
}
?>