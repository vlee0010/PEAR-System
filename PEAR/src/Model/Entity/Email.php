<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Email Entity
 *
 * @property int $id
 * @property int|null $unit_id
 * @property string $sender
 * @property string $header
 * @property string|null $emailSubject
 * @property string|null $message
 * @property string $fromSender
 *
 * @property \App\Model\Entity\Unit $unit
 */
class Email extends Entity
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
        'unit_id' => true,
        'sender' => true,
        'header' => true,
        'emailSubject' => true,
        'message' => true,
        'fromSender' => true,
        'unit' => true
    ];
}
