<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PeerReview Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $date_start
 * @property \Cake\I18n\FrozenTime $date_end
 * @property \Cake\I18n\FrozenTime $date_reminder
 * @property string $title
 * @property int $unit_id
 *
 * @property \App\Model\Entity\Unit $unit
 * @property \App\Model\Entity\Question[] $questions
 * @property \App\Model\Entity\Team[] $teams
 * @property \App\Model\Entity\User[] $users
 */
class PeerReview extends Entity
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
        'date_start' => true,
        'date_end' => true,
        'date_reminder' => true,
        'title' => true,
        'unit_id' => true,
        'unit' => true,
        'questions' => true,
        'teams' => true,
        'users' => true
    ];
}
