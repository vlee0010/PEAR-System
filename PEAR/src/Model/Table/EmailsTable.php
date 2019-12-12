<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Emails Model
 *
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
 *
 * @method \App\Model\Entity\Email get($primaryKey, $options = [])
 * @method \App\Model\Entity\Email newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Email[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Email|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Email saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Email patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Email[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Email findOrCreate($search, callable $callback = null, $options = [])
 */
class EmailsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('emails');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('sender')
            ->maxLength('sender', 100)
            ->allowEmptyString('sender');

        $validator
            ->scalar('header')
            ->maxLength('header', 100)
            ->requirePresence('header', 'create')
            ->notEmptyString('header');

        $validator
            ->scalar('emailSubject')
            ->maxLength('emailSubject', 100)
            ->requirePresence('emailSubject', 'create')
            ->notEmptyString('emailSubject');

        $validator
            ->scalar('message')
            ->maxLength('message', 1000)
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        $validator
            ->scalar('fromSender')
            ->maxLength('fromSender', 100)
            ->allowEmptyString('fromSender');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['unit_id'], 'Units'));

        return $rules;
    }
}
