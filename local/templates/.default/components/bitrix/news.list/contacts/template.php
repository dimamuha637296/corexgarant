<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;
if($arParams['COLUM'] > 2){
	$bHasTableTemplate = true;
}
$arParams['COLUM'] = $arParams['COLUM'] ? $arParams['COLUM'] : 2;
$columnMax = 12;
$columnCNT = floor($columnMax/$arParams['COLUM']);
?>
<div class="contacts">
	<?foreach($arResult["SECTIONS"] as $key => $arSection):?>
		<?if($arSection['NAME']):?>
			<div class="h2 title"><?=$arSection['NAME']?></div>
		<?endif;?>
		<div class="cont-table div-table">
			<div class="tbody">
				<?foreach ($arSection['ITEMS'] as $key => $arElement):
					$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
					$bHasPicture = is_array($arElement['PREVIEW_IMG']);?>
					<div class="tr" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
						<div class="td">
							<b><?=$arElement["NAME"]?></b>
							<?if(strlen($arElement["PROPERTIES"]["POST"]["VALUE"])>0):?>
								<div class="caption-text">
									<?=$arElement["PROPERTIES"]["POST"]["VALUE"]?>
								</div>
							<?endif;?>
						</div>
						<div class="td">
						<?if($arElement["PROPERTIES"]["CONTACT_1"]["VALUE"]):?>
							<?=$arElement["PROPERTIES"]["CONTACT_1"]["~VALUE"]["TEXT"]?>
						<?endif;?>
						</div>
						<div class="td">
							<?if($arElement["PROPERTIES"]["CONTACT_2"]["VALUE"]):?>
								<?=$arElement["PROPERTIES"]["CONTACT_2"]["~VALUE"]["TEXT"]?>
							<?endif;?>
						</div>
						
					</div>
				<?endforeach;?>
			</div>
		</div>
	<?endforeach;?>
</div>
<?//pr($arResult["SECTIONS"]);?>