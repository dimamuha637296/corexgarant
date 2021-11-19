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

if($arResult['NavPageNomer'] == 1):?>
	<script>
			var in_process = false;
			var page = <?=$arResult['NavPageNomer']?>;
			var nEndPage = <?=$arResult['NavPageCount']?>;
			var LastPage = <?=$arResult['NavPageNomer']?>;
			
			function get_next_items() {
				if (in_process) {
					return false;
				}
				if(LastPage<page)
					return false;
				
				page = page + 1;
				LastPage = page;
				
				if(page>nEndPage)
					return false;
					
	            url = window.location.toString();
	            url = url.replace('#','');
	            
				in_process = true;			
				$.ajax({
					type: "GET",
					dataType: "html",
					data: "dbAjaxNav=Y&PAGEN_1="+page,
					url: url + (window.location.search != '' ? "&" : "?") + "type=html",
					beforeSend: function(){
						$('.pagin_button').hide();
						$('.pagin_preloader').removeClass("hide");						
					},
					success: function( HTML ){
						if(HTML)
						{
							$('.pagin_preloader').addClass("hide");
							$(HTML).insertAfter('div.dbAjaxnavItem:last');
							$('div.dbAjaxnavItem:first').remove();
						}
					},
					complete: function(){
						in_process = false;
					}
	            });	
			}
			/*
			$(window).scroll(function() {
				if  ($(window).scrollTop()+200 >= $(document).height() - $(window).height())
					get_next_items();
			});
			//*/
	</script>
<?endif;?>

<?if($arResult['NavPageNomer'] != $arResult['NavPageCount']):?>
	<div class="dbAjaxnavItem">
		<div class="text-center mt_1 mb_1">
			<center class="pagin_preloader preloader hide"><img src="<?=$templateFolder?>/images/preloader.GIF" alt="preloader"></center>
			<a class="pagin_button btn-silver big" href="<?=$arResult["sUrlPath"]?>?PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" onclick="get_next_items();return false;" ><span class="arr-b"></span> <?=GetMessage('DB_MSG_SHOW_MORE')?></a>
		</div>
	</div>
<?endif;?>
<?//pr($arResult);?>