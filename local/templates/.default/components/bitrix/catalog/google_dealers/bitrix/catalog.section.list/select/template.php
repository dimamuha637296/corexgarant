<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<? //pr($arResult);?>
<? //pr($arParams);?>
	<div class="b-region country-select">
		<select class="b-select" name="region" data-placeholder="<?=GetMessage('CATALOG_T_COUNTRY')?>" onchange="javascript:window.location = this.value">
			<option value=""></option>
			<?foreach($arResult["SECTIONS"] as $key => $arSection):?>
				<option
					<?if($arSection["CODE"] == $arParams['SECTION_CODE_CUR']):?>selected<?$subKey=(is_array($arSection["SUB_SECTION"])? $key : false);?><?endif;?>
					value="<?=$arSection["SECTION_PAGE_URL"]?>">
					<?=$arSection["NAME"]?>
				</option>
			<?endforeach;?>
		</select>
		<i class="arr"></i>
	</div>
<?if(isset($subKey) && $subKey !== false):?>
	<div class="b-region region">
		<select class="b-select" name="region" data-placeholder="<?=GetMessage('CATALOG_T_REGION')?>" onchange="javascript:window.location = this.value">
			<option value=""></option>
			<?foreach($arResult["SECTIONS"][$subKey]["SUB_SECTION"] as $arSubSection):?>
				<option
					<?if($arSubSection["CODE"] == $arParams['SECTION_CODE_CUR']):?>
						selected
					<?endif;?>
					value="<?=$arSubSection["SECTION_PAGE_URL"]?>">
					<?=$arSubSection["NAME"]?>
				</option>
			<?endforeach;?>
		</select>
		<i class="arr"></i>
	</div>
<?endif;?>
