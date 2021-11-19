<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//*************************************
//show confirmation form
//*************************************
?>

<form id="form-subscript-confirm" role="form" method="post" action="<?=$arResult["FORM_ACTION"]?>" class="form-horizontal">
	<fieldset class="fieldset">

		<div class="title h3"><?=GetMessage("subscr_title_confirm")?></div>
		<div class="form-group control-group">
			<div class="col-sm-7 col-12">
				<div class="row">
					<div class="col-12">
						<label for="form-CODE" class="name"><?=GetMessage("subscr_conf_code")?><span class="f-star"> *</span></label>
					</div>
					<div class="col-12">
						<div class="text">
							<input type="text" class="form-control" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" />
						</div>
					</div>
					<div class="col-12 mt_1">
						<p><?=GetMessage("subscr_conf_date")?></p>
						<p><?echo $arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?></p>
					</div>
				</div>
			</div>
			<div class="text col-sm-5 col-12">
				<p class="small">
					<?=GetMessage("subscr_conf_note1")?><a href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"> <?=GetMessage("subscr_conf_note2")?></a>
				</p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-12">
				<input type="submit" name="submit" value="<?=GetMessage("subscr_conf_button")?>" class="btn btn-default btn_submit">
			</div>
			<?/*?>
			<div class="col-12 form_required"><span class="f-star"> *</span> &mdash; <?=GetMessage("subscr_req")?></div>
			<?//*/?>
		</div>
	</fieldset>

	<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
	<?echo bitrix_sessid_post();?>
</form>
