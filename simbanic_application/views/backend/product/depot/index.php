
    <div class="col-md-12">
        <div class="table-responsive">
            <!--define the table using the proper table tags, leaving the tbody tag empty -->
            <table id="depot_product_list" class="table table-striped table-bordered table-hover">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">

    var griddefs = <?= json_encode($gridDefs); ?>;
    var depot_product_list = jQuery("#depot_product_list");
    
    var grid = depot_product_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/depot/product",
        formatters: {
            
        }
    });

</script>