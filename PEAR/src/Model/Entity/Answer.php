<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity
 *
 * @property int $id
 * @property string $answer
 * @property int $user_id
 * @property int $response_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Response[] $responses
 */
class Answer extends Entity
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
        'answer' => true,
        'user_id' => true,
        'response_id' => true,
        'user' => true,
        'responses' => true
    ];
}
