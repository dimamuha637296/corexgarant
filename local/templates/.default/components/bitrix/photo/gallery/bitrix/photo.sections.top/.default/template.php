<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arResult['CNT'] = count($arResult['SECTIONS']) - 1;
if ($arResult['CNT'] < 0)
	return;
$columnMax = 12;
$arParams['LINE_ELEMENT_COUNT'] =intval($arParams['LINE_ELEMENT_COUNT'])> 0 ? $arParams['LINE_ELEMENT_COUNT'] : 3;
$columnCNT = floor($columnMax/$arParams['LINE_ELEMENT_COUNT']);

?>
<div class="c_about_gallery _break-word">
	<div class="row" id="db-gallery-items-<?=$arResult['ID']?>">
		<?foreach($arResult["SECTIONS"] as $arSection):?>
			<?
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_ADD"), array('ICON' => 'bx-context-toolbar-create-icon'));
			$this->AddEditAction('section_'.$arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction('section_'.$arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_SECTION_DELETE_CONFIRM')));
			?>
			<section id="<?=$this->GetEditAreaId('section_'.$arSection['ID']);?>" class="gallery_item mb_2 col-lg-<?=$columnCNT?> col-md-<?=$columnCNT?> col-sm-<?=$columnCNT?> col-10">
                <div class="gallery_picture mb_1">
                    <div class="gallery_picture_wrap">
                        <a title="<?=$arSection['NAME']?>" href="<?=$arSection['SECTION_PAGE_URL']?>">
                            <img class="img" src="<?=$arSection['PREVIEW_IMG']['SRC'];?>" width="<?=$arSection['PREVIEW_IMG']['WIDTH']?>" alt="<?=$arSection['PREVIEW_IMG']['ALT']?>" title="<?=$arSection['PREVIEW_IMG']['TITLE']?>"  >
                        </a>
                    </div>
                </div>
                <div class="gallery_descr _center">
                    <a title="<?=$arSection['NAME']?>" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
                </div>
            </section>
			<div class="_delimeter"></div>
		<?endforeach;?>
	</div>
</div>
<?//pr($arParams);?>