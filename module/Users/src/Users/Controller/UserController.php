<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegisterForm;

class UserController extends AbstractActionController
{

    public function indexAction()
    {
        $view = new ViewModel(
            array("data" => "Hello there!")
        );

        $view->setTemplate('users/index');
        return $view;
    }

    public function registerAction()
    {
        $form = new RegisterForm();
        $view = new ViewModel(array("form" => $form));
        $view->setTemplate('users/register');
        return $view;
    }

    public function confirmAction()
    {
        $view = new ViewModel();
        $view->setTemplate('users/confirm');
        return $view;
    }

    public function loginAction()
    {
        $view = new ViewModel();
        $view->setTemplate('users/login');
        return $view;
    }
}