<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Response Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $date_response
 * @property int $user_id
 * @property int $question_id
 * @property int $answer_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Question $question
 * @property \App\Model\Entity\Answer $answer
 */
class Response extends Entity
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
        'date_response' => true,
        'user_id' => true,
        'question_id' => true,
        'answer_id' => true,
        'user' => true,
        'question' => true,
        'answer' => true
    ];
}
