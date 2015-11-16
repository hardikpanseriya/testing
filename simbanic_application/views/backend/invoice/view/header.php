<div id="notification">
</div>
<div class="row">
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="col-md-12">
            <span class="pull-left">
                <?php
                if(isset($previous_invoice) && !empty($previous_invoice) && count($previous_invoice) == 1)
                {
                    if($this->input->get_post('view') == 'customer')
                    {
                        ?>
                        <a class="btn yellow btn-sm previous_btn" href="<?= redirect_backend_url('invoice/view/'.$previous_invoice[0]->id.'?view=customer') ?>">
                        <?php
                    }
                    else
                    {
                        ?>
                        <a class="btn yellow btn-sm previous_btn" href="<?= redirect_backend_url('invoice/view/'.$previous_invoice[0]->id) ?>">
                        <?php
                    }
                    ?>
                    
                        <i class="fa fa-arrow-circle-left"></i>
                        Previous
                    </a>
                    <?php
                }
                ?>
            </span>
            <span class="pull-right">
                <?php 
                if(isset($next_invoice) && !empty($next_invoice) && count($next_invoice) == 1)
                {
                    if($this->input->get_post('view') == 'customer')
                    {
                        ?>
                        <a class="btn yellow btn-sm next_btn" href="<?= redirect_backend_url('invoice/view/'.$next_invoice[0]->id.'?view=customer') ?>">
                        <?php
                    }
                    else
                    {
                        ?>
                        <a class="btn yellow btn-sm next_btn" href="<?= redirect_backend_url('invoice/view/'.$next_invoice[0]->id) ?>">
                        <?php
                    }
                    ?>
                        <i class="fa fa-arrow-circle-right"></i>
                        Next
                    </a>
                    <?php
                }
                ?>
            </span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="simbanic_user_view">
            <?php
                if(isset($invoice->depot_id))
                {
                    $user_info = $this->ion_auth->getSimbanicUser($invoice->depot_id);
                    $simba_order_id = $invoice->depot_order_id;
                }
                elseif(isset($invoice->retailer_id))
                {
                    $user_info = $this->ion_auth->getSimbanicUser($invoice->retailer_id);
                    $simba_order_id = $invoice->retailer_order_id;
                }
                if(isset($invoice->depot_id) || isset($invoice->retailer_id))
                {
                    ?>
                    <span class="pull-left"><?= $user_info->customer_id . " : " . $user_info->full_name; ?></span>
                    <span class="pull-right">
                        <?php if($this->input->get_post('view') != 'customer'){ ?>
                        Order No.:<a style="color: #FFF" target="_blank" href="<?= redirect_backend_url('order/view/'.$simba_order_id) ?>"> <?= $simba_order_id; ?>
                        <?php } ?>
                        </a>
                        <?= " &nbsp; Invoice No.:" . $invoice_id; ?></span>
                    <?php
                }
            ?>
        </div>
    </div>
</div>