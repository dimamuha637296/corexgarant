<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);
?>
<div class="contact-us-modal modal fade" id="faq-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="<?=$arParams['FORM_ID']?>_modal">
            <div class="modal__state--form">
                <div class="modal-header">
                    <div class="h2 modal-title"><?=$arParams['FORM_TITLE']?></div>
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="contact-us-form form-2-dropdown" id="<?=$arParams['FORM_ID']?>" method="post" action="<?=$APPLICATION->getCurDir()?>">
                        <fieldset class="fieldset-2">
                            <div class="form-group-2 control-group dropdown-valid-2">
                                <label class="col-form-label-2 col-12" for="FIO"><?=GetMessage('DB_FIO')?><span class="f-star">&nbsp;*</span>
                                </label>
                                <div class="text col-12">
                                    <div class="input-wrap">
                                        <input class="form-control-2" id="FIO" name="FIO" required="">
                                        <div class="error-drop">
                                            <button class="error-icon" data-toggle="dropdown">?</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="controls"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-2 control-group dropdown-valid-2">
                                <label class="col-form-label-2 col-12" for="EMAIL"><?=GetMessage('DB_EMAIL')?><span class="f-star">&nbsp;*</span>
                                </label>
                                <div class="text col-12">
                                    <div class="input-wrap">
                                        <input class="form-control-2" id="EMAIL" name="EMAIL" required="">
                                        <div class="error-drop">
                                            <button class="error-icon" data-toggle="dropdown">?</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="controls"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-2 control-group dropdown-valid-2">
                                <label class="col-form-label-2 col-12" for="QUESTION"><?=GetMessage('DB_QUESTION')?><span class="f-star">&nbsp;*</span>
                                </label>
                                <div class="text col-12">
                                    <div class="input-wrap">
                                        <textarea class="form-control-2" id="QUESTION" name="QUESTION" maxlength="500" rows="4" cols="60" required=""></textarea>
                                        <div class="error-drop">
                                            <button class="error-icon" data-toggle="dropdown">?</button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <div class="controls"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?=bitrix_sessid_post()?>
                            <div class="form-group-2">
                                <div class="col-12">
                                    <div class="required-wrap">
                                        <input class="btn btn-secondary btn_submit btn-sm" id="submit_<?=$arParams['FORM_ID']?>" name="submit" type="submit" value="<?=(strlen($arParams["BTN_TITLE"]) > 0 ? $arParams["BTN_TITLE"] : GetMessage("MFT_SUBMIT"));?>">
                                        <div class="form_required"><span class="f-star">&nbsp;*</span><?=GetMessage('REQ')?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
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
                                        'EMAIL': {
                                            required: true,
                                            email: true
                                        },
                                        'QUESTION': {
                                            required: true,
                                            minlength: 2
                                        },
                                    }
                                })).initValid();
                            });
                        }();
                    </script>
                </div>
            </div>
            <?$APPLICATION->IncludeFile(
                SITE_DIR.'local/include/forms/states_modal.php',
                Array('SHOW_CLOSE' => true),
                Array("MODE"=>"text", "SHOW_BORDER" => false, "NAME" => "Текст", 'TEMPLATE' => 'default.php')
            );?>
            <div class="preloader" id="<?=$arParams['FORM_ID']?>-preloader-1">
                <div class="preloader__spinner sm"></div>
            </div>
        </div>
    </div>
</div>