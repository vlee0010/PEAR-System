<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PeerReviewsQuestions Controller
 *
 * @property \App\Model\Table\PeerReviewsQuestionsTable $PeerReviewsQuestions
 *
 * @method \App\Model\Entity\PeerReviewsQuestion[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PeerReviewsQuestionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PeerReviews', 'Questions']
        ];
        $peerReviewsQuestions = $this->paginate($this->PeerReviewsQuestions);

        $this->set(compact('peerReviewsQuestions'));
    }

    /**
     * View method
     *
     * @param string|null $id Peer Reviews Question id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $peerReviewsQuestion = $this->PeerReviewsQuestions->get($id, [
            'contain' => ['PeerReviews', 'Questions']
        ]);

        $this->set('peerReviewsQuestion', $peerReviewsQuestion);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $peerReviewsQuestion = $this->PeerReviewsQuestions->newEntity();
        if ($this->request->is('post')) {
            $peerReviewsQuestion = $this->PeerReviewsQuestions->patchEntity($peerReviewsQuestion, $this->request->getData());
            if ($this->PeerReviewsQuestions->save($peerReviewsQuestion)) {
                $this->Flash->success(__('The peer reviews question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The peer reviews question could not be saved. Please, try again.'));
        }
        $peerReviews = $this->PeerReviewsQuestions->PeerReviews->find('list', ['limit' => 200]);
        $questions = $this->PeerReviewsQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('peerReviewsQuestion', 'peerReviews', 'questions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Peer Reviews Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $peerReviewsQuestion = $this->PeerReviewsQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $peerReviewsQuestion = $this->PeerReviewsQuestions->patchEntity($peerReviewsQuestion, $this->request->getData());
            if ($this->PeerReviewsQuestions->save($peerReviewsQuestion)) {
                $this->Flash->success(__('The peer reviews question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The peer reviews question could not be saved. Please, try again.'));
        }
        $peerReviews = $this->PeerReviewsQuestions->PeerReviews->find('list', ['limit' => 200]);
        $questions = $this->PeerReviewsQuestions->Questions->find('list', ['limit' => 200]);
        $this->set(compact('peerReviewsQuestion', 'peerReviews', 'questions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Peer Reviews Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $peerReviewsQuestion = $this->PeerReviewsQuestions->get($id);
        if ($this->PeerReviewsQuestions->delete($peerReviewsQuestion)) {
            $this->Flash->success(__('The peer reviews question has been deleted.'));
        } else {
            $this->Flash->error(__('The peer reviews question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
