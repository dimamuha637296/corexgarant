<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty("ContentClass", "g-content col-md-8 col-lg-6 col-12");
$APPLICATION->SetPageProperty("HideAside", "Y");
?>
<div class="auth">

    <? if ($arResult["AUTH_SERVICES"]): ?>
        <?
        $APPLICATION->IncludeComponent("bitrix:socserv.auth.form",
            "flat",
            array(
                "AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
                "AUTH_URL" => $arResult["AUTH_URL"],
                "POST" => $arResult["POST"],
            ),
            $component,
            array("HIDE_ICONS" => "Y")
        );
        ?>
        <hr class="bxe-light">
    <? endif ?>

    <form class="form-1" id="form-auth" name="form_auth" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
        <fieldset class="fieldset">

            <input type="hidden" name="AUTH_FORM" value="Y"/>
            <input type="hidden" name="TYPE" value="AUTH"/>
            <? if (strlen($arResult["BACKURL"]) > 0): ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <? endif ?>
            <? foreach ($arResult["POST"] as $key => $value): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
            <? endforeach ?>

            <?
            if (!empty($arParams["~AUTH_RESULT"])):
                $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                ?>
                <div class="alert alert-danger"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
            <? endif ?>

            <?
            if ($arResult['ERROR_MESSAGE'] <> ''):
                $text = str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE']);
                ?>
                <div class="alert alert-danger"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
            <? endif ?>

            <!-- row-->
            <div class="form-group control-group">
                <label class="name col-12" for="USER_LOGIN"><?= GetMessage("AUTH_LOGIN") ?></label>
                <div class="text col-12">
                    <input class="form-control" id="USER_LOGIN" type="text" name="USER_LOGIN" maxlength="255" value="<?= $arResult["LAST_LOGIN"] ?>" spellcheck="true" required>
                </div>
                <div class="controls col-12"></div>
            </div>

            <!-- row-->
            <div class="form-group control-group">
                <label class="name col-12" for="USER_PASSWORD"><?= GetMessage("AUTH_PASSWORD") ?></label>
                <? if ($arResult["SECURE_AUTH"]): ?>
                    <div class="bx-authform-psw-protected col-12" id="bx_auth_secure" style="display:none;margin-bottom: 10px;">
                        <div class="bx-authform-psw-protected-desc">
                            <span></span><? echo GetMessage("AUTH_SECURE_NOTE") ?></div>
                    </div>
                    <script>
                        document.getElementById('bx_auth_secure').style.display = '';
                    </script>
                <? endif ?>
                <div class="text col-12">
                    <input class="form-control" id="USER_PASSWORD" type="password" name="USER_PASSWORD" maxlength="255" value="" required="">
                </div>
                <div class="controls col-12"></div>
            </div>

            <!-- row-->
            <? if ($arResult["CAPTCHA_CODE"]): ?>
                <div class="form-group control-group">
                    <label class="name col-12" for="AUTH_CAPTCHA_PROMT">
                        <input class="form-control" type="hidden" name="captcha_sid" value="<? echo $arResult["CAPTCHA_CODE"] ?>"/>
                        <? echo GetMessage("AUTH_CAPTCHA_PROMT") ?>
                    </label>
                    <div class="text col-12">
                        <div class="captcha_img">
                            <img src="/bitrix/tools/captcha.php?captcha_sid=<? echo $arResult["CAPTCHA_CODE"] ?>" alt="CAPTCHA" width="180" height="40">
                        </div>
                        <input class="form-control" id="AUTH_CAPTCHA_PROMT" type="text" name="captcha_word" maxlength="50" value="" size="15">
                    </div>
                    <div class="controls col-12"></div>
                </div>
            <? endif; ?>

            <!-- row-->
            <? if ($arResult["STORE_PASSWORD"] == "Y"): ?>
                <div class="form-group">
                    <div class="col-12">
                        <div class="checkbox">
                            <label>
                                <input class="ui-checkbox" id="USER_REMEMBER" type="checkbox" name="USER_REMEMBER" value="Y">
                                <span><?= GetMessage("AUTH_REMEMBER_ME") ?></span>
                            </label>
                        </div>
                    </div>
                </div>
            <? endif; ?>

            <!-- row-->
            <div class="form-group">
                <div class="col-12 btn-wrap">
                    <input class="btn btn-primary btn_submit" name="Login" type="submit" value="<?= GetMessage("AUTH_AUTHORIZE") ?>">
                    <!--<noindex>-->
                    <div class="form_required-wrap">
                        <? if ($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"): ?>
                            <div class="form_required">
                                <a href="<?= $arResult["AUTH_REGISTER_URL"] ?>" rel="nofollow">
                                    <?= GetMessage("AUTH_REGISTER") ?>
                                </a>
                            </div>
                        <? endif ?>
                        <? if ($arParams["NOT_SHOW_LINKS"] != "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"): ?>
                            <div class="form_required forgot-password">
                                <a href="<?= $arResult["AUTH_FORGOT_PASSWORD_URL"] ?>" rel="nofollow"><?= GetMessage("AUTH_FORGOT_PASSWORD_2") ?></a>
                            </div>
                        <? endif ?>
                    </div>
                    <!--</noindex>-->
                </div>
            </div>
        </fieldset>
    </form>
    <script>
        !function () {
            'use strict';

            // Form validation
            function initValid() {
                // Validation options http://jqueryvalidation.org/documentation/
                var form_validator = $('#form-auth');
                if (form_validator.length && $.fn.validate) {
                    form_validator.validate({
                        rules: {
                            'USER_LOGIN': {
                                required: true,
                                minlength: 2
                            },
                            'USER_PASSWORD': {
                                required: true
                            }
                            <? if ($arResult["USE_CAPTCHA"] == "Y"): ?>
                            ,'captcha_word': {
                                required: true
                            }
                            <? endif ?>
                        }
                    });
                }
            }

            $(function () {
                initValid();
            });
        }();
    </script>
    <script>
        <?if (strlen($arResult["LAST_LOGIN"]) > 0):?>
        try {
            document.form_auth.USER_PASSWORD.focus();
        } catch (e) {
        }
        <?else:?>
        try {
            document.form_auth.USER_LOGIN.focus();
        } catch (e) {
        }
        <?endif?>
    </script>
</div>

