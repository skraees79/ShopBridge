<?php
// setcookie('product_info', null, -1);

if(isset($_GET['products'])){
	$product_info = ARRAY(ARRAY("image" => "https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg", "name" => "Digital Camera", "description" => "Digital DSLR Camera", "price" => 45000), ARRAY("image" => "https://cdn.vox-cdn.com/thumbor/3o5bkD-T3oQ3EIfXotA4k9P97TY=/1400x1400/filters:format(png)/cdn.vox-cdn.com/uploads/chorus_asset/file/22443013/5.png", "name" => "Wireless Headphones", "description" => "Wireless Bluetooth Headphones", "price" => 1200), ARRAY("image" => "https://static.digit.in/product/thumb_160001_product_td_300.jpeg", "name" => "Smart Phone", "description" => "Android Screen Touch Smart Phone", "price" => 49999), ARRAY("image" => "https://cdn.pixabay.com/photo/2020/05/26/09/32/product-5222398_960_720.jpg", "name" => "Sun Glass", "description" => "Black Sun Glass", "price" => 999));

	if(isset($_COOKIE['product_info'])){
		echo $_COOKIE['product_info'];
	}else{
		setcookie('product_info', json_encode($product_info), time()+3600);
		echo json_encode($product_info);
	}	
}elseif(isset($_GET['product'])){
	$product_info = json_decode($_COOKIE['product_info'], true);
	$product_info[$_GET['product']]['id'] =  $_GET['product'];
	echo "[".json_encode($product_info[$_GET['product']])."]";
}elseif(isset($_GET['NAME'])){
	$product_info = json_decode($_COOKIE['product_info'], true);	
	if($_GET['PRODUCT_ID']!=''){
		$product_info[$_GET['PRODUCT_ID']] = ARRAY("image" => $_GET['IMAGE'], "name" => $_GET['NAME'], "description" => $_GET['DESCRIPTION'], "price" => $_GET['PRICE']);
		setcookie('product_info', json_encode($product_info), time()+3600);
	}else{
		array_push($product_info, ARRAY("image" => $_GET['IMAGE'], "name" => $_GET['NAME'], "description" => $_GET['DESCRIPTION'], "price" => $_GET['PRICE']));
		setcookie('product_info', json_encode($product_info), time()+3600);
	}
	echo json_encode($product_info);
}elseif(isset($_GET['delete'])){
	$product_info = json_decode($_COOKIE['product_info'], true);	
	unset($product_info[$_GET['delete']]);
	$product_info = array_values($product_info);
	setcookie('product_info', json_encode($product_info), time()+3600);
	echo json_encode($product_info);
}

if(!empty($_FILES['prod_img']['name'])){   
    $file_name = $_FILES['prod_img']['name'];
    $extension = pathinfo($file_name,PATHINFO_EXTENSION);
    $upload_path = '';
	
	$temp_file_name = $file_name;
    $upload_file = $upload_path. '' . $file_name;
    $image = ''.$temp_file_name;
    error_log($image);
    if(move_uploaded_file($_FILES["prod_img"]["tmp_name"], $upload_file)){
        echo $image;
    }else{
		$image = null;
    }
}

?>
