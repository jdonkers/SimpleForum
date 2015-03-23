<?php

use Phalcon\Mvc\User\Component;

class Auth extends Component
{
    public $loggedIn = false;
    public $user = null;

    public function logout()
    {
        $this->loggedIn = false;
        $this->user = null;

        if ($this->cookies->has('remember-me')) {
            $rememberMe = $this->cookies->get('remember-me');
            $display = trim($rememberMe->getValue());

            if ($this->session->has($display)) {
                $this->session->remove($display);
            }

            $this->cookies->get('remember-me')->delete();
        }
    }

    public function authenticate()
    {
        if ($this->cookies->has('remember-me')) {
            $rememberMe = $this->cookies->get('remember-me');
            $display = trim($rememberMe->getValue());

            if ($this->session->has($display)) {
                $this->loggedIn = true;
                $this->user = Users::findFirstByDisplay($display);
            }
        }
    }
}