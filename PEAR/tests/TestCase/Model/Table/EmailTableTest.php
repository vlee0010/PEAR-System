<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmailTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmailTable Test Case
 */
class EmailTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EmailTable
     */
    public $Email;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Email',
        'app.Units'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Email') ? [] : ['className' => EmailTable::class];
        $this->Email = TableRegistry::getTableLocator()->get('Email', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Email);

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
