<?php
require 'DB.php';
require 'User.php';
require 'State.php';
require 'Rating.php';
require 'Place.php';
require 'Picture_commentary.php';
require 'Picture.php';
require 'Favorite.php';
require 'District.php';
require 'Country.php';
require 'Commentary.php';
require 'City.php';
require 'Category.php';
require 'Slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(array('debug' => true));
$app->response()->header('Content-Type', 'application/json;charset=utf-8');


$app->get('/category', function () {
	$categoryDAO = new Category();
	$result = $categoryDAO->get();
	echo json_encode($result);
});

$app->post('/category/insert', function () {
	$request = \Slim\Slim::getInstance()->request();
	$category = json_decode($request->getBody());
	$categoryDAO = new Category();
	$categoryDAO->insert($category);
	echo '{"result":"ok"}';
});

$app->post('/category/update', function () {
	$request = \Slim\Slim::getInstance()->request();
	$category = json_decode($request->getBody());
	$categoryDAO = new Category();
	$categoryDAO->update($category);
	echo '{"result":"ok"}';
});

$app->post('/category/delete', function () {
	$request = \Slim\Slim::getInstance()->request();
	$category = json_decode($request->getBody());
	$categoryDAO = new Category();
	$categoryDAO->delete($category);
	echo '{"result":"ok"}';
});


$app->post('/place/getbycat', function () {
	$request = \Slim\Slim::getInstance()->request();
	$param = json_decode($_POST["json"]);
	$placeDAO = new Place();
	$result = $placeDAO->getbycat2($param);
	if(sizeof($result)>0){
		$result["success"]=true;
		echo json_encode($result);
	}else{
		$result["success"]=false;
		echo json_encode($result);
	}
});

$app->post('/place/getall', function () {
	$request = \Slim\Slim::getInstance()->request();
	$param = json_decode($_POST["json"]);
	$placeDAO = new Place();
	$result = $placeDAO->getall($param);
	if(sizeof($result)>0){
		$result["success"]=true;
		echo json_encode($result);
	}else{
		$result["success"]=false;
		echo json_encode($result);
	}
});

$app->post('/place/find', function () {
	$request = \Slim\Slim::getInstance()->request();
	$param = json_decode($_POST["json"]);
	$placeDAO = new Place();
	$result = $placeDAO->find($param);
	if(sizeof($result)>0){
		$result["success"]=true;
		echo json_encode($result);
	}else{
		$result["success"]=false;
		echo json_encode($result);
	}
});

$app->post('/place/create', function () {
	$request = \Slim\Slim::getInstance()->request();
	$param = json_decode($_POST["json"]);
	$placeDAO = new Place();
	$result = $placeDAO->insert($param);
	echo '{"result":"ok"}';
	/*if(sizeof($result)>0){
		echo json_encode($result);
	}else{
		echo json_encode(array(array("id"=>"not_found")));
	}*/
});


$app->post('/user/login', function () {
	$request = \Slim\Slim::getInstance()->request();
	//$user = json_decode($request->getBody());
	$user = json_decode($_POST["json"]);
	$userDAO = new User();
	$result = $userDAO->login($user);
	if(sizeof($result)>0){
		$result["success"]=true;
	}else{
		$result["success"]=false;
	}
	echo json_encode($result);
});

$app->post('/user/create', function () {
	$request = \Slim\Slim::getInstance()->request();
	//$user = json_decode($request->getBody());
	$user = json_decode($_POST["json"]);
	$userDAO = new User();
	$result = $userDAO->insert($user);
	if(sizeof($result)>0){
		$result["success"]=true;
	}else{
		$result["success"]=false;
	}
	echo json_encode($result);
});

$app->post('/user/delete', function () {
	$request = \Slim\Slim::getInstance()->request();
	//$user = json_decode($request->getBody());
	$user = json_decode($_POST["json"]);
	$userDAO = new User();
	$userDAO->delete($user);
	$result = array();
	$result["success"]=true;
	echo json_encode($result);
});

$app->post('/user/update', function () {
	$request = \Slim\Slim::getInstance()->request();
	//$user = json_decode($request->getBody());
	$user = json_decode($_POST["json"]);
	$userDAO = new User();
	$result = $userDAO->update($user);
	if(sizeof($result)>0){
		$result["success"]=true;
	}else{
		$result["success"]=false;
	}
	echo json_encode($result);
});


$app->post('/favorite/mark', function () {
	$request = \Slim\Slim::getInstance()->request();
	$favorite = json_decode($_POST["json"]);
	$favoriteDAO = new Favorite();
	$result = $favoriteDAO->mark($favorite);
	echo json_encode(array("id"=>$result));
});

$app->post('/favorite/unmark', function () {
	$request = \Slim\Slim::getInstance()->request();
	$favorite = json_decode($_POST["json"]);
	$favoriteDAO = new Favorite();
	$result = $favoriteDAO->unmark($favorite);
	echo json_encode(array("id"=>$result));
});

$app->post('/favorite/check', function () {
	$request = \Slim\Slim::getInstance()->request();
	$favorite = json_decode($_POST["json"]);
	$favoriteDAO = new Favorite();
	$result = $favoriteDAO->check($favorite);
	if(sizeof($result)>0){
		echo json_encode(array("id"=>"true"));
	}else{
		echo json_encode(array("id"=>"false"));
	}
});


$app->post('/rating/get', function () {
	$request = \Slim\Slim::getInstance()->request();
	$rating = json_decode($_POST["json"]);
	$ratingDAO = new Rating();
	$result = $ratingDAO->get($rating);
	if(sizeof($result)>0){
		echo json_encode($result);
	}else{
		echo json_encode(array("id"=>"false"));
	}
});

$app->post('/rating/set', function () {
	$request = \Slim\Slim::getInstance()->request();
	$rating = json_decode($_POST["json"]);
	$ratingDAO = new Rating();
	$result = $ratingDAO->set($rating);
	echo json_encode(array("id"=>$result));
});


$app->post('/rating/update', function () {
	$request = \Slim\Slim::getInstance()->request();
	$rating = json_decode($_POST["json"]);
	$ratingDAO = new Rating();
	$result = $ratingDAO->update($rating);
	echo json_encode(array("id"=>$result));
});

$app->post('/rating/list', function () {
	$request = \Slim\Slim::getInstance()->request();
	$rating = json_decode($_POST["json"]);
	$ratingDAO = new Rating();
	$result = $ratingDAO->list_($rating);
	if(sizeof($result)>0){
		echo json_encode($result);
	}else{
		echo json_encode(array(array("id"=>"false")));
	}
});


$app->get('/commentary', function () {
	$commentaryDAO = new Commentary();
	$result = $commentaryDAO->get();
	echo json_encode($result);
});

$app->post('/commentary/set', function () {
	$request = \Slim\Slim::getInstance()->request();
	$commentary = json_decode($_POST["json"]);
	$commentaryDAO = new Commentary();
	$commentaryDAO->insert($commentary);
	$result = array();
	$result["success"]=true;
	echo json_encode($result);
});

$app->post('/commentary/delete', function () {
	$request = \Slim\Slim::getInstance()->request();
	$commentary = json_decode($_POST["json"]);
	$commentaryDAO = new Commentary();
	$commentaryDAO->delete($commentary);
	$result = array();
	$result["success"]=true;
	echo json_encode($result);
});

$app->post('/commentary/list', function () {
	$request = \Slim\Slim::getInstance()->request();
	$commentary = json_decode($_POST["json"]);
	$commentaryDAO = new Commentary();
	$result = $commentaryDAO->list_($commentary);
	if(sizeof($result)>0){
		echo json_encode($result);
	}else{
		echo json_encode(array("id"=>"false"));
	}
});

$app->post('/commentary/getallbyplace', function () {
	$request = \Slim\Slim::getInstance()->request();
	$commentary = json_decode($_POST["json"]);
	$commentaryDAO = new Commentary();
	$result = $commentaryDAO->listall($commentary);
	if(sizeof($result)>0){
		$result["success"]=true;
	}else{
		$result["success"]=false;
	}
	echo json_encode($result);
});

$app->put('/commentary', function () {
	$request = \Slim\Slim::getInstance()->request();
	$commentary = json_decode($request->getBody());
	$commentaryDAO = new Commentary();
	$commentaryDAO->update($commentary);
	echo '{"result":"ok"}';
});

$app->delete('/commentary', function () {
	$request = \Slim\Slim::getInstance()->request();
	$commentary = json_decode($request->getBody());
	$commentaryDAO = new Commentary();
	$commentaryDAO->delete($commentary);
	echo '{"result":"ok"}';
});



$app->post('/picture/getbyplace', function () {
	$request = \Slim\Slim::getInstance()->request();
	//$picture = json_decode($request->getBody());
	$picture = json_decode($_POST["json"]);
	$pictureDAO = new Picture();
	//$pictureDAO->getByPlace($picture);
	//echo '{"result":"ok"}';
	$result = $pictureDAO->getByPlace($picture);
	echo json_encode(array("pictures"=>$result));
});

$app->post('/picture/send', function () {
	$request = \Slim\Slim::getInstance()->request();
	$param = json_decode($_POST["json"]);
	$pictureDAO = new Picture();
	$result = $pictureDAO->insert($param);
	echo '{"result":"ok"}';
	/*if(sizeof($result)>0){
		echo json_encode($result);
	}else{
		echo json_encode(array(array("id"=>"not_found")));
	}*/
});













$app->get('/favorite', function () {
	$favoriteDAO = new Favorite();
	$result = $favoriteDAO->get();
	echo json_encode($result);
});

$app->post('/favorite', function () {
	$request = \Slim\Slim::getInstance()->request();
	$favorite = json_decode($request->getBody());
	$favoriteDAO = new Favorite();
	$favoriteDAO->insert($favorite);
	echo '{"result":"ok"}';
});

$app->put('/favorite', function () {
	$request = \Slim\Slim::getInstance()->request();
	$favorite = json_decode($request->getBody());
	$favoriteDAO = new Favorite();
	$favoriteDAO->update($favorite);
	echo '{"result":"ok"}';
});

$app->delete('/favorite', function () {
	$request = \Slim\Slim::getInstance()->request();
	$favorite = json_decode($request->getBody());
	$favoriteDAO = new Favorite();
	$favoriteDAO->delete($favorite);
	echo '{"result":"ok"}';
});













$app->get('/user', function () {
	$userDAO = new User();
	$result = $userDAO->get();
	echo json_encode($result);
});

$app->post('/user', function () {
	$request = \Slim\Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	$userDAO = new User();
	$userDAO->insert($user);
	echo '{"result":"ok"}';
});

$app->put('/user', function () {
	$request = \Slim\Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	$userDAO = new User();
	$userDAO->update($user);
	echo '{"result":"ok"}';
});

$app->delete('/user', function () {
	$request = \Slim\Slim::getInstance()->request();
	$user = json_decode($request->getBody());
	$userDAO = new User();
	$userDAO->delete($user);
	echo '{"result":"ok"}';
});













$app->get('/city', function () {
	$cityDAO = new City();
	$result = $cityDAO->get();
	echo json_encode($result);
});

$app->post('/city', function () {
	$request = \Slim\Slim::getInstance()->request();
	$city = json_decode($request->getBody());
	$cityDAO = new City();
	$cityDAO->insert($city);
	echo '{"result":"ok"}';
});

$app->put('/city', function () {
	$request = \Slim\Slim::getInstance()->request();
	$city = json_decode($request->getBody());
	$cityDAO = new City();
	$cityDAO->update($city);
	echo '{"result":"ok"}';
});

$app->delete('/city', function () {
	$request = \Slim\Slim::getInstance()->request();
	$city = json_decode($request->getBody());
	$cityDAO = new City();
	$cityDAO->delete($city);
	echo '{"result":"ok"}';
});



$app->get('/country', function () {
	$countryDAO = new Country();
	$result = $countryDAO->get();
	echo json_encode($result);
});

$app->post('/country', function () {
	$request = \Slim\Slim::getInstance()->request();
	$country = json_decode($request->getBody());
	$countryDAO = new Country();
	$countryDAO->insert($country);
	echo '{"result":"ok"}';
});

$app->put('/country', function () {
	$request = \Slim\Slim::getInstance()->request();
	$country = json_decode($request->getBody());
	$countryDAO = new Country();
	$countryDAO->update($country);
	echo '{"result":"ok"}';
});

$app->delete('/country', function () {
	$request = \Slim\Slim::getInstance()->request();
	$country = json_decode($request->getBody());
	$countryDAO = new Country();
	$countryDAO->delete($country);
	echo '{"result":"ok"}';
});

$app->get('/district', function () {
	$districtDAO = new District();
	$result = $districtDAO->get();
	echo json_encode($result);
});

$app->post('/district', function () {
	$request = \Slim\Slim::getInstance()->request();
	$district = json_decode($request->getBody());
	$districtDAO = new District();
	$districtDAO->insert($district);
	echo '{"result":"ok"}';
});

$app->put('/district', function () {
	$request = \Slim\Slim::getInstance()->request();
	$district = json_decode($request->getBody());
	$districtDAO = new District();
	$districtDAO->update($district);
	echo '{"result":"ok"}';
});

$app->delete('/district', function () {
	$request = \Slim\Slim::getInstance()->request();
	$district = json_decode($request->getBody());
	$districtDAO = new District();
	$districtDAO->delete($district);
	echo '{"result":"ok"}';
});



$app->get('/picture', function () {
	$pictureDAO = new Picture();
	$result = $pictureDAO->get();
	echo json_encode($result);
});



$app->put('/picture', function () {
	$request = \Slim\Slim::getInstance()->request();
	$picture = json_decode($request->getBody());
	$pictureDAO = new Picture();
	$pictureDAO->update($picture);
	echo '{"result":"ok"}';
});

$app->delete('/picture', function () {
	$request = \Slim\Slim::getInstance()->request();
	$picture = json_decode($request->getBody());
	$pictureDAO = new Picture();
	$pictureDAO->delete($picture);
	echo '{"result":"ok"}';
});

$app->get('/picture_commentary', function () {
	$picture_commentaryDAO = new Picture_commentary();
	$result = $picture_commentaryDAO->get();
	echo json_encode($result);
});

$app->post('/picture_commentary', function () {
	$request = \Slim\Slim::getInstance()->request();
	$picture_commentary = json_decode($request->getBody());
	$picture_commentaryDAO = new Picture_commentary();
	$picture_commentaryDAO->insert($picture_commentary);
	echo '{"result":"ok"}';
});

$app->put('/picture_commentary', function () {
	$request = \Slim\Slim::getInstance()->request();
	$picture_commentary = json_decode($request->getBody());
	$picture_commentaryDAO = new Picture_commentary();
	$picture_commentaryDAO->update($picture_commentary);
	echo '{"result":"ok"}';
});

$app->delete('/picture_commentary', function () {
	$request = \Slim\Slim::getInstance()->request();
	$picture_commentary = json_decode($request->getBody());
	$picture_commentaryDAO = new Picture_commentary();
	$picture_commentaryDAO->delete($picture_commentary);
	echo '{"result":"ok"}';
});

$app->get('/place', function () {
	$placeDAO = new Place();
	$result = $placeDAO->get();
	echo json_encode($result);
});

$app->post('/place', function () {
	$request = \Slim\Slim::getInstance()->request();
	$place = json_decode($request->getBody());
	$placeDAO = new Place();
	$placeDAO->insert($place);
	echo '{"result":"ok"}';
});



$app->put('/place', function () {
	$request = \Slim\Slim::getInstance()->request();
	$place = json_decode($request->getBody());
	$placeDAO = new Place();
	$placeDAO->update($place);
	echo '{"result":"ok"}';
});

$app->delete('/place', function () {
	$request = \Slim\Slim::getInstance()->request();
	$place = json_decode($request->getBody());
	$placeDAO = new Place();
	$placeDAO->delete($place);
	echo '{"result":"ok"}';
});

$app->get('/rating', function () {
	$ratingDAO = new Rating();
	$result = $ratingDAO->get();
	echo json_encode($result);
});

$app->post('/rating', function () {
	$request = \Slim\Slim::getInstance()->request();
	$rating = json_decode($request->getBody());
	$ratingDAO = new Rating();
	$ratingDAO->insert($rating);
	echo '{"result":"ok"}';
});

$app->put('/rating', function () {
	$request = \Slim\Slim::getInstance()->request();
	$rating = json_decode($request->getBody());
	$ratingDAO = new Rating();
	$ratingDAO->update($rating);
	echo '{"result":"ok"}';
});

$app->delete('/rating', function () {
	$request = \Slim\Slim::getInstance()->request();
	$rating = json_decode($request->getBody());
	$ratingDAO = new Rating();
	$ratingDAO->delete($rating);
	echo '{"result":"ok"}';
});

$app->get('/state', function () {
	$stateDAO = new State();
	$result = $stateDAO->get();
	echo json_encode($result);
});

$app->post('/state', function () {
	$request = \Slim\Slim::getInstance()->request();
	$state = json_decode($request->getBody());
	$stateDAO = new State();
	$stateDAO->insert($state);
	echo '{"result":"ok"}';
});

$app->put('/state', function () {
	$request = \Slim\Slim::getInstance()->request();
	$state = json_decode($request->getBody());
	$stateDAO = new State();
	$stateDAO->update($state);
	echo '{"result":"ok"}';
});

$app->delete('/state', function () {
	$request = \Slim\Slim::getInstance()->request();
	$state = json_decode($request->getBody());
	$stateDAO = new State();
	$stateDAO->delete($state);
	echo '{"result":"ok"}';
});



$app->run();
