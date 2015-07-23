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
            $userName = isset($_SESSION['loggeduser']['userName']) ? ucwords($_SESSION['loggeduser']['userName']) : 'Guest';
            $errors = array();

            //Get album data
            $album = array();
            $album = $this->_model->getAlbumByIdAsArray((int)$albumId);

            if (!isset($album)) {
                $album['albumtitle'] = '';
                array_push($errors, "Album with ID=" . $albumId . " does not exist!");
            }

            //check fom submission
            if (isset($_POST['sharealbumsubmit'])) {
                //TODO: 1. send email(s)
                //$this->sendemails($_POST['album']);
                $emailsuccess = true; //tmp....
                if (!$emailsuccess) {
                    array_push($errors, "Emails sending failure!");
                }
                //Implement "Add to contacts" feature
                $emailstoadd = array();
                $emailstoadd = $this->_model->checkEmailsExist($_POST['album']['shareemails']);
                //display "Add to contacts" form
                return $this->sharereport($errors, $emailstoadd);

            } else {

                if (isset($_POST['selectcontacts'])) {
                    $album['shareemails'] = implode(', ', $_POST['selctedcontacts']);
                }
                //set initial sharing view
                $this->_view->set('admin', 'semteacher@gmail.com');
                $this->_view->set('pageheader', $userName . ': Albums Share (Demo) - ' . $album['albumtitle']);
                $this->_view->set('title', 'BundleJoy Inc. - Albums Share.');
                $this->_view->set('album', $album);
                $this->_view->set('errors', $errors);

                return $this->_view->output();
            }

            //return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

    public function selectcontacts()
    {
        try {
            //we can use select from other page only!
            if (!empty($_SERVER['HTTP_REFERER'])) {
                $_SESSION['selectcontact']['ref_url'] = $_SERVER['HTTP_REFERER'];

                $cont = new ContactsController('Contacts', 'select');
                return $cont->select();
            } else {
                header('Location: ' . SITE_ROOT . '/site/err403');
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }


    public function sharereport($errors = null, $emailstoadd = null)
    {
        try {
            $userName = isset($_SESSION['loggeduser']['userName']) ? ucwords($_SESSION['loggeduser']['userName']) : 'Guest';

            //check fom submission
            if (isset($_POST['sharereportaddcontacts'])) {
                //add emails to DB
                //exclude it from list
            }
            if (isset($_POST['sharereportgotoindex'])) {
                //goto list of albums
                //tmp - redirect to site home
                $cont = new SiteController('Site', 'index');
                return $cont->index();
            }

                if (!isset($errors)) {
                    $this->_view->set('pageheader', $userName . ': Album - ' . $this->_model->getAlbumTitle() . ' - shared successfully!');
                } else {
                    $this->_view->set('pageheader', $userName . ': Albums - ' . $this->_model->getAlbumTitle() . ' - sharing error!');
                }

                $this->_view->set('title', 'BundleJoy Inc. - Albums Sharing Report Page.');
                $this->_view->set('emailstoadd', $emailstoadd);
                $this->_view->set('errors', $errors);

                return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }
}