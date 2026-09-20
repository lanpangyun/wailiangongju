# 外链发布工具网站
## 项目简介
基于 PHP + MySQL 开发的轻量外链管理发布网站，前后台完整一体，开箱即用。
### 功能清单
1. 前台展示外链列表，一键复制链接，移动端自适应
2. 管理员登录后台，独立权限管控
3. 外链新增、编辑、删除、显示/隐藏、自定义排序
4. 后台分页展示数据，操作弹窗确认防误删
### 运行环境
- PHP 5.6 ~ PHP 8.2
- MySQL / MariaDB
- 宝塔面板、Apache、Nginx 均可部署

## 项目目录结构
├── config.php          # 数据库全局配置
├── index.html          # 网站前端首页
├── admin/              # 后台管理目录
│   ├── login.php      # 后台登录页面
│   ├── index.php      # 外链管理列表
│   ├── add.php        # 新增外链
│   ├── edit.php       # 编辑外链
│   ├── del.php        # 删除外链接口
│   └── logout.php     # 退出登录
└── README.md           # 部署说明文档

## 一、数据库初始化 SQL
新建数据库 `link_tool`，执行下方SQL创建数据表与默认管理员账号
```sql
CREATE DATABASE IF NOT EXISTS link_tool DEFAULT CHARSET utf8mb4;
USE link_tool;

CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(200) NOT NULL COMMENT '外链标题',
  `url` varchar(500) NOT NULL COMMENT '外链地址',
  `sort` int(11) DEFAULT 0 COMMENT '排序值，数字越大展示越靠前',
  `status` tinyint(1) DEFAULT 1 COMMENT '1前台显示 0前台隐藏',
  `addtime` int(11) NOT NULL COMMENT '添加时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '管理员账号',
  `password` varchar(100) NOT NULL COMMENT 'MD5加密密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 默认登录账号：admin 密码：123456
INSERT INTO `admin` (`username`, `password`) VALUES ('admin', MD5('123456'));


## 二、数据库配置文件 config.php

修改数据库连接信息，替换为自己服务器数据库账号密码

## 三、完整部署步骤

1. 服务器数据库管理面板新建数据库 `link_tool`，复制上方 SQL 语句执行完成建表
2. 修改项目根目录 `config.php` 文件内数据库用户名、密码、库名
3. 将全部源码文件完整上传至网站根目录，保持原有文件夹结构不变
4. 访问域名即可打开前台外链展示页面
5. 后台管理地址：`你的域名/admin/login.php`
6. 默认登录账号：admin，密码：123456

四、前台页面 index.html

## 五、后台源码文件

### 1. admin/login.php 登录页
2. admin/index.php 外链管理列表
### 3. admin/add.php 新增外链
### 4. admin/edit.php 编辑外链
### 5. admin/del.php 删除外链接口
### 6. admin/logout.php 退出登录

## 六、使用说明

### 前台使用

1. 页面自动读取数据库中状态 = 1 的外链，按排序值倒序展示
2. 每条链接配备复制按钮，一键复制完整 URL
3. 页面底部提供后台登录入口

### 后台使用

1. 登录账号密码登录管理面板
2. 新增外链：填写标题、链接、排序、展示状态后提交
3. 编辑外链：修改已有外链全部信息并保存
4. 删除外链：弹窗确认后永久删除数据
5. 排序规则：sort 数值越大，前台展示优先级越高

## 七、安全优化建议

1. 部署完成第一时间修改默认 admin 密码
2. Nginx/Apache 限制 admin 后台目录 IP 访问
3. 数据库不使用 root 账号，新建专用低权限账号
4. 增加登录验证码，抵御暴力破解
5. 增加 URL 特殊字符过滤，拦截恶意跳转链接
6. 服务器关闭 PHP 错误详情输出，防止路径泄露

## 八、二次开发拓展方向

- 批量导入、导出外链数据
- 外链分类标签功能
- 外链点击访问统计
- 前台链接搜索功能
- 多管理员账号与权限分级
- 后台自助修改管理员密码页面
