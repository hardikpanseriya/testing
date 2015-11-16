<?php $this->load->view('common/header'); ?>
         
<div class="main-container">
    <div class="main-content">
        <div class="container">
        <?php
        if(strpos($_SERVER['REQUEST_URI'], '/edit') !== false)
        {
            if(isset($invoice_id) && $invoice_id != 0) 
            {
                $offset_invoice_id = $invoice_id;
            }
            else
            {
                $offset_invoice_id = 0;
            }
            if(isset($_GET['page']) && $_GET['page'] == 'dashboard')
            {
                $page_redirect = $_GET['page'];
                $_GET['offset'] = $offset_invoice_id;
                $get_search_data = '?'.http_build_query($_GET, '', "&");
            }
            elseif(isset($_GET['page']) && $_GET['page'] == 'search')
            {
                $page_redirect = 'invoice/search/create';
                $_GET['offset'] = $offset_invoice_id;
                $get_search_data = '?'.http_build_query($_GET, '', "&");
            }
            else
            {
                $get_search_data = '';
            }
            
            
            ?>
            <a class="btn btn-light-grey" href="<?= base_url($page_redirect.$get_search_data); ?>" style="margin-left: 10px;">
                <i class="fa fa-arrow-circle-left"></i>&nbsp;Back
            </a>
            <?php
        }
        ?>
        <?php 
            if($this->session->flashdata('message'))
            { 
            ?>
            <div class="alert alert-success flash_message">
                <button class="close" data-dismiss="alert">
                    ×
                </button>
                <i class="fa fa-check-circle"></i>
                <strong>Well done!</strong>
                <?= $this->session->flashdata('message'); ?>
            </div>
            <?php
            }
            ?>
            <div class="row">
                <div class="col-sm-6 col-sm-offset-2">
                    <div class="panel-default">
                        <div class="panel-body">
                            <?php
                            if(isset($invoice_id) && $invoice_id != 0) 
                            {
                                echo form_open('invoice/update/'.$invoice_id.$get_search_data, array('id'=>'invoice_form', 'class'=>'form-invoice form-horizontal'));
                                ?>
                                <input type="hidden" id="invoice_id" name="invoice_id" value="<?= $invoice_id; ?>">
                                <?php
                            }
                            else
                            {
                                echo form_open('invoice/store', array('id'=>'invoice_form', 'class'=>'form-invoice form-horizontal'));
                                ?>
                                <input type="hidden" id="invoice_id" name="invoice_id" value="0">
                                <?php
                            }
                            ?>
                            <div class="invoice_error">
                                <?= validation_errors(); ?>
                            </div>
                            <?php
                            if(isset($user_role) && ($user_role == 'Admin' || $user_role == 'Manager'))
                            {
                            ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Invoice Id </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="invoice_invoice_id" placeholder="Enter Invoice Id" value="<?php if(isset($invoice_invoice_id)){ echo $invoice_invoice_id; } ?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <?php
                            if(isset($user_role) && $user_role == 'Admin')
                            {
                            ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"> Prefix </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="prefix" placeholder="Enter prefex" value="<?php if(isset($prefix)){ echo $prefix; } ?>">
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Date </label>
                                <div class="col-sm-9">
                                    <!--<input class="form-control date-picker" type="text" data-date-viewmode="years" data-date-format="mm-dd-yyyy" name="date" placeholder="Enter Date" value="">-->
                                    <input class="form-control date-picker" type="text" data-date-viewmode="years" data-date-format="mm-dd-yyyy" name="date" placeholder="Enter Date" value="<?php if(isset($date)){ echo $date; } ?>">
                                    <!--<span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>-->
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Amount </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value="<?php if(isset($amount)){ echo $amount; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Collector Name </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="collector_name" placeholder="Collector Name" value="<?php if(isset($collector_name)){ echo $collector_name; } ?>">
                                </div>
                            </div>
                            
                            <p style="text-align: center">
                                <b>Enter your company details below:</b>
                            </p>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Company Name </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="<?php if(isset($company_name)){ echo $company_name; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Address </label>
                                <div class="col-sm-9">
                                    <textarea name="company_address" class="form-control" placeholder="Company Address"><?php if(isset($company_address)){ echo $company_address; } ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> City </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="company_city" placeholder="Company City" value="<?php if(isset($company_city)){ echo $company_city; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> State </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="company_state" placeholder="Company State" value="<?php if(isset($company_state)){ echo $company_state; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Zip </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="company_zip" placeholder="Company Zip" value="<?php if(isset($company_zip)){ echo $company_zip; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Phone </label>
                                <div class="col-sm-9">
                                    <input id="company_phone" name="company_phone" class="form-control input-mask-phone" type="text" placeholder="Company Phone" value="<?php if(isset($company_phone)){ echo $company_phone; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Fax </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="company_fax" placeholder="Company Fax" value="<?php if(isset($company_fax)){ echo $company_fax; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Email </label>
                                <div class="col-sm-9">
                                    <input type="text" id="company_email" class="form-control" name="company_email" placeholder="Company Email" value="<?php if(isset($company_email)){ echo $company_email; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Contact </label>
                                <div class="col-sm-9">
                                    <input type="text" id="contact_name" class="form-control" name="contact_name" placeholder="Contact Name" value="<?php if(isset($contact_name)){ echo $contact_name; } ?>">
                                </div>
                            </div>
			   <div class="form-group">
                                <label class="col-sm-3 control-label"> Position </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="position" placeholder="Position" value="<?php if(isset($position)){ echo $position; } ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Discount </label>
                                <div class="col-sm-9">
                                    <input type="text" id="discount" class="form-control" name="discount" placeholder="Discount" value="<?php if(isset($discount)){ echo $discount; } else { echo '0'; } ?>">
                                </div>
                            </div>
                            <?php
                            $options = array('None' => 'None', 'Ptp' => 'Ptp', 'Not Interested' => 'Not Interested', 'No Longer There' => 'No Longer There', 'No Block callers' => 'No Block callers', 'Number Disconnected' => 'Number Disconnected', 'Do not call' => 'Do not call', 'Paid' => 'Paid');
                            $data_attributes = 'id="invoice_status" class="form-control"';
                            ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Invoice Status </label>
                                <div class="col-sm-9">
                                    <?= form_dropdown('invoice_status', $options, isset($invoice_status) ? $invoice_status : 'None', $data_attributes); ?>
                                </div>
                            </div>
                            <!--
                            <?php
                            if(isset($user_role) && $user_role == 'Admin')
                            {
                            ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Invoice Sent </label>
                                <div class="col-sm-9">
                                    <input type="checkbox" name="invoice_sent" <?= isset($invoice_id) ? "disabled readonly" : "" ?> <?= isset($invoice_status) && $invoice_status != ''  ? "checked=checked" : '' ?>>
                                </div>
                            </div>
                           <?php
                            }
                           ?> 
                            -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label">  </label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-bricky pull-right">
                                        <?= isset($invoice_id) && $invoice_id != 0 ? 'Update' : 'Submit'; ?>
                                        <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                if(isset($user_role) && $user_role == 'Admin' && !isset($invoice_id))
                {
                ?>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="panel-default">
                        <div class="panel-body">
<!--
                            <a href="<?= base_url('invoicecontroller/download/sampleinvoice.csv'); ?>"> Download Sample CSV File </a>
-->    
                        <h2>Import CSV File</h2>
                            <?= form_open_multipart('invoicecontroller/readExcel', array('class'=>'form-invoice-csv form-horizontal')); ?>
                                <div class="invoice_error">
                                    <?= validation_errors(); ?>
                                </div>
                                <?php
                                if($this->session->flashdata('error_message'))
                                {                                
                                    ?>
                                    <div class="alert alert-block alert-danger fade in">
                                        <button class="close" type="button" data-dismiss="alert"> × </button>
                                        <h4 class="alert-heading">
                                            <i class="fa fa-times-circle"></i>
                                            Error!
                                        </h4>
                                        <p><?= $this->session->flashdata('error_message'); ?></p>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div style="margin: 15px 0px;">
                                    <input type="file" name="csvfile">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-bricky">
                                        Submit <i class="fa fa-arrow-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('common/footer'); ?>
<script>
    jQuery(document).ready(function() {
        FormElements.init();

        /*jQuery('.form-invoice .btn').live('click', function(e) {
            alert("Hiii");
            e.preventDefault();
        });*/
    });
</script>