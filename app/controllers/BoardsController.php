<?php

class BoardsController extends ControllerBase
{
    public function viewAction($slug) 
    {
        $board = Boards::findFirstBySlug($slug);
        
        if ($board === false) {
            $this->response->redirect(); 
            return;
        }

        $this->view->board = $board;
        $this->view->threads = Threads::find(
            array(
                "conditions" => "board_id = " . $board->id, 
                "order" => "updated DESC",
                "limit" => 30
            )
        );
    }

    public function indexAction()
    {
    }
}