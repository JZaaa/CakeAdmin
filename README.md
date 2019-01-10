# CakePHP 3.6 + BJUI 快速开发后台模板

默认账号： admin

密码：123456

## 开始使用

### 安装

````
composer install
````

### 其他配置

复制 ``config/app.default.php`` 至 ``config`` 文件下，并重命名为 ``app.php`` , 修改相关配置后。

### 数据库

- `sql`文件导入：向``msyql``中导入 根目录下的``cakeadmin.sql``文件

 或者使用  `Migrations` 迁移

````
// 创建数据库后运行以下命令

$ bin/cake migrations migrate -p Admin

$ bin/cake migrations seed -p Admin
````




**Linux文件夹权限**

Linux系统可能会出现文件权限的问题，请给以下文件与子文件添加权限：
````
/logs
/tmp
/files
/webroot/assets/b-jui/BJUI/plugins/kindeditor/attached
````

## 定制开发模块推荐

``arctype`` 表中存在存在 ``keywords`` 字段,利用此字段标识将要开发对应模块，并创建其子模块，例如：

````php
    /**
     * 获取栏目关键字，修改原关键字请确保ArticlesTable 内文章具体分类不受影响
     * @param null $key
     * @return array|mixed
     */
    public function getKey($key = null)
    {
        $data = [
            'index' => '首页',
            'about' => '关于我们'
        ];

        $data = array_merge(
            $data,
            $this->getIndexKeywords(),
            $this->getAboutKeywords()
        );

        return !empty($key) ? $data[$key] : $data;
    }
    
     /**
       * 获取首页keywords
       * @return array
       */
     public function getIndexKeywords() {
        return [
            'index-banner' => '首页banner',
            'index-article-0' => '首页文章1',
            'news-0' => '新闻'
            ];
     }
     
     // ....

```` 

定义类似keywords获取函数后，再创建对应栏目与菜单,菜单内容可复制``Template/list_page_main.ctp`` 进行修改，并根据程序中自定义keywords获取内容树。如不存在特殊功能的，后台文章内容部分工作就已经完成了。

## [更新日志](./changlog.md)


### 其他
**项目中使用的部分组件/类：**[Cake-repository](https://github.com/JZaaa/Cake-repository)

