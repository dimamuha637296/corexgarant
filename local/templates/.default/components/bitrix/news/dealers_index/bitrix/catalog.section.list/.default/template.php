<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
$cnt=0;
?>
<div class="dealers-filter">
    <div class="h2 title">
        <a href="/etalon/dealers/dealers_inner/"><?=GetMessage('DB_DEALERS')?></a></div>
    <p class="descr"><?=GetMessage('DB_CHOOSE')?></p>
    <form id="form-dealers" method="post" action="/">
        <fieldset class="fieldset">
            <!-- row-->
            <div class="form-group control-group js-categories">
                <?if(count($arResult['SECTIONS_TREE']) > 0):?>
                    <div class="col-12 col-sm-6 text">
                        <div class="checkbox">
                            <label>
                                <input class="ui-checkbox map_filter map_filter--all " type="checkbox" value="all" name="form-CHECKBOX"<?=(("" == $arParams['CUR_SECTION_CODE']) ? ' checked=""' : '');?>><span><?=GetMessage("ALL")?> <span class='quant'>(<?=$arResult["COUNTER"]?>)</span></span>
                            </label>
                        </div>
                    </div>
                    <?$cnt = 1;foreach($arResult['SECTIONS_TREE'] as $key => $arSection):?>
                        <?if($cnt < 8):?>
                            <div class="col-12 col-sm-6 text">
                                <div class="checkbox">
                                    <label>
                                        <input class="ui-checkbox map_filter" type="checkbox" value="ex_<?=$key?>" name="form-CHECKBOX"><span><?=$arSection['NAME']?> <span class='quant'>(<?=$arSection['ELEMENT_CNT']?>)</span></span>
                                    </label>
                                </div>
                            </div>
                        <?endif;?>
                    <?$cnt++;endforeach;?>
                <?endif;?>
        </fieldset>
    </form>
</div>