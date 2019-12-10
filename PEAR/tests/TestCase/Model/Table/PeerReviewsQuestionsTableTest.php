<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeerReviewsQuestionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeerReviewsQuestionsTable Test Case
 */
class PeerReviewsQuestionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PeerReviewsQuestionsTable
     */
    public $PeerReviewsQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PeerReviewsQuestions',
        'app.PeerReviews',
        'app.Questions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PeerReviewsQuestions') ? [] : ['className' => PeerReviewsQuestionsTable::class];
        $this->PeerReviewsQuestions = TableRegistry::getTableLocator()->get('PeerReviewsQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PeerReviewsQuestions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
