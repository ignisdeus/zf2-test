<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegisterForm;
use Users\Form\RegisterFilter;
use Users\Form\LoginForm;
use Doctrine\ORM\EntityManager;
use Users\Entity\User;

class UserController extends AbstractActionController
{
    protected $em;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction()
    {
        $users = $this->getEntityManager()->getRepository('Users\Entity\User')->findAll();

        $view = new ViewModel(array("users" => $users));
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
        if(!$this->request->isPost()){
            return $this->redirect()->toRoute(NULL, array('controller' => 'user', 'action' => 'register'));
        }

        $post = $this->request->getPost();
        $form = new RegisterForm();
        $filter = new RegisterFilter();
        $form->setInputFilter($filter);
        $form->setData($post);

        if($form->isValid() == false){
            $model = new ViewModel(array(
               'error' => true,
               'form' => $form,
            ));

            $model->setTemplate('users/register');
            return $model;
        }

        $user = new User();
        $user->populate($post);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        $view = new ViewModel();
        $view->setTemplate('users/confirm');
        return $view;
    }

    public function loginAction()
    {
        $form = new LoginForm();
        $view = new ViewModel(array("form" => $form));
        $view->setTemplate('users/login');
        return $view;
    }

    public function tryLoginAction()
    {
        if(!$this->request->isPost()){
            return $this->redirect()->toRoute(NULL, array('controller' => 'user', 'action' => 'login'));
        }

        $post = $this->request->getPost();
        $entity = $this->getEntityManager()->getRepository('Users\Entity\User')->findOneByEmail($post["email"]);

        \Zend\Debug\Debug::dump($entity);
        die();

        if($entity){
            if($entity->verifyPassword($post["password"])){
                $view = new ViewModel(array("user" => $entity));
                $view->setTemplate('users/account');
                return $view;
            }
        }



        return $this->redirect()->toRoute(NULL, array('controller' => 'user', 'action' => 'login'));
    }
}