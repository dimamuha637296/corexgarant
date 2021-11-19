<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
// change 29/01/2014 Shevchik 404
if($arResult['SECTION']['ID'] == 0 && $arParams['SHOW_SECTIONS'] == 'Y' && $arResult['SECTIONS_COUNT'] < 1){
	@define("ERROR_404","Y");
}

?>
<div class="catalog-main">
	<div class="list_1 row row-clear js-width">
	<?foreach($arResult["NEW_SECTIONS"] as $arSection):
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		?>
			<div class="item_1 col-sm-6 col-12" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<div class="media-old">
					<?if($arSection["PREVIEW_IMG"]):?>	
                        <div class="media-left-old js-width-trg">
                            <img src="<?=$arSection['PREVIEW_IMG']['src'];?>" alt="<?=$arSection["NAME"]?>" >
                        </div>
					<?endif;?>
					<div class="media-body-old">
						<div class="title">
							<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["~NAME"]?></a>
						</div>
						<?if($arSection["SECTIONS"] && count($arSection["SECTIONS"])>0):?>
                            <ul class="list_2 list-reset">
                                <?foreach($arSection["SECTIONS"] as $arSections):
                                    $this->AddEditAction($arSections['ID'], $arSections['EDIT_LINK'], $strSectionEdit);
                                    $this->AddDeleteAction($arSections['ID'], $arSections['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
                                <li class="item_2" id="<?=$this->GetEditAreaId($arSections['ID']); ?>">
                                    <a href="<?=$arSections["SECTION_PAGE_URL"]?>">
                                        <span class="link-text"><?=$arSections["~NAME"]?></span>
                                        <?if($arParams['COUNT_ELEMENTS'] == "Y"):?>
                                            <sup><?=$arSections["ELEMENT_CNT"]?></sup>
                                        <?endif;?>
                                    </a>
                                </li>
                                <?endforeach;?>
                            </ul>
						<?endif;?>
						<?if($arParams['DISPLAY_PREVIEW_TEXT'] == "Y" && $arSection["DESCRIPTION"]):?>
                            <div class="text">
                                <?=$arSection["~DESCRIPTION"]?>
                            </div>
						<?endif;?>
					</div>
				</div>
			</div>
	<?endforeach;?>
	</div>
</div>
<?/*/?><pre><?print_r($arResult);?></pre><?//*/?>