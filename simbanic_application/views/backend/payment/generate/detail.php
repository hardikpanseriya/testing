	<table width="100%" align="center" style="margin: 5px 0px 5px 0px; font-size: 22px; color: #8e5fa2;">
		<tr>
			<td align="center">
				<b><?= $payment_info->method ?> Receipt</b>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin: 15px 0px 5px 0px;">

		<tr>
			<td align="left" width="50%">
				<b><?= $payment_info->method ?> Receipt #: <?= $payment_info->receipt_no; ?></b>
			</td>
			<td align="right" width="50%">
				<b>Date: <?= gridDisplayDate($payment_info->confirm_date); ?></b>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin: 15px 0px 5px 0px; font-size: 18px;">
		<tr>
			<td>
				<?= $payment_info->method ?> Received From <span style="text-decoration: underline; display:inline-block;"> <?= $user_info->full_name ?> </span> of Rs. <?= $payment_info->amount; ?>
			</td>
		</tr>
	</table>

	<table width="100%" style="margin: 15px 0px 5px 0px; font-size: 18px;">
		<tr>
			<td align="right">
				<b>Total Amount Received: Rs.<?= $payment_info->amount; ?></b>
			</td>
		</tr>
	</table>

	<table width="100%" align="center" style="margin: 15px 0px 5px 0px; border: 0.1mm solid #888888;">
		<tr>
			<td align="center">
				<b>For, WALARTPHARMACEUTICAL CO .</b>
			</td>
		</tr>

		<tr>
			<td align="right" style="padding: 5px; vertical-align: middle;">
				<b>AUTHORISED SIGNATORY</b>
			</td>
		</tr>
	</table>