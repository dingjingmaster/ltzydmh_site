-- ltzydmh
ALTER DATABASE ltzydmh CHARACTER SET utf8;
USE ltzydmh;



-- 访问情况
CREATE TABLE IF NOT EXISTS `ltzydmh_summary` (
	`id` VARCHAR(128)	NOT NULL,
    `passage_num` INT NOT NULL,                 -- 文章数量
    `category_num` INT NOT NULL,                -- 分类数量
    `comment_num` INT NOT NULL,                 -- 评论数量
    `visitor_num` INT NOT NULL,                 -- 访问数量
	PRIMARY KEY (`id`)
);

INSERT INTO `ltzydmh_summary`(id, passage_num, category_num, comment_num, visitor_num)VALUES('id', 0, 0, 0, 0);

-- 文章分类
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_category` (
	`category`	VARCHAR(128) NOT NULL,			-- 文章分类
	`num` INT NOT NULL,							-- 此分类文章数
	PRIMARY KEY (`category`)
);

-- 文章信息
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_info` (
    `djid` VARCHAR(128) NOT NULL,               -- 主键
    `name` TEXT NOT NULL,                       -- 标题
    `summary` TEXT NOT NULL,                    -- 摘要
    `create_time` VARCHAR(128) NOT NULL,        -- 创建时间
    `update_time` VARCHAR(128) NOT NULL,        -- 更新时间
    `status` VARCHAR(128) NOT NULL,             -- 状态: 原创 转载 翻译
    `category` TEXT NOT NULL,                   -- 分类
    `view` BIGINT DEFAULT 0 NOT NULL,           -- 阅读量
    PRIMARY KEY (`djid`)
);

-- 友情链接
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_link` (
    `id` VARCHAR(128) NOT NULL,                 -- 主键
    `link` TEXT NOT NULL,                       -- 链接
    PRIMARY KEY (`id`)
);

-- 文章内容
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_content` (
    `djid` VARCHAR(128) NOT NULL,               -- 主键
	`keyword` VARCHAR(128) NOT NULL,			-- 关键字
    `content` TEXT NOT NULL,                    -- 内容
    PRIMARY KEY (`djid`)
);

-- 评论表格
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_comment` (
    `id` VARCHAR(128) NOT NULL,                 -- 主键
    `passage_id` VARCHAR(128) NOT NULL,         -- 文章djid
    `question` TEXT NOT NULL,                   -- 评论
    `answer` TEXT,                              -- 回答
    PRIMARY KEY (`id`)
);


-- 用于后台的天访问情况统计
alter table ltzydmh_summary default character set utf8;
alter table ltzydmh_passage_info default character set utf8;
alter table ltzydmh_passage_link default character set utf8;
alter table ltzydmh_passage_content default character set utf8;
alter table ltzydmh_passage_comment default character set utf8;