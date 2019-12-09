<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Class Entity
 *
 * @property int $id
 * @property int $tutor_id
 * @property string $class_name
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Unit[] $units
 */
class Class extends Entity
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
        'tutor_id' => true,
        'class_name' => true,
        'users' => true,
        'units' => true
    ];
}
