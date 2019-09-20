<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property int $id
 * @property string $description
 * @property int $peer_review_id
 *
 * @property \App\Model\Entity\PeerReview[] $peer_reviews
 * @property \App\Model\Entity\Response[] $responses
 */
class Question extends Entity
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
        'description' => true,
        'peer_review_id' => true,
        'peer_review' => true,
        'responses' => true
    ];
}
