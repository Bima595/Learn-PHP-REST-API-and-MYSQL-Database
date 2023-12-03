<?php
    namespace app\Controller;

    include 'app/Models/Kasir.php';

    use app\Models\Kasir;
    use app\Traits\ApiResponseFormatter;

    class KasirController
    {
        use ApiResponseFormatter;

        public function index()
        {
            $kasirModel = new Kasir();
            $response = $kasirModel->findAll();
            return $this->apiResponse(200, 'Success', $response);
        }

        public function getById($id)
        {
            $kasirModel = new Kasir();
            $response = $kasirModel->findById($id);
            return $this->apiResponse(200, 'Success', $response);
        }

        public function insert()
        {
            $jsonInput = file_get_contents('php://input');
            $inputData = json_decode($jsonInput, true);

            if(json_last_error()){
                return $this->apiResponse(400, "Error Invalid Input", null);
            }

            $kasirModel = new Kasir();
            $response = $kasirModel->create([
                'shift' => $inputData['shift'],
                'idProduct' => $inputData['idProduct']
            ]);

            return $this->apiResponse(200, 'Success', $response);
        }
        
        public function update($id) {
            $jsonInput = file_get_contents('php://input');
            $inputData = json_decode($jsonInput, true);
        
            if (json_last_error()) {
                return $this->apiResponse(400, "Error Invalid Input", null);
            }
        
            $kasirModel = new Kasir();
            $response = $kasirModel->update(
                [
                    'shift' => $inputData['shift'],
                    'idProduct' => $inputData['idProduct']
                ],
                $id
            );
        
            return $this->apiResponse(200, 'Success', $response);
        }
        


        public function delete($id)
        {
            $kasirModel = new Kasir();
            $response = $kasirModel->destroy($id);
            
            return $this->apiResponse(200, 'Succes', $response);
        }
    }
