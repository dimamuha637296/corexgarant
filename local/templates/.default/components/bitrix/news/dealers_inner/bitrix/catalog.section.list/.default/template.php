<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
$cnt=0;
?>
<div class="dealers-filter">
    <form id="form-dealers" method="post" action="/">
        <fieldset class="fieldset">
            <!-- row-->
            <div class="form-group control-group js-categories">
                <?if(count($arResult['SECTIONS_TREE']) > 0):?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 text">
                        <div class="checkbox">
                            <label>
                                <input class="ui-checkbox map_filter map_filter--all " type="checkbox" value="all" name="form-CHECKBOX"<?=(("" == $arParams['CUR_SECTION_CODE']) ? ' checked=""' : '');?>><span><?=GetMessage("ALL")?> <span class='quant'>(<?=$arResult["COUNTER"]?>)</span></span>
                            </label>
                        </div>
                    </div>
                    <?foreach($arResult['SECTIONS_TREE'] as $key => $arSection):?>
                        <div class="col-sm-6 col-lg-4 col-xl-3 text">
                            <div class="checkbox">
                                <label>
                                    <input class="ui-checkbox map_filter" type="checkbox" value="ex_<?=$key?>" name="form-CHECKBOX"><span><?=$arSection['NAME']?> <span class='quant'>(<?=$arSection['ELEMENT_CNT']?>)</span></span>
                                </label>
                            </div>
                        </div>
                    <?endforeach;?>
                <?endif;?>
        </fieldset>
    </form>
</div>