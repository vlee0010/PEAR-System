<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Units Model
 *
 * @property \App\Model\Table\PeerReviewsTable&\Cake\ORM\Association\HasMany $PeerReviews
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\HasMany $Teams
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Unit get($primaryKey, $options = [])
 * @method \App\Model\Entity\Unit newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Unit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Unit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Unit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Unit[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Unit findOrCreate($search, callable $callback = null, $options = [])
 */
class UnitsTable extends Table
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

        $this->setTable('units');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('PeerReviews', [
            'foreignKey' => 'unit_id'
        ]);
        $this->hasMany('Teams', [
            'foreignKey' => 'unit_id'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'unit_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'units_users'
        ]);
        $this->hasMany('Classes',[
            'foreignKey' => 'unit_id',
            'joinTable' => 'units_classes'
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
            ->scalar('title')
            ->maxLength('title', 1000)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('code')
            ->maxLength('code', 10)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('semester')
            ->maxLength('semester', 1)
            ->requirePresence('semester', 'create')
            ->notEmptyString('semester');

        $validator
            ->scalar('year')
            ->requirePresence('year', 'create')
            ->notEmptyString('year');

        return $validator;
    }
}
