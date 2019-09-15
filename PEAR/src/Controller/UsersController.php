<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Core\App;
use Cake\Controller\Exception\SecurityException;
use Cake\Utility\Security;
use Cake\Mailer\Email;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
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
            'contain' => []
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

    public function login(){
        if ($this->Auth->user()){
            return $this->redirect(["controller"=>"users","action"=>"studentdash"]);
        }
        if ($this->request->is('post')){
            if($this->request->data('_type')==='login') {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
                    if ($user->verified) {
                        $this->redirect(['controller' => 'users', 'action' => 'studentdash']);
                    } else {
                        $this->Flash->error('Please verify your Email address first');
                        $this->Auth->logout();
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


            if ($this->request->data('_type') === 'reset'){
                $email = $this->request->getData('email');
                $user = $this->Users->find()->where(['email'=>$email])->first();
                $subject="Password reset";
                $body="Hi ".$user->firstname." ".$user->lastname."<br / >Please reset your password through the link below<br /><a href=http://ie.infotech.monash.edu/team123/pear/PEAR/users/reset/". $user->token.">Click here to reset</a>";
                $this->sendEmailToUser($email,$subject,$body); $this->Flash->success('Check your email to reset your password');
                return $this->redirect(['action' => 'login']);
}


            }



    }


    public function logout(){


        $this->Auth->logout();
//        $this->Flash->success('You are logged out');
        return $this->redirect(['controller'=>'pages', 'action'=>'display']);


    }

    public function reset($token){
        $password = $this->request->getData('password');
        if ($password){
            $encryptedPassword = (new DefaultPasswordHasher)->hash($password);
            $user = TableRegistry::get('Users');
            $query = $user->query();
            $query->update()
                ->set(["password" => $encryptedPassword])
                ->where(["token" => $token])
                ->execute();
            return $this->redirect(["action" => 'login']);
        }
    }

    public function verification($token){
        $user = TableRegistry::get('Users');
        $query = $user->query();
        $query->update()
            ->set(['verified'=>1])
            ->where(['token'=>$token])
            ->execute();

        $verify = $user->find('all')->where(['token'=>$token])->first();
        $user->save($verify);
        $this->redirect(['action'=>'login']);
    }
    public function studentdash(){

    }
    public function register(){
        $user = $this->Users->newEntity();
        if($this->request->is('post')){
            $userTable = TableRegistry::get('Users');
//            $error_message = var_dump($userTable->find());
//            foreach ($userTable->find() as $row){
//                echo "<script type='text/javascript'>alert('$row->email');</script>";
     //       }

            $hasher = new DefaultPasswordHasher();
            $myFirstName = $this->request->getData('firstname');
            $myLastName = $this->request->getData('lastname');
            $myEmail = $this->request->getData('email');
//            $myPassword = Security::hash($this->request->getData('password'),'sha1',false);
            $myPassword =$this->request->getData('password');
            $myToken = Security::hash(Security::randomBytes(32));

            $user->firstname = $myFirstName;
            $user->lastname = $myLastName;
            $user->email = $myEmail;
            $user->password = $myPassword;
            $user->token = $myToken;

            if ($this->Users->save($user)){
                $this->Flash->set('Your Registration is successful, your confirmation email has been sent to your email address. Please Verify.',['element'=>'success']);

//                if all info passed in successful, then send email confirmation to users
                $subject = 'Please Click the link to confirm your Email Verification';
                $body = 'Hi, ' . $myFirstName . ' ' . $myLastName;
                $body .= "<br><br>Please Click the link below to verify your registration.";
                $body .= "<br><br><a href=http://ie.infotech.monash.edu/team123/pear/PEAR/users/verification/".$myToken.">Verification Link</a>" ;


                $email = new Email('default');
                $email
                      ->transport('gmail')
                      ->from(['monashietesting@gmail.com'=>'Team 123 PEAR'])
                      ->subject($subject)
                      ->emailFormat('html')
                      ->to($myEmail)
                      ->send($body);



            }else{
                $this->Flash->set('Register Failed, Please Try Again',['element'=>'error']);
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
    }
}
