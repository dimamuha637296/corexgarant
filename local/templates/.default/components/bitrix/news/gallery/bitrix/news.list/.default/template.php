<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<div class="gallery-albums">
	<div class="row row-clear">
		<?foreach($arResult["ITEMS"] as $arItem):
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<?if(count($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])>0):?>
			<div class="item col-12 col-sm-6 col-md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<?if($arItem["PREVIEW_IMG"]):?>
						<div class="pic">
							<div class="pic_i">
								<img class="img" src="<?=$arItem["PREVIEW_IMG"]["src"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"/>
							</div>
						</div>
					<?endif;?>
					<div class="title">
						<?=$arItem["~NAME"]?>
					</div>
				</a>
				<div class="quant caption-text">
					<?=count($arItem["IMAGES"])?> <?=GetMessage("DB_PHOTO")?>
				</div>
			</div>
		<?endif;?>
		<?endforeach;?>
	</div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
