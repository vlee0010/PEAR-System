<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 *
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($peer_id = null)
    {
        $questions = $this->paginate($this->Questions);
        $student_id = $this->Auth->user('id');
        $teamUserTable = TableRegistry::getTableLocator()->get('teams_users');
        $teams_users_query = $teamUserTable->find();
        $peersTeamsTable = TableRegistry::getTableLocator()->get('peer_reviews_teams');
        $peers_teams_query = $peersTeamsTable->find();
        $userTable = TableRegistry::getTableLocator()->get('users');
        $user_query = $userTable->find();
        $questionsTable = TableRegistry::getTableLocator()->get('questions');
        $question_query = $questionsTable->find();
        $responsesTable = TableRegistry::getTableLocator()->get('responses');
        $teamMatches=0;
        foreach ($peers_teams_query as $peer_team){
            if ($peer_team->peer_review_id == $peer_id){
                $teamMatches = $peer_team->team_id;
            }
        }
        $user_id_list=[];
        foreach($teams_users_query as $team_user){
            if($team_user->team_id==$teamMatches){
                array_push($user_id_list,$team_user->user_id);
            }
        }

        if($this->request->is('post')){
            foreach($question_query as $question){
                foreach($user_id_list as $user_id){
                    $response=$responsesTable->newEntity();
                    $response->date_response= Time::now();
                    $response->user_id=$this->Auth->user('id');
                    $response->question_id=$question->id;
                    $response->ratee_id=$user_id;
                    if($question->id != 6){
                        $response->is_text_number = 0;
                        $response->rate_number = $this->request->getData('sliderRating_'.$question->id.'_'.$user_id);
                        $responsesTable->save($response);
                    }
                    else{
                        $response->is_text_number = 1;
                        $response->rate_text = $this->request->getData('textRating_'.$question->id.'_'.$user_id);
                        $responsesTable->save($response);
                    }

                }
            }

        }
        $this->set(compact('questions'));
        $this->set(compact('user_id_list'));
        $this->set(compact('user_query'));
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);

        $this->set('question', $question);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function peerQuestions($id=1){
        $question = $this->Questions->get($id,[
            'contain' => [
                'PeerReviews' =>['Questions']
            ]
        ]);
        $this->set('questions', $question);
        $this->viewBuilder()->setLayout('default');
    }
}
