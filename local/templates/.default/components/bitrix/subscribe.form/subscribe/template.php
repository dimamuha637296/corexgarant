<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<form id="form-subscript-confirm " class="b-form" action="<?=$arResult["FORM_ACTION"]?>">
	<fieldset>
        <div class="control-group">
            <div class="title"><?=GetMessage("subscr_form_title")?></div>
            <input class="input form-control" type="text"
                title="<?=GetMessage("subscr_form_title")?>" value="" placeholder="<?=GetMessage("subscr_form_email_title")?>" name="sf_EMAIL">
            <div class="b-btn">
                <input class="btn btn-default" name="OK" type="submit" value="<?=GetMessage("subscr_form_button")?>">
            </div>
        </div>
	</fieldset>
</form>
<script>
    !function () {
        'use strict';
        function initValid() {
            // Validation options http://jqueryvalidation.org/documentation/
            var form_validator = $('#form-subscript-confirm');
            if (form_validator.length && $.fn.validate) {
                form_validator.validate({
                    rules: {
                        'sf_EMAIL': {
                            required: true,
                            email: true
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
