<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Unit Entity
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string $semester
 * @property string $year
 *
 * @property \App\Model\Entity\PeerReview[] $peer_reviews
 * @property \App\Model\Entity\Team[] $teams
 * @property \App\Model\Entity\User[] $users
 */
class Unit extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'code' => true,
        'semester' => true,
        'year' => true,
        'peer_reviews' => true,
        'teams' => true,
        'users' => true
    ];

    protected function _getFullTitle()
    {
        return $this->_properties['code'] . ' ' . $this->_properties['title']
            . ' ' . $this->_properties['year'] . " S " . $this->_properties['semester'];
    }
}
