<?php
    // session
    session_start();

    // fichiers
    require_once __DIR__.'/library/RequirePage.php';
    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/library/Twig.php';
    require_once __DIR__.'/library/Validation.php';
    require_once __DIR__.'/library/CheckSession.php';

    // récupérer le chemin
    $url = isset($_GET['url']) ? explode('/', ltrim($_GET['url'], '/')) : '/';
    
    if($url == '/'){
        // page d'accueil (home-index) (par défaut)
        require_once('controllers/ControllerHome.php');
        $controller = new ControllerHome();
        echo $controller->index();
    }
    else{
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
                
                /**
                 * @source https://www.php.net/manual/fr/function.method-exists.php
                 * @source https://www.php.net/manual/en/reflectionfunctionabstract.getnumberofrequiredparameters.php
                 */
                if(method_exists($controller, $method)){
                    // nombre de paramètres attendus
                    $reflection = new \ReflectionMethod($controller, $method);
                    $args = $reflection->getNumberOfRequiredParameters();
                    
                    if($args == 0){
                        // afficher la page
                        echo $controller->$method();
                    } else{
                        if(isset($url[2])){
                            // afficher la page avec sa valeur
                            $value = $url[2];
                            echo $controller->$method($value);
                        }
                        else{
                            // page d'erreur (home-error)
                            require_once('controllers/ControllerHome.php');
                            $controller = new ControllerHome();
                            echo $controller->error();
                        }
                    }
                }
                else{
                    // page d'erreur (home-error)
                    require_once('controllers/ControllerHome.php');
                    $controller = new ControllerHome();
                    echo $controller->error();
                }
            } else{
                // page controller-index (par défaut)
                echo $controller->index();
            }
        }
        else{
            // page d'erreur (home-error)
            require_once('controllers/ControllerHome.php');
            $controller = new ControllerHome();
            echo $controller->error();
        }
    }
?>

