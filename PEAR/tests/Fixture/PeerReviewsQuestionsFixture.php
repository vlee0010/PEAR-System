<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PeerReviewsQuestionsFixture
 */
class PeerReviewsQuestionsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'peer_reviews_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'question_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'peer_reviews_questions_questions_id_fk' => ['type' => 'index', 'columns' => ['question_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['peer_reviews_id', 'question_id'], 'length' => []],
            'peer_reviews_questions_peer_reviews_id_fk' => ['type' => 'foreign', 'columns' => ['peer_reviews_id'], 'references' => ['peer_reviews', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'peer_reviews_questions_questions_id_fk' => ['type' => 'foreign', 'columns' => ['question_id'], 'references' => ['questions', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'peer_reviews_id' => 1,
                'question_id' => 1
            ],
        ];
        parent::init();
    }
}
