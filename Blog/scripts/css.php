	<link rel="shortcut icon" href="images/logo.png">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">

	<?php 

	 $query ="select * from tbl_thems where id = '1'";
     $themes = $db->select($query);
                        
        while ($result = $themes->fetch_assoc()) {

        	if ($result['theme'] == 'default') { ?>
        		<link rel="stylesheet" href="themes/default.css">
        	<?php }elseif($result['theme'] == 'green'){ ?>
				<link rel="stylesheet" href="themes/green.css">
			<?php }elseif($result['theme'] == 'red'){ ?>
				<link rel="stylesheet" href="themes/red.css">

        	<?php } } ?>
