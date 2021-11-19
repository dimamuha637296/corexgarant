<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//***********************************
//status and unsubscription/activation section
//***********************************
?>
<form class="form-horizontal" id="form-subscript" method="post" action="<?=$arResult["FORM_ACTION"]?>">
    <fieldset class="fieldset">
        <div class="h3"><?echo GetMessage("subscr_title_status")?></div>
        <div class="row">
            <div class="col-12">
                <?if($arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"):?>
                    <p><?echo GetMessage("subscr_title_status_note1")?></p>
                <?elseif($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>
                    <p><?echo GetMessage("subscr_title_status_note2")?></p>
                    <p><?echo GetMessage("subscr_status_note3")?></p>
                <?else:?>
                    <p><?echo GetMessage("subscr_status_note4")?></p>
                    <p><?echo GetMessage("subscr_status_note5")?></p>
                <?endif;?>
            </div>
            <div class="col-sm-4 col-12">
                <p><?echo GetMessage("subscr_conf")?></p>
            </div>
            <div class="col-12">
                <p><?echo ($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"? GetMessage("subscr_yes"):GetMessage("subscr_no"));?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12">
                <p><?echo GetMessage("subscr_act")?></p>
            </div>
            <div class="col-sm-4 col-12">
                <p><?echo ($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"? GetMessage("subscr_yes"):GetMessage("subscr_no"));?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12">
                <p><?echo GetMessage("adm_id")?></p>
            </div>
            <div class="col-sm-4 col-12">
                <p><?echo $arResult["SUBSCRIPTION"]["ID"];?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12">
                <p><?echo GetMessage("subscr_date_add")?></p>
            </div>
            <div class="col-sm-4 col-12">
                <p><?echo $arResult["SUBSCRIPTION"]["DATE_INSERT"];?></p>
            </div>
        </div>
        <?if($arResult["SUBSCRIPTION"]["DATE_UPDATE"]):?>
            <div class="row">
                <div class="col-sm-4 col-12">
                    <p><?echo GetMessage("subscr_date_upd")?></p>
                </div>
                <div class="col-sm-4 col-12">
                    <p><?echo $arResult["SUBSCRIPTION"]["DATE_UPDATE"];?></p>
                </div>
            </div>
        <?endif;?>
        <?if($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"):?>
            <div class="form-group">
                <?if($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>
                    <input type="submit" class="btn btn-primary btn_submit" name="unsubscribe" value="<?echo GetMessage("subscr_unsubscr")?>" />
                    <input type="hidden" name="action" value="unsubscribe" />
                <?else:?>
                    <input type="submit" class="btn btn-primary btn_submit" name="activate" value="<?echo GetMessage("subscr_activate")?>" />
                    <input type="hidden" name="action" value="activate" />
                <?endif;?>
            </div>
        <?endif;?>
    </fieldset>
    <input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
    <?echo bitrix_sessid_post();?>
</form>