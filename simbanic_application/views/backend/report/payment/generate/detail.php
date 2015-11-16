	<?php 
	if(isset($payment_info))
	{
		if(!empty($payment_info))
		{
			?>
			<div class="table-responsive" style="margin-top: 20px;">
				<table border="1" width="100%" align="center" class="table table-bordered">
					<tr>
						<th>Full Name</th>
						<th>Date</th>
						<th>Details</th>
						<th>Debit</th>
						<th>Credit</th>
						<th>Due Balance</th>
					</tr>
			<?php
			foreach ($payment_info as $paymentInfo) 
			{
				?>
				<!--<div class="table-responsive">
					<table width="100%" align="center" class="table table-bordered">-->
						<?php
						$filter_user_id = $paymentInfo[0]['filter_user_id'];
						$customer_info = $this->ion_auth->getSimbanicUser($filter_user_id);
						$customer_name = $customer_info->full_name;

						for($i = 0; $i < count($paymentInfo); $i++)
						{

							?>
							<tr>
								<?php 
								if($i == 0)
								{
									?>
									<td rowspan="<?= count($paymentInfo); ?>" width="20%">
										<?php 
										echo $customer_name;
										?>
									</td>
									<?php
								}
								?>
								
								<td width="10%">
									<?php 
									if(isset($paymentInfo[$i]['date']))
									{
										echo $paymentInfo[$i]['date'];
									}
									?>
								</td>
								<td width="20%">
									<?php 
									if(isset($paymentInfo[$i]['details']))
									{
										echo $paymentInfo[$i]['details'];
									}
									?>
								</td>
								<td width="15%">
									<?php 
									if(isset($paymentInfo[$i]['debit']))
									{
										echo $paymentInfo[$i]['debit'];
									}
									?>
								</td>
								<td width="15%">
									<?php 
									if(isset($paymentInfo[$i]['credit']))
									{
										echo $paymentInfo[$i]['credit'];
									}
									?>
								</td>
								<td width="20%">
									<?php 
									if(isset($paymentInfo[$i]['due_balance']))
									{
										echo $paymentInfo[$i]['due_balance'];
									}
									?>
								</td>
							</tr>
							<?php
							
						}
						?>
					<!--</table>
				</div>-->
				<?php
			}
			?>
				</table>
			</div>
			<?php
		}
	}
	?>
	

	<!--<table width="100%" align="center" style="margin: 15px 0px 5px 0px; border: 0.1mm solid #888888;">
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
	</table>-->