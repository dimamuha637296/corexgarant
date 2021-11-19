<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);
$cnt=0;
?>
<form id="form-dealers" class="form-horizontal" role="form" method="post" action="/">
    <fieldset class="fieldset">
        <div class="form-group control-group city">
            <div class="col-sm-6 col-12">
                <div class="item">
                    <label class="name label-pt" for="form-COUNTRY">
                        <?=GetMessage("BTW_REGION")?>
                    </label>
                    <div class="text">
                        <select id="form-COUNTRY" class="form-control formstyler" name="form-COUNTRY">
                            <?if(count($arResult['SECTIONS_TREE']) > 0):
                                $i = 0;
                                ?>
                                <?foreach($arResult['SECTIONS_TREE'] as $arSection):?>
                                    <?$i++;?>
                                    <?if($i == 1):?>
                                        <option  value="<?=$arSection['LIST_PAGE_URL']?>"  <?=(("" == $arParams['CUR_SECTION_CODE']) ? 'selected ' : '');?>><?=GetMessage("ALL")?></option>
                                    <?endif;?>
                                    <?if($arParams['CUR_DEPTH'] == 1):?>
                                        <option  value="<?=$arSection['SECTION_PAGE_URL']?>"  <?=(($arSection['CODE'] == $arParams['CUR_SECTION_CODE']) ? 'selected' : '');?>><?= $arSection['NAME']?></option>
                                    <?else:?>
                                        <option  value="<?=$arSection['SECTION_PAGE_URL']?>"  <?=(($arSection['ID'] == $arParams['PARENT_SECTION']) ? 'selected' : '');?>><?= $arSection['NAME']?></option>
                                    <?endif;?>
                                <?endforeach;?>
                            <?endif;?>
                        </select>
                    </div>
                </div>
            </div>
            <?if(count($arResult['SECTIONS_TREE'][$arParams['PARENT_SECTION']]['SUBSECTIONS']) > 0):?>
                <div class="col-sm-6 col-12">
                    <div class="item">
                        <label class="name label-pt" for="form-CITY">
                            Район/город
                        </label>
                        <div class="text">
                            <select id="form-CITY" class="form-control formstyler" name="form-CITY" >
                                <option  value="<?=$arResult['SECTIONS_TREE'][$arParams['PARENT_SECTION']]['SECTION_PAGE_URL']?>"  <?=(("" == $arParams['CUR_SECTION_CODE']) ? 'selected' : '');?>><?=GetMessage("ALL")?></option>
                                <?foreach($arResult['SECTIONS_TREE'][$arParams['PARENT_SECTION']]['SUBSECTIONS'] as $arSection):?>
                                    <?if($arParams['CUR_DEPTH'] == 1):?>
                                        <option  value="<?=$arSection['SECTION_PAGE_URL']?>" ><?= $arSection['NAME']?></option>
                                    <?else:?>
                                        <option  value="<?=$arSection['SECTION_PAGE_URL']?>"  <?=(($arSection['CODE'] == $arParams['CUR_SECTION_CODE']) ? 'selected' : '');?>><?= $arSection['NAME']?></option>
                                    <?endif;?>
                                <?endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            <?endif;?>
        </div>

        <? /**JS FILTER CATEGORIES **/ ?>
        <?if ($arParams['MAP_HAS_CATEGORY_FILTER'] == 'Y'):?>
            <?//*/
            $GLOBALS['APPLICATION']->AddHeadScript(("/local/templates/.default/components/bitrix/news/dealers_new/bitrix/catalog.section.list/.default/category-filter.js"));
            //*/?>
            <div class="form-group control-group row-clear js-categories">
                <div class="col-sm-6 col-12">
                    <div class="checkbox">
                        <label>
                            <input class="map_filter map_filter--all formstyler" checked="checked" type="checkbox" value="all" name="form-CHECKBOX">
                            <span>Вся сеть</span>
                        </label>
                    </div>
                </div>
                <? foreach ($arResult['FILTER'] as $key => $arFilter): ?>
                    <div class="col-sm-6 col-12">
                        <div class="checkbox">
                            <label>
                                <input class="map_filter formstyler" <?= ((count($arFilter['ITEMS']) > 0) ? '' : 'disabled') ?> type="checkbox" value="ex_<?= $key ?>" name="form-CHECKBOX">
                                <span><?= $arFilter['NAME'] ?></span>
                            </label>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <?endif;?>
    </fieldset>
</form>