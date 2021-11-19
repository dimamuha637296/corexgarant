<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
	<div class="catalog-detail js-height js-width">
		<?$i=1;foreach($arResult["SECTIONS"] as $arSection):
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

			$colum = ceil(count($arSection["SECTIONS"])/2);
			//$colum = floor(count($arSection["SECTIONS"])/2);
			?>
			<div class="item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<div class="media-old">
					<?if($arSection["PREVIEW_IMG"]):?>
					<div class="pic media-left-old js-width-trg">
						<img src="<?=$arSection["PREVIEW_IMG"]["src"]?>" alt="<?=$arSection["NAME"]?>" class="img">
					</div>
					<?endif;?>
					<div class="media-body-old">
						<div class="title-cat"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["~NAME"]?></a></div>
						<?if($arSection["~DESCRIPTION"]):?>
							<div class="text">
								<?=$arSection["~DESCRIPTION"]?>
							</div>
						<?endif;?>
					</div>
				</div>
			</div>
		<?$i++;endforeach;?>
</div>
<?/*/?><pre><?print_r($arResult);?></pre><?//*/?>