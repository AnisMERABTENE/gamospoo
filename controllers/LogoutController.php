<?php

class LogoutController
{
    public $logoutRepository;

    

    public function __construct($logoutRepository)
    {
        $this->logoutRepository= $logoutRepository ;
    }
    
    public function home() 
        
    {
    
        require "views\logout.html";

        $this->logoutRepository->logOut();

      

    }
}