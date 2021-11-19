<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<div class="faq">
	<?foreach($arResult["SECTIONS"] as $arSection):?>
		<?if($arSection['NAME']):?>
			<div class="h2"><?=$arSection['NAME']?></div>
		<?endif;?>
		<?if($arSection["ITEMS"] || $arResult["SECTIONS"]["ITEMS"]):?>
			<?foreach($arSection["ITEMS"] as $key => $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
				<div class="answer" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="title" id="element-<?=$arItem["ID"]?>"><?=$arItem["NAME"]?></div>
					<?if($arItem["DETAIL_TEXT"]):?>
						<div class="text"><?if($arItem['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arItem["DETAIL_TEXT"]?><?else:?><p><?=$arItem["DETAIL_TEXT"]?></p><?endif;?></div>
					<?endif;?>
				</div>

			<?endforeach;?>
		<?endif;?>
	<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
