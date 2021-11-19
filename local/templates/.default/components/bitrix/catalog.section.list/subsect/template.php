<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
// change 29/01/2014 Shevchik 404
if($arResult['SECTION']['ID'] == 0 && $arParams['SHOW_SECTIONS'] == 'Y' && $arResult['SECTIONS_COUNT'] < 1){
	@define("ERROR_404","Y");
}
//-- change
	CModule::IncludeModule("db.base");
	$cntSections = count($arResult["SECTIONS"]);
///////////////// not TOP level ///////////////////////

if( $cntSections > 0):
///////////////// show list of section ///////////////////////
?>
<div class="b-filter-catalog">
	<div class="row"><?
	$i = 0;
	foreach($arResult["SECTIONS"] as $arSection):
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		
		$arSection["PREVIEW_IMG"] = CFile::ResizeImageGet(
				$arSection["PICTURE"],
				array("width" => $arParams["DISPLAY_SECTION_IMG_WIDTH"], "height" => $arParams["DISPLAY_SECTION_IMG_HEIGHT"]),
				$arParams["TYPE_IMG_THUMB"],
				true
		);

		$bHasPicture = is_array($arSection['PREVIEW_IMG']);?>
			<section class="col-md-5 col-lg-5 col-sm-5 col-5 item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>">				
					<?if($bHasPicture):?>	
						<div class="picture">
							<img src="<?=$arSection['PREVIEW_IMG']['src'];?>" width="<?=$arSection['PREVIEW_IMG']['WIDTH']?>" alt="<?=$arSection['PREVIEW_IMG']['ALT']?>" >
						</div>
					<?endif;?>
					<div class="title-pic"><?=$arSection["NAME"]?></div>
				</a>
			</section>
	<?endforeach;?>
	</div>
</div>
<?endif;?>
<?/*/?><pre><?print_r($arParams);?></pre><?//*/?>