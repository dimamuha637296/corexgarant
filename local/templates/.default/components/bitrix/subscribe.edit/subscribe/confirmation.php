<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//*************************************
//show confirmation form
//*************************************
?>
<form class="form-horizontal" id="form-subscript-confirm2" method="post" action="<?=$arResult["FORM_ACTION"]?>">
    <fieldset class="fieldset">
        <div class="title h3"><?echo GetMessage("subscr_title_confirm")?></div>
        <div class="form-group control-group">
            <div class="col-sm-7 col-12">
                <label class="name" for="form-CODE"><?echo GetMessage("subscr_conf_code")?><span class="f-star">&nbsp;*</span>
                </label>
                <div class="text">
                    <input class="form-control" id="form-CODE" type="text" name="CONFIRM_CODE" maxlength="50" spellcheck="true" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" required="">
                    <div class="controls col-12"></div>
                </div>
                <p><?echo GetMessage("subscr_conf_date")?></p>
                <p><?echo $arResult["SUBSCRIPTION"]["DATE_CONFIRM"];?></p>
            </div>
            <div class="text col-sm-5 col-12">
                <p class="small"><?echo GetMessage("subscr_conf_note1")?> <a href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
                </p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-12">
                <input class="btn btn-primary btn_submit" name="submit" type="submit" value="<?echo GetMessage("subscr_conf_button")?>">
            </div>
            <div class="col-12 form_required"><span class="f-star">&nbsp;*</span>— <?=GetMessage('subscr_req')?>
            </div>
        </div>
    </fieldset>
    <input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
    <?echo bitrix_sessid_post();?>
    <script>
        !function () {
            'use strict';

            // Form validation
            function initValid() {
                // Validation options http://jqueryvalidation.org/documentation/
                var form_validator = $('#form-subscript-confirm');
                if (form_validator.length && $.fn.validate) {
                    form_validator.validate({
                        rules: {
                            'form-CODE': {
                                required: true,
                                minlength: 2
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