
<?php

class LogoutRepository
{
public function logOut()
    {
    
        session_unset(); 
        session_destroy(); 
       
        
        exit;
    }
}

