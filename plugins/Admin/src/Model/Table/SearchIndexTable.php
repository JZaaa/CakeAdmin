<?php
namespace Admin\Model\Table;

use App\Lib\Spliter;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * SearchIndex Model
 *
 * @method \Admin\Model\Entity\SearchIndex get($primaryKey, $options = [])
 * @method \Admin\Model\Entity\SearchIndex newEntity($data = null, array $options = [])
 * @method \Admin\Model\Entity\SearchIndex[] newEntities(array $data, array $options = [])
 * @method \Admin\Model\Entity\SearchIndex|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admin\Model\Entity\SearchIndex patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admin\Model\Entity\SearchIndex[] patchEntities($entities, array $data, array $options = [])
 * @method \Admin\Model\Entity\SearchIndex findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SearchIndexTable extends Table
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

        $this->setTable('ad_search_index');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('obj_type')
            ->maxLength('obj_type', 20)
            ->requirePresence('obj_type', 'create')
            ->notEmpty('obj_type');

        $validator
            ->integer('obj_id')
            ->requirePresence('obj_id', 'create')
            ->notEmpty('obj_id');

        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->scalar('params')
            ->allowEmpty('params');


        return $validator;
    }


    /**
     * ascii 转换
     * @param $string
     * @return string
     */
    public function splitString($string)
    {
        $spliter = new Spliter();

        return $spliter->ord2UTF8($string)['words'];
    }


    /**
     * 保存字段格式化
     * @param $searchIndex
     * @return bool|array
     */
    public function formatterField($searchIndex)
    {
        if (empty($searchIndex['title']) || empty($searchIndex['content'])) {
            return false;
        }

        $spliter = new Spliter();

        $searchIndex['title'] = $spliter->ord2UTF8($searchIndex['title'])['words'];
        $searchIndex['content'] = $spliter->ord2UTF8(strip_tags($searchIndex['content']))['words'];

        return $searchIndex;
    }


    /**
     * 查看全文索引是否开启
     * @return bool
     */
    public function isEnable()
    {
        $enable = TableRegistry::getTableLocator()->get('Admin.Options')->find()
            ->where([
                'field' => 'systemfulltext'
            ])->first();

        if (empty($enable)) {
            return false;
        }


        return $enable['value'] == 1;
    }

    /**
     * 查询
     * @param $string
     * @param array $condition
     */
    public function searchInfo($string, $condition = [])
    {
        $string = $this->splitString($string);
        $query = $this->find()
            ->where([
                "MATCH(title, content) AGAINST(:search IN BOOLEAN MODE)"
            ])
            ->where($condition)
            ->bind(':search', $string, 'string')->all();

        debug($query);
        exit;
    }


    /**
     * 创建索引
     * @param $searchIndex
     * @return \Admin\Model\Entity\SearchIndex|bool
     */
    public function createInfo($searchIndex)
    {
        $searchIndex = $this->formatterField($searchIndex);
        if ($searchIndex === false) {
            return false;
        }

        $entity = $this->newEntity();

        $data = $this->patchEntity($entity, $searchIndex);

        return $this->save($data);

    }


    /**
     * 编辑索引
     * @param $searchIndex array
     * @param $obj_type string
     * @param $obj_id int
     * @return \Admin\Model\Entity\SearchIndex|bool
     */
    public function editInfo($searchIndex, $obj_type, $obj_id)
    {
        if (empty($obj_id) || empty($obj_type)) {
            return false;
        }
        $searchIndex = $this->formatterField($searchIndex);

        if (empty($searchIndex)) {
            return false;
        }

        $data = $this->find()->where([
            'obj_type' => $obj_type,
            'obj_id' => $obj_id
        ])->first();

        if (empty($data)) {
            $data = $this->newEntity();
        }
        $data = $this->patchEntity($data, $searchIndex);


        return $this->save($data);
    }

    /**
     * 删除
     * @param $obj_type
     * @param $obj_id
     * @return bool|mixed
     */
    public function deleteInfo($obj_type, $obj_id) {
        if (empty($obj_id) || empty($obj_type)) {
            return false;
        }

        $data = $this->find()->where([
            'obj_type' => $obj_type,
            'obj_id' => $obj_id
        ])->first();

        if (empty($data)) {
            return true;
        }
        return $this->delete($data);
    }



}
