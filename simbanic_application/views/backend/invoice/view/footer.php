<div class="row">
    <div class="col-md-12">
        <div class="col-md-6 form-group">
            <textarea name="comment" id="comment" class="form-control simba_form_control invoice_view_comment"><?= $invoice->comment; ?></textarea>
            <a class="btn btn-sm green pull-right" id="save_comment" onclick="return save_comment_invoice()">
                <i class="fa fa-save"></i>
                Save Comment
            </a>
        </div>
        <div class="col-md-6 form-group invoice_print_view">
            <?php if($this->ion_auth->is_admin()) { ?>
            <div class="col-md-12">
                <label class="simba_form_label width_50 invoice_view_label">
                    Transportation Name:
                </label>
                <input id="transportation_name" class="form-control simba_form_control width_50" type="text" name="transportation_name" value="<?=isset($invoice->transportation_name) ? $invoice->transportation_name : ''; ?>">
            </div>
            <div class="col-md-12">
                <label class="simba_form_label width_50 invoice_view_label">
                    LR No.:
                </label>
                <input id="lr_no" class="form-control simba_form_control width_50" type="text" name="lr_no" value="<?=isset($invoice->lr_no) ? $invoice->lr_no : ''; ?>">
            </div>
            <div class="col-md-12">
                <a class="btn btn-sm green pull-right" id="print_invoice" onclick="return print_invoice()">
                    <i class="fa fa-print"></i>
                    Print Invoice
                </a>
            </div>
            <?php } ?>
            <?php
            if(($this->ion_auth->is_depot() || $this->ion_auth->is_customer()) && $this->input->get_post('view') != 'customer') 
            {
                ?>
                <div class="col-md-12">
                <?php
                if($invoice->date_confirm == NULL)
                {
                    ?>
                    <a href="<?= redirect_backend_url('invoice/confirm/'.$invoice_id); ?>" class="btn btn-md green pull-right" onclick="return confirm('Are you sure?');">Confirm Invoice</a>
                    <?php
                }
                else
                {
                    ?>
                    <a class="btn btn-md green pull-right" disabled>Confirm Invoice</a>
                    <?php
                }
                ?>
                </div>
                <?php
            }
            ?>
            <?php
            if(!$this->ion_auth->is_admin())
            {
                ?>
                <div class="col-md-12">
                <?php
                if($this->input->get_post('view') == 'customer')
                {
                    ?>
                    <a class="btn btn-sm green pull-right" id="print_invoice" href="<?= redirect_backend_url('invoice/generate/'.$invoice_id . '?view=customer') ?>">
                    <?php
                }
                else
                {
                    ?>
                    <a class="btn btn-sm green pull-right" id="print_invoice" href="<?= redirect_backend_url('invoice/generate/'.$invoice_id) ?>">
                    <?php
                }
                ?>
                    <i class="fa fa-print"></i>
                    Print Invoice
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>