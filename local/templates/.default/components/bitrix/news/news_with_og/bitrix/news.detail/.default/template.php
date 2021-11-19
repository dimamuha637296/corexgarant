<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
	$bhasDate = $arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"];
	$bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult['PREVIEW_IMG']);
?>
<div class="b-element mb_3" id="element-<?=$arResult['ID']?>" >
	<div class="c_news">
		<div class="wrap mb_1">
			<?if($bhasDate):?>
				<time class="date" datetime="<?=date('Y-m-d', strtotime($arResult["ACTIVE_FROM"]));?>"><?=ToLower($arResult["DISPLAY_ACTIVE_FROM"]);?></time>
			<?endif?>
		</div>
	</div>
	<?if($bHasPicture):?>
		<div class="fl-img">
			<img src="<?=$arResult['PREVIEW_IMG']['SRC']?>" alt="<?=$arResult['PREVIEW_IMG']['ALT']?>" />
		</div>
	<?endif;?>
	<div class="descr mb_2">
		<?if($arResult["DETAIL_TEXT"]):?>	
			<?if($arResult['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arResult["DETAIL_TEXT"]?><?else:?><p><?=$arResult["DETAIL_TEXT"]?></p><?endif;?>
			<div class="clear"></div>
		<?endif;?>	
	</div>
	<?if(count($arResult['MORE_FILES']) > 0):
		$arResult['MORE_FILES']['ARGS']['COLUM'] = intval($arParams["COLUMN_COUNT_FOR_MORE_FILES"]) > 0 ? $arParams["COLUMN_COUNT_FOR_MORE_FILES"] : 2;
		$arResult['MORE_FILES']['ARGS']['COLUM_MAX'] = $arParams['COLUM_GRID'];
		$arResult['MORE_FILES']['ARGS']['FORSE_DOWN_LOAD'] = "N";
	?>
		<div class="b-dop_files">
		<?if($arResult['PROPERTIES']['MORE_FILES_TITLE']['VALUE']):?>
			<h3 class="mb_2"><?=$arResult['PROPERTIES']['MORE_FILES_TITLE']['VALUE']?>:</h3>
		<?endif;?>
			<?$APPLICATION->IncludeComponent(
				$arResult['MORE_FILES']['COMPONENT']['NAME'],$arResult['MORE_FILES']['COMPONENT']['TEMPLATE'], 
				$arResult['MORE_FILES']['ARGS'],
				false, array('HIDE_ICONS' => 'Y')
			);
			?>
		</div>
   	<?endif;?>
   	<?if(count($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']) > 0 && $arResult['PROPERTIES']['MORE_PHOTOS']['VALUE'][0] > 0):?>	
		<?if($arResult['PROPERTIES']['MORE_PHOTOS_TITLE']['VALUE']):?>
			<h3 class="mb_2"><?=$arResult['PROPERTIES']['MORE_PHOTOS_TITLE']['VALUE']?>:</h3>
		<?endif;?>
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
						"ITEMS" => $arResult['PROPERTIES']['MORE_PHOTOS']['VALUE'],
						"DEF_NAME" => $arResult['NAME']
					),
					false
				);
				?>
		</div>	
	<?endif;?>
   	<?if(count($arResult['PROPERTIES']['VIDEO']['VALUE'])>0):?>
   		
   		<?if($arResult['PROPERTIES']['VIDEO_TITLE']['VALUE']):?>
			<h3 class="mb_2"><?=$arResult['PROPERTIES']['VIDEO_TITLE']['VALUE']?>:</h3>
		<?endif;?>
		<div class="row row-clear">
			<?foreach($arResult['PROPERTIES']['VIDEO']['VALUE'] as $num => $arVideo):?>
				<div class="col-10 col-md-5 col-sm-10">
					<iframe width="400" height="345" src="<?=$arVideo?>"></iframe>
				</div>
			<?endforeach;?>
		</div>
	<?endif;?>
</div>
