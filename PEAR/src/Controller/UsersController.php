<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Core\App;
use Cake\Controller\Exception\SecurityException;
use Cake\Utility\Security;
use Cake\Mailer\Email;
use App\Model\Entity\Role;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Units');
        $this->loadModel('peer_reviews');
        $this->loadModel('Users');
        $this->loadModel('units_tutors');
        $this->loadModel('units_classes');
        $this->loadModel('students_classes');
        $this->loadModel('units_users');
        $this->loadModel('teams_users');
        $this->loadModel('teams');
        $this->loadModel('Classes');
        $this->loadModel('peer_reviews_users');
        $this->loadModel('Responses');
        $this->loadModel('Questions');
        $this->loadModel('peer_reviews_teams');
        $this->viewBuilder()->setLayout('default');
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));


    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $user = $this->Users->get($id, [
            'contain' => ['PeerReviews', 'Teams', 'Units', 'Responses']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function profile()
    {

    }

    public function login()
    {
        if ($this->Auth->user()) {
            return $this->redirect(["controller" => "users", "action" => "studentdash"]);
        }
        if ($this->request->is('post')) {
            if ($this->request->data('_type') === 'login') {
                $user = $this->Auth->identify();
                if ($user) {
                    if (Role::isStaff($user['role'])) {
                        $this->Auth->setUser($user);
                        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
                        if ($user->verified) {
                            $this->redirect(['controller' => 'staff', 'action' => 'index']);
                        } else {
                            $this->Flash->error('Please verify your Email address first');
                            $this->Auth->logout();
                        }
                    } elseif (Role::isStudent($user['role'])) {
                        $this->Auth->setUser($user);
                        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
                        if ($user->verified) {
                            $this->redirect(['controller' => 'users', 'action' => 'studentdash']);
                        } else {
                            $this->Flash->error('Please verify your Email address first');
                            $this->Auth->logout();
                        }
                    }elseif (Role::isAdmin($user['role'])){
                        $this->Auth->setUser($user);
                        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
                        if ($user->verified) {
                            $this->redirect(['controller' => 'admins', 'action' => 'index']);
                        } else {
                            $this->Flash->error('Please verify your Email address first');
                            $this->Auth->logout();
                        }
                    }

                } else {
                    $this->Flash->error('Unable to Log in, Please Check your Email & Password');
                }
            }
//            if($this->request->data('_type') === 'reset'){
//                $email= $this->request->getData('email');
//                $user = $this->Users->find()->where(['email' => $email])->first();
//                $subject = 'Reset Your Password' ;
//                $body = "Hello, " . $user->firstname . ' ' . $user->lastname .
//                    "<br> Please Reset Your Password Through the link provided below <br><a href=http://ie.infotech.monash.edu/team123/pear/PEAR/users/reset/".$user->token.">Click This Link To Reset</a>";


//                $email = new Email('default');
//                $email
//                    ->transport('gmail')
//                    ->from(['monashietesting@gmail.com'=>'Team 123 PEAR'])
//                    ->subject($subject)
//                    ->emailFormat('html')
//                    ->to($email)
//                    ->send($body);

//                $this->Flash->success('Check Your Email To Reset Your Password');


            if ($this->request->data('_type') === 'reset') {
                $userEmail = $this->request->getData('email');
                $userTable = TableRegistry::getTableLocator()->get('users');

                if ($userTable->find()->where(['email' => $userEmail])->first()) {
                    $email = $this->request->getData('email');
                    $user = $this->Users->find()->where(['email' => $email])->first();
                    $resetLink = Router::url(array("controller"=>"users","action"=>"reset",$user->token),true);
                    $subject = "Password reset";
                    $body = "Hi " . $user->firstname . " " . $user->lastname . "<br / >Please reset your password through the link below<br /><a href=".$resetLink.">Click here to reset</a>";
                    $this->sendEmailToUser($email, $subject, $body);
                    $this->Flash->success('Check your email to reset your password');
                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error('User Email Doesn\'t exist');
                }


            }


        }


    }


    public function logout()
    {


        $this->Auth->logout();
//        $this->Flash->success('You are logged out');
        return $this->redirect(['controller' => 'pages', 'action' => 'display']);


    }

    public function reset($token)
    {
        $password = $this->request->getData('password');
        if ($password) {
            $encryptedPassword = (new DefaultPasswordHasher)->hash($password);


             sleep(3);
            return $this->redirect(["action" => 'login']);
        }
    }

    public function verification($token)
    {
        $user = TableRegistry::get('Users');
        $query = $user->query();
        $query->update()
            ->set(['verified' => 1])
            ->where(['token' => $token])
            ->execute();

//        $verify = $user->find('all')->where(['token'=>$token])->first();
//        $user->save($verify);

        $this->Flash->success('Your email has been verified! Please Log in. ');
        sleep(3);
        $this->redirect(['action' => 'login']);
        $this->Flash->success('Your email has been verified! Please Log in. ');


    }

    /**
     * Studentdash method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function studentdash()
    {

        $studentid = $this->Auth->User('id');
        $peer_review_user_query = $this->peer_reviews_users->find('all')->where(['user_id' => $studentid]);

        $dashResult = $peer_review_user_query->select([
            'title' => 'p.title',
            'dateStart' => 'p.date_start',
            'dateEnd' => 'p.date_end',
            'unitCode' => 'u.code',
            'unitTitle' => 'u.title',
            'unitSemester' => 'u.semester',
            'unitYear' => 'u.year',
            'peer_id' => 'p.id',
            'status' => 'peer_reviews_users.status'
        ])->join([
            'p' => [
                'table' => 'peer_reviews',
                'conditions' => [
                    'p.id = peer_reviews_users.peer_review_id',
                ]
            ],
            'u' => [
                'table' => 'units',
                'conditions' => [
                    'u.id = p.unit_id',
                ]
            ]
        ]);

        $team_query = $this->teams_users->find()->where(['user_id' => $studentid]);
        $team_list = $team_query->select([
            'teamID' => 't.id_',
            'teamName' => 't.name',
            'user_id' => $studentid,
            'peer_id' => 'pt.peer_review_id'

        ])->join([
            't' => [
                'table' => 'teams',
                'conditions' => [
                    'teams_users.team_id = t.id_ ',
                ]
            ],
            'pt' => [
                'table' => 'peer_reviews_teams',
                'conditions' => [
                    'pt.team_id = teams_users.team_id ',
                ]
            ]
        ])->distinct();


        $this->set(compact('team_list'));
        $this->set(compact('dashResult'));
        $this->set(compact('studentid'));
    }

    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $userTable = TableRegistry::get('Users');
//            $error_message = var_dump($userTable->find());
//            foreach ($userTable->find() as $row){
//                echo "<script type='text/javascript'>alert('$row->email');</script>";
            //       }

            $myEmail = $this->request->getData('email');
            if($this->Users->find()->where(['email'=>$myEmail])->first()){
                $this->Flash->error('This email has already been registered. Please Log in or check your email for verification link');
            }else{
                $hasher = new DefaultPasswordHasher();
                $myFirstName = $this->request->getData('firstname');
                $myLastName = $this->request->getData('lastname');
                $myEmail = $this->request->getData('email');
//            $myPassword = Security::hash($this->request->getData('password'),'sha1',false);
                $myPassword = $this->request->getData('password');
                $myId = $this->request->getData('studentid');
                $myToken = Security::hash(Security::randomBytes(32));

                $user->firstname = $myFirstName;
                $user->lastname = $myLastName;
                $user->email = $myEmail;
                $user->password = $myPassword;
                $user->token = $myToken;
                $user->verified = 0;
                $user->studentid = $myId;
                $user->role = Role::STUDENT;



            if ($this->Users->save($user)) {
                $this->Flash->set('Your Registration is successful, your confirmation email has been sent to your email address. Please Verify.', ['element' => 'success']);

                $verifiedLink = Router::url(array("controller"=>"users","action"=>"verification", $myToken),true);
//                if all info passed in successful, then send email confirmation to users
                $subject = 'Please Click the link to confirm your Email Verification';
                $body = 'Hi, ' . $myFirstName . ' ' . $myLastName;
                $body .= "<br><br>Please Click the link below to verify your registration.";
//                $body .= "<br><br><a href=http://localhost:8888/PEAR/PEAR/users/verification/".$myToken.">Verification Link</a>" ;
                $body .= "<br><br><a href=" . $verifiedLink . ">Verification Link</a>";


                $email = new Email('default');
                $email
                    ->transport('gmail')
                    ->from(['pearmonash@gmail.com' => 'Team 123 PEAR'])
                    ->subject($subject)
                    ->emailFormat('html')
                    ->to($myEmail)
                    ->send($body);


            } else {
                $this->Flash->set('Register Failed, Please Try Again', ['element' => 'error']);
            }

        }

        }
        $this->set(compact('user'));
    }
//Backup
//    public function register(){
//        $user = $this->Users->newEntity();
//        if ($this->request->is('post')){
//            $user = $this->Users->patchEntity($user,$this->request->getData());
//            if ($this->Users->save($user)){
//                $this->Flash->success('You are registered and can log in');
//                return $this->redirect(['action' => 'login']);
//            }else{
//                $this->Flash->error('You are not registered.');
//            }
//        }
//        $this->set(compact('user'));
//        $this->set('_serialize',['user']);
//    }
    public function beforeFilter(Event $event)
    {

        $this->Auth->allow('register');
        $this->Auth->allow('verification');
        $this->Auth->allow('reset');
        $this->Auth->allow('portal');

        $user = $this->Auth->user();

        //If user's role is 1(students), redirect to students page;
        if ( $user['role'] == 2 ) {
            $this->Auth->deny('index');
            $this->redirect(['controller'=>'staff','action'=>'index']);
        }
        if ( $user['role'] == 3 ) {
            $this->Auth->deny('index');
            $this->redirect(['controller'=>'staff','action'=>'index']);
        }
    }
}
