<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?
foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
foreach($arResult["ERROR"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));

if($arResult["ALLOW_ANONYMOUS"]=="N" && !$USER->IsAuthorized()):
	echo ShowMessage(array("MESSAGE"=>GetMessage("CT_BSE_AUTH_ERR"), "TYPE"=>"ERROR"));
else:
?>
<div class="subscription">
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post" class="b-form">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
	<input type="hidden" name="RUB_ID[]" value="0" />

	<div class="subscription-title">
		<b class="r2"></b><b class="r1"></b><b class="r0"></b>
		<div class="subscription-title-inner"><?echo GetMessage("CT_BSE_SUBSCRIPTION_FORM_TITLE")?></div>
	</div>

	<div class="subscription-form table-responsive">

		<table cellspacing="0" class="subscription-layout">
			<tr>
				<td class="field-name"><?echo GetMessage("CT_BSE_EMAIL_LABEL")?></td>
				<td class="field-form">
                    <div class="b-field subscription-utility" >
                        <input class="text" type="email" name="EMAIL" value="<?echo
                        $arResult["SUBSCRIPTION"]["EMAIL"]!=""? $arResult["SUBSCRIPTION"]["EMAIL"]: $arResult["REQUEST"]["EMAIL"];?>" />
                        <?/*/?>
                        <div class="subscription-format b-radio">
                            <span><? echo GetMessage("CT_BSE_FORMAT_LABEL") ?></span>&nbsp;
                            <label class="label" for="MAIL_TYPE_TEXT">
                                <input class="radio" type="radio" name="FORMAT" id="MAIL_TYPE_TEXT" value="text" <? if
                                ($arResult["SUBSCRIPTION"]["FORMAT"] != "html") echo "checked" ?> />
                                <b></b>
                                <span><? echo GetMessage("CT_BSE_FORMAT_TEXT") ?></span>
                            </label>&nbsp;
                            <label class="label" for="MAIL_TYPE_HTML">
                                <input class="radio" type="radio" name="FORMAT" id="MAIL_TYPE_HTML" value="html" <? if
                                ($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo "checked" ?> />
                                <b></b>
                                <span><? echo GetMessage("CT_BSE_FORMAT_HTML") ?></span>
                            </label>
                        </div>
                        <?//*/?>
                    </div>
				</td>
			</tr>
            <?//*/?>
			<tr>
				<td class="field-name"><?echo GetMessage("CT_BSE_RUBRIC_LABEL")?></td>
				<td class="field-form">
                    <?$coutRubr = count($arResult["RUBRICS"]);?>
					<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
						<div class="subscription-rubric b-checkbox">
                            <label class="label" for="RUBRIC_<?echo $itemID?>">
                                <input <?=($coutRubr == 1?"checked":"")?> id="RUBRIC_<?echo $itemID?>" class="cb" type="checkbox" name="RUB_ID[]"
                                       value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
                                <b></b>
                                <span><?echo $itemValue["NAME"]?><?echo $itemValue["DESCRIPTION"]?></span>
                            </label>
						</div>
					<?endforeach;?>

					<?if($arResult["ID"]==0):?>
						<div class="subscription-notes"><?echo GetMessage("CT_BSE_NEW_NOTE")?></div>
					<?else:?>
						<div class="subscription-notes"><?echo GetMessage("CT_BSE_EXIST_NOTE")?></div>
					<?endif?>
					<div class="subscription-buttons">
							<div class="button">
								<input type="submit" class="btn btn-danger btn-xs" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("CT_BSE_BTN_EDIT_SUBSCRIPTION"): GetMessage("CT_BSE_BTN_ADD_SUBSCRIPTION"))?>" /><i></i>
							</div>
					</div>
				</td>
			</tr>
		</table>
	</div>

	<?if($arResult["ID"]>0 && $arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"):?>
	<div class="subscription-utility">
		<p><?echo GetMessage("CT_BSE_CONF_NOTE")?></p>
		<input name="CONFIRM_CODE" type="text" class="text" value="" placeholder="<?echo GetMessage("CT_BSE_CONFIRMATION")?>" />
		<br /><br />
		<div class="subscription-buttons">
				<div class="button">
					<input type="submit" class="btn btn-danger btn-xs" name="confirm" value="<?echo GetMessage
                    ("CT_BSE_BTN_CONF")?>" /><i></i>
				</div>
		</div>
	</div>
	<?endif?>

	</form>
	<?if(!CSubscription::IsAuthorized($arResult["ID"])):?>
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post" class="b-form">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="action" value="sendcode" />

	<div class="subscription-utility">
		<p><?echo GetMessage("CT_BSE_SEND_NOTE")?></p>
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <input class="text" name="sf_EMAIL" type="text"  placeholder="<?echo GetMessage("CT_BSE_CONFIRMATION") ?>" />
            </div>
        </div>
		<div class="subscription-buttons">
				<div class="button">
					<input type="submit" class="btn btn-danger btn-sm" value="<?echo GetMessage("CT_BSE_BTN_SEND")?>" /><i></i>
				</div>
		</div>
	</div>
	</form>
	<?endif?>

</div>
<?endif;?>