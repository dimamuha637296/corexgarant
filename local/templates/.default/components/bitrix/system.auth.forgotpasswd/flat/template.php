<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$APPLICATION->SetPageProperty("ContentClass", "g-content col-md-8 col-lg-6 col-12");
$APPLICATION->SetPageProperty("HideAside", "Y");
?>

<div class="forgot-password">

    <div class="h3"><?= GetMessage("AUTH_GET_CHECK_STRING") ?></div>
    <p class="text"><?= GetMessage("AUTH_FORGOT_PASSWORD_1") ?></p>
    <form class="form-1" id="form-forgot_password" name="form_forgot-pwd" method="post" target="_top" action="<?= $arResult["AUTH_URL"] ?>">
        <fieldset class="fieldset">

            <?
            if (!empty($arParams["~AUTH_RESULT"])):
                $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
                ?>
                <div class="alert <?= ($arParams["~AUTH_RESULT"]["TYPE"] == "OK" ? "alert-success" : "alert-danger") ?>"><?= nl2br(htmlspecialcharsbx($text)) ?></div>
            <? endif ?>

            <? if ($arResult["BACKURL"] <> ''): ?>
                <input type="hidden" name="backurl" value="<?= $arResult["BACKURL"] ?>"/>
            <? endif ?>
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="SEND_PWD">

            <!-- row-->
            <div class="form-group control-group">
                <label class="name col-12" for="USER_LOGIN"><? echo GetMessage("AUTH_LOGIN_EMAIL") ?></label>
                <div class="col-12">
                    <input class="form-control" id="USER_LOGIN" type="text" name="USER_LOGIN" maxlength="255" value="<?= $arResult["LAST_LOGIN"] ?>" required>
                    <input type="hidden" name="USER_EMAIL"/>
                </div>
                <div class="controls col-12"></div>
            </div>

            <!-- row-->
            <div class="form-group">
                <div class="col-12 btn-wrap">
                    <input class="btn btn-primary btn_submit" name="send_account_info" type="submit" value="<?= GetMessage("AUTH_SEND") ?>">
                    <div class="form_required-wrap">
                        <div class="form_required">
                            <a href="<?= $arResult["AUTH_AUTH_URL"] ?>" rel="nofollow"><?= GetMessage("AUTH_AUTH") ?></a>
                        </div>
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
                var form_validator = $('#form-forgot_password');
                if (form_validator.length && $.fn.validate) {
                    form_validator.validate({
                        rules: {
                            'USER_LOGIN': {
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
    <script>
        document.bform.onsubmit = function () {
            document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;
        };
        document.bform.USER_LOGIN.focus();
    </script>
</div>
