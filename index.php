<?php
    // fichiers
    require_once __DIR__.'/library/RequirePage.php';
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/library/Twig.php';

    // récupérer le chemin
    $url = isset($_GET['url']) ? explode('/', ltrim($_GET['url'], '/')) : '/';

    if($url == '/'){
        // page d'accueil (home-index) (par défaut)
        require_once('controllers/ControllerHome.php');
        $controller = new ControllerHome();
        echo $controller->index();
    } else{
        // chemin du controller
        $requestURL = ucfirst($url[0]);
        $controllerPath = __DIR__.'/controllers/Controller'.$requestURL.'.php';

        if(file_exists($controllerPath)){
            // récupérer le controller
            require_once($controllerPath);
            $controllerName = 'Controller'.$requestURL;
            $controller = new $controllerName();

            if(isset($url[1])){
                // récupérer la méthode
                $method = $url[1];
                if(isset($url[2])){
                    $value = $url[2];
                    echo $controller->$method($value);
                } else{
                    echo $controller->$method();
                }
            } else{
                // page controller-index
                echo $controller->index();
            }
        } else{
            // page d'erreur (home-error)
            require_once('controllers/ControllerHome.php');
            $controller = new ControllerHome();
            echo $controller->error();
        }
    }
?>

