<?php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;

/**
 * SearchIndex Entity
 *
 * @property int $id
 * @property string $obj_type
 * @property int $obj_id
 * @property string $title
 * @property string $content
 * @property string $params
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class SearchIndex extends Entity
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
        'obj_type' => true,
        'obj_id' => true,
        'title' => true,
        'content' => true,
        'params' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
