<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
$width = intval($arParams['DISPLAY_MORE_PHOTO_WIDTH']);
$height = intval($arParams['DISPLAY_MORE_PHOTO_HEIGHT']);
	$arResult["DOP_IMAGES"] = array();
	$arResult["DOP_IMAGES_ID"] = array();
	if(count($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']) > 0 && intval($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']) > 0){
		foreach($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE'] as $num => $idFile){
            if(intval($idFile) > 0){
                $arFileTmp = CFile::ResizeImageGet(
                    $idFile,
                    array("width" => $width, "height" => $height),
                    BX_RESIZE_IMAGE_EXACT,
                    true, $arFilter
                );
				$arResult["DOP_IMAGES_ID"][] = $idFile;
                $arResult["DOP_IMAGES"][$num] = array(
                    "SRC" => $arFileTmp["src"],
                    'WIDTH' => $arFileTmp["width"],
                    'HEIGHT' => $arFileTmp["height"],
					'ID' => $idFile,
					'PATH' => CFile::GetPath($idFile),
					'ALT' => (strlen($arResult['PROPERTIES']['MORE_PHOTOS']['DESCRIPTION'][$num]) > 0 ? $arResult['PROPERTIES']['MORE_PHOTOS']['DESCRIPTION'][$num] : $arResult['NAME']),
					'TITLE' => (strlen($arResult['PROPERTIES']['MORE_PHOTOS']['DESCRIPTION'][$num]) > 0 ? $arResult['PROPERTIES']['MORE_PHOTOS']['DESCRIPTION'][$num] : $arResult['NAME']),
                );
            }
        }
	}
/*
BX_RESIZE_IMAGE_EXACT - масштабирует в прямоугольник $arSize без сохранения пропорций;
BX_RESIZE_IMAGE_PROPORTIONAL - масштабирует с сохранением пропорций, размер ограничивается $arSize;
BX_RESIZE_IMAGE_PROPORTIONAL_ALT - масштабирует с сохранением пропорций, размер ограничивается $arSize, улучшенна обработка вертикальных картинок.
*/	
	$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", 'IBLOCK_ID', 'PROPERTY_ADRESS','PROPERTY_LIST_SHOW_VALUE','PROPERTY_STORE_TYPE');
	$arFilter = Array("IBLOCK_ID"=> $arParams['IBLOCK_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", 'SECTION_ID' => $arResult['IBLOCK_SECTION_ID'],'!PROPERTY_LIST_SHOW_VALUE'=>"Да");
	$res = CIBlockElement::GetList(Array('SORT' => 'asc'), $arFilter, false, false, $arSelect);
	while($arFields = $res->GetNext())
	{
		$arResult['ALL_MAGG'][] = $arFields;
	}
	if(intval($arParams['IBLOCK_ID_VAC']) > 0){
		$arFilter = Array("IBLOCK_ID"=> $arParams['IBLOCK_ID_VAC'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", 'PROPERTY_IT_MANUFACTURES' => $arResult['ID']);
		$arResult['ALL_VAC_CNT'] = CIBlockElement::GetList(Array(), $arFilter, array());
	}else{
		$arResult['ALL_VAC_CNT'] = 0;
	}

?>