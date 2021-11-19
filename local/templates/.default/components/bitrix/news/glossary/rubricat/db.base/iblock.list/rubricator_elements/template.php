<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
cutil::initjscore(array('jquery'));
if (count($arResult['ITEMS']) < 1)
	return;
?>
<div id="rubric">
<ul class="list-item" id="db-items-<?=$arResult['ID']?>"><?
foreach ($arResult['ITEMS'] as $key => $arElement):
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CATALOG_ELEMENT_DELETE_CONFIRM')));

	$bHasPicture = $arParams["DISPLAY_PICTURE"]!="N" && is_array($arElement['PREVIEW_IMG']);
?>
	<li class="item" id="elem-<?=$arElement["ID"]?>">
	
		<h3 class="title" id="<?=$this->GetEditAreaId($arElement['ID']);?>" >
            <span class="title  title_rubric_elem _dash" data-rubric="descr-rubr-<?=$arElement["ID"]?>"><?=$arElement["NAME"]?></span>
        </h3>
	
		<?if(strlen($arElement["DETAIL_TEXT"]) > 0):?><div class="descr_rubricator ugc _clear mb_2" id="descr-rubr-<?=$arElement["ID"]?>">
			<?if($arElement['DETAIL_TEXT_TYPE'] == 'html'):?><?=$arElement["DETAIL_TEXT"]?><?else:?><p><?=$arElement["DETAIL_TEXT"]?></p><?endif;?>
		</div><?endif;?>
	
	</li>
<?endforeach;?>
</ul>
</div>
<script>
BX.ready(function(){
		var r = t = null,
			IdScrollTo = '';
		
		r = new RegExp('^#elem-([0-9]+)+$', 'ig');
		t = r.exec(window.location.hash);
		if(t != null){
			IdScrollTo = t[0].substr(1);
			DBRubricatorScroll(IdScrollTo);
		}

		BX.bindDelegate(BX('rubricator-elems-list'), "click", {tag:'A'}, function(e) {
			var objURLImgID = BX(this).getAttribute('data-href'),
					objURLFix = BX(this).getAttribute('data-fix');
			if(objURLFix && objURLFix.length > 0){
				var elemId = objURLFix;		
				BX.removeClass(BX.addClass(BX('descr-rubr-'+elemId), '_open'), '_close');	
				
				var NodeElem = BX.findChild(BX('rubric'), {attribute: {'data-rubric':'descr-rubr-'+elemId}}, true);
				BX.removeClass(BX.addClass(NodeElem,  '_open'), '_close');	
				DBRubricatorScroll(objURLImgID);				
			}
			BX.PreventDefault(e);
		});
		
		/*===Show and hide rubricator element description on click=====*/
		
		BX.bindDelegate(BX('rubric'), "click", {tag:'SPAN'}, function(e) {
			var 	objULSubSection = BX(this.getAttribute('data-rubric')),
					SubSectionsNode = this;
			//BX.debug(e, objULSubSection, this);		
			if(BX.hasClass(SubSectionsNode, '_open')){
				BX.removeClass(BX.addClass(SubSectionsNode, '_close'), '_open');
				BX.removeClass(BX.addClass(objULSubSection, '_close'), '_open');
			}else{
				BX.removeClass(BX.addClass(SubSectionsNode, '_open'), '_close');
				BX.removeClass(BX.addClass(objULSubSection, '_open'), '_close');
			}
			BX.PreventDefault(e);
		});	
		
	});
	
function DBRubricatorScroll(IdScrollTo){
	if(IdScrollTo.length > 0){
		var windowScroll = BX.GetWindowScrollPos(),
		objPos = BX.pos(BX(IdScrollTo), true);
					
		(new BX.fx({
			start: windowScroll.scrollTop,
			finish: objPos.top-50,
			time: 0.7,
			step: 0.01,
			type: 'linear',
			callback: function(top)
			{
				window.scrollTo(windowScroll.scrollLeft,top);
			},
			callback_complete: function(){
				BX.fx.colorAnimate(BX(IdScrollTo), 'showActive');
			}
		})).start();
	}
}


</script>
<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult)?></pre><?//*/?>