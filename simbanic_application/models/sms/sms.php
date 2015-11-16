<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends Simba_Model
{
	public $app_url = 'https://play.google.com/store/apps/details?id=com.alan.tag2m';
	public $web_url = 'http://www.walartpharma.com/';
	public $info_mail = 'info@walartpharma.com';
	public $customer_care_no = '07623872700';


	public function __construct()
	{
		parent::__construct();
		$this->load->model('prescription/prescription');
	}

	public function createCustomer($user_id)
	{
		$user_info = $this->ion_auth->getSimbanicUser($user_id);
		if($user_info)
		{
			header( 'Content-Type: text/html; charset=utf-8' );

			$mobile_no = $user_info->mobile_no;
			$full_name = $user_info->full_name;
			$customer_id = $user_info->customer_id;
			$password = $user_info->password;
			$message = "Respected ". $full_name .", You are welcome to India’s Biggest Veterinary Family (VBM Parivar).
			Your Cust.ID is ". $customer_id ."%0aPassword is ". $password ."
			VBM Parivar";

			$send_sms = $this->simba_sms->send_sms($mobile_no, $message, '', 'json');
			$this->webInfo($mobile_no);
			if($this->ion_auth->is_doctor($user_id))
			{
				$this->appInfo($mobile_no);	
			}
			
			return true;
		}
		else
		{
			return false;
		}
	}

	public function webInfo($mobile_no) 
	{
		$message = "Sir, For your VBM Turn Over Details, %0aSee our Website ". $this->web_url ." %0aFor suggest Email to " . $this->info_mail . "%0aCust.Care No. ". $this->customer_care_no ."
			VBM Parivar";

		$send_sms = $this->simba_sms->send_sms($mobile_no, $message, '', 'json');
		return true;
	}

	public function appInfo($mobile_no) 
	{
		$message = "Sir, For Writing online Prescription in Mobile, %0aOpen This link ". $this->app_url;

		$send_sms = $this->simba_sms->send_sms($mobile_no, $message, '', 'json');
		return true;
	}

	public function changePassword($user_id)
	{
		$user_info = $this->ion_auth->getSimbanicUser($user_id);
		if($user_info)
		{
			$mobile_no = $user_info->mobile_no;
			$full_name = $user_info->full_name;
			$customer_id = $user_info->customer_id;
			$password = $user_info->password;
			$message = "Hello Sir, your password for VBM Cust.ID ". $customer_id ." has been changed successfully. %0aNew password is ". $password ." %0aThanks have a nice day. 
			VBM Parivar";
			$send_sms = $this->simba_sms->send_sms($mobile_no, $message, '', 'json');
			return true;
		}
		else
		{
			return false;
		}
	}

	public function createPrescription($user_id)
	{
		$prescription_sms = $this->prescription->getPrescriptionsSMS($user_id);
		if($prescription_sms)
		{
			if(count($prescription_sms) > 0)
			{
				header( 'Content-Type: text/html; charset=utf-8' );

				foreach ($prescription_sms as $prescriptionSMS) {
					$prescription_id = $prescriptionSMS->id;
					$code = $prescriptionSMS->code;
					$mobile_no = $prescriptionSMS->mobile_no;
					$stores_name = $prescriptionSMS->stores_name;

					/*$message = "Code: ". $code ."
					प्रिय ग्राहक, अपनी दवाओं निम्नलिखित सरकार मान्य मेडिकल स्टोर पर उपलब्ध है।
					";*/
					$message = "Code: ". $code ."
					Dear Customer, Aapki Standard Medicine niche likhe gaye Goverment manya Medical store se Milegi.
					";

					$store_data = $this->prescription->getPrescriptionSMSMedicalStore($prescription_id);
					if($store_data)
					{
						$k = 1;
						foreach($store_data As $store)
						{
							$store_name = $store->store_name;
							$medical_mobile_no = $store->mobile_no;
							$work_address = $store->work_address;
							$medical_message = $store_name . " " . $work_address . " " . $medical_mobile_no;
							
							$message .= "%0a". $k .") ".$medical_message;
							$k++;
						}
					}
					$message .= "%0a%0aVBM Parivar";
					
					//$send_sms = $this->simba_sms->send_sms($mobile_no, $message, '', 'json');
					
					$update_array = array('sms_status' => '1');
					$this->query_model->save('prescription', $update_array, $prescription_id);
				}
			}
		}
	}

	public function prescriptionChanged($prescription_id)
	{
		$prescription_data = $this->query_model->get('prescription', $prescription_id);
		if($prescription_data)
		{
			$user_id = $prescription_data->created_by;
			$completed_by = $prescription_data->completed_by;
			$customer_mobile_no = $prescription_data->mobile_no;
			$medical_info = $this->ion_auth->getSimbanicUser($completed_by);
			$medical_full_name = $medical_info->full_name;

			$user_info = $this->ion_auth->getSimbanicUser($user_id);
			$mobile_no = $user_info->mobile_no;

			$message = "Your Prescription No ". $prescription_id ." with Cust.Mob ". $customer_mobile_no ." is Changed By ". $medical_full_name .". So Please Check it.
			VBM Parivar";
			
			$send_sms = $this->simba_sms->send_sms($mobile_no, $message, '', 'json');
			return true;
		}
		else
		{
			return false;
		}
		
	}
}