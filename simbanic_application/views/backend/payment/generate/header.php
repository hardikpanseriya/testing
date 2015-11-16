	
		<table width="100%">
			<tr>
				<td width="50%" style="color:#0000BB;">
					<span style="font-weight: bold; font-size: 14pt;">WALART PHARMACEUTICAL CO.</span><br />
					SF - 63, 3RD FLOOR<br />
					SHRIMAD BHAVAN<br />
					RAJKOT - 360001<br />
					<span style="font-size: 15pt;">&#9742;</span> 97241 54433
				</td>
				<td width="50%" style="text-align: right;">
					<table align="right" style="font-weight: bold;">
		                <tr>
		                    <td align="right">Receipt No.</td>
		                    <td>&nbsp;:&nbsp;</td>
		                    <td><?= $payment_info->receipt_no; ?></td>
		                </tr>
		                <tr>
		                    <td align="right">Date</td>
		                    <td>&nbsp;:&nbsp;</td>
		                    <td><?= gridDisplayDate($payment_info->confirm_date); ?></td>
		                </tr>
		            </table>
				</td>
			</tr>
		</table>
	
	