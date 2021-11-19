<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;
if($arParams['TILED_VIEW'] == 'Y'){
	$tiled = true; 
}
?>
<?foreach($arResult["SECTIONS"] as $key => $arSection):?>
<div class="personal-<?=($tiled? "list": "detail")?> js-<?=($tiled? "height": "width")?> js-hover">
	<?if($arSection['NAME']):?>
		<div class="h2"><?=$arSection['NAME']?></div>
	<?endif;?>
	<?if($arSection['DESCRIPTION']):?>
		<div class="descr ">
			<?=$arSection['DESCRIPTION']?>
		</div>
	<?endif;?>
	<?if($tiled):?>
		<div class="row row-clear">
	<?endif;?>
	<?foreach ($arSection['ITEMS'] as $key => $arElement):
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
		$bHasPicture = is_array($arElement['PREVIEW_IMG']);
		if(strlen($arElement['PROPERTIES']['MAIL']['VALUE'])>0){
			$mail = true;
		}
		if(strlen($arElement['PROPERTIES']['PHONE']['VALUE'])>0){
			$phone = true;
		}
		if(strlen($arElement['PROPERTIES']['SKYPE']['VALUE'])>0){
			$skype = true;
		}
		if(strlen($arElement["PREVIEW_TEXT"])>0){
			$text = true;
		}
	?>
		<div class="item<?=($tiled? " col-md-4 col-sm-6 col-12": "")?>" id="element-<?=$arElement['ID']?>">
				<?if($tiled):?>
				<div class="wrap" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
					<div class="pic-wrap js-trg">
						<div class="pic_o">
				<?endif;?>
				<?if($arParams["DISPLAY_PICTURE"]!="N" && $bHasPicture):?>
					<div class="pic<?=($tiled? "": " js-width-trg")?>">
                        <i class="icon"></i>
						<img src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['PREVIEW_IMG']['ALT']?>" title="<?=$arElement['PREVIEW_IMG']['ALT']?>" >
					</div>
				<?endif;?>
				<?if($tiled):?>
						</div>
					</div>
					<div class="title">
						<?=$arElement["NAME"]?>
					</div>
				</div>
				<?endif;?>
				<?if($tiled):?>
					<?if($arElement['PROPERTIES']['POST']['VALUE']):?>
						<div class="caption-text"><?=$arElement['PROPERTIES']['POST']['VALUE'];?></div>
					<?endif;?>
				<?endif;?>
				<?if(!$tiled):?>
					<div class="wrap" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
						<?if($arParams["DISPLAY_NAME"]!="N" && $arElement["NAME"]):?>
						<div class="title"><?=$arElement["NAME"]?></div>
					<?endif;?>
					<?if($arElement['PROPERTIES']['POST']['VALUE']):?>
						<div class="caption-text"><?=$arElement['PROPERTIES']['POST']['VALUE'];?></div>
					<?endif;?>
					<?if(($text || $phone || $mail || $skype) && $arParams["DISPLAY_PREVIEW_TEXT"]!="N"):?>
						<div class="text">
							<?if($phone):?>
							<p><?if($arElement['PROPERTIES']['PHONE']['DESCRIPTION']):?>
									<?=$arElement['PROPERTIES']['PHONE']['DESCRIPTION'];?>:
								<?endif;?>
								<?=$arElement['PROPERTIES']['PHONE']['VALUE'];?>
							</p>
							<?endif;?>
							<?if($mail):?>
								<p><?if($arElement['PROPERTIES']['MAIL']['DESCRIPTION']):?>
										<?=$arElement['PROPERTIES']['MAIL']['DESCRIPTION'];?>:
									<?endif;?>
									<a href="mailto:<?=$arElement['PROPERTIES']['MAIL']['VALUE'];?>" itemprop="email"><?=$arElement['PROPERTIES']['MAIL']['VALUE'];?></a>
								</p>
							<?endif;?>
							<?if($skype):?>
								<p><?if($arElement['PROPERTIES']['SKYPE']['DESCRIPTION']):?>
										<?=$arElement['PROPERTIES']['SKYPE']['DESCRIPTION'];?>:
									<?endif;?>
									<a href="mailto:<?=$arElement['PROPERTIES']['MAIL']['VALUE'];?>" itemprop="email"><?=$arElement['PROPERTIES']['SKYPE']['VALUE'];?></a>
								</p>
							<?endif;?>
							<?if($text):?>
								<?if($arElement['PREVIEW_TEXT_TYPE'] == 'html'):?><?=$arElement["PREVIEW_TEXT"]?><?else:?><p><?=$arElement["PREVIEW_TEXT"]?></p><?endif;?>
							<?endif;?>
						</div>
					<?endif;?>
					</div>
				<?endif;?>
			</div>
	<?endforeach;?>
	<?if($tiled):?>
		</div>
	<?endif;?>
</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>