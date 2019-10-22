<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PeerReviews Model
 *
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\HasMany $Questions
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\BelongsToMany $Teams
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\PeerReview get($primaryKey, $options = [])
 * @method \App\Model\Entity\PeerReview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PeerReview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PeerReview|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PeerReview saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PeerReview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PeerReview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PeerReview findOrCreate($search, callable $callback = null, $options = [])
 */
class PeerReviewsTable extends Table
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

        $this->setTable('peer_reviews');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Units', [
            'foreignKey' => 'unit_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Questions', [
            'foreignKey' => 'peer_review_id'
        ]);
        $this->belongsToMany('Teams', [
            'foreignKey' => 'peer_review_id',
            'targetForeignKey' => 'team_id',
            'joinTable' => 'peer_reviews_teams'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'peer_review_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'peer_reviews_users'
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
            ->dateTime('date_start')
            ->requirePresence('date_start', 'create')
            ->notEmptyDateTime('date_start');

        $validator
            ->dateTime('date_end')
            ->requirePresence('date_end', 'create')
            ->notEmptyDateTime('date_end');

        $validator
            ->dateTime('date_reminder')
            ->requirePresence('date_reminder', 'create')
            ->notEmptyDateTime('date_reminder');

        $validator
            ->scalar('title')
            ->maxLength('title', 1000)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

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
