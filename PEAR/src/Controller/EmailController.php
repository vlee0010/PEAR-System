<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Email Controller
 *
 * @property \App\Model\Table\EmailTable $Email
 *
 * @method \App\Model\Entity\Email[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmailController extends AppController
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
        $email = $this->paginate($this->Email);

        $this->set(compact('email'));
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
        $email = $this->Email->get($id, [
            'contain' => ['Units']
        ]);

        $this->set('email', $email);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($unit_id)
    {
        $email = $this->Email->newEntity();
        if ($this->request->is('post')) {
            $email = $this->Email->patchEntity($email, $this->request->getData());
            $email->unit_id = $unit_id;
            if ($this->Email->save($email)) {
                $this->Flash->success(__('The email has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The email could not be saved. Please, try again.'));
        }
        $units = $this->Email->Units->find('list', ['limit' => 200]);
        $this->set(compact('email', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Email id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($unit_id = null)
    {
        $email = $this->Email->find('all')->where(['unit_id' => $unit_id])->first();
        if ($email == null) {
            $email = $this->Email->get(1);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $email = $this->Email->patchEntity($email, $this->request->getData());
            $email->unit_id = $unit_id;
            if ($this->Email->save($email)) {
                $this->Flash->success(__('The email has been saved.'));

                return $this->redirect(['controller' => 'units','action' => 'view',$unit_id]);
            }
            $this->Flash->error(__('The email could not be saved. Please, try again.'));
        }
        if ($this->request->is(['cancel'])){
            $this->redirect($this->referer());
        }
        $this->set('unit_id',$unit_id);
        $this->set(compact('email'));
    }

}
