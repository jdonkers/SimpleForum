<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Db\RawValue;

class ThreadsController extends ControllerBase
{
    public function indexAction()
    {
    }

    public function createAction()
    {
        if (!$this->auth->loggedIn) {            
            $this->response->redirect($redirect);
        }

        $slug = $this->request->getQuery("board", "string");

        $board = Boards::findFirstBySlug($slug);

        if ($board === false) {
            $this->response->redirect(); 
            return;
        }

        $this->view->board = $board;

        if (!$this->request->isPost()) {
            return;
        }

        $title = $this->request->getPost("title");
        $content = $this->request->getPost("content");

        $slug = Slug::generate($title);
        $count = Threads::query()
            ->where("slug LIKE :slug:")
            ->bind(array("slug" => $slug .'%'))
            ->execute()
            ->count();
            
        if ($count > 0) {
            $slug = $slug . "-" . $count;
        }        


        $thread = new Threads();
        $thread->created_by = $this->auth->user->id;
        $thread->title = $title;
        $thread->board_id = $board->id;
        $thread->slug = $slug;
        $thread->replies = 0;        
        $thread->created = date('Y-m-d H:i:s');
        $thread->updated = date('Y-m-d H:i:s');        


        if (!$thread->create()) {
            foreach ($thread->getMessages() as $message) {               

                echo $message;
            }

            $this->view->disable();
            return;
        }


        $post = new Posts();
        $post->created_by = $this->auth->user->id;
        $post->thread_id = $thread->id;
        $post->content = $content;
        $post->created = date('Y-m-d H:i:s');
        $post->create();

        $board->thread_count++;
        $board->post_count++;        
        $board->update();

        $this->auth->user->post_count++;
        $this->auth->user->update();

        $redirect = "threads/view/" . $thread->slug;
        $this->response->redirect($redirect);    
    }

    public function viewAction($slug) 
    {
        $thread = Threads::findFirstBySlug($slug);

        if ($thread === false) {
            $this->flash->error("Sorry, thread could not be found.");
            $this->view->disable();
            return;
        }

        $board = Boards::findFirst($thread->board_id);

        if ($board === false) {
            $this->flash->error("Sorry, the board this thread was posted in no longer exists.");
            $this->view->disable();
            return;
        }

        $this->view->thread = $thread;  
        $this->view->board = $board;  

        $this->view->max_previous_pages = 2;
        $this->view->max_next_pages = 2;

        $phql = "SELECT 
                Posts.id AS post_id
                ,Posts.content
                ,Posts.created
                ,Users.display AS user_display
                ,Users.id AS user_id
                ,Users.post_count AS user_post_count
                FROM Posts JOIN Users
                ON Posts.created_by = Users.id
                WHERE Posts.thread_id = :thread_id:
                ORDER BY Posts.id";

        $posts = $this->modelsManager->executeQuery($phql, array('thread_id' => $thread->id));

         $pageNumber = $this->request->getQuery("page", "string");

         if ($pageNumber == "last") {
            $pageNumber = ceil($posts->count() / 10);
         } else {
            $pageNumber = intval($pageNumber);
         }

         if (!$pageNumber) {
            $pageNumber = 1;
         }

        $paginator = new Paginator(array(
            "data" => $posts,
            "limit"=> 10,
            "page" => $pageNumber
        ));

        $this->view->page = $paginator->getPaginate();        
    }

}

