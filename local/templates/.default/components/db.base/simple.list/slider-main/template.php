<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="sl-main-3">
    <div class="wrap cursor inited-not">
        <div class="wrap cursor inited-not">
            <div class="slider">
                <?foreach($arResult["ITEMS"] as $arElement):
                    $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    $bHasPicture = is_array($arElement['PREVIEW_IMG']);
                    $bhasLink = strlen($arElement["PROPERTIES"]['HREF']['VALUE']) > 0;
                    ?>
                    <div class="slide" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                        <div class="sl-main-3-slide">
                            <div class="pic" >
                                <img src="<?=$arElement['PREVIEW_IMG']['SRC'];?>" alt="<?=$arElement['DETAIL_PICTURE']['ALT']?>" class="img">
                            </div>
                            <div class="b-wrap">
                                <div class="title"><?=$arElement['~NAME']?></div>
                                <?if($arElement['DETAIL_TEXT']):?>
                                    <div class="text"><?=$arElement['~DETAIL_TEXT']?></div>
                                <?endif;?>
                                <?if($bhasLink):?>
                                    <div class="b-btn">
                                        <a href="<?=$arElement["PROPERTIES"]['HREF']['VALUE']?>" class="btn btn-default"><?=$arParams["HREF_BUTTON_TEXT"]?></a>
                                    </div>
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
            <div class="js-sl-pager sl-pager-2"></div>
            <div class="sl-nav"><a class="prev" href="#"></a><a class="next" href="#"></a></div>
        </div>
    </div>
</div>