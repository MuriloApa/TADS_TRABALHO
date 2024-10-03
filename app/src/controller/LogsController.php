<?php

class LogsController {

    private $route;

    private $logs = array();

    private function get_logs(){
        $options = [ 
            'http' => [ 
                'method'  => 'GET', 
                'header'  => 'Content-type: application/json',
            ], 
        ]; 

        $service = MicroserviceRegistry::get('microservice-logs');

        if (!MicroserviceRegistry::has('microservice-logs'))
            throw new Exception ('Microservice undefined');
        
        $context  = stream_context_create($options); 

        $this->logs = json_decode(file_get_contents($service[1], false, $context)); 
       
    }

    public function listAction(){

        $this->get_logs();

        $viewModel = [
            'logs' => $this->logs,
        ];
  
        $this->route = Route::route (['module' => 'logs', 'action' => 'list']);
  
        return  Renderer::view($this->route, $viewModel);
    }

}

?> 