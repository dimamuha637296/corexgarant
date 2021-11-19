<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$count = count($arResult["NEW_SECTIONS"]);?>
<?if($arResult["NEW_SECTIONS"]):?>
    <div class="catalog-4">
        <div class="bg"></div>
        <div class="bg-wrap">
            <div class="b-title">
                <div class="b-title__title-wrap">
                    <div class="b-title__title h1"><?=$arParams['DB_TITLE']?></div><a class="b-title__link" href="<?=$arParams['DB_LINK']?>"><?=$arParams['DB_LINK_NAME']?></a>
                </div>
            </div>
            <div class="list_1 row">
                <?$i=1;foreach($arResult["NEW_SECTIONS"] as $arSection):
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                <div class="item_1 col-md-12 col-lg-6" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <div class="media-old">
                        <?if($arSection["PREVIEW_IMG"]):?>
                            <div class="media-left-old"><img src="<?=$arSection['PREVIEW_IMG']['SRC'];?>" alt="<?=$arSection["NAME"]?>"></div>
                        <?endif;?>
                        <div class="media-body-old">
                            <div class="title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></div>
                            <?if($arSection["SECTIONS"]):?>
                                <ul class="list_2 list-reset">
                                    <?foreach($arSection["SECTIONS"] as $arSections):
                                        $this->AddEditAction($arSections['ID'], $arSections['EDIT_LINK'], $strSectionEdit);
                                        $this->AddDeleteAction($arSections['ID'], $arSections['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                                        ?>
                                            <li class="item_2" id="<?=$this->GetEditAreaId($arSections['ID']);?>">
                                                <a href="<?=$arSections["SECTION_PAGE_URL"]?>"><?=$arSections["NAME"]?></a>
                                            </li>
                                    <?endforeach;?>
                                </ul>
                            <?endif;?>
                        </div>
                    </div>
                </div>
                <?if($i==$arParams["DB_COUNT_SECTIONS"] && $count > $arParams["DB_COUNT_SECTIONS"]):?>
                    </div>
                    <div class="collapse" id="accordion-60">
                        <div class="list_1 row">
                <?endif;?>
                <?$i++;endforeach;?>
            </div>
            <?if($i > $arParams["DB_COUNT_SECTIONS"] && $count > $arParams["DB_COUNT_SECTIONS"]):?>
                </div>
                <div class="b-btn">
                    <button class="btn btn-success collapsed" data-toggle="collapse" data-target="#accordion-60" type="button"><span class="dash"><?=$arParams['DB_BUTTON']?></span></button>
                </div>
            <?endif;?>
        </div>
    </div>
<?endif;?>
