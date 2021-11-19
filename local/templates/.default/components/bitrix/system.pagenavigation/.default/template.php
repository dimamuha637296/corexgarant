<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if(!$arResult["NavShowAlways"])
{
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>


    <nav>
        <ul class="pagination list-reset">
            <?if($arResult["bDescPageNumbering"] === true):
                if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
                    <li>
                        <?if($arResult["bSavePage"]):?>
                            <a class="page-link prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"></a>
                        <?else:?>
                            <?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
                                <a class="page-link prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"></a>
                            <?else:?>
                                <a class="page-link prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"></a>
                            <?endif?>
                        <?endif?>
                    </li>
                <?else:?>
                    <li class="disabled">
                        <span class="page-link prev"></span>
                    </li>
                <?endif?>

                <?if ($arResult["nStartPage"] < $arResult["NavPageCount"]):?>
                <?$bFirst = false;?>
                <?if($arResult["bSavePage"]):?>
                    <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">1</a></li>
                <?else:?>
                    <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
                <?endif;

                if($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):?>
                    <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=intVal($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2)?>">...</a></li>
                <?endif;?>
            <?endif;?>

                <?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
                <li class="page-item">
                    <?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

                    <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                        <span><?=$NavRecordGroupPrint?></span>
                    <?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
                    <?else:?>
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
                    <?endif?>

                    <?$arResult["nStartPage"]--?>
                </li>
            <?endwhile?>

                <?if ($arResult["NavPageNomer"] > 1):
                if ($arResult["nEndPage"] > 1):
                    if ($arResult["nEndPage"] > 2):?>
                        <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] / 2)?>">...</a></li>
                    <?endif;?>
                    <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=$arResult["NavPageCount"]?></a></li>
                <?endif;?>
                <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a></li>
            <?else:?>
                <li class="disabled">
                    <span class="page-link prev"></span>
                </li>
            <?endif;?>

            <?else:
                if ($arResult["NavPageNomer"] > 1):?>
                    <li class="page-item">
                        <?if($arResult["bSavePage"]):?>
                            <a class="page-link prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a>
                        <?else:?>
                            <?if ($arResult["NavPageNomer"] > 2):?>
                                <a class="page-link prev" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a>
                            <?else:?>
                                <a class="page-link prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"></a>
                            <?endif?>
                        <?endif?>
                    </li>
                <?else:?>
                    <li class="page-item disabled">
                        <span class="page-link prev"></span>
                    </li>
                <?endif?>

                <?if ($arResult["nStartPage"] > 1):?>
                <?$bFirst = false;?>
                <?if($arResult["bSavePage"]):?>
                    <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a></li>
                <?else:?>
                    <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a></li>
                <?endif;

                if($arResult["nStartPage"] > 2):?>
                    <li class="page-item"><a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nStartPage"] / 2)?>">...</a></li>
                <?endif;?>
            <?endif;?>

                <?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

                <?if($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
                    <li class="page-item active">
                        <span class="page-link"><?=$arResult["nStartPage"]?>
                            <span class="sr-only">(current)</span>
                        </span>
                    </li>
                <?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>
                    </li>
                <?else:?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
                    </li>
                <?endif?>
                <?$arResult["nStartPage"]++?>
            <?endwhile?>

                <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
                if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
                    if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):?>
                        <li class="page-item">
                            <a class="modern-page-dots" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2)?>">...</a>
                        </li>
                    <?endif;?>
                    <li class="page-item">
                        <a class="page-link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
                    </li>
                <?endif;?>
                <li class="page-item">
                    <a class="page-link next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"></a>
                </li>
            <?else:?>
                <li class="page-item disabled">
                    <span class="page-link next"></span>
                </li>
            <?endif;?>

            <?endif?>
        </ul>
    </nav>

<? /*if ($arResult["bShowAll"]):?>
<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>
	<?endif?>
</noindex>
<?endif */?>