<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 21.07.2015
 * Time: 14:30
 */

class AlbumsController extends Controller {

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
            $check = true;

            //Get album data
            //Uncomment for rel case
            //$album = $this->_model->getAlbumById((int)$albumId);
            $album = ['albumtitle'=>'My Demo Album'];
            //$album=array();

            if ($album) {
                $this->_view->set('album', $album);
            } else {
                $album = ['albumtitle'=>''];
                array_push($errors, "Album with ID=".$albumId." does not exist!");
            }

            //set initial sharing view
            $this->_view->set('admin', 'semteacher@gmail.com');
            $this->_view->set('pageheader', $userName .': Albums Share (Demo) - '.$album['albumtitle']);
            $this->_view->set('title', 'BundleJoy Inc. - Albums Share.');

            //check fom submission
            if (isset($_POST['sharealbumsubmit'])) {
                //process post
            } elseif ($_POST['sharealbumsubmit']=='cancel'){
                header('Location: '.SITE_ROOT.'/contact/index');
            } else {

                return $this->_view->output();
            }
        } catch (Exception $e) {
            echo "Application error:" . $e->getMessage();
        }
    }

}