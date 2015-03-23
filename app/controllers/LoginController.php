<?php

class LoginController extends ControllerBase
{
    public function indexAction()
    {

    }

    public function logoutAction()
    {
        $this->auth->logout();
        $this->response->redirect();
    }

    public function authAction()
    {
        if (!$this->request->isPost()) {
            return;
        }

        $given_display = $this->request->getPost("login");
        $given_password = $this->request->getPost("password");

        $user = Users::findFirstByDisplay($given_display);

        if ($user === false) {
            $this->flash->error("Incorrect username or password");
            return;
        }

        if ($this->security->checkHash($given_password . $user->salt, $user->password)) {
            $this->cookies->set('remember-me', $user->display, time() + 21600);            
            $this->session->set($user->display, $user->display);
            $this->response->redirect();
        } else {
            sleep(1);
            $this->flash->error("Incorrect username or password");
            return;
        }
    }
}