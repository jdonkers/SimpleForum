<?php

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        $this->view->boards = Boards::find(); 
    }
}

