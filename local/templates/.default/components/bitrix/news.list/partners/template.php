<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;
if($arParams['TILED_VIEW'] == 'Y'){
	$tiled = true; 
}
?>
<?foreach($arResult["SECTIONS"] as $key => $arSection):?>
<div class="partners-<?=($tiled? "list": "detail ")?> js-<?=($tiled? "height": "width")?>">
	<?if($arSection['NAME']):?>
		<div class="h2"><?=$arSection['NAME']?></div>
	<?endif;?>
	<?if($arSection['DESCRIPTION']):?>
		<div class="descr ">
			<?=$arSection['DESCRIPTION']?>
		</div>
	<?endif;?>
	<?if($tiled):?>
		<div class="row row-clear">
	<?endif;?>
	<?foreach ($arSection['ITEMS'] as $key => $arElement):
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));
		$bHasPicture = is_array($arElement['PREVIEW_IMG']);
			if(strlen($arElement['PROPERTIES']['HREF']['VALUE']) > 0){
				$tp_link = 'http://';
				$link = trim($arElement['PROPERTIES']['HREF']['VALUE']);
				if(strstr($link , 'http://') !==false){
					$link = substr($link, 7);
				}elseif(strstr($link , 'https://') !==false){
					$link = substr($link, 8);
					$tp_link = 'https://';
				}else{
					$link = $link;
				}
				$href = true;
			}else{
				$link = '';
				$tp_link = '';
			}
			?>
		<div class="item <?=($tiled? "col-md-4 col-sm-6 col-12": "")?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
			<?if(!$tiled):?>
				<div class="item_i" >
			<?endif;?>
				<?if($arParams["DISPLAY_PICTURE"]!="N" && $bHasPicture):?>

						<div class="pic js-<?=($tiled? "trg": "width-trg")?>" >
							 <?if($strlenHref = strlen($arElement['PROPERTIES']['HREF']['VALUE']) > 0):?><a href="<?=$tp_link.$link ?>" target="_blank"><?endif;?>
								<img src="<?echo $arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['DETAIL_PICTURE']['ALT']?>" title="<?=$arElement['DETAIL_PICTURE']['TITLE']?>" >
							 <?if($strlenHref = strlen($arElement['PROPERTIES']['HREF']['VALUE']) > 0):?></a><?endif;?>
						</div>
				<?endif;?>
				<div class="wrap break-word" id="element-<?=$arElement['ID']?>">
					<?if($arParams["DISPLAY_NAME"]!="N" && $arElement["NAME"]):?>
						<div class="title"><?=$arElement["NAME"]?></div>
					<?endif;?>
					<?if(($arElement["DETAIL_TEXT"] || $link) && $arParams["DISPLAY_PREVIEW_TEXT"]!="N"):?>
						<div class="text">
							<?if($link):?>
							    <a href="<?=$tp_link.$link ?>" target="_blank"><?=$link?><i class="icon ic-blank"></i></a><br />
							<?endif;?>
							<?if($arElement['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arElement["~DETAIL_TEXT"]?><?else:?><p><?=$arElement["~DETAIL_TEXT"]?></p><?endif;?>
						</div>
					<?endif;?>
				</div>
			<?if(!$tiled):?>
			</div>
			<?endif;?>
		</div>
	<?endforeach;?>
	<?if($tiled):?>
		</div>
	<?endif;?>
	
	

</div>
<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>