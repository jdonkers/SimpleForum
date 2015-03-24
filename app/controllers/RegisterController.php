<?php

use Phalcon\Db\RawValue;

class RegisterController  extends ControllerBase
{
    public function indexAction()
    {
        if ($this->auth->loggedIn) {            
            $this->response->redirect();
        } 
    }

    public function authAction()
    {
        if (!$this->request->isPost()) {
            return;
        }

        $given_display = trim($this->request->getPost("login"));
        $given_password = trim($this->request->getPost("password"));
        $given_password_repeat = trim($this->request->getPost("password2"));

        $user = Users::findFirstByDisplay($given_display);

        if (strlen($given_display) < 4) {
            $this->flash->error("Username must be at least 4 characters.");
            return;
        }

        if (strlen($given_password) < 4) {
            $this->flash->error("Password must be at least 4 characters.");
            return;
        }

        if ($given_password != $given_password_repeat) {
            $this->flash->error("Passwords do not match.");
            return;
        }

        if ($user != false) {
            $this->flash->error("User already exists.");
            return;
        }

        $salt = $this->security->getSaltBytes();
        $password = $this->security->hash($given_password . $salt);

        $user = new Users();
        $user->display = $given_display;
        $user->salt = $salt;
        $user->password = $password;
        $user->post_count = 0;
        $user->create();

        $this->cookies->set('remember-me', $user->display, time() + 21600);            
        $this->session->set($user->display, $user->display);
        $this->response->redirect();
    }
}
