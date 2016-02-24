<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
include 'C:/wamp/www/hello-world-silex/vendor/silex/silex/src/Silex/Application/SwiftmailerTrait.php';


require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
	
	$app['debug'] = true;

$app->get('/', function () {
    return 'Hello world';
});

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});
$blogPosts = array(
    1 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex',
        'body'      => '...',
    ),
	 2 => array(
        'date'      => '2011-03-29',
        'author'    => 'igorw',
        'title'     => 'Using Silex1',
        'body'      => '...',
    ),
);

$app->get('/blog', function () use ($blogPosts) {
    $output = '';
    foreach ($blogPosts as $post) {
        $output .= $post['title'];
        $output .= '<br />';
    }

    return $output;
});

//**************
$app->get('/blog/{id}', function ($id) use ($blogPosts, $app) {
    if (!isset($blogPosts[$id])) {
        $app->abort(404, "Post $id does not exist."); // to stop the request
    }

    $post = $blogPosts[$id];
 return  
    "<h1>{$post['title']}</h1>".
            "<p>{$post['body']}</p>";
    
   
});

//**************
$app->get('/blog/edit/form', function () use ($app) {
    
 return  
    '
	<form action="/blog/edit/show" method="post">
	<label for="id">Saisir un ID: </label>
		<input id="id" name="id" value="" />
	</from>
	';
    
   
});

//**************
$app->post('/blog/edit/show', function () use ($blogPosts, $app) {
	
	$request = $app['request'];
	
	$id = $request->get('id');
	
    if (!isset($blogPosts[$id])) {
        $app->abort(404, "Post $id does not exist."); // to stop the request
    }

    $post = $blogPosts[$id];
 return  
    "<h1>{$post['title']}</h1>".
            "<p>{$post['body']}</p>";
    
   
});

//******************

 $app->get('/feedback', function (Request $request) {
    $message = $request->get('message');
    mail('feedback@yoursite.com', '[YourSite] Feedback', $message);

    return new Response('Thank you for your feedback!', 201);
});

//*************







require_once __DIR__.'/../vendor/autoload.php';


$app = new Silex\Application();


require __DIR__.'/../app/config/dev.php';

require __DIR__.'/../app/app.php';

require __DIR__.'/../app/routes.php';


$app->run();
