    <div class="row">
        <div class="col-md-12">
            <?php 
            if(isset($filter_view))
            {
                if(!empty($filter_view))
                {
                    ?>
                    <div class="col-md-4 marginBtm20">
                        <select name="filter_view" id="filter_view" class="form-control">
                            <?php 
                            foreach ($filter_view as $key => $value) 
                            {
                                ?>
                                <option value="<?= $key; ?>">
                                    <?= $value; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <input type="text" class="form-control date_range" name="daterange" id="daterange" value="" placeholder="Select Date to Date" />
            </div>
            <div class="col-md-8 paddingLeftright0">
                <?php 
                if(isset($depot_data))
                {
                    if(!empty($depot_data))
                    {
                        ?>
                        <div class="col-md-6 paddingLeftright0">
                            <select name="filter_user_id" id="filter_user_id" class="form-control">
                                <option value="">Select Depot</option>
                                <?php 
                                foreach ($depot_data as $depotData) 
                                {
                                    ?>
                                    <option value="<?= $depotData->user_id; ?>">
                                        <?= $depotData->full_name; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                    }
                }
                ?>
                
                <?php 
                if(isset($customer_data))
                {
                    if(!empty($customer_data))
                    {
                        ?>
                        <div class="col-md-6">
                            <?php 
                            if(isset($depot_data) && isset($customer_data) && !empty($depot_data) && !empty($customer_data))
                            {
                                ?>
                                <select name="filter_customer_id" id="filter_customer_id" class="form-control">
                                <?php
                            }
                            else
                            {
                                ?>
                                <select name="filter_user_id" id="filter_user_id" class="form-control">
                                <?php
                            }
                            ?>
                            
                                <option value="">Select Customer</option>
                                <?php 
                                foreach ($customer_data as $customerData) 
                                {
                                    ?>
                                    <option value="<?= $customerData->user_id; ?>">
                                        <?= $customerData->full_name; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                    }
                }
                if(isset($depot_data) && isset($customer_data) && !empty($depot_data) && !empty($customer_data))
                {
                    $style = "margin-left: -15px; margin-top: 10px;";
                }
                else
                {
                    $style = "";
                }
                ?>
                
                <div class="col-md-2" style="<?= $style; ?>">
                    <a class="btn simba_btn green" id="daterangeFilter" onclick="daterangeFilter()" >
                        <i class="fa fa-search"></i>
                        Filter
                    </a>
                </div>
            </div>
        </div>
    </div>