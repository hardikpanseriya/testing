<html>
	<head>
	<style type="text/css">
	body {
		font-family: sans-serif;
	    font-size: 10pt;
	}
	p {
		margin: 0pt;
	}
	td { 
		vertical-align: top; 
	}
	
	.items td {
	    border-left: 0.1mm solid #000000;
	    border-right: 0.1mm solid #000000;
	    padding: 5px;
	}
	table thead th {
		background-color: #EEEEEE;
	    text-align: center;
	    border: 0.1mm solid #000000;
	    padding: 5px;
	}
	.items td.blanktotal {
	    background-color: #FFFFFF;
	    border: 0mm none #000000;
	    border-top: 0.1mm solid #000000;
	    border-right: 0.1mm solid #000000;
	}
	.items td.totals {
	    text-align: right;
	    border: 0.1mm solid #000000;
	}
	
	</style>

	</head>
	
<body>

	<?php $this->load->view(BACKEND . '/payment/generate/detail'); ?>

</body>
</html>