<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;
if($arParams['TILED_VIEW'] == 'Y'){
	$tiled = true;
}
//pr($arResult);
?>

	<div class="personal-<?=($tiled? "list": "detail")?> js-<?=($tiled? "height": "width")?> js-hover">
		<?if($tiled):?>
		<div class="row row-clear">
			<?endif;?>
			<?foreach ($arResult['ITEMS'] as $key => $arElement):
				$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
				$bHasPicture = is_array($arElement['PREVIEW_IMG']);
				if(strlen($arElement['PROPERTIES']['POST']['VALUE'])>0){
					$post = true;
				}
				if(strlen($arElement['PROPERTIES']['MAIL']['VALUE'])>0){
					$mail = true;
				}
				if(is_array($arElement['PROPERTIES']['INFO']['VALUE'])){
					$info = true;
				}
				if(strlen($arElement["PREVIEW_TEXT"])>0){
					$text = true;
				}
				?>
				
				<div class="item<?=($tiled? " col-md-4 col-sm-6 col-12": "")?> js-hover-wrap" id="element-<?=$arElement['ID']?>">
					<?if($tiled):?>
					<div class="wrap" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
						<div class="pic-wrap js-trg">
							<div class="pic_o">
								<?endif;?>
								<?if($arParams["DISPLAY_PICTURE"]!="N" && $bHasPicture):?>
									<div class="pic<?=($tiled? "": " js-width-trg")?>">
										<a href="<?=$arElement['DETAIL_PAGE_URL'];?>" class="link js-hover-trg">
											<i class="icon"></i>
											<img src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['PREVIEW_IMG']['ALT']?>" title="<?=$arElement['PREVIEW_IMG']['ALT']?>" >
										</a>
									</div>
								<?endif;?>
								<?if($tiled):?>
							</div>
						</div>
						<div class="title">
							<a href="<?=$arElement['DETAIL_PAGE_URL'];?>" class="js-hover-trg">
								<?=$arElement["~NAME"]?>
							</a>
						</div>
					</div>
				<?endif;?>
					<?if($tiled && $post):?>
						<div class="caption-text">
							<?if($post):?>
								<p><?=$arElement['PROPERTIES']['POST']['VALUE'];?></p>
							<?endif;?>
							<?/*if($info):?>
						<?foreach($arElement['PROPERTIES']['INFO']['VALUE'] as $num => $arInfo):?>
							<p><?=($arElement['PROPERTIES']['INFO']['DESCRIPTION'][$num]?$arElement['PROPERTIES']['INFO']['DESCRIPTION'][$num].': ':"")?><?=$arInfo?></p>
						<?endforeach;?>
					<?endif;*/?>
						</div>
					<?endif;?>
					<?if(!$tiled):?>
						<div class="wrap" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
							<?if($arParams["DISPLAY_NAME"]!="N" && $arElement["NAME"]):?>
								<div class="title">
									<a href="<?=$arElement['DETAIL_PAGE_URL'];?>">
										<?=$arElement["~NAME"]?>
									</a>
								</div>
							<?endif;?>
							<?if($post):?>
								<div class="caption-text"><?=$arElement['PROPERTIES']['POST']['VALUE'];?></div>
							<?endif;?>
							<?if(($text || $info || $mail) && $arParams["DISPLAY_PREVIEW_TEXT"]!="N"):?>
								<div class="info-text">
									<?if($info):?>
										<?foreach($arElement['PROPERTIES']['INFO']['VALUE'] as $num => $arInfo):?>
											<p><?=($arElement['PROPERTIES']['INFO']['DESCRIPTION'][$num]?$arElement['PROPERTIES']['INFO']['DESCRIPTION'][$num].': ':"")?><?=$arInfo?></p>
										<?endforeach;?>
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

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

<?//pr($arResult);?>