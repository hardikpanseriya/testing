    <!-- /.navbar-static-side -->
    <div role="navigation" class="navbar-default sidebar">
        <div class="sidebar-nav navbar-collapse">

            <ul id="side-menu" class="nav in">
            	<?php
            		if($this->ion_auth->is_admin())
					{
						echo admin_menu();
					}
					elseif($this->ion_auth->is_depot())
					{
						echo depot_menu();
					}
					elseif($this->ion_auth->is_doctor())
					{
						echo doctor_menu();
					}
					elseif($this->ion_auth->is_medical_store())
					{
						echo medical_store_menu();
					}
					else
					{
						echo "Menu";
					}
            	?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>