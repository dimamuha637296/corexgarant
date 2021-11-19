<?$APPLICATION->IncludeComponent(
	"db.base:form",
	"modal_catalog",
	Array(
		"FORM_ID" => "FRM_catalog",
		"USE_CAPTCHA" => "N",
		"USE_AJAX" => "Y",
		"BTN_TITLE" => "Отправить",
		"OK_TEXT" => "<p>Наш менеджер получил вот такое сообщение:</p>
<table class='table'>
	<tr>
		<td>Отправлено</td><td>#DATE#, #TIME#</td>
	</tr>
	<tr>
		<td>Товар</td><td>#goods_hide#</td>
	</tr>
	<tr>
		<td>Компания</td><td>#COMPANY#</td>
	</tr>
	<tr>
		<td>ФИО</td><td>#FIO#</td>
	</tr>
	<tr>
		<td>Телефон</td><td>#PHONE#</td>
	</tr>
	<tr>
		<td>E-mail</td><td>#EMAIL#</td>
	</tr>
	<tr>
		<td>Заказать звонок</td><td>#COLL#</td>
	</tr>
	<tr>
		<td>Сообщение</td><td>#MESSAGE#</td>
	</tr>
</table>
<p>Мы свяжемся с Вами в течении нескольких дней. Ожидайте ответ на указанные в форме контакты.</p>",
		"EMAIL_TO" => htmlspecialchars(COption::GetOptionString("main","email_from","geraas@db.by")),
		"EMAIL_TITLE" => "Сообщение из формы Контакты",
		"EVENT_MESSAGE_ID" => array("36"),
		"COLS_MAX" => "12",
		"COL_LEFT" => "12",
		"COL_RIGHT" => "12",
		"INCLUDE_CSS" => "N",
		"FIELDS_CNT" => "8",
		"IBLOCK_TYPE" => "wys",
		"IBLOCK_ID" => "14",
		"IBLOCK_SECTION_ID" => "9",
		"DETAIL_RECORD" => "N",
		"ACTIVE_ELEMENT" => "N",
		"CATEGORY_0_TITLE" => "Товар",
		"CATEGORY_0_CODE" => "goods",
		"CATEGORY_0_TYPE" => "text",
		"CATEGORY_0_REQ" => "N",
		"CATEGORY_0_TYPE_VALIDATION" => array(),
		"CATEGORY_0_PLACEHOLDER" => "",
		"CATEGORY_0_DECR" => "",
		"CATEGORY_0_VALUE" => $arParams["NAMA_GOODS"],
		"CATEGORY_1_TITLE" => "Компания",
		"CATEGORY_1_CODE" => "COMPANY",
		"CATEGORY_1_TYPE" => "text",
		"CATEGORY_1_REQ" => "Y",
		"CATEGORY_1_TYPE_VALIDATION" => array("minlength: 1"),
		"CATEGORY_1_PLACEHOLDER" => "",
		"CATEGORY_1_DECR" => "",
		"CATEGORY_1_VALUE" => "",
		"CATEGORY_2_TITLE" => "ФИО",
		"CATEGORY_2_CODE" => "FIO",
		"CATEGORY_2_TYPE" => "text",
		"CATEGORY_2_REQ" => "Y",
		"CATEGORY_2_TYPE_VALIDATION" => array("minlength: 1"),
		"CATEGORY_2_PLACEHOLDER" => "",
		"CATEGORY_2_DECR" => "",
		"CATEGORY_2_VALUE" => "",
		"CATEGORY_3_TITLE" => "Телефон",
		"CATEGORY_3_CODE" => "PHONE",
		"CATEGORY_3_TYPE" => "tel",
		"CATEGORY_3_REQ" => "N",
			"CATEGORY_2_TYPE_VALIDATION" => array(
					0 => "minlength: 5",
					2 => "",
			),
		"CATEGORY_3_PLACEHOLDER" => "",
		"CATEGORY_3_DECR" => "",
		"CATEGORY_3_VALUE" => "",
		"CATEGORY_4_TITLE" => "Заказать звонок",
		"CATEGORY_4_CODE" => "COLL",
		"CATEGORY_4_TYPE" => "checkbox",
		"CATEGORY_4_REQ" => "N",
		"CATEGORY_4_PLACEHOLDER" => "",
		"CATEGORY_4_DECR" => "",
		"CATEGORY_4_VALUE" => array("да"),
		"CATEGORY_4_DEF_VALUE" => "",
		"CATEGORY_5_TITLE" => "E-mail",
		"CATEGORY_5_CODE" => "EMAIL",
		"CATEGORY_5_TYPE" => "email",
		"CATEGORY_5_REQ" => "N",
		"CATEGORY_5_PLACEHOLDER" => "",
		"CATEGORY_5_DECR" => "",
		"CATEGORY_5_VALUE" => "",
		"CATEGORY_6_TITLE" => "Сообщение",
		"CATEGORY_6_CODE" => "MESSAGE",
		"CATEGORY_6_TYPE" => "textarea",
		"CATEGORY_6_REQ" => "Y",
		"CATEGORY_6_TYPE_VALIDATION" => array("minlength: 10"),
		"CATEGORY_6_PLACEHOLDER" => "",
		"CATEGORY_6_DECR" => "",
		"CATEGORY_6_VALUE" => "",
		"CATEGORY_7_TITLE" => "Товар",
		"CATEGORY_7_CODE" => "goods_hide",
		"CATEGORY_7_TYPE" => "text",
		"CATEGORY_7_REQ" => "N",
		"CATEGORY_7_TYPE_VALIDATION" => array(),
		"CATEGORY_7_PLACEHOLDER" => "",
		"CATEGORY_7_DECR" => "",
		"CATEGORY_7_VALUE" => $arParams["NAMA_GOODS"],
	)
);?>
