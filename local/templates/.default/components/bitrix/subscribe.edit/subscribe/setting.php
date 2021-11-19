<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//***********************************
//setting section
//***********************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="post" class="form-horizontal">
<?echo bitrix_sessid_post();?>
    <fieldset class="fieldset">
        <div class="title h3"><?=GetMessage("subscr_title_settings")?></div>
        <div class="form-group control-group">
            <div class="col-sm-7 col-12">
                <label class="name" for="form-EMAIL"><?echo GetMessage("subscr_email")?><span class="f-star">&nbsp;*</span>
                </label>
                <div class="text">
                    <input class="form-control" id="form-EMAIL" type="text" name="EMAIL" maxlength="255" spellcheck="true" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" required="">
                    <div class="controls col-12"></div>
                </div>
                <div class="text"><?=GetMessage("subscr_rub")?><span class="f-star">&nbsp;*</span>
                </div>
                <div class="text">
                    <div class="checkbox">
                        <?$countRubr = count($arResult["RUBRICS"]);?>
                        <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                            <label>
                                <input class="ui-checkbox" id="RUB_ID"<?=($countRubr == '1'?' checked="checked"':"")?> type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?><?if($itemValue["CHECKED"]) echo ' checked="checked"'?>"><span><?=$itemValue["NAME"]?></span>
                            </label>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
            <div class="text col-sm-5 col-12">
                <p class="small"><?=GetMessage('subscr_settings_note1')?></p>
                <p class="small"><?=GetMessage('subscr_settings_note2')?></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-12">
                <input class="btn btn-primary btn_submit" name="Save" type="submit" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>">
                <input class="btn btn-primary btn_submit" type="reset" name="submit" value="<?echo GetMessage("subscr_reset")?>">
            </div>
            <div class="col-12 form_required"><span class="f-star">&nbsp;*</span>— <?=GetMessage('subscr_req')?>
        </div>
        <input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
        <input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
        <?if($_REQUEST["register"] == "YES"):?>
            <input type="hidden" name="register" value="YES" />
        <?endif;?>
        <?if($_REQUEST["authorize"]=="YES"):?>
            <input type="hidden" name="authorize" value="YES" />
        <?endif;?>
    </fieldset>
    <script>
        !function () {
            'use strict';

            // Form validation
            function initValid() {
                // Validation options http://jqueryvalidation.org/documentation/
                var form_validator = $('#form-subscript-settings');
                if (form_validator.length && $.fn.validate) {
                    form_validator.validate({
                        rules: {
                            'form-EMAIL': {
                                required: true
                            }
                        }
                    });
                }
            }

            $(function () {
                initValid();
            });
        }();
    </script>
</form>