<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Classes Controller
 *
 * @property \App\Model\Table\ClassesTable $Classes
 *
 * @method \App\Model\Entity\Class[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClassesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $classes = $this->paginate($this->Classes);

        $this->set(compact('classes'));
    }

    /**
     * View method
     *
     * @param string|null $id Class id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $class = $this->Classes->get($id, [
            'contain' => ['Users', 'Units']
        ]);

        $this->set('class', $class);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $class = $this->Classes->newEntity();
        if ($this->request->is('post')) {
            $class = $this->Classes->patchEntity($class, $this->request->getData());
            if ($this->Classes->save($class)) {
                $this->Flash->success(__('The class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The class could not be saved. Please, try again.'));
        }
        $users = $this->Classes->Users->find('list', ['limit' => 200]);
        $units = $this->Classes->Units->find('list', ['limit' => 200]);
        $this->set(compact('class', 'users', 'units'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Class id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $class = $this->Classes->get($id, [
            'contain' => ['Users', 'Units']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $class = $this->Classes->patchEntity($class, $this->request->getData());
            if ($this->Classes->save($class)) {
                $this->Flash->success(__('The class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The class could not be saved. Please, try again.'));
        }
        $users = $this->Classes->Users->find('list', ['limit' => 200]);
        $units = $this->Classes->Units->find('list', ['limit' => 200]);
        $this->set(compact('class', 'users', 'units'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Class id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $class = $this->Classes->get($id);
        if ($this->Classes->delete($class)) {
            $this->Flash->success(__('The class has been deleted.'));
        } else {
            $this->Flash->error(__('The class could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
