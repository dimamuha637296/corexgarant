<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<div class="accordion">
	<div id="accordion" class="acc-group">
		<?$i=1;foreach($arResult["SECTIONS"] as $arSection):?>
			<?if($arSection['NAME']):?>
				<div class="h2"><?=$arSection['NAME']?></div><?=$arSection['NAME']?></div>
			<?endif;?>
			<?if($arSection["ITEMS"] || $arResult["SECTIONS"]["ITEMS"]):?>
				<?foreach($arSection["ITEMS"] as $key => $arItem):
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
					<div class="panel" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >
						<div class="acc-heading" id="element-<?=$arItem["ID"]?>">
							<a data-toggle="collapse" data-parent="#accordion" class="link ic-arrow <?if($arParams['OPEN_FIRST'] == 'Y' && $key == 0 && $i == 1):?><?else:?>collapsed<?endif;?>"
							   href="#accordion-<?=$arItem["ID"]?>">
								<span class="dash"><?=$arItem["NAME"]?></span>
							</a>
						</div>
						<div id="accordion-<?=$arItem["ID"]?>" class="collapse <?if($arParams['OPEN_FIRST'] == 'Y' && $key == 0 && $i == 1):?>in<?endif;?>">
							<div class="acc-body">
								<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["DETAIL_TEXT"]):?>
									<div class="descr ugc _clear">
										<?if($arItem['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arItem["DETAIL_TEXT"]?><?else:?><p><?=$arItem["DETAIL_TEXT"]?></p><?endif;?>
										<?if($arItem['PREVIEW_TEXT_TYPE'] == 'html'):?><?=$arItem["PREVIEW_TEXT"]?><?else:?><p><?=$arItem["PREVIEW_TEXT"]?></p><?endif;?>
									</div>
								<?endif;?>
								<?if(count($arItem["PROPERTIES_EXT"]['MORE_FILES']) > 0):?>
										<?$APPLICATION->IncludeComponent(
											$arItem["PROPERTIES_EXT"]['MORE_FILES']['COMPONENT']['NAME'],$arItem["PROPERTIES_EXT"]['MORE_FILES']['COMPONENT']['TEMPLATE'],
											$arItem["PROPERTIES_EXT"]['MORE_FILES']['ARGS'],
											false, array('HIDE_ICONS' => 'Y')
										);
										?>
								<?endif;?>
							</div>
						</div>
					</div>
				<?endforeach;?>
			<?endif;?>
		<?$i++;endforeach;?>
	</div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>