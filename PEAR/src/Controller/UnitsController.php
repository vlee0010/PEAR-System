<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Units Controller
 *
 * @property \App\Model\Table\UnitsTable $Units
 *
 * @method \App\Model\Entity\Unit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UnitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $units = $this->paginate($this->Units);

        $this->set(compact('units'));
    }

    /**
     * View method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => ['Users', 'PeerReviews', 'Teams']
        ]);

        $this->set('unit', $unit);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $unit = $this->Units->newEntity();
        if ($this->request->is('post')) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $users = $this->Units->Users->find('list', ['limit' => 200]);
        $this->set(compact('unit', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $unit = $this->Units->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $unit = $this->Units->patchEntity($unit, $this->request->getData());
            if ($this->Units->save($unit)) {
                $this->Flash->success(__('The unit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The unit could not be saved. Please, try again.'));
        }
        $users = $this->Units->Users->find('list', ['limit' => 200]);
        $this->set(compact('unit', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Unit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $unit = $this->Units->get($id);
        if ($this->Units->delete($unit)) {
            $this->Flash->success(__('The unit has been deleted.'));
        } else {
            $this->Flash->error(__('The unit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function generateCsv($unit_id,$role){
        $unitQuery = $this->Units->find()->where(['id'=>$unit_id]);
        $unitArray = [];
        $unitSelect = $unitQuery->select($this->Units);
        $unitSelect->toArray();

        switch($role) {
            case 1:
                $_header = ['Team', 'StudentId', 'Email', 'Firstname', 'Lastname', 'Class'];
                foreach ($unitSelect as $unit):
                    $file_name = 'PEARMONASH'.'_'.$unit->code . '_' . $unit->year . '_S' . $unit->semester . '_' . 'student_list.csv';
                endforeach;
                break;
            case 2:
                $_header = ['StaffId', 'Firstname', 'Lastname', 'Email', 'Class'];
                foreach ($unitSelect as $unit):
                    $file_name = 'PEARMONASH'.'_'.$unit->code . '_' . $unit->year . '_S' . $unit->semester . '_' .   'staff_list.csv';
                endforeach;
                break;
            default:
                foreach ($unitSelect as $unit):
                    $file_name = $unit->code . '_S' . $unit->semester . '_' . $unit->year . '.csv';
                endforeach;
                break;
        }
        $_serialize = 'data';
        $data = [];
        $this->response = $this->response->withDownload($file_name);

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('data', '_serialize', '_header'));
    }

}
