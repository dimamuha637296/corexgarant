<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<div class="search-sm hide-print">
    <form action="<?=$arResult["FORM_ACTION"]?>" method="get" onsubmit="var str=document.getElementById('searchinp'); if (!str.value || str.value == str.title) return false;">
        <fieldset class="field">
            <input class="input" id="searchinp" type="text" placeholder="<?=GetMessage("BSF_T_SEARCH_TITLE");?>" name="q" maxlength="50">
                <span class="submit">
                    <input class="btn-search" name="btn-search" type="submit" value="">
                </span>
        </fieldset>
    </form>
</div>

