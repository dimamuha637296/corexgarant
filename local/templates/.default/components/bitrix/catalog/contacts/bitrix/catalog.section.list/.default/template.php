<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//echo '<pre>'; print_r($arResult); echo '</pre>';
$countItems =count($arResult["SECTIONS"]);
if ($countItems < 1)
	return;?>
<div class="partner clearfix" >
	<label class="text" for="partner"><?=GetMessage("CITY")?></label>
	<div class="input">
		<select id="partner" class="form-control-ya mb_1" name="ICON">
			<?$i=0;foreach($arResult["SECTIONS"] as  $key => $arSection):?>
				<?if($arSection["ELEMENT_CNT"] != 0):?>
					<option value="<?=$arSection["SECTION_PAGE_URL"]?>" <?if($arSection["SECTION_PAGE_URL"] == $APPLICATION->GetCurPage()):?>selected<?endif;?>>
						<?=$arSection["NAME"]?>
					</option>
				<?endif;?>
			<?$i++;endforeach;?>
		</select>
		<button type="submit" class="btn btn-primary" id="btn-show-sity"><?=GetMessage('SHOW')?></button>
	</div>
	
</div>
<script>
	$('#btn-show-sity').click(function(){
		//alert(val);
		window.location = $('#partner').val();
	});
</script>
<?/*/?><pre><?print_r($_REQUEST)?></pre><?//*/?>