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
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $role
 * @property string $password
 * @property int|null $verified
 * @property string|null $token
 * @property string|null $studentid
 *
 * @property \App\Model\Entity\Response[] $responses
 * @property \App\Model\Entity\PeerReview[] $peer_reviews
 * @property \App\Model\Entity\Team[] $teams
 * @property \App\Model\Entity\Class[] $classes
 * @property \App\Model\Entity\Unit[] $units
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
        'password' => true,
        'verified' => true,
        'token' => true,
        'studentid' => true,
        'responses' => true,
        'peer_reviews' => true,
        'teams' => true,
        'classes' => true,
        'units' => true
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('email', 'create')
            ->notEmpty('email');
    }

    protected function _getFullName()
    {
        return $this->_properties['firstname'] . ' ' . $this->_properties['lastname'];

    }

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token'
    ];
}
