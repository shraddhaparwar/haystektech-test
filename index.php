<?php 
$tot = 0;
if(file_exists('data.json')){
	$jdata = file_get_contents('data.json');
	$data = json_decode($jdata);
	$tot = count($data);
	$message = "<h3 class='text-success'>PEOPLE DATA</h3>";
}else{
	$message = "<h3 class='text-danger'>DATA NOT FOUND</h3>";
}


$menuItems = array_slice( $data, 0, 3 ); 

$page = ! empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
$total = count( $data ); //total items in array    
$limit = 3; //per page    
$totalPages = ceil( $total/ $limit ); //calculate total pages
$page = max($page, 1); //get 1 page when $_GET['page'] <= 0
$page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
$offset = ($page - 1) * $limit;
if( $offset < 0 ) $offset = 0;

$yourDataArray = array_slice( $data, $offset, $limit );


$link = 'index.php?page=%d';
$pagerContainer = '<div style="width: 300px;">';   
if( $totalPages != 0 ) 
{
	if( $page == 1 ) 
	{ 
		$pagerContainer .= ''; 
	} 
	else 
	{ 
		$pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 ); 
	}
	$pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>'; 
	if( $page == $totalPages ) 
	{ 
		$pagerContainer .= ''; 
	}
	else 
	{ 
		$pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 ); 
	}           
}                   
$pagerContainer .= '</div>';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<title>Read a JSON File</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<style>
		body{
			background-color: #008cbf; text-align: center;
		}
		.page-head{
			color: #fff; font-size: 40px;
		}
		.next-btn{
			color: #fff; font-size: 20px; margin-left: 60px; background-color: #cc482f;border-radius: 50px;
			padding: 10px;
		}
		.spanno{
			color: #fff; font-size: 15px; margin-left: 20px;font-size: 35px;margin-top: 10px;background: green; height: 83px;
			border: 1px solid rgba(0,0,0,.125);
			border-radius: 0.25rem;
			width: 45px;
		}
		.spannoTt{
			color: #fff;
			font-size: 20px;
			margin-top: 10px;
			height: 83px;width: 80%;
			border: 1px solid rgba(0,0,0,.125);
			border-radius: 0.25rem;

		}

		.name{
			background-color: #a3bedb;
			font-size: 20px;
			color: black;
			padding: 5px;
			margin-bottom: 0px;	
			border: 1px solid rgba(0,0,0,.125);
			border-radius: 0.25rem;

		}
		.location{
			margin-top: -2px;
			font-size: 20px;
			color: black;
			padding: 5px;
			background-color: #f8f9fa;
			border: 1px solid rgba(0,0,0,.125);
			border-radius: 0.25rem;

		}

		.container{
			margin-top: 20px;
		}
		.bottom-heading{
			color: white;
			padding: 20px;
			text-align: center;
			font-size: 14px;
		}
	</style>
</head>
<body >
	<div class="container" style="width:500px;">
		<div class="table-container">
			<span class="page-head">PEOPLE DATA</span>
			<span class="next-btn">NEXT PERSON</span>
			<div class="" style=" margin-top: 50px;">
				<?php foreach ($yourDataArray as $contItem => $item) { ?>
					<div class="row ">
						<div class="spanno"><span class="" style=""><?php echo $item->id;?></span></div>

						<div class="spannoTt">
							<p class="name" ><?php echo $item->name; ?></p><p class="location"><?php echo $item->location; ?></p>
						</div>
					</div>
					<?php 
				}?>

			</div>
			<p class="bottom-heading">CURRENTLY  <?php echo $total;?> PEOPLE SHOWING</p>
			<?php echo $pagerContainer;?>
		</div>
	</div>
</body>
</html>