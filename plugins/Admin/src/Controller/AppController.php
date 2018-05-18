<?php

namespace Admin\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub


        try {
            $this->loadComponent('Auth', [
                'authenticate' => [
                    'Form' => [
                        'userModel' => 'Admin.Users'
                    ]
                ],
                'loginAction' => [
                    'controller' => 'Users',
                    'action' => 'login',
                    'plugin' => 'Admin'
                ],
                'loginRedirect' => [
                    'controller' => 'Welcome',
                    'action' => 'index',
                    'plugin' => 'Admin'
                ],
                'storage' => [
                    'className' => 'Session',
                    'key' => 'Admin.User'
                ]
            ]);


//            $this->loadComponent('Admin.AuthRules', [
//                'authModel' => 'Admin.AuthRules',
//                'fields' => [
//                    'keywords' => 'name',
//                    'extend' => 'condition',
//                    'name' => 'title'
//                ],
//                'sessionKey' => 'AuthRules',
//                'ids' => [1,2,3],
//                'statusCode' => 405
//            ]);
        } catch (\Exception $e) {
            echo '网站异常！';
            exit;
        }


        $this->limit = 20;  //每页显示条数

        $this->viewBuilder()->setLayout('ajax');
    }


    /*
   * 页面跳转函数
   * @param statusCode int 必选。状态码(ok = 200, error = 300, timeout = 301)
   * @param message string 可选。信息内容。
   * @param tabid string 可选。待刷新navtab id，多个id以英文逗号分隔开，当前的navtab id不需要填写
   * @param dialogid string 可选。待刷新dialog id，多个id以英文逗号分隔开，请不要填写当前的dialog id。
   * @param divid string 可选。待刷新div id，多个id以英文逗号分隔开
   * @param closeCurrent boolean 可选。是否关闭当前窗口(navtab或dialog)。
   * @param forward string 可选。跳转到某个url。
   * @param forwardConfirm string 可选。跳转url前的确认提示信息。
   *
   * */
    public function jump($statusCode, $message, $tabid, $closeCurrent = true, $forward = '', $divid = '', $dialogid = '', $forwardConfirm = '')
    {
        $result = array();
        $result['statusCode'] = empty($statusCode) ? 200 : $statusCode;
        $result['message'] = $message;
        $result['tabid'] = strtolower($tabid);
        $result['forward'] = $forward;
        $result['dialogid'] = $dialogid;
        $result['divid'] = $divid;
        $result['forwardConfirm'] = $forwardConfirm;
        $result['closeCurrent'] = $closeCurrent;
        header("Content-Type:text/html; charset=utf-8");
        exit(json_encode($result));
    }

    /*
     * 分页参数设置
     *
     * */
    public function setPage()
    {
        $page = !empty($this->request->getData('pageCurrent')) ? $this->request->getData('pageCurrent') : 1;
        $numPerPage = !empty($this->request->getData('pageSize')) ? $this->request->getData('pageSize') : $this->limit;
        $this->paginate['page'] = $page;
        $this->paginate['limit'] = $numPerPage;

        $this->set(compact('page', 'numPerPage'));
    }



}