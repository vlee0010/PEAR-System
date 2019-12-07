<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        //$this->loadComponent('Security');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'logAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }


    public function sendEmailToUser($to, $subject, $msg)
    {
        $email = new Email('default');
        $email
            ->transport('gmail')
            ->from(['monashietesting@gmail.com' => 'PEAR'])
            ->to($to)
            ->subject($subject)
            ->emailFormat('html')
            ->viewVars(array('msg' => $msg))
            ->send($msg);
    }

    function uploadFiles($folder, $formdata, $itemId = null)
    {
        //this function is called from add and edit actions of HorseController.php with the following method call
        //$fileOK = $this->uploadFiles('img/horse_images', $this->data['Horse']['horse_image']);
        // setup dir names absolute and relative
        //WWW_ROOT is a CakePHP constant which returns the full path to the webroot folder
        $folder_url = $folder;
        $rel_url = $folder;


        // create the folder if it does not exist
        if(!is_dir($folder_url))
        {
            mkdir($folder_url);
        }

        // if itemId is set create an item folder
        if($itemId)
        {
            // set new absolute folder
            $folder_url = WWW_ROOT.$folder.DS.$itemId;
            // set new relative folder
            $rel_url = $folder.DS.$itemId;
            // create directory
            if(!is_dir($folder_url))
            {
                mkdir($folder_url);
            }
        }

        // list of permitted file types
        $permitted = array('application/vnd.ms-excel','text/x-csv','text/csv','text/comma-separated-values','application/csv','application/excel','application/vnd.msexcel');

        // replace spaces with underscores
        $filename = str_replace(' ', '_', $formdata['name']);
        // assume filetype is false
        $typeOK = false;
        // check filetype is ok
        foreach($permitted as $type)
        {
            if($type == $formdata['type'])
            {
                $typeOK = true;
                break;
            }
        }
        // if file type ok upload the file
        if($typeOK)
        {
            // switch based on error code
            switch($formdata['error'])
            {
                case 0:
                    // create full filename
                    $full_url = $folder_url.'/'.$formdata['name'];
                    $url = $rel_url.'/'.$formdata['name'];
                    // upload the file - overwrite existing file
                    $success = move_uploaded_file($formdata['tmp_name'], $url);

                    // if upload was successful
                    if($success)
                    {
                        //save the filename of the file
                        $result['urls'][] = $formdata['name'];
                    } else
                    {
                        $result['errors'][] = "Error uploaded ". $formdata['name']. "Please try again.";
                    }
                    break;
                case 3:
                    // an error occurred
                    $result['errors'][] = "Error uploading ".$formdata['name']." Please try again.";
                    break;
                default:
                    // an error occurred
                    $result['errors'][] = "System error uploading ".$formdata['name']. "Contact webmaster.";
                    break;
            }
        }
        elseif($formdata['error'] == 4)
        {
            // no file was selected for upload
            $result['errors'][] = "No file Selected";
        } else
        {
            // unacceptable file type
            $result['errors'][] = $formdata['name']." cannot be uploaded. Acceptable file types: csv.";
        }

        return $result;
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['display']);
        $this->Auth->allow(['login']);
    }
}
