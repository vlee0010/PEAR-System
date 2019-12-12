<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Emails Controller
 *
 * @property \App\Model\Table\EmailsTable $Emails
 *
 * @method \App\Model\Entity\Email[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailsController extends AppController
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
        $emails = $this->paginate($this->Emails);

        $this->set(compact('emails'));
    }

    /**
     * View method
     *
     * @param string|null $id Email id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $email = $this->Emails->get($id, [
            'contain' => ['Units']
        ]);

        $this->set('email', $email);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $email = $this->Emails->newEntity();
        if ($this->request->is('post')) {
            $email = $this->Emails->patchEntity($email, $this->request->getData());
            if ($this->Emails->save($email)) {
                $this->Flash->success(__('The email has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email could not be saved. Please, try again.'));
        }
        $units = $this->Emails->Units->find('list', ['limit' => 200]);
        $this->set(compact('email', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($unit_id = null)
    {
        $email = $this->Emails->find('all')->where(['unit_id' => $unit_id])->first();
        if ($email == null) {
            $email = $this->Emails->get(1);
        }
        $newEmail = $this->Emails->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newEmail = $this->Emails->patchEntity($newEmail, $this->request->getData());
            $newEmail->unit_id = $unit_id;
            if ($this->Emails->save($newEmail)) {
                $this->Flash->success(__('The email has been saved.'));

                return $this->redirect(['controller' => 'units','action' => 'view',$unit_id]);
            }
            $this->Flash->error(__('The email could not be saved. Please, try again.'));
        }
        $units = $this->Emails->Units->find('list', ['limit' => 200]);
        $this->set(compact('newEmail', 'units'));
        $this->set('unit_id',$unit_id);
        $this->set(compact('email'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Email id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $email = $this->Emails->get($id);
        if ($this->Emails->delete($email)) {
            $this->Flash->success(__('The email has been deleted.'));
        } else {
            $this->Flash->error(__('The email could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
