	<table width="100%" style="margin: 5px 0px 5px 0px;">
		<tr>
			<td style="border: 0.1mm solid #888888; padding: 5px;">
				<b>To,</b><br />
				<b><?= $user_info->full_name; ?></b><br/>
				<?= nl2br($user_info->work_address); ?><br />
				<?= $user_info->contact_person; ?><br />
				<?= $user_info->mobile_no; ?><br />
				<span style="font-weight: 300;">
					TIN: &nbsp;<?= $user_info->tin_no; ?>&nbsp;
					DL No: &nbsp;<?= $user_info->dl_no; ?>
				</span>
			</td>
		</tr>
	</table>