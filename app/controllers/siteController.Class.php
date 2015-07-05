<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 28.06.2015
 * Time: 17:37
 */

class SiteController extends Controller {
    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function index()
    {
        try {

            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', 'Wellcome BundleJoy Inc. Site!');
            $this->_view->set('title', 'BundleJoy Inc.');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    
    public function login()
    {
        try {
        
            if (isset($_POST['loginusersubmit']))
            {
                if ($_POST['loginusersubmit']=='cancel'){
                    $this->index();
                } else {
                    //get POST data
                    $userName = isset($_POST['username']) ? trim($_POST['username']) : NULL;
                    $password = isset($_POST['password']) ? trim($_POST['password']) : NULL;
                    
                    $loggedUser = new UsersModel;
                    $login = $loggedUser->userLogin($userName, $password);
                    //var_dump($login);
                    
                    if ($login) {
                        //login successfull
                        $_SESSION['loggeduser']['userName'] = $loggedUser->getUserName();
                        $_SESSION['loggeduser']['userRole'] = $loggedUser->getRole();
                        //var_dump($_SESSION);
                        //var_dump($_SESSION['loggeduser']['userName']);
                        header('Location: /site/index');
                        //$this->index;
                        
                    } else {
                        //login fail
                        //$this->err403();
                        header('Location: /site/err403');
                    }
                    
                }
            }

            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', 'BundleJoy Inc. - Login, please!');
            $this->_view->set('title', 'BundleJoy Inc. - Login Form');

            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
    
    public function logout()
    {
        unset($_SESSION['loggeduser']);
        //$this->index();
        header('Location: /site/index');
    }
}