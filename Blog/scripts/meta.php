	<?php 
			if (isset($_GET['pageid'])) {
				$pagetitle = $_GET['pageid'];

				$query = "select * from tbl_addpage where id ='$pagetitle'";
            	$show_title = $db->select($query);
                if ($show_title) {
                    while ($result = $show_title->fetch_assoc()) { ?>
			<title><?php echo $result['name']; ?> -<?php echo TITEL; ?></title>
     <?php   }}}elseif(isset($_GET['id'])) {
				$posttitle = $_GET['id'];

				$query = "select * from tbl_post where id ='$posttitle'";
            	$post_title = $db->select($query);
                if ($post_title) {
                    while ($result = $post_title->fetch_assoc()) { ?>
			<title><?php echo $result['title']; ?> -<?php echo TITEL; ?></title>
     <?php   }}} else{ ?>
			<title><?php echo $fm->title(); ?> -<?php echo TITEL; ?></title>
     <?php } ?>

	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php 
		if (isset($_GET['id'])) {
			$keyid = $_GET['id'];
		    $query = "select * from tbl_post where id ='$keyid'";
            $tag = $db->select($query);
            if ($tag) {
                    while ($metatags = $tag->fetch_assoc()) { ?>
        <meta name="keywords" content="<?php echo $metatags['tags']; ?>">            	
	<?php } } }else{ ?>
	 	<meta name="keywords" content="<?php echo KEYWORDS; ?>">
	<?php } ?>
	<meta name="author" content="Hossain">