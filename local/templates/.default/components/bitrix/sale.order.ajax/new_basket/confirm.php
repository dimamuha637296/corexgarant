<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arFilter = Array(
	"ID" => $arResult["ORDER"]["ACCOUNT_NUMBER"],

);


$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
	$ardateOrder = $ar_sales["DATE_INSERT"];
}

if (!empty($arResult["ORDER"]))
{
	?>

	<div class="confirm_props mb_1">
		<div class="item">Заказ № <?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?></div>
		<div class="item">Время заказа <?=$ardateOrder?></div>
	</div>
	<div>
		<p>Мы Вам сейчас перезвоним, чтобы подтвердить заказ и уточнить некоторые детали доставки.</p>
	</div>

	<?/*
		$APPLICATION->IncludeComponent("bitrix:sale.personal.order.detail","",Array(
		"PATH_TO_LIST" => "order_list.php",
		"PATH_TO_CANCEL" => "order_cancel.php",
		"PATH_TO_PAYMENT" => "payment.php",
		"ID" => $arResult["ORDER"]["ACCOUNT_NUMBER"],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"PREVIEW_PICTURE_WIDTH" => "110",
		"PREVIEW_PICTURE_HEIGHT" => "110",
		"RESAMPLE_TYPE" => "1",
		"CUSTOM_SELECT_PROPS" => array(),
		"PROP_1" => Array(),
		"PROP_2" => Array()
	)
);
//*/?>



	<?

	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>
		<div class="pay_name h5"><?=GetMessage("SOA_TEMPL_PAY")?>:</div>
		<div class="paysystem_name"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div>
			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0 && $arResult["PAY_SYSTEM"]["CODE"] != "cash")
			{

				?>
				<table class="sale_order_full_table">
				<tr>
					<td>
						<?
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<script language="JavaScript">
								window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>&PAYMENT_ID=<?=$arResult['ORDER']["PAYMENT_ID"]?>');
							</script>
						<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&PAYMENT_ID=".$arResult['ORDER']["PAYMENT_ID"]))?>
							<?
							if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE']))
							{
								?><br />
								<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))."&pdf=1&DOWNLOAD=Y")) ?>
								<?
							}
						}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								try
								{
									include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
								}
								catch(\Bitrix\Main\SystemException $e)
								{
									if($e->getCode() == CSalePaySystemAction::GET_PARAM_VALUE)
										$message = GetMessage("SOA_TEMPL_ORDER_PS_ERROR");
									else
										$message = $e->getMessage();

									echo '<span style="color:red;">'.$message.'</span>';
								}
							}
						}
						?>
					</td>
				</tr>
				</table>
				<?
			}
			?>

		<?
	}
	?>
	<?
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
	<?
}

$APPLICATION->SetTitle("Заказ оформлен");
?>

