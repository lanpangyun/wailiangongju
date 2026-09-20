# 🔗 外链发布工具网站

一个基于 **PHP + MySQL** 开发的轻量级外链管理与发布工具，采用前后台一体化设计，支持外链的新增、编辑、删除、排序及显示状态管理。

项目结构简单、部署方便，适合个人站点、资源导航页、友情链接页以及需要集中管理外链的场景。

---

## ✨ 项目简介

本项目提供一个简单实用的外链管理后台。

管理员可以通过后台统一管理网站外链，前台自动读取数据库中的有效链接并进行展示，同时支持一键复制 URL。

### 主要特点

* 📌 前台外链列表展示
* 📋 一键复制完整链接
* 📱 移动端自适应
* 🔐 独立后台登录管理
* ➕ 新增、编辑、删除外链
* 👁️ 外链显示 / 隐藏
* 🔢 自定义外链排序
* 📄 后台分页管理
* ⚠️ 删除操作二次确认
* 🚀 PHP + MySQL，部署简单

---

## 🛠️ 运行环境

* **PHP：** 5.6 ～ 8.2
* **数据库：** MySQL / MariaDB
* **Web 环境：** Apache / Nginx
* **服务器面板：** 宝塔面板等
* **字符集：** UTF-8 / utf8mb4

> 建议使用 PHP 7.4 及以上版本运行，以获得更好的兼容性和安全性。

---

## 📁 项目目录

```text
├── config.php              # 数据库连接配置
├── index.html              # 前台外链展示页面
├── admin/                  # 后台管理目录
│   ├── login.php           # 后台登录
│   ├── index.php           # 外链管理列表
│   ├── add.php             # 新增外链
│   ├── edit.php            # 编辑外链
│   ├── del.php             # 删除外链接口
│   └── logout.php          # 退出登录
└── README.md               # 项目说明文档
```

---

# 一、数据库初始化

首先创建数据库 `link_tool`，然后执行以下 SQL 完成数据表创建。

```sql
CREATE DATABASE IF NOT EXISTS link_tool DEFAULT CHARSET utf8mb4;

USE link_tool;

CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(200) NOT NULL COMMENT '外链标题',
  `url` varchar(500) NOT NULL COMMENT '外链地址',
  `sort` int(11) DEFAULT 0 COMMENT '排序值，数字越大越靠前',
  `status` tinyint(1) DEFAULT 1 COMMENT '1显示，0隐藏',
  `addtime` int(11) NOT NULL COMMENT '添加时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '管理员账号',
  `password` varchar(100) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 默认管理员账号：admin
-- 默认密码：123456
INSERT INTO `admin` (`username`, `password`)
VALUES ('admin', MD5('123456'));
```

> ⚠️ 默认账号仅用于首次登录。正式部署后请立即修改管理员密码，并建议将密码存储方式升级为 `password_hash()`。

---

# 二、配置数据库

打开项目根目录中的：

```text
config.php
```

根据服务器实际环境修改数据库连接信息，例如：

```php
<?php

$db_host = 'localhost';
$db_name = 'link_tool';
$db_user = '数据库用户名';
$db_pass = '数据库密码';
```

请根据项目实际代码中的变量名称进行修改，确保数据库名称、用户名和密码与服务器数据库配置一致。

---

# 三、完整部署教程

### 1. 创建数据库

进入服务器数据库管理工具，例如宝塔面板：

```text
数据库 → 添加数据库
```

创建：

```text
数据库名：link_tool
```

然后将上方 SQL 代码复制并执行。

---

### 2. 修改数据库配置

打开：

```text
config.php
```

填写服务器实际使用的：

* 数据库地址
* 数据库名称
* 数据库用户名
* 数据库密码

---

### 3. 上传项目源码

将项目全部源码上传到网站根目录。

上传后请保持原有目录结构，例如：

```text
网站根目录/
├── config.php
├── index.html
└── admin/
    ├── login.php
    ├── index.php
    ├── add.php
    ├── edit.php
    ├── del.php
    └── logout.php
```

不要随意修改文件名或目录结构。

---

### 4. 访问前台

部署完成后访问：

```text
https://你的域名/
```

即可打开外链展示页面。

---

### 5. 进入后台

后台登录地址：

```text
https://你的域名/admin/login.php
```

默认账号：

```text
账号：admin
密码：123456
```

首次登录成功后，建议立即修改管理员密码。

---

# 四、前台页面

前台入口：

```text
index.html
```

主要负责读取数据库中的有效外链并进行展示。

### 前台功能

1. 自动读取 `status = 1` 的外链
2. 按 `sort` 值从高到低排序
3. 展示外链标题及 URL
4. 支持一键复制完整 URL
5. 适配电脑、手机等不同屏幕尺寸
6. 提供后台管理入口

---

# 五、后台管理

后台目录：

```text
admin/
```

### `admin/login.php`

后台管理员登录页面。

用于验证管理员账号和密码，并建立后台登录状态。

### `admin/index.php`

外链管理列表。

主要功能：

* 查看现有外链
* 查看显示状态
* 查看排序
* 编辑外链
* 删除外链
* 添加新的外链

### `admin/add.php`

新增外链页面。

可以设置：

* 外链标题
* 外链地址
* 排序值
* 显示 / 隐藏状态

### `admin/edit.php`

编辑已有外链。

可以修改外链的标题、URL、排序以及显示状态。

### `admin/del.php`

删除外链接口。

删除操作建议配合前端二次确认，避免误操作。

### `admin/logout.php`

退出后台登录状态。

---

# 六、外链排序规则

项目使用 `sort` 字段控制前台展示顺序。

规则如下：

```text
sort 数值越大
↓
前台排序越靠前
```

例如：

```text
外链 A：sort = 100
外链 B：sort = 50
外链 C：sort = 10
```

前台展示顺序为：

```text
外链 A
外链 B
外链 C
```

如果多个外链使用相同排序值，则具体显示顺序以数据库查询结果及项目代码中的排序规则为准。

---

# 七、安全建议

由于项目包含后台管理功能，正式部署时建议进行以下安全加固。

### 1. 修改默认管理员密码

不要长期使用：

```text
admin / 123456
```

正式使用前应立即修改。

### 2. 使用安全的密码哈希

当前示例使用：

```php
MD5()
```

仅适合作为简单示例。

正式项目建议使用 PHP 原生：

```php
password_hash()
```

验证时使用：

```php
password_verify()
```

### 3. 限制后台访问

可以通过 Nginx、Apache 或服务器防火墙限制：

```text
/admin/
```

目录的访问来源，例如仅允许指定 IP 访问。

### 4. 使用独立数据库账号

不要直接使用 MySQL `root` 账号连接网站。

建议创建一个仅拥有当前数据库必要权限的专用数据库账号。

### 5. 防止暴力登录

后台登录建议增加：

* 登录失败次数限制
* 验证码
* IP 限速
* 登录日志
* 异常登录提醒

### 6. 过滤外链 URL

后台提交 URL 时建议进行格式验证和安全过滤，避免保存明显恶意或异常跳转地址。

同时在前台输出数据时进行 HTML 转义，防止 XSS 等安全问题。

### 7. 关闭生产环境错误详情

正式网站建议关闭 PHP 错误详情输出，避免数据库信息、服务器路径等敏感信息暴露。

---

# 八、二次开发方向

项目后续可以根据实际需求增加以下功能：

* 📥 批量导入外链
* 📤 批量导出外链
* 🏷️ 外链分类与标签
* 🔍 前台外链搜索
* 📊 外链点击统计
* 📈 访问数据统计
* 👥 多管理员账号
* 🔐 管理员权限分级
* 🔑 后台修改管理员密码
* 📝 操作日志
* 🌐 外链状态检测
* ⏱️ 外链有效期设置
* 🔗 自动检测失效链接

---

# 九、项目总结

这是一个结构简单、功能实用的 PHP 外链管理工具，适合快速搭建个人外链展示页、资源导航页或友情链接管理页面。

项目采用 **PHP + MySQL**，无需复杂依赖，上传源码、配置数据库后即可运行。

对于个人站点（如wsyj.com)而言，可以在现有基础上继续增加分类、统计、权限、批量管理以及链接检测等功能，
