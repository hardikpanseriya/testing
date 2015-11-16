	<table class="items" width="100%" style="font-size: 11pt; border-collapse: collapse;" cellpadding="8">

		<thead>
			<tr>
				<th width="5%">SR.</th>
				<th width="20%">Product Name</th>
				<th width="12%">Batch No.</th>
				<th width="13%">Exp.Date</th>
				<th width="10%">Qty</th>
				<th width="7%">Rate</th>
				<th width="7%">MRP</th>
				<th width="8%">VAT%</th>
				<th width="8%">VATRs</th>
				<th width="20%">Amount</th>
			</tr>
		</thead>

		<tbody>
		<?php
			if($invoice_product_info)
			{
				$total_vatrs = 0;
				$total_amount = 0;
				$sr_no = 1;

				foreach($invoice_product_info as $invoice_product)
				{
					if($invoice_product->id)
					{
						$total_vatrs += $invoice_product->vatrs;
						$total_amount += $invoice_product->sub_total;
						?>
						<tr>
							<td align="center"><?= $sr_no; ?></td>
							<td align="center"><?= $invoice_product->name . ' ' . $invoice_product->packing_size . ' ' . $invoice_product->unit; ?></td>
							<td align="center"><?= $invoice_product->batch_no; ?></td>
							<td align="center"><?= convertYMDtoDMY("-", $invoice_product->expiry_date); ?></td>
							<td align="center"><?= $invoice_product->order_quantity; ?></td>
							<td align="center"><?= $invoice_product->price; ?></td>
							<td align="center"><?= $invoice_product->mrp; ?></td>
							<td align="center"><?= $invoice_product->vat == '' ? '0%'  : $invoice_product->vat .' %'; ?></td>
							<td align="right"><?= $invoice_product->vatrs; ?></td>
							<td align="right"><?= $invoice_product->sub_total; ?></td>
						</tr>
						<?php
						$sr_no++;
					}
				}
			}
		?>	

						<tr style="font-weight: bold;">
							<td class="blanktotal" colspan="7" rowspan="5"></td>
							<td class="totals">Total</td>
							<td class="totals"><?= $total_vatrs; ?></td>
							<td class="totals"><?= $total_amount; ?></td>
						</tr>
		</tbody>
	</table>

	<table width="100%" style="margin: 5px 0px 5px 0px; border: 0.1mm solid #888888;">
		<tr>
			<td width="70%" style="padding: 5px;">
				<span style="margin-bottom: 5px;"><b><u>SUBJECT TO RAJKOT JURISDICTION</u></b></span><br />
				<span style="margin-bottom: 5px;">TIN No. 24090704243 CST TIN No. 2459070424</span><br/>
				<span style="margin-bottom: 5px;">D.L.No. 20 B GJRAJ98155 / 21 B GJRAJ98156</span><br />
				<span style="margin-bottom: 5px;">We will charge 18% interest p.a. after Due date </span>
				<?= date('d-m-Y', strtotime("+1 months", strtotime($invoice_info->date_created)));?><br />
				<span style="margin-bottom: 5px;">
					Transportation Name: <?= $invoice_info->transportation_name; ?> | 
					LR No. <?= $invoice_info->lr_no; ?>  
				</span>
			</td>
			<td align="right" width="30%" style="padding: 5px; vertical-align: bottom !important; font-size: 14pt;">
				<b>Grand Total: <?= round($total_vatrs + $total_amount); ?></b>
			</td>
		</tr>
	</table>