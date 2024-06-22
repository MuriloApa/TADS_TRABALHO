<?php

class LogsControllerFactory implements FactoryInterface
{
    public function __invoke ()
    {
        $controller = new LogsController ();

        return $controller;
    }
}
