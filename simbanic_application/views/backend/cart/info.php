<div class="table-responsive">
	<table id="cart_order_list_data" class="table table-striped table-bordered" >
		<thead>
            <tr>
                <th data-column-id="simbanic_product_name">Product Name</th>
                <th data-column-id="price">Rate</th>
                <th data-column-id="quantity">Product Quantity</th>
                <th data-column-id="subtotal">Qty x Rate (Rs.)</th>
                <?php 
                    if(isset($this->data['order']))
                    {
                        if($this->data['order']->status == 'Pending')
                        {
                            ?>
                            <th data-column-id="action" data-formatter="action">Action</th>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <th data-column-id="action" data-formatter="action">Action</th>
                        <?php
                    }
                ?>
            </tr>
        </thead>
	</table>

	<div id="order_info" class="">

	</div>

</div>