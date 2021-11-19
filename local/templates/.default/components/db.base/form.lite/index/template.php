<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>
<div class="contact-form-2">
    <div id="<?= $arParams['FORM_ID'] ?>_modal">

        <div class="modal__state--form">
            <form id="<?=$arParams['FORM_ID']?>" method="post" action="<?=$APPLICATION->getCurDir()?>">
                <fieldset class="fieldset">
                    <div class="form-group">
                        <div class="text col-12 control-group dropdown-valid">
                            <div class="input-wrap">
                                <input class="form-control" type="text" name="FIO" required="" placeholder="<?=GetMessage('DB_FIO')?>">
                                <div class="error-drop">
                                    <button class="error-icon" data-toggle="dropdown">?</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="controls"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text col-12 col-sm-6 control-group dropdown-valid">
                            <div class="input-wrap">
                                <input class="form-control js_mask_tel" type="tel" name="PHONE" required="" placeholder="<?=GetMessage('DB_PHONE')?>">
                                <div class="error-drop">
                                    <button class="error-icon" data-toggle="dropdown">?</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="controls"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text col-12 col-sm-6 control-group dropdown-valid">
                            <div class="input-wrap">
                                <input class="form-control" type="email" name="EMAIL" required="" placeholder="<?=GetMessage('DB_EMAIL')?>">
                                <div class="error-drop">
                                    <button class="error-icon" data-toggle="dropdown">?</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="controls"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text col-12 control-group dropdown-valid">
                            <div class="input-wrap">
                                <textarea class="form-control" name="MESSAGE" placeholder="<?=GetMessage('DB_MESSAGE')?>" maxlength="500" rows="3" cols="60"></textarea>
                                <div class="error-drop">
                                    <button class="error-icon" data-toggle="dropdown">?</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="controls"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <input class="btn btn-primary btn_submit" id="submit_<?=$arParams['FORM_ID']?>" name="submit" type="submit" value="<?=(strlen($arParams["BTN_TITLE"]) > 0 ? $arParams["BTN_TITLE"] : GetMessage("MFT_SUBMIT"));?>">
                            <input class="form-control" name="COMPANY_NAME_Z" placeholder="<?=GetMessage("MFT_FAKE")?>" autocomplete="off" required="">
                        </div>
                    </div>
                </fieldset>
                <script>
                    !function () {
                        'use strict';

                        $(function () {
                            (new ModalForm({
                                formID: '<?=$arParams['FORM_ID']?>',
                                action: '<?=$arParams['FORM_ACTION']?>',
                                globalName: '<?=$arParams['FORM_ID']?>',
                                btn: '#submit_<?=$arParams['FORM_ID']?>',
                                arrCode: {},
                                rules: {
                                    'FIO': {
                                        required: true,
                                        minlength: 2
                                    },
                                    'PHONE': {
                                        required: true,
                                        minlength: 2
                                    },
                                    'EMAIL': {
                                        required: true,
                                        minlength: 2
                                    },
                                    'MESSAGE': {
                                        minlength: 5
                                    },
                                    'COMPANY_NAME_Z': {
                                        required: false
                                    }
                                }
                            })).initValid();
                        });
                    }();
                </script>
            </form>
        </div>
        <?$APPLICATION->IncludeFile(
            SITE_DIR.'local/include/forms/states_page.php',
            Array(),
            Array("MODE"=>"text", "SHOW_BORDER" => false, "NAME" => "Текст", 'TEMPLATE' => 'default.php')
        );?>
        <div class="preloader" id="<?=$arParams['FORM_ID']?>-preloader-1">
            <div class="preloader__spinner sm"></div>
        </div>
    </div>
</div>