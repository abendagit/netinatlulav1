<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta content="he-il" http-equiv="Content-Language" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link rel="stylesheet" type="text/css" href="buyingprocess.css" />
    <script type="text/javascript" src="AddOns/jquery-3.1.0.min.js"></script>
    <script type="text/javascript">var pickupLocations = <?php require 'pickupLocations.php'; getPickupLocations(); ?> </script>
    <script type="text/javascript">var setsPrices = <?php echo json_encode(parse_ini_file("setsPrices.txt", true)) ?> </script>
    <script type="text/javascript" src="data.js"></script>
    <script type="text/javascript" src="buyingprocess.js"></script>
</head>

<body>
<div align="center">
<div id="part1">
<img class="title_bars" src="TitleBars/1.gif" title="בוחרים סט" alt="בוחרים סט">
<br>
<br>
<table>
<tr>
<td>
</td>
<td>
<table id="sets">
	<tr>
		<td class="sets_table_style sets_table_style_text">סט</td>
		<td class="sets_table_style sets_table_style_text">מחיר</td>
		<td class="sets_table_style sets_table_style_text">כמות</td>
		<td class="sets_table_style sets_table_style_text">סה"כ</td>
	</tr>
	<tr>
		<td id="sets_item_name_0" class="sets_table_style sets_table_style_text">ילדים <b>(לא לברכה)</b></td>
		<td id="sets_amount_0" class="sets_table_style"></td>
		<td class="sets_table_style">
			<select id="sets_quantity_0" class="selectSets" onchange="onQuantityChange()">
			</select>
		</td>
		<td id="total0" class="sets_table_style">0</td>
	</tr>
	<tr>
		<td id="sets_item_name_1" class="sets_table_style sets_table_style_text">כשר לברכה</td>
		<td id="sets_amount_1" class="sets_table_style"></td>
		<td class="sets_table_style">
			<select id="sets_quantity_1" class="selectSets" onchange="onQuantityChange()"></select>
		</td>
		<td id="total1" class="sets_table_style">0</td>
	</tr>
	<tr>
		<td id="sets_item_name_2" class="sets_table_style sets_table_style_text">מהודר</td>
		<td id="sets_amount_2" class="sets_table_style"></td>
		<td class="sets_table_style">
			<select id="sets_quantity_2" class="selectSets" onchange="onQuantityChange()"></select>
		</td>
		<td id="total2" class="sets_table_style">0</td>
	</tr>
	<tr>
		<td id="sets_item_name_3" class="sets_table_style sets_table_style_text">מהודר מן המהודר</td>
		<td id="sets_amount_3" class="sets_table_style"></td>
		<td class="sets_table_style">
			<select id="sets_quantity_3" class="selectSets" onchange="onQuantityChange()"></select>
		</td>
		<td id="total3" class="sets_table_style">0</td>
	</tr>
	<tr>
		<td id="sets_item_name_4" class="sets_table_style sets_table_style_text">סט עבור נזקקים</td>
		<td id="sets_amount_4" class="sets_table_style"></td>
		<td class="sets_table_style">
			<select id="sets_quantity_4" class="selectSets" onchange="onQuantityChange()"></select>
		</td>
		<td id="total4" class="sets_table_style">0</td>
	</tr>
<!--
	<tr>
		<td id="yemeni_etrog_name" class="sets_table_style sets_table_style_text">אתרוג תימני לכל הסטים</td>
		<td id="yemeni_etrog_amount" class="sets_table_style">
            <input type="checkbox" id="yemeni_etrog" onclick="setSetsPrices(this.checked)">
        </td>
	</tr>
-->	
    <tr class="sets_table_style">
		<td class="sets_table_style sets_table_style_text" colspan="3">סה"כ</td>
		<td id="total" class="sets_table_style total_style">0</td>
	</tr>
</table>
</td>
<td>
</td>
</tr>
</table>
</div>

<div id="part2" style="display:none">
<img class="title_bars" src="TitleBars/2.gif" alt="בוחרים עמותה" title="בוחרים עמותה">
<br>
<table id="selectAmuta"></table>

</div>

<div id="part3" style="display:none">

<img class="title_bars" src="TitleBars/3.gif" alt="דרך איסוף הסט" title="דרך איסוף הסט">
<br>
<br>
<div class="title">נקודת חלוקה</div>
<br>
<div class="blue">בימים שישי ומוצאי שבת, בין יום כיפור לסוכות, יפעלו ברחבי הארץ מספר רב של מוקדים בהם תוכלו לאסוף את הסט</div>
<div class="bulletFlex">
    <ul class="noBullet">
        <li>אזור:  <select id="selectArea"></select></li>
        </br>
        <li>תחנה: <select id="selectPickup"></select></li>
    </ul>
</div>
<div class="blue">כתובת מדויקת לאיסוף תופיע בקבלה</div>

<!--
<table class="deliveryTable">
    <tr><td class="deliveryTitle">בחר דרך קבלת הסט מתוך האפשרויות הבאות:</td></tr>
    <tr><td> </td></tr>
	<tr><td><input name="delivery" class="delivery" type="radio" value="1" checked="checked"><span id="textForPickup" class="deliveryTextStyle"></span></td></tr>
 	<tr><td class="delivaryIdent"><span id="commentForPickup" class="deliveryCommentStyle"></span></td></tr>
 	<tr class="choosePickup"><td class="delivaryIdent">אזור:  <select id="selectArea"></select></td></tr>
 	<tr class="choosePickup"><td class="delivaryIdent">תחנה: <select id="selectPickup"></select></td></tr>
    <tr class="choosePickup"><td class="delivaryIdent blue">כתובת מדויקת לאיסוף תופיע בקבלה</td></tr>
    <tr><td> </td></tr>
	<tr><td><input name="delivery"  class="delivery" type="radio" value="2"><span id="textForDelivery" class="deliveryTextStyle"></span></td></tr>
	<tr><td class="delivaryIdent"><span id="commentForDelivery" class="deliveryCommentStyle"></span></td></tr>
</table>
-->
</div>

<div id="part4" style="display:none">
<img class="title_bars" src="TitleBars/4.gif" alt="תשלום" title="תשלום">
<br>
<br>
<div class="title">פרטים על הרכישה</div>
<div class="endOfProcessDetails bulletFlex">
    <ul>
        <li>התשלום יתבצע באופן מאובטח דרך אתר פייפאל:
            <ul class="endOfProcessNote">
                <li>אין צורך להרשם לאתר פייפאל - ניתן לבחור באפשרות "שלם באמצעות כרטיס אשראי"</li>
                <li>הרכישה מאושרת רק לאחר קבלת הקבלה במייל מאת חברת פייפאל</li>
                <li>במידה ולא קיבלתם את הקבלה, אנא בידקו בכל תיקיות הדואר
                    <ul class="noBullet">
                        <li>(יתכן כי בטעות הדואר יסווג כ"ספאם" או "קידום מכירות")</li>
                    </ul>
                </li>
            </ul>
        </li>
        </br>
        <li>לאחר השלמת הרכישה, ישלחו 2 מיילים מטעם העמותה:
            <ul class="endOfProcessNote">
                <li>הסבר על המשך התהליך</li>
                <li>מייל כללי עם פרטים על הפרוייקט אותו תוכלו לשתף</li>
            </ul>
        </li>
    </ul>
</div>
<br>
<br>
<table>
	<tr><td class="detailsTable">שם פרטי:</td><td><input id="first_name" type="text"></td></tr>
	<tr><td class="detailsTable">שם משפחה:</td><td><input id="last_name" type="text"></td></tr>
	<tr><td class="detailsTable">פלאפון:</td><td><input id="night_phone_b" type="text"></td></tr>
	<tr><td class="detailsTable">אימייל:</td><td><input id="email" type="text"></td></tr>
</table>
<br>
<br>
</div>

<table>
<tr>

<td><input type="image" id="prev" class="buttons" src="Buttons/prev.gif" onclick="onPrev()" style="display:none"></td>
   
<td><input type="image" id="next" class="buttons" src="Buttons/next.gif" onclick="onNext()"></td>

<td>

<!-- PayPal form -->
<form id="PayPal" target="_parent" action="https://www.paypal.com/cgi-bin/webscr" onsubmit="return validateForm()" method="post" style="display:none">
<input class="buttons" type="image"  name="submit" src="Buttons/next.gif">

<!-- Settings: -->
<input type="hidden" name="cmd" value="_ext-enter">
<input type="hidden" name="redirect_cmd" value="_cart">
<input type="hidden" name="upload" value="1">

<input type="hidden" name="charset" value="utf-8">
<input type="hidden" name="currency_code" value="ILS">
<input type="hidden" name="lc" value="he_IL">

<input type="hidden" name="business" value="netinatlulav@gmail.com">
<input type="hidden" name="return" id="return" value="http://www.netinatlulav.com/#!thankyou/cydf">
<input type="hidden" name="cancel_return" id="cancel_return" value="http://www.netinatlulav.com">
<input type="hidden" name="notify_url" value="http://netinatlulav.azurewebsites.net/email/ipnListener.php"> 

<input type="hidden" id="image_url" name="image_url" value="">

<!-- Details: -->
<input type="hidden" name="first_name" value="">
<input type="hidden" name="last_name" value="">
<input type="hidden" name="email" value="">
<input type="hidden" name="night_phone_b" value="">
<input type="hidden" name="custom" id="custom" value="">

<!-- Items: -->

</form>
</td>
</tr>
</table>

</div>
</body>
</html>
