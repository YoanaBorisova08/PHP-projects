<?php

require __DIR__ . '/inc/all.inc.php';

$container = new \App\Support\Container();
$container->bind('pdo', function(){
    $pdo = require __DIR__ . '/inc/db-connect.inc.php';
    return $pdo;
});
$container->bind('authService', function() use($container) {
    $pdo = $container->get('pdo');
    return new \App\Admin\Support\AuthService($pdo);
});
$container->bind('pagesRepository', function() use($container) {
    $pdo = $container->get('pdo');
    return new \App\Repository\PagesRepository($pdo);
});
$container->bind('pagesController', function() use($container) {
    $pagesRepository = $container->get('pagesRepository');
    return new \App\Frontend\Controller\PagesController($pagesRepository);
});
$container->bind('notFoundController', function() use($container) {
    $pagesRepository = $container->get('pagesRepository');
    return new \App\Frontend\Controller\NotFoundController($pagesRepository);
});
$container->bind('pagesAdminController', function() use($container) {
    return new \App\Admin\Controller\PagesAdminController($container->get('pagesRepository'));
});
$container->bind('loginController', function() use($container) {
    $authService = $container->get('authService');
    return new \App\Admin\Controller\LoginController($authService);
});


$route = @(string) ($_GET['route'] ?? 'pages');
if($route === 'pages'){
    $page = @(string) ($_GET['page'] ?? 'index');
    $pagesController = $container->get('pagesController');
    $pagesController->showPage($page);
}
elseif($route === 'admin/pages'){
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->index();
}
elseif($route === 'admin/pages/login'){
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();
    
    $loginController = $container->get('loginController');
    $loginController->login();
}
elseif($route === 'admin/pages/create'){
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->create();
}
elseif($route === 'admin/pages/delete'){
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->delete();
}
elseif($route === 'admin/pages/edit'){
    $authService = $container->get('authService');
    $authService->ensureLoggedIn();

    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->edit();
}
else{
    $notFoundController = $container->get("notFoundController");
    $notFoundController->error404();
}