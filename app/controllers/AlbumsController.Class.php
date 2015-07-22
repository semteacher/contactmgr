<?php

/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.07.2015
 * Time: 14:30
 */
class AlbumsController extends Controller
{

    public function __construct($model, $action)
    {
        parent::__construct($model, $action);
        $this->_setModel($model);
    }

    public function share($albumId)
    {
        try {
            //check fom submission
            if (isset($_POST['sharealbumsubmit'])) {
                //TODO: 1. send email(s)
                //TODO 2. Implement "Add to contacts" feature

                //Back to list of albums
                //$this->_setView('index');
                //tmp - redirect to site home
                $cont = new SiteController('Site', 'index');
                return $cont->index();
            } else {
                $userName = isset($_SESSION['loggeduser']['userName']) ? ucwords($_SESSION['loggeduser']['userName']) : 'Guest';

                $errors = array();
                //$check = true;

                //Get album data
                //Uncomment for rel case
                //$album = $this->_model->getAlbumById((int)$albumId);
                //tmp - for demo only
                $album = array();
                $album['albumtitle'] = 'My Demo Album';
                $album['albumId'] = $albumId;

                if (!$album) {
                    $album['albumtitle'] = '';
                    array_push($errors, "Album with ID=" . $albumId . " does not exist!");
                    $this->_view->set('errors', $errors);
                }

                if (isset($_POST['selectcontacts'])) {
                    $album['shareemails'] = implode(', ', $_POST['selctedcontacts']);
                }
                //set initial sharing view
                $this->_view->set('admin', 'semteacher@gmail.com');
                $this->_view->set('pageheader', $userName . ': Albums Share (Demo) - ' . $album['albumtitle']);
                $this->_view->set('title', 'BundleJoy Inc. - Albums Share.');
                $this->_view->set('album', $album);

                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function selectcontacts()
    {
        //we can use select from other page only!
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $_SESSION['selectcontact']['ref_url'] = $_SERVER['HTTP_REFERER'];

            $cont = new ContactsController('Contacts', 'select');
            return $cont->select();
        } else {
            header('Location: ' . SITE_ROOT . '/site/err403');
        }
    }
}