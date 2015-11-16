
    <div class="col-md-12 margin_btm_10">
        <a class="btn simba_btn green pull-right" href="<?= redirect_backend_url('depot/create'); ?>"><i class="fa fa-plus"></i> Create Depot</a>
    </div>

    <div class="col-md-12">
        <div class="table-responsive">
            <table id="depot_list" class="table table-bordered">
                <?php echo displayGrid($gridDefs); ?>
            </table>
        </div>
    </div>

<?php $this->load->view( BACKEND . '/common/footer'); ?>

<script type="text/javascript">
    
    var griddefs = <?= json_encode($gridDefs); ?>;

    var bootgrid_table_id = jQuery('table').attr('id');
    var simbanic_grid_list = jQuery("#" + bootgrid_table_id);

    var grid = simbanic_grid_list.bootgrid({
        ajax: true,
        sorting: false,
        columnSelection: true,
        rowCount: <?= (int)$this->config->item('simba_list_limit'); ?>,
        url: base_url + "get/depot",
        formatters: {
            "action": function(column, row)
            {
                return "<a href=\"" + base_url + "depot/edit/" + row.id + "\" class=\"btn btn-sm purple\"><i class=\"fa fa-edit\"></i> Edit</a> " + 
                    "<a class=\"btn btn-sm red\" onclick=\"return simbanicRemove('depot', "+ row.id +")\"><i class=\"fa fa-trash-o\"></i> Delete</a>";
            },
        }
    }).on("loaded.rs.jquery.bootgrid", function(e)
    {
        simbanicGridWidth(griddefs);
    });

</script>