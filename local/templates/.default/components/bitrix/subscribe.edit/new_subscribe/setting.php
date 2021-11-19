<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$countRubr = count($arResult["RUBRICS"]);
?>

<form id="form-subscript-settings" role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>" class="form-horizontal">
	<?echo bitrix_sessid_post();?>
	<fieldset class="fieldset">
		<div class="title h3"><?=GetMessage("subscr_title_settings")?></div>
		<div class="form-group control-group">
			<div class="col-sm-7 col-12">
				<label for="form-EMAIL" class="name"><?=GetMessage("subscr_email")?><span class="f-star"> *</span></label>
				<div class="text">
					<input id="sub-mail" type="text" class="form-control" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" /></p>
					<div class="controls col-12"></div>
				</div>
				<span <?=($countRubr == '1'?'class="hide"':"")?>>
				<p><?=GetMessage("subscr_rub")?><span class="f-star"> *</span></p>
				<p>
					<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
						<label><input <?=($countRubr == '1'?"checked":"")?> type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
							<?=$itemValue["NAME"]?></label>
					<?endforeach;?></p>
					</p>
				</span>
			</div>
			<div class="text col-sm-5 col-12">
				<p class="small"><?=GetMessage("subscr_settings_note1")?></p>
				<p class="small"><?=GetMessage("subscr_settings_note2")?></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-12">
				<input type="submit" class="btn btn-default btn_submi" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
				<input id="sub-reset" type="reset" class="btn btn-default btn_submi" value="<?echo GetMessage("subscr_reset")?>" name="reset" />
			</div>
			<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
			<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
			<div class="col-12 form_required"><span class="f-star"> *</span> &mdash; <?=GetMessage(subscr_req)?></div>
		</div>
	</fieldset>
	<?if($_REQUEST["register"] == "YES"):?>
		<input type="hidden" name="register" value="YES" />
	<?endif;?>
	<?if($_REQUEST["authorize"]=="YES"):?>
		<input type="hidden" name="authorize" value="YES" />
	<?endif;?>
</form>

<script>
	$('#sub-reset').on('click', function () {
		$('#sub-mail').attr('value', '');
	});
</script>