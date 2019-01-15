<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;

/**
 * Apilication Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class ApiController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);

    }

    public $ApiPagination = true; // 分页解析


    /**
     * 用于api接口调用,可返回json/xml数据,默认返回json数据
     *
     * 标准请求请添加accept header
     * json: application/json
     * xml: application/xml
     *
     * 使用方法：
     * 1.创建AppController.php 继承 当前类
     * 2.创建apiResponse函数重载此方法
     *
     * example:
     * #in plugin appController
     *
     * public function apiResponse($func_args...) {
            // xxx 你的处理程序

            return parent::apiResponse($array);

     * }
     *
     * @param $array
     */
    public function apiResponse($array)
    {
        // 跨域配置
        $allowOrigin = Configure::read('Cors.AllowOrigin');

        if (!empty($allowOrigin)) {
            if ($allowOrigin === true || $allowOrigin === '*') {
                $allowOrigin = '*';
            }

            if (is_array($allowOrigin)) {
                $allowOrigin = implode(',', $allowOrigin);
            }

            header("Access-Control-Allow-Origin: {$allowOrigin}");
        }

        $this->_setVariable($array);

    }

    /**
     * 设置传输变量
     * 默认返回json数据
     * @param array $data
     */
    private function _setVariable($data = [])
    {
        if ($this->ApiPagination) {
            $pagination = $this->_setPagination();
            if (!empty($pagination)) {
                $data['pagination'] = $pagination;
            }
        }

        $accept = $this->request->getHeader('accept');

        if (empty($accept) || current($accept) === '*/*') {
            header('Content-Type:application/json; charset=utf-8');

            die(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK));
        }

        $data['_serialize'] = array_keys($data);

        $this->set($data);
    }


    /**
     * 设置分页解析
     * @return array
     */
    private function _setPagination()
    {
        $request = $this->getRequest();

        if (empty($request->paging)) {
            return [];
        }

        $paging = $request->paging;

        if (count($paging) != 1) {
            return [];
        }

        $pagination = current($paging);

        return [
            'pageCount' => $pagination['pageCount'],
            'currentPage' => $pagination['page'],
            'nextPage' => $pagination['nextPage'],
            'prevPage' => $pagination['prevPage'],
            'count' => $pagination['count'],
            'limit' => $pagination['perPage'],
            'paging' => $pagination,
            'modelClass' => key($paging)
        ];


    }
}
