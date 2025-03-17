<?php

class DatabaseInfo
{
    public static function getInfo()
    {
        $db = Typecho_Db::get();

        // 查询 MySQL 版本
        $query = $db->query('SELECT VERSION() AS version');
        $result = $db->fetchRow($query);
        $mysqlVersion = $result['version'];
        preg_match('/[0-9]+\.[0-9]+\.[0-9]+/', $mysqlVersion, $matches);
        $mysqlVersionInfo = isset($matches[0])? $matches[0] : '未知';

        // 查询文章总数
        $articleCountQuery = $db->query('SELECT COUNT(*) AS articleCount FROM '. $db->getPrefix().'contents WHERE type=\'post\'');
        $articleCountResult = $db->fetchRow($articleCountQuery);
        $articleCount = $articleCountResult['articleCount'];

        // 查询留言总数（假设留言表名为 comments）
        $commentCountQuery = $db->query('SELECT COUNT(*) AS commentCount FROM '. $db->getPrefix().'comments');
        $commentCountResult = $db->fetchRow($commentCountQuery);
        $commentCount = $commentCountResult['commentCount'];
        
        // 查询草稿数量
        $draftQuery = $db->query('SELECT COUNT(*) AS draftCount FROM '. $db->getPrefix().'contents WHERE type=\'post\' AND status=\'draft\'');
        $draftResult = $db->fetchRow($draftQuery);
        $draftCount = $draftResult['draftCount'];

        // 查询已发布文章数量
        $publishedCountQuery = $db->query('SELECT COUNT(*) AS publishedCount FROM '. $db->getPrefix().'contents WHERE type=\'post\' AND status=\'publish\'');
        $publishedCountResult = $db->fetchRow($publishedCountQuery);
        $publishedCount = $publishedCountResult['publishedCount'];

        // 查询已发布评论数量
        $publishedCommentQuery = $db->query('SELECT COUNT(*) AS publishedCommentCount FROM '. $db->getPrefix().'comments WHERE status=\'approved\'');
        $publishedCommentResult = $db->fetchRow($publishedCommentQuery);
        $publishedCommentCount = $publishedCommentResult['publishedCommentCount'];

        // 查询待审核评论数量
        $pendingCommentQuery = $db->query('SELECT COUNT(*) AS pendingCommentCount FROM '. $db->getPrefix().'comments WHERE status=\'waiting\'');
        $pendingCommentResult = $db->fetchRow($pendingCommentQuery);
        $pendingCommentCount = $pendingCommentResult['pendingCommentCount'];

        // 查询友情链接数量
        $linkCountQuery = $db->query('SELECT COUNT(*) AS linkCount FROM '. $db->getPrefix().'links');
        $linkCountResult = $db->fetchRow($linkCountQuery);
        $linkCount = $linkCountResult['linkCount'];

        return [
            'mysqlVersion' => $mysqlVersionInfo,
            'articleCount' => $articleCount,
            'publishedCommentCount' => $publishedCommentCount,
            'pendingCommentCount'=> $pendingCommentCount,
            'commentCount' => $commentCount,
            'draftCount'=> $draftCount,
            'publishedCount'=> $publishedCount,
            'typechoVersion'=>\Typecho\Common::VERSION,
            'linkCount' => $linkCount
        ];
    }
}