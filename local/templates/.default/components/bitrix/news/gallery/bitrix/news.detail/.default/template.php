<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);


?>
<div class="b-element mb_3" id="element-<?=$arResult['ID']?>" >
   	<?if(count($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']) > 0 && $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'][0] > 0):?>
		<?
		//$arPrev = array($arResult['PREVIEW_PICTURE']["ID"]);
		//$idItem = array_merge($arPrev, $arResult['PROPERTIES']['MORE_PHOTO']['VALUE']);
		?>
		<div class="b-more_photos" id="photos-<?=$arResult['ID']?>">
				<?$APPLICATION->IncludeComponent(
					"db.base:gallery.list", 
					".default", 
					array(
						"DISPLAY_IMG_WIDTH" => $arParams['DISPLAY_DETAIL_DOP_IMG_WIDTH'],
						"DISPLAY_IMG_HEIGHT" => $arParams['DISPLAY_DETAIL_DOP_IMG_HEIGHT'],
						"TYPE_IMG_THUMB" => "BX_RESIZE_IMAGE_EXACT",
						"COLUM" => intval($arParams["COLUMN_COUNT_FOR_MORE_PHOTOS"]) > 0 ? $arParams["COLUMN_COUNT_FOR_MORE_PHOTOS"] : 4,
						"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
						"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
						"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"ITEMS" => $arResult['PROPERTIES']['MORE_PHOTO']['VALUE'],
						"DEF_NAME" => $arResult['NAME']
					),
					false
				);
				?>
		</div>	
	<?endif;?>
</div>

<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult['VIDEO']['COMPONENT']['NAME'])?></pre><?//*/?>