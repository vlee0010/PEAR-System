<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PeerReviewsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PeerReviewsTable Test Case
 */
class PeerReviewsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PeerReviewsTable
     */
    public $PeerReviews;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PeerReviews',
        'app.Units',
        'app.Questions',
        'app.Teams',
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PeerReviews') ? [] : ['className' => PeerReviewsTable::class];
        $this->PeerReviews = TableRegistry::getTableLocator()->get('PeerReviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PeerReviews);

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
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
