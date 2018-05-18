<?php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuthRule Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $title
 * @property string $condition
 *
 * @property \Admin\Model\Entity\ParentAuthRule $parent_auth_rule
 * @property \Admin\Model\Entity\ChildAuthRule[] $child_auth_rule
 */
class AuthRule extends Entity
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
        'parent_id' => true,
        'name' => true,
        'title' => true,
        'condition' => true,
        'parent_auth_rule' => true,
        'child_auth_rule' => true
    ];
}
