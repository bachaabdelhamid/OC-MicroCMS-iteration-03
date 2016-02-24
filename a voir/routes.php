<?php


// Home page

$app->get('/', function () use ($app) {

    $articles = $app['dao.article']->findAll();


    ob_start();             // start buffering HTML output

    require '../views/view.php';

    $view = ob_get_clean(); // assign HTML output to $view

    return $view;
	});

	app->get('/1', function () use ($app) {

    $sql = "UPDATE t_article SET art_title = ? WHERE art_id = ?";
    $app['db']['mysql_write']->executeUpdate($sql, array('newValue', (int) $id));

});