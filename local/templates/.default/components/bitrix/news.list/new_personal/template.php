<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;

?>
<div class="personal-list js-height">
	<?foreach ($arResult['ITEMS'] as $key => $arElement):
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
		$bHasPicture = is_array($arElement['PREVIEW_IMG']);
		$text = false;
		$itemTop = false;

		if(strlen($arElement["PREVIEW_TEXT"])>0){
			$text = true;
		}
		if($arElement['PROPERTIES']['TOP']['VALUE_XML_ID'] == "Y"){
			$itemTop = true;
		}

	?>
 		<div class="item <?=($itemTop? "item-lg": "item-sm")?>" id="element-<?=$arElement['ID']?>">
			<div class="wrap" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
				<?if($arElement['PREVIEW_IMG']):?>
				<div class="pic-wrap js-trg">
					<div class="pic_o">
						<div class="pic">
							<i class="icon"></i>
							<img src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['PREVIEW_IMG']['ALT']?>"></div>
					</div>
				</div>
				<?endif;?>
				<div class="text-wrap">
					<div class="title"><?=$arElement["~NAME"]?></div>
					<?if($arElement['PROPERTIES']['POST']['VALUE']):?>
						<div class="caption-text"><?=$arElement['PROPERTIES']['POST']['VALUE'];?></div>
					<?endif;?>
					<?if($text):?>
					<div class="text">
						<?if($arElement['PREVIEW_TEXT_TYPE'] == 'html'):?><?=$arElement["PREVIEW_TEXT"]?><?else:?><p><?=$arElement["PREVIEW_TEXT"]?></p><?endif;?>
					</div>
					<?endif;?>
				</div>
			</div>

		</div>
	<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>