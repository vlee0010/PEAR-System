<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classes Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StudentsClassesTable&\Cake\ORM\Association\HasMany $StudentsClasses
 * @property \App\Model\Table\ClassesTutorsTable&\Cake\ORM\Association\HasMany $ClassesTutors
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsToMany $Units
 *
 * @method \App\Model\Entity\Class get($primaryKey, $options = [])
 * @method \App\Model\Entity\Class newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Class[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Class|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Class saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Class patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Class[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Class findOrCreate($search, callable $callback = null, $options = [])
 */
class ClassesTable extends Table
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

        $this->setTable('classes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // delete
        $this->belongsTo('Users', [
            'foreignKey' => 'tutor_id'
        ]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'class_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'students_classes'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'class_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'classes_tutors'
        ]);
        $this->belongsToMany('Units', [
            'foreignKey' => 'class_id',
            'targetForeignKey' => 'unit_id',
            'joinTable' => 'units_classes',
            'joinType' => 'INNER'
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
            ->scalar('class_name')
            ->maxLength('class_name', 1000)
            ->allowEmptyString('class_name');

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
        // $rules->add($rules->existsIn(['tutor_id'], 'Users'));
        $rules->add($rules->isUnique(['class_name'], 'This time slot has class already.'));
        return $rules;
    }
}
