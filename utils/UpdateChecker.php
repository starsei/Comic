<?php

class UpdateChecker
{
    public static function checkForUpdates()
    {   
        // if(!is_admin()) {
        //     return '';
        // }
        // 假设已经加载了配置管理类 ConfigManager

        $configManager = ConfigManager::getInstance();
        $currentVersion = $configManager->getConfigValue('currentVersion');
        $githubRepoOwner = $configManager->getConfigValue('githubRepoOwner');
        $githubRepoName = $configManager->getConfigValue('githubRepoName');

        // 缓存文件名和缓存时间
        $cacheFile = __TYPECHO_ROOT_DIR__ . '/usr/plugins/Comic/cache/update_cache.txt';
        // echo __DIR__;
        $cacheDuration = 86400;
        
        // 尝试从缓存中读取数据
        if (file_exists($cacheFile)) {
            $cachedData = json_decode(file_get_contents($cacheFile), true);
            if ($cachedData && isset($cachedData['timestamp']) && time() - $cachedData['timestamp'] < $cacheDuration) {
                $latestVersion = $cachedData['latestVersion'];
            } else {
                $latestVersion = null;
            }
        } else {
            $latestVersion = null;
        }

        if ($latestVersion === null) {
            $githubApiUrl = "https://api.github.com/repos/{$githubRepoOwner}/{$githubRepoName}/releases/latest";
            $context = stream_context_create(array(
                'http' => array(
                    'method' => 'GET',
                    'header' => "User-Agent: PHP Script\r\nAccept: application/vnd.github+json"
                )
            ));

            $response = file_get_contents($githubApiUrl, false, $context);

            if ($response === false) {
                // 请求失败，缓存失败状态
                file_put_contents($cacheFile, json_encode(['timestamp' => time(), 'latestVersion' => null]));
                return '';
            } else {
                $releaseData = json_decode($response, true);
                if ($releaseData && isset($releaseData['tag_name'])) {
                    $latestVersion = str_replace('v', '', $releaseData['tag_name']);
                    // 写入缓存
                    file_put_contents($cacheFile, json_encode(['timestamp' => time(), 'latestVersion' => $latestVersion]));
                } else {
                    // 解析失败，缓存失败状态
                    file_put_contents($cacheFile, json_encode(['timestamp' => time(), 'latestVersion' => null]));
                    return '';
                }
            }
        }

        if ($latestVersion && version_compare($currentVersion, $latestVersion, '<')) {
            // 如果有新版本可用，返回更新提示
            $SuccessMessage = [
                'version' => $currentVersion,
                'message' => '您有新的插件版本可用！请点击下方Alist按钮下载更新'
            ];
            return $SuccessMessage;

        } else {
            $SuccessMessage = [
                'version' => $currentVersion,
                'message' => '当前插件已经是最新版'
            ];
            return $SuccessMessage;
        }
        return '';
    }
}