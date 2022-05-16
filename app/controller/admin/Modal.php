<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends Controller
{
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
        $Route = $this->getVariable("Route"); 
        $this->view('modal/'.$Route->params->modal, 'admin');

    }
}
