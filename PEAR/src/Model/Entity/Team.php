<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id_
 * @property string $name
 * @property int $unit_id
 *
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\PeerReview[] $peer_reviews
 * @property \App\Model\Entity\User[] $users
 */
class Team extends Entity
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
        'name' => true,
        'unit_id' => true,
        'unit' => true,
        'peer_reviews' => true,
        'users' => true
    ];
}
