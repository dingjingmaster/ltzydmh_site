-- ltzydmh
ALTER DATABASE ltzydmh CHARACTER SET utf8;
USE ltzydmh;

-- 访问情况
CREATE TABLE IF NOT EXISTS `ltzydmh_summary` (
    `djid` VARCHAR(128) NOT NULL COMMENT '主键',
    `page_num` LONGINT NOT NULL COMMIT '文章数量',
    `category_num` LONGINT NOT NULL COMMIT '分类数量',
    `comment_num` LONGINT NOT NULL COMMIT '评论数量',
    `visitor_num` LONGINT NOT NULL COMMIT '访问数量',
    PRIMARY KEY (`djid`)
);

-- 文章信息
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_info` (
    `djid` VARCHAR(128) NOT NULL COMMENT '主键',
    `name` TEXT NOT NULL COMMENT '标题',
    `summary` TEXT NOT NULL COMMIT '摘要',
    `create` DATE NOT NULL COMMIT '创建时间',
    `update` DATE NOT NULL COMMIT '更新时间',
    `status` INT NOT NULL COMMENT '状态: 1-原创 2-转载 3-翻译',
    `category` TEXT NOT NULL COMMENT '分类',
    `view` BIGINT DEFAULT 0 NOT NULL COMMENT '阅读量',
    PRIMARY KEY (`djid`)
);

-- 文章内容
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_content` (
    `djid` VARCHAR(128) NOT NULL COMMENT '主键',
    `content` LONGTEXT NOT NULL COMMIT '内容',
    PRIMARY KEY (`djid`)
);

-- 友情链接
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_link` (
    `id` VARCHAR(128) NOT NULL COMMENT '主键',
    `link` LONGTEXT NOT NULL COMMIT '链接',
    PRIMARY KEY (`id`)
);

-- 评论表格
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_comment` (
    `id` VARCHAR(128) NOT NULL COMMENT '主键',
    `page_id` VARCHAR NOT NULL COMMENT '文章djid',
    `comment` VARCHAR NOT NULL COMMENT '评论'，
    `answer` VARCHAR COMMENT '回答',
    PRIMARY KEY (`id`)
);

-- 用于后台的天访问情况统计
CREATE TABLE IF NOT EXISTS `ltzydmh_passage_comment` (
    `id` VARCHAR(128) NOT NULL COMMENT '主键',
    `page_id` VARCHAR NOT NULL COMMENT '文章djid',
    `comment` VARCHAR NOT NULL COMMENT '评论'，
    `answer` VARCHAR COMMENT '回答',
    PRIMARY KEY (`id`)
);

alter table ltzydmh_summary default character set utf8;
alter table ltzydmh_passage_info default character set utf8;
alter table ltzydmh_passage_content default character set utf8;
alter table ltzydmh_passage_comment default character set utf8;