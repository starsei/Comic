<?php
require_once 'Autoloader.php';
/**
 * <strong style="color:#00acff;">二次元风格美化插件</strong><br/>
 * 更新时间: <code style="padding: 2px 4px; font-size: 90%; color: #c7254e; background-color: #f9f2f4; border-radius: 4px;">2025-03-17</code><br/>
 * @package Comic
 * @author starsei
 * @version 3.0.0
 * @link https://starsei.com
 * 
 * 
 * 这个插件用于为 Typecho 博客提供二次元风格的美化效果，包括全局样式、局部样式、右键美化、新年灯笼等功能。
 */
class Comic_Plugin implements Typecho_Plugin_Interface
{   
    const STATIC_DIR = '/typecho/usr/plugins/Comic/static';
    /**
     * 激活插件方法，如果激活失败，直接抛出异常
     * 
     * @access public
     * @return void
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->footer= array('Comic_Plugin','render');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     */
    public static function deactivate()
    {    
    }

    /**
     * 获取插件配置面板
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        // $dir = self::STATIC_DIR;

        // 在插件配置页面检查更新并显示提示
        $updateMessage = UpdateChecker::checkForUpdates();

        // 加载模版文件并读取
        $htmlFilePath = __DIR__. '/template/plugin_template.php';
        $htmlContent = file_get_contents($htmlFilePath);

        // 读取数据文件
        $info = DatabaseInfo::getInfo();

        $htmlContent = str_replace('{{ updateMessage }}',$updateMessage['message'], $htmlContent);
        $htmlContent = str_replace('{{ phpversion }}',phpversion(), $htmlContent);
        $htmlContent = str_replace('{{ mysqlversion }}',$info['mysqlVersion'], $htmlContent);
        $htmlContent = str_replace('{{ articleCount }}',$info['articleCount'], $htmlContent);
        $htmlContent = str_replace('{{ commentCount }}',$info['commentCount'], $htmlContent);
        $htmlContent = str_replace('{{ typechoVersion }}',$info['typechoVersion'], $htmlContent);
        $htmlContent = str_replace('{{ version }}',$updateMessage['version'], $htmlContent);
        $htmlContent = str_replace('{{ draftCount }}',$info['draftCount'], $htmlContent);
        $htmlContent = str_replace('{{ publishedCount }}',$info['publishedCount'], $htmlContent);
        $htmlContent = str_replace('{{ publishedCommentCount }}',$info['publishedCommentCount'], $htmlContent);
        $htmlContent = str_replace('{{ pendingCommentCount }}',$info['pendingCommentCount'], $htmlContent);
        $htmlContent = str_replace('{{ linkCount }}',$info['linkCount'], $htmlContent);

        ConfigurationOptions::addOptions($form);

        // self::addConfigurationOptions($form);
        $inputCount = 0;
        foreach ($form->getInputs() as $input) {
            $inputCount++;
        }
        $htmlContent = str_replace('{{ inputCount }}',$inputCount, $htmlContent);

        echo $htmlContent;
    }

     /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 插件实现方法
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function render()
    {
        $Comic = Helper::options()->plugin('Comic');
        $arr = self::handleBubbleType($Comic);
        
        echo $arr['html'];
        echo $arr['js'];
        echo "<style type='text/css'/>".$arr['css']."</style>";
        // 78A3F9
        echo "<script>console.log('%c Comic v3.0.0- 二次元风格美化插件  www.starsei.com ','color:white;background-image:linear-gradient(90deg, #95B9FF 40%, #FFBBEC 97%);padding:6px;font-size:14px;border-radius:1px;text-shadow:0px 2px 2px rgba(0,0,0,.1);font-family:黑体;');// 你能留下我的信息, 我会很高兴的 ^_^</script>";
    }
    /**
     * @param $Comic
     * @return array
     */
    private static function handleBubbleType($Comic)
    {
        $dir = self::STATIC_DIR; //文件目录
        if(!empty($Comic->Resources))
        {
            $dir = $Comic->Resources;
        }
        $js = '';
        $html = '';
        $css = '';
        HandlerManager::handle($Comic, $js, $html, $css, $dir);
        return compact('js','html','css');
    }
}