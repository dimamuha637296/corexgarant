<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty("ContentClass", "g-content col-md-8 col-lg-6 col-12");
$APPLICATION->SetPageProperty("HideAside", "Y");
?>

<div class="registration">
    <? if ($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) && $arParams["AUTH_RESULT"]["TYPE"] === "OK"): ?>
        <div class="alert alert-success"><? echo GetMessage("AUTH_EMAIL_SENT") ?></div>
    <? else: ?>
        <form class="form-auth" id="form-auth" name="bform" method="post" action="<?= $arResult["AUTH_URL"] ?>">
            <fieldset class="fieldset">

                <?
                if (!empty($arParams["~AUTH_RESULT"])):
                    $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                    ?>
                    <div class="alert <?= ($arParams["~AUTH_RESULT"]["TYPE"] == "OK" ? "alert-success" : "alert-danger") ?>"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
                <? endif ?>

                <? if ($arResult["USE_EMAIL_CONFIRMATION"] === "Y"): ?>
                    <div class="alert alert-warning"><? echo GetMessage("AUTH_EMAIL_WILL_BE_SENT") ?></div>
                <? endif ?>

                <? if ($arResult["BACKURL"] <> ''): ?>
                    <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
                <? endif ?>
                <input type="hidden" name="AUTH_FORM" value="Y"/>
                <input type="hidden" name="TYPE" value="REGISTRATION"/>

                <!-- row-->
                <div class="form-group control-group">
                    <label class="name col-12" for="USER_NAME"><?= GetMessage("AUTH_NAME") ?></label>
                    <div class="text col-12">
                        <input class="form-control" id="USER_NAME" type="text" name="USER_NAME" maxlength="255" value="<?= $arResult["USER_NAME"] ?>">
                    </div>
                    <div class="controls col-12"></div>
                </div>

                <!-- row-->
                <div class="form-group control-group">
                    <label class="name col-12" for="USER_LAST_NAME"><?= GetMessage("AUTH_LAST_NAME") ?></label>
                    <div class="text col-12">
                        <input class="form-control" id="USER_LAST_NAME" type="text" name="USER_LAST_NAME" maxlength="255" value="<?= $arResult["USER_LAST_NAME"] ?>">
                    </div>
                    <div class="controls col-12"></div>
                </div>
                <!-- row-->
                <div class="form-group control-group">
                    <label class="name col-12" for="USER_LOGIN"><?= GetMessage("AUTH_LOGIN_MIN") ?></label>
                    <div class="text col-12">
                        <input class="form-control" id="USER_LOGIN" type="text" name="USER_LOGIN" maxlength="255" value="<?= $arResult["USER_LOGIN"] ?>" spellcheck="true" required>
                    </div>
                    <div class="controls col-12"></div>
                </div>

                <!-- row-->
                <div class="form-group control-group">
                    <label class="name col-12" for="USER_PASSWORD"><?= GetMessage("AUTH_PASSWORD_REQ") ?></label>
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
                        <input class="form-control" id="USER_PASSWORD" type="password" name="USER_PASSWORD" value="<?= $arResult["USER_PASSWORD"] ?>" maxlength="255" autocomplete="off" required>
                    </div>
                    <div class="controls col-12"></div>
                </div>

                <!-- row-->
                <div class="form-group control-group">
                    <label class="name col-12" for="USER_CONFIRM_PASSWORD"><?= GetMessage("AUTH_CONFIRM") ?></label>
                    <div class="text col-12">
                        <input class="form-control" id="USER_CONFIRM_PASSWORD" type="password" name="USER_CONFIRM_PASSWORD" maxlength="255" value="<?= $arResult["USER_CONFIRM_PASSWORD"] ?>" autocomplete="off" required>
                    </div>
                    <div class="controls col-12"></div>
                </div>

                <!-- row-->
                <div class="form-group control-group">
                    <label class="name col-12" for="USER_EMAIL"><?= GetMessage("AUTH_EMAIL") ?></label>
                    <div class="text col-12">
                        <input class="form-control" id="USER_EMAIL" type="email" name="USER_EMAIL" maxlength="255" value="<?= $arResult["USER_EMAIL"] ?>" required>
                    </div>
                    <div class="controls col-12"></div>
                </div>

                <? if ($arResult["USER_PROPERTIES"]["SHOW"] == "Y"): ?>
                    <? foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField): ?>

                        <div class="bx-authform-formgroup-container">
                            <div class="bx-authform-label-container"><? if ($arUserField["MANDATORY"] == "Y"): ?>
                                    <span class="bx-authform-starrequired">*
                                    </span><? endif ?><?= $arUserField["EDIT_FORM_LABEL"] ?></div>
                            <div class="bx-authform-input-container">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:system.field.edit",
                                    $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                    array(
                                        "bVarsFromForm" => $arResult["bVarsFromForm"],
                                        "arUserField" => $arUserField,
                                        "form_name" => "bform"
                                    ),
                                    null,
                                    array("HIDE_ICONS" => "Y")
                                );
                                ?>
                            </div>
                        </div>

                    <? endforeach; ?>
                <? endif; ?>

                <? if ($arResult["USE_CAPTCHA"] == "Y"): ?>
                    <!-- row-->
                    <div class="form-group control-group">
                        <label class="name col-12" for="AUTH_CAPTCHA_PROMT">
                            <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                            <?= GetMessage("CAPTCHA_REGF_PROMT") ?>:
                        </label>
                        <div class="text col-12">
                            <div class="captcha_img">
                                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" alt="CAPTCHA" width="180" height="40">
                            </div>
                            <input class="form-control" id="AUTH_CAPTCHA_PROMT" type="text" name="captcha_word" maxlength="50" value="" size="15">
                        </div>
                        <div class="controls col-12"></div>
                    </div>
                <? endif ?>

                <!-- row-->
                <div class="form-group">
                    <div class="col-12 reg-row">
                        <input class="btn btn-primary btn_submit" name="Login" type="submit" value="<?= GetMessage("AUTH_REGISTER") ?>">
                        <div class="form_required">
                            <a href="<?= $arResult["AUTH_AUTH_URL"] ?>" rel="nofollow"><?=GetMessage('AUTH_AUTH')?></a>
                        </div>
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
                                    required: true
                                },
                                'USER_PASSWORD': {
                                    required: true
                                },
                                'USER_CONFIRM_PASSWORD': {
                                    required: true
                                },
                                'USER_EMAIL': {
                                    required: true,
                                    email: true
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
            document.bform.USER_NAME.focus();
        </script>
    <? endif ?>
</div>