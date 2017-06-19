<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/master.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>    
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mousewheel-3.0.6.pack.js"></script>
	
	


    <!-- Add fancyBox -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
    
</head>
<body class="<?php if(isset($pageClass)){ echo $pageClass; } ?>">