<?php
namespace Admin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Articles Model
 *
 * @property \Admin\Model\Table\ArctypesTable|\Cake\ORM\Association\BelongsTo $Arctypes
 * @property \Admin\Model\Table\PagetypesTable|\Cake\ORM\Association\BelongsTo $Pagetypes
 * @property \Admin\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Admin\Model\Entity\Article get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\Article newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\Article[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\Article|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\Article patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\Article[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\Article findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArticlesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ad_articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Arctypes', [
            'foreignKey' => 'arctype_id',
            'className' => 'Admin.Arctypes'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Admin.Users'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 100)
            ->allowEmpty('title');

        $validator
            ->scalar('shorttitle')
            ->maxLength('shorttitle', 36)
            ->allowEmpty('shorttitle');

        $validator
            ->scalar('color')
            ->maxLength('color', 10)
            ->allowEmpty('color');

        $validator
            ->scalar('description')
            ->maxLength('description', 250)
            ->allowEmpty('description');

        $validator
            ->scalar('keywords')
            ->maxLength('keywords', 100)
            ->allowEmpty('keywords');

        $validator
            ->scalar('content')
            ->maxLength('content', 16777215)
            ->allowEmpty('content');

        $validator
            ->dateTime('pubdate')
            ->allowEmpty('pubdate');

        $validator
            ->scalar('image')
            ->maxLength('image', 200)
            ->allowEmpty('image');

        $validator
            ->allowEmpty('autoimage');

        $validator
            ->scalar('tag')
            ->maxLength('tag', 100)
            ->allowEmpty('tag');

        $validator
            ->allowEmpty('isshow');

        $validator
            ->allowEmpty('istop');

        $validator
            ->allowEmpty('url');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['arctype_id'], 'Arctypes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }


    /*
    * 数据转换
    *
    * */
    public function changeData($data = array())
    {
        $diyNoArr = array(
            'istop' => 2,
            'isshow' => 1,
            'autoimage' => 2
        );

        foreach ($diyNoArr as $key => $val) {
            if (!isset($data[$key])) {
                $data[$key] = $val;
            }
        }
        return $data;
    }

    /*
     * 提取内容第一张图片为缩略图
     *
     * */
    public function autoImage($content, $order = 'ALL', $basePath = '/webroot/'){
        $pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
        preg_match_all($pattern, $content, $match);
        if (isset($match[1]) && !empty($match[1])) {
            if ($order === 'ALL') {
                return substr($match[1][0],strpos($match[1][0],$basePath)+ strlen($basePath));
            }
            if (is_numeric($order) && isset($match[1][$order])) {
                return substr($match[1][$order],strpos($match[1][$order],$basePath)+ strlen($basePath));
            }
        }
        return '';
    }
}
