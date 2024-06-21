<?php

class LoggingObserver implements ObserverInterface 
{
    public function update($serviceName, $isOnline) 
    {   
        $service = MicroserviceRegistry::get('microservice-logs');

        if (!MicroserviceRegistry::has('microservice-logs'))
            throw new Exception ('Microservice undefined');

        $data = ["context" => "$serviceName",
                    "message" => "The service $serviceName is offline."        
        ];
        
        $response = ConnectServiceFacade::connect ($service, $data, 'JSON');
    }
}
