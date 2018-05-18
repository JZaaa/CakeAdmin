<?php
namespace Admin\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int $arctype_id
 * @property int $pagetype_id
 * @property string $title
 * @property string $shorttitle
 * @property string $color
 * @property string $description
 * @property string $keywords
 * @property string $content
 * @property \Cake\I18n\FrozenTime $pubdate
 * @property string $image
 * @property int $autoimage
 * @property string $tag
 * @property int $isshow
 * @property int $istop
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Admin\Model\Entity\Arctype $arctype
 * @property \Admin\Model\Entity\Pagetype $pagetype
 * @property \Admin\Model\Entity\User $user
 */
class Article extends Entity
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
        'arctype_id' => true,
        'title' => true,
        'shorttitle' => true,
        'color' => true,
        'description' => true,
        'keywords' => true,
        'content' => true,
        'pubdate' => true,
        'image' => true,
        'autoimage' => true,
        'tag' => true,
        'isshow' => true,
        'istop' => true,
        'url' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'arctype' => true,
        'user' => true
    ];
}
