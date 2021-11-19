<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arResult['CNT'] = count($arResult['SECTIONS']) - 1;
if ($arResult['CNT'] < 0)
	return;
?>
<div class="c_about_gallery break-word row-clear">
	<div class="row" id="db-gallery-items-<?=$arResult['ID']?>">
		<?foreach($arResult["SECTIONS"] as $arSection):
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_ADD"), array('ICON' => 'bx-context-toolbar-create-icon'));
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction('section_'.$arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_SECTION_DELETE_CONFIRM')));
			?>
			<div id="<?=$this->GetEditAreaId('section_'.$arSection['ID']);?>" class="item  col-4">
				<a class="link" title="<?=$arSection['NAME']?>" href="<?=$arSection['SECTION_PAGE_URL']?>">
					<div class="pic">
						<div class="pic_i">
							<img class="img"  src="<?=$arSection['SECTION_IMG']['SRC'];?>" alt="<?=($arSection['PREVIEW_PICTURE']['DESCRIPTION']? $arSection['PREVIEW_PICTURE']['DESCRIPTION'] : $arSection['NAME'])?>" title="<?=$arSection['PREVIEW_IMG']['TITLE']?>">
						</div>
					</div>
					<div class="text ptsans-r">
						<div class="tag">
							<?=count($arSection["ITEMS"])?> <?=GetMessage("PHOTO")?>
						</div>
						<div class="wrap">
							<?if($arSection["UF_DATE"] || strlen($arSection["UF_DOP_NAME"])>0):?>
								<div class="caption-text">
									<?$arr = ParseDateTime($arSection["UF_DATE"]);?> 
									<?=$arr["DD"]?> <?=GetMessage("FULL_MONTH_".$arr["MM"])?> <?=$arr["YYYY"]?> 
									<?if($arSection["UF_DOP_NAME"]):?>
										/ <?=$arSection["UF_DOP_NAME"]?>
									<?endif;?>
								</div>
							<?endif;?>
							<div class="title">
								<?=$arSection['NAME']?>
							</div>
						</div>
					</div>
                </a>
            </div>
		<?endforeach;?>
	</div>
</div>
<?pr($arResult);?>
