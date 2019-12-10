<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PeerReviewsQuestions Model
 *
 * @property \App\Model\Table\PeerReviewsTable&\Cake\ORM\Association\BelongsTo $PeerReviews
 * @property \App\Model\Table\QuestionsTable&\Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\PeerReviewsQuestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\PeerReviewsQuestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PeerReviewsQuestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PeerReviewsQuestion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PeerReviewsQuestion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PeerReviewsQuestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PeerReviewsQuestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PeerReviewsQuestion findOrCreate($search, callable $callback = null, $options = [])
 */
class PeerReviewsQuestionsTable extends Table
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

        $this->setTable('peer_reviews_questions');
        $this->setDisplayField('peer_reviews_id');
        $this->setPrimaryKey(['peer_reviews_id', 'question_id']);

        $this->belongsTo('PeerReviews', [
            'foreignKey' => 'peer_reviews_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['peer_reviews_id'], 'PeerReviews'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));

        return $rules;
    }
}
