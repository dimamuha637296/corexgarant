<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//******************************************
//subscription authorization form
//******************************************
?>
<h3><?echo GetMessage("subscr_auth_sect_title")?></h3>
<form class="form-horizontal" method="post" action="<?echo $arResult["FORM_ACTION"].($_SERVER["QUERY_STRING"]<>""? "?".htmlspecialcharsbx($_SERVER["QUERY_STRING"]):"")?>">
    <fieldset class="fieldset">
        <div class="form-group control-group">
            <div class="col-sm-7 col-12">
                <label class="name" for="sf_EMAIL">e-mail</label>
                <div class="text">
                    <input class="form-control" id="sf_EMAIL" type="text" name="sf_EMAIL" maxlength="50" value="<?echo $arResult["REQUEST"]["EMAIL"];?>" required="" title="<?echo GetMessage("subscr_auth_email")?>">
                    <div class="controls col-12"></div>
                </div>
                <label class="name" for="AUTH_PASS"><?echo GetMessage("subscr_auth_pass")?></label>
                <div class="text">
                    <input class="form-control" id="AUTH_PASS" type="text" name="AUTH_PASS" maxlength="50" value="" required="" title="<?echo GetMessage("subscr_auth_email")?>">
                    <div class="controls col-12"></div>
                </div>
            </div>
            <div class="text col-sm-5 col-12">
                <p class="small"><?echo GetMessage("adm_auth_note")?></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-12">
                <input class="btn btn-primary btn_submit" name="autorize" type="submit" value="<?echo GetMessage("adm_auth_butt")?>">
            </div>
            <input type="hidden" name="action" value="authorize" />
            <?echo bitrix_sessid_post();?>
        </div>
    </fieldset>
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
                            'sf_EMAIL': {
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


<h3><?echo GetMessage("subscr_pass_title")?></h3>
<form class="form-horizontal" method="post" action="<?=$arResult["FORM_ACTION"]?>">
    <fieldset class="fieldset">
        <div class="form-group control-group">
            <div class="col-sm-7 col-12">
                <label class="name" for="sf_EMAIL">e-mail</label>
                <div class="text">
                    <input class="form-control" id="sf_EMAIL" type="text" name="sf_EMAIL" maxlength="50" value="<?echo $arResult["REQUEST"]["EMAIL"];?>" required="" title="<?echo GetMessage("subscr_auth_email")?>">
                    <div class="controls col-12"></div>
                </div>
            </div>
            <div class="text col-sm-5 col-12">
                <p class="small"><?echo GetMessage("subscr_pass_note")?></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-12">
                <input class="btn btn-primary btn_submit" name="sendpassword" type="submit" value="<?echo GetMessage("subscr_pass_button")?>">
            </div>
            <input type="hidden" name="action" value="sendpassword" />
            <?echo bitrix_sessid_post();?>
        </div>
    </fieldset>
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
                            'sf_EMAIL': {
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