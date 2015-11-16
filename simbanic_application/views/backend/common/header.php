<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo (isset($title) && $title !='' ? $title : 'WalArtPharma'); ?></title>

    <!-- start: MAIN CSS -->
    <!-- Bootstrap Core CSS -->
    <link href="<?= public_backend_url(); ?>components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= public_backend_url(); ?>components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= public_backend_url(); ?>css/walart_style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= public_backend_url(); ?>components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?= public_backend_url(); ?>components/js/html5shiv.js"></script>
        <script src="<?= public_backend_url(); ?>components/js/respond.min.js"></script>
    <![endif]-->

    <!-- end: MAIN CSS -->

    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <?php
            if(isset($styles) && count($styles) > 0)
            {
                foreach($styles['href'] as $style_href)
                {
                    ?>
                    <link rel="stylesheet" href="<?= public_backend_url(); ?><?= $style_href; ?>" type="text/css" />
                    <?php
                }
            }
        ?>
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
</head>

    <body class="<?php echo (isset($body_class) && $body_class !='' ? $body_class : ''); ?>">
            <?php
            if($this->ion_auth->logged_in())
            {
                ?>
                <div id="wrapper">
                    <?php $this->load->view( BACKEND . '/common/top'); ?>
                <div id="page-wrapper" style="min-height: 389px;">
                    <?php 
                    if($this->session->flashdata('success_message')) 
                    { 
                    ?>
                    <div class="alert alert-success flash_message">
                        <i class="glyphicon glyphicon-check"></i>
                        <strong>Well done!</strong>
                        <?= $this->session->flashdata('success_message'); ?>
                    </div>
                    <?php
                    }
                    ?>
                <?php
            }
            ?>
    