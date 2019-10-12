<?php
namespace App\Controller;

use App\Model\Entity\Role;

class StaffController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Units');
        $this->loadModel('PeerReviews');
        $this->loadModel('Users');
    }

    public function isAuthorized($user)
    {
        // If you are a user, you can access this dashboard.
        return Role::isStaff($user['role']);
    }

    public function index()
    {

    }
}