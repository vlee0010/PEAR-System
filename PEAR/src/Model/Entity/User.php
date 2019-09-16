<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $role
 * @property string $password
 *
 * @property \App\Model\Entity\PeerReview[] $peer_reviews
 * @property \App\Model\Entity\Team[] $teams
 * @property \App\Model\Entity\Unit[] $units
 * @property \App\Model\Entity\Response[] $responses
 */
class User extends Entity
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
        'firstname' => true,
        'lastname' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'password' => true
    ];



    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }
    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
