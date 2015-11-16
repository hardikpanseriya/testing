<nav style="margin-bottom: 0" role="navigation" class="navbar navbar-default navbar-static-top">

    <div class="navbar-header">
        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?= base_url('/'); ?>" class="navbar-brand">Walart Pharmaceautical</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span>Welcome, <?= $this->ion_auth->user()->row()->full_name; ?></span>
        </li>
        
        <li>
            <span><a href="<?= redirect_backend_url('auth/logout'); ?>">Logout</a></span>
        </li>
        
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <?php $this->load->view(BACKEND . '/common/left'); ?>

</nav>