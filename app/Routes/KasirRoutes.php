<?php
    namespace app\Routes;

    include 'app/Controller/KasirController.php';

    use app\Controller\KasirController;

    class KasirRoutes 
    {
        public function handle($method, $path)
        {
            if ($method === 'GET' && $path === '/api/kasir')
            {
                $controller = new KasirController();
                echo $controller->index();
            }

            if ($method === 'GET' && strpos($path, '/api/kasir/') === 0)
            {
                $parthParts = explode('/', $path);
                $id = $parthParts[count($parthParts) - 1];

                $controller = new KasirController();
                echo $controller->getById($id);
            }
            
            if ($method === 'POST' && $path === '/api/kasir')
            {
                $controller = new KasirController();
                echo $controller->insert();
            }
            
            if ($method === 'PUT' && strpos($path, '/api/kasir/') === 0)
            {
                $parthParts = explode('/', $path);
                $id = $parthParts[count($parthParts) - 1];
    
                $controller = new KasirController();
                echo $controller->update($id);
            }

            if ($method === 'DELETE' && strpos($path, '/api/kasir/') === 0)
            {
                $parthParts = explode('/', $path);
                $id = $parthParts[count($parthParts) - 1];
    
                $controller = new KasirController();
                echo $controller->delete($id);
            }
        }
    }
