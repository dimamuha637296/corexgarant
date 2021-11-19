<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?$arResult['CNT'] = count($arResult['ITEMS']) - 1;
if ($arResult['CNT'] < 0)
	return;
?>


    <div class="reviews border">
        <?foreach($arResult["ITEMS"] as $key => $arElement):
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="item" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-12">
                        <div class="rating">
                            <ul data-category="cost" class="list-rating list-reset star-list-small">
                                <?for($i=0; $i<5; $i++): ?>
                                    <li class="star-item <?if($i<intval($arElement["PROPERTIES"]["STARS"]["VALUE"])):?>active<?endif;?>"></li>
                                <?endfor;?>
                            </ul>
                        </div>
                        <div class="name"><?=$arElement["~NAME"]?></div>
                        <?if($arElement["DISPLAY_ACTIVE_FROM"]):?>
                            <time class="date"><?=ToLower($arElement["DISPLAY_ACTIVE_FROM"])?></time>
                        <?endif;?>
                    </div>
                    <div class="col-md-9 col-sm-8 col-12">
                        <?if($arElement["PREVIEW_TEXT"]):?>
                            <div class="question">
                                <?if(intval($arParams["LONG_TEXT"]) == "0"):?>
                                    <span>
                                        <?if($arElement['PREVIEW_TEXT__TYPE'] == 'html'):?><?=$arElement["PREVIEW_TEXT"]?><?else:?><p><?=$arElement["PREVIEW_TEXT"]?></p><?endif;?>
                                    </span>
                                <?else:?>
                                    <span data-max-symb="<?=intval($arParams["LONG_TEXT"])?>" class="js-cutter">
                                        <?if($arElement['PREVIEW_TEXT__TYPE'] == 'html'):?><?=$arElement["PREVIEW_TEXT"]?><?else:?><p><?=$arElement["PREVIEW_TEXT"]?></p><?endif;?>
                                    </span>
                                <?endif;?>
                            </div>
                        <?endif;?>
                        <?if($arElement["DETAIL_TEXT"]):?>
                            <div class="answer">
                                <div class="title"><?=GetMessage('DB_ANSWER')?></div>
                                <div class="text">
                                    <?if($arElement['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arElement["DETAIL_TEXT"]?><?else:?><p><?=$arElement["DETAIL_TEXT"]?></p><?endif;?>
                                </div>
                                <?if($arElement["PROPERTIES"]["FIO_ANSWER"]["~VALUE"]):?>
                                    <div class="who"><?=$arElement["PROPERTIES"]["FIO_ANSWER"]["~VALUE"]?></div>
                                <?endif;?>
                            </div>
                        <?endif;?>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <div class="page-count">
        <?=$arResult["NAV_STRING"]?>
    </div>
<?endif;?>
    <script>
        !function () {
            'use strict';
            function moreCutter() {
                var opt = {
                    block: $('.js-cutter'),
                    data: 'max-symb',
                    show: '<?=GetMessage("DB_OPEN_REV")?>',
                    hide: '<?=GetMessage("DB_OFF_REV")?>'
                };
                if (!opt.block.length) {
                    return false;
                }
                opt.maxSymb = 150;
                opt.block.each(function () {
                    var self = $(this);
                    var text = self.text();
                    var selfData = self.data(opt.data);
                    if (self.data(opt.data) !== undefined) {
                        opt.maxSymb = parseInt(selfData);
                    }
                    if (text.length > opt.maxSymb) {
                        var newText = text.substr(0, (opt.maxSymb - 3)) + '...';
                        self.html(newText);
                        self.parent().append('<span class="js-more collapsed lnk-pseudo">' +
                            '<span class="opener">' + opt.show + '</span>' +
                            '<span class="closer">' + opt.hide + '</span>' +
                            '</span>');
                        var moreLink = self.siblings('.js-more');
                        moreLink.on('click', function () {
                            if (moreLink.hasClass('collapsed')) {
                                self.html(text);
                                moreLink.removeClass('collapsed');
                            } else {
                                self.html(newText);
                                moreLink.addClass('collapsed');
                            }
                        });
                    }
                });
            }
            $(function () {
                moreCutter();
            });
        }();
    </script>
<script>
BX.ready(function(){
	var r = t = null,
		IdScrollTo = '';
	
	r = new RegExp('^#review-([0-9]+)+$', 'ig');
	t = r.exec(window.location.hash);
	if(t != null){
		IdScrollTo = t[0].substr(1);
	}
	
	if(IdScrollTo.length > 0){
		BX.DbScrollTo(IdScrollTo);
	}
});
</script>
<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?//pr($arResult)?>