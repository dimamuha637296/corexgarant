<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

	<div class="catalog_menu sectio row row-clear mb_2">
		<?if($arResult["MAX_DEPTH_LEVEL"]):?>
		<?$i=1;foreach($arResult["NEW_SECTIONS"] as $arSection):
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		?>
			<div class="item_1 col-3" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<div class="title h3"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["~NAME"]?></a></div>
				<?foreach($arSection["SECTIONS"] as $arSect):
				$this->AddEditAction($arSect['ID'], $arSect['EDIT_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_EDIT"));
				$this->AddDeleteAction($arSect['ID'], $arSect['DELETE_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
				?>
					<div class="title item_2" id="<?=$this->GetEditAreaId($arSect['ID']);?>">
						<a href="<?=$arSect["SECTION_PAGE_URL"]?>"><?=$arSect["~NAME"]?></a>
					</div>
				<?endforeach;?>
			</div>
		<?$i++;endforeach;?>
		<?else:?>

			<?foreach($arResult["NEW_SECTIONS"] as $arSect):
				$this->AddEditAction($arSect['ID'], $arSect['EDIT_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_EDIT"));
				$this->AddDeleteAction($arSect['ID'], $arSect['DELETE_LINK'], CIBlock::GetArrayByID($arSect["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="col-3 title item_2" id="<?=$this->GetEditAreaId($arSect['ID']);?>">
					<a href="<?=$arSect["SECTION_PAGE_URL"]?>"><?=$arSect["~NAME"]?></a>
				</div>
			<?endforeach;?>
		<?endif;?>
</div>
<?/*/?><pre><?print_r($arResult);?></pre><?//*/?>