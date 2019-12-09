<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PeerReviews Controller
 *
 * @property \App\Model\Table\PeerReviewsTable $PeerReviews
 *
 * @method \App\Model\Entity\PeerReview[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PeerReviewsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Units']
        ];
        $peerReviews = $this->paginate($this->PeerReviews);

        $this->set(compact('peerReviews'));
    }

    /**
     * View method
     *
     * @param string|null $id Peer Review id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $peerReview = $this->PeerReviews->get($id, [
            'contain' => ['Units', 'Teams', 'Users', 'Questions']
        ]);

        $this->set('peerReview', $peerReview);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $peerReview = $this->PeerReviews->newEntity();
        if ($this->request->is('post')) {
            $peerReview = $this->PeerReviews->patchEntity($peerReview, $this->request->getData());
            if ($this->PeerReviews->save($peerReview)) {
                $this->Flash->success(__('The peer review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The peer review could not be saved. Please, try again.'));
        }
        $units = $this->PeerReviews->Units->find('list', ['limit' => 200]);
        $teams = $this->PeerReviews->Teams->find('list', ['limit' => 200]);
        $users = $this->PeerReviews->Users->find('list', ['limit' => 200]);
        $this->set(compact('peerReview', 'units', 'teams', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Peer Review id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $peerReview = $this->PeerReviews->get($id, [
            'contain' => ['Teams', 'Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $peerReview = $this->PeerReviews->patchEntity($peerReview, $this->request->getData());
            if ($this->PeerReviews->save($peerReview)) {
                $this->Flash->success(__('The peer review has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The peer review could not be saved. Please, try again.'));
        }
        $units = $this->PeerReviews->Units->find('list', ['limit' => 200]);
        $teams = $this->PeerReviews->Teams->find('list', ['limit' => 200]);
        $users = $this->PeerReviews->Users->find('list', ['limit' => 200]);
        $this->set(compact('peerReview', 'units', 'teams', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Peer Review id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $peerReview = $this->PeerReviews->get($id);
        if ($this->PeerReviews->delete($peerReview)) {
            $this->Flash->success(__('The peer review has been deleted.'));
        } else {
            $this->Flash->error(__('The peer review could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
