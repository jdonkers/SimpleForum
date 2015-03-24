<?php

use Phalcon\Db\RawValue;

class PostsController  extends ControllerBase
{
    public function indexAction()
    {
    }

    public function createAction()
    {
        if (!$this->auth->loggedIn) {            
            $this->response->redirect($redirect);
        } 

        $slug = $this->request->getQuery("thread", "string");

        $thread = Threads::findFirstBySlug($slug);
        if ($thread === false) {
            $this->response->redirect();
            return;
        }

        $board = Boards::findFirst($thread->board_id);
        if ($board === false) {            
            $this->response->redirect();
            return;
        }

        $this->view->thread = $thread;  
        $this->view->board = $board; 

        if (!$this->request->isPost()) {
            return;
        }

        $post = new Posts();
        $post->content = $this->request->getPost("content");
        $post->created_by = $this->auth->user->id;
        $post->thread_id = $thread->id;
        $post->created = date('Y-m-d G:i:s');        
        $post->save();        

        $board->post_count++;
        $board->update();

        $this->auth->user->post_count++;
        $this->auth->user->update();

        $thread->replies++;
        $thread->updated = date('Y-m-d G:i:s');
        $thread->update();

        $redirect = "threads/view/" . $thread->slug . "?page=last";
        $this->response->redirect($redirect);
    }
}