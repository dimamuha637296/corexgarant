<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arResult['CNT'] = count($arResult['SECTIONS']) - 1;
if ($arResult['CNT'] < 0)
	return;
?>
<div class="gallery albums">
	<div class="row row-clear" id="db-gallery-items-<?=$arResult['ID']?>">
		<?foreach($arResult["SECTIONS"] as $arSection):
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_ADD"), array('ICON' => 'bx-context-toolbar-create-icon'));
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction('section_'.$arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_SECTION_DELETE_CONFIRM')));
			?>
			<div id="<?=$this->GetEditAreaId('section_'.$arSection['ID']);?>" class="gallery_item mb_2 col-lg-4 col-md-4 col-sm-4 col-10">
				<a class="link" href="<?=$arSection['SECTION_PAGE_URL']?>">
	                <div class="pic">
	                    <div class="pic_i">
	                         <img class="img" src="<?=$arSection['SECTION_IMG']['SRC'];?>" alt="<?=($arSection['PREVIEW_PICTURE']['DESCRIPTION']? $arSection['PREVIEW_PICTURE']['DESCRIPTION'] : $arSection['NAME'])?>" title="<?=$arSection['PREVIEW_IMG']['TITLE']?>"  >
	                    </div>
	                </div>
	                <div class="title">
	                    <?=$arSection['NAME']?>
	                </div>
                </a>
                <div class="quant caption-text"><?=$arSection['ELEMENTS_CNT']?> <?=GetMessage("P_SECT_PHOTOS")?></div>                              
            </div>
			
		<?endforeach;?>
	</div>
</div>
<?//pr($arResult);?>