<?php
/**
 * <strong style="color:#00acff;">二次元风格美化插件</strong><br/>
 * 更新时间: <code style="padding: 2px 4px; font-size: 90%; color: #c7254e; background-color: #f9f2f4; border-radius: 4px;">2024-01-29</code><br/>
 * 阅读文档：<code><a href="https://alist.starsei.com/TencentCloud/handsome/Comic" target="_blank"/>README.md</code>
 * @package Comic
 * @author starsei
 * @version 1.3.1
 * @link https://starsei.com
 */
class Comic_Plugin implements Typecho_Plugin_Interface
{   
    const STATIC_DIR = '/usr/plugins/Comic/static';
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
        $dir = self::STATIC_DIR;
        $html = <<<HTML
            <ul class="typecho-option">
                <li class="title-tip" id="tip">
                    <div>
                        <p>当前版本: v1.3.1</p>
                        <p>阅读文档：<a href="https://alist.starsei.com/TencentCloud/handsome/Comic" target="_blank">跳转</a></p>
                    </div>
                </li>
            </ul>
        HTML;
        echo $html;
        // $jquery = new Typecho_Widget_Helper_Form_Element_Radio('jquery',['0'=>_t('不加载'),'1'=>_t('加载')],'0',_t('是否加载外部jQuery v3.6.0库'),_t('插件需要加载jQuery库文件的支持，如果已加载就无需开启，jQuery源来源官网https://releases.jquery.com/'));
        // $form->addInput($jquery);
        // 美化集合样式
        $CheckClick = new Typecho_Widget_Helper_Form_Element_Checkbox('CheckClick', 
        [
            'GlobalStyle'=>_t('全局css样式'),
            'GlobalJS'=>_t('全局js'),
            'iconfont'=>_t('icon样式'),
            'live2D'=> _t('看板娘'),
            'commentTyping'=> _t('评论打字烟花特效'),
            'sakura'=>_t('樱花飘落'),
            'backTop'=>_t('返回顶部')
        ],
        [
            'GlobalStyle','GlobalJS'
        ],
        _t('美化集合样式&nbsp;<span style="color:#10101070;">(多选)</span>'),
        _t('<span style="color:red;">说明：全局css样式和全局js样式目前仅支持HandsomePro9.2.1主题使用，样式均为博主站点样式，不使用无需开启，icon样式为博主站点底部徽章，目前仅设置3种</span>'));
        $form->addInput($CheckClick->multiMode());
        // 右键美化
        $rightClick = new Typecho_Widget_Helper_Form_Element_Radio("rightClick",['0'=>_t('关闭'),'1'=>_t('开启')],'0',_t('是否开启右键美化'));
        $form->addInput($rightClick);

        //输入跳转链接
        $rightClickText = new Typecho_Widget_Helper_Form_Element_Text('rightClickText',null,_t(''),_t('右键美化跳转链接'),_t('开启右键美化后请按照"主页链接&友链&留言/评论"填写<br/>示例：https://starsei.com&https://starsei.com/links.html&https://starsei.com/msg.html'));
        $form->addInput($rightClickText);

        // // 控制台输出文字
        // $ConsoleText = new Typecho_Widget_Helper_Form_Element_Text('ConsoleText',null,_t('控制台输出文字'),_t('请填写文字'),_t('自定义控制台输出内容，如未修改默认为域名'));
        // $form->addInput($ConsoleText);

        // 新年灯笼
        $Lantern = new Typecho_Widget_Helper_Form_Element_Radio("Lantern",['0'=>_t('关闭'),'1'=>_t('开启')],'0',_t('是否开启新年灯笼'));
        $form->addInput($Lantern);

        // 新年灯笼左侧图片 + 右侧图片
        $lanternLink = new Typecho_Widget_Helper_Form_Element_Text('lanternLink',null,_t(''),_t('灯笼左侧图片+右侧图片'),_t('开启新年灯笼后请按照"灯笼左侧图片链接&灯笼右侧图片链接"填写'));
        $form->addInput($lanternLink);
        //气泡类型
        $BubbleOptions = [
            'none'=> _t('无'),
            'text' => _t('文字气泡'),
            'fireworks'=> _t('烟花特效'),
            'blast'=> _t('粒子气泡'),
            'othertext'=> _t('自定义文字气泡')
        ];
        $ClickEffect = new Typecho_Widget_Helper_Form_Element_Radio('ClickEffect',$BubbleOptions,'none',_t('设置点击气泡'));
        $form->addInput($ClickEffect);
        
        //自定义文字气泡内容
        $TextSet = new Typecho_Widget_Helper_Form_Element_Text('TextSet',null,_t('欢迎来到我的小站!;随机'),_t('请填写文字内容'),_t('如果选择设置自定义文字气泡类型, 请按照"文字内容;颜色"填写<br/>气泡颜色可填入"随机"或十六进制颜色值 如#2db4d8,无需填写符号`#`'));
        $form->addInput($TextSet);

        //字体样式
        $FontOptions  = [
            'none'=>_t('无'),
            'HarmonyOS'=> _t('鸿蒙HarmonyOS'),
            'fzlty'=>_t('<span style="font-family:fzlty;">方正兰亭圆</span>'),
            'jnmyt'=>_t('<span style="font-family:jnmyt;">荆南麦圆体</span>'),
            'zjkkt'=>_t('<span style="font-family:zjkkt;">字集康康体</span>'),
            'ydacmht'=>_t('<span style="font-family:ydacmht;">云朵爱吃棉花糖</span>'),
            'hycyj'=>_t('<span style="font-family:hycyj;">汉仪粗圆简</span>'),
            'cryyt'=>_t('<span style="font-family:cryyt;">站酷-仓耳渔阳体</span>'),
            'xiaowei'=>_t('<span style="font-family:xiaowei;">站酷-小薇LOGO体</span>'),
            'zhuokai'=>_t('<span style="font-family:zhuokai;">江西拙楷体</span>')
        ];
        $FontStyle = new Typecho_Widget_Helper_Form_Element_Radio('FontStyle',$FontOptions,'none',_t('设置页面字体样式'));
        $form->addInput($FontStyle);

        //鼠标样式
        $CursorDir = $dir . '/image/cursor';
        $CursorOptions = [
            'none' => _t('系统默认'),
            'vision' => "<img src='{$CursorDir}/vision/normal.cur'><img src='{$CursorDir}/vision/link.cur'>",
            'dew' => "<img src='{$CursorDir}/dew/normal.cur'><img src='{$CursorDir}/dew/link.cur'>",
            'comix' => "<img src='{$CursorDir}/comix/normal.cur'><img src='{$CursorDir}/comix/link.cur'>",
            'mayhem' => "<img src='{$CursorDir}/mayhem/normal.cur'><img src='{$CursorDir}/mayhem/link.cur'>",
            'League' => "<img src='{$CursorDir}/League/normal.cur'><img src='{$CursorDir}/League/link.cur'>",
            'eren' => "<img src='{$CursorDir}/eren/normal.cur'><img src='{$CursorDir}/eren/link.cur'>",
            'other' => "<img src='{$CursorDir}/other/normal.cur' style='
            width:42px;'><img src='{$CursorDir}/other/link.cur' style='width:42px;'>",
            // 'shiro' => "<img src='{$CursorDir}/shiro/normal.cur'><img src='{$CursorDir}/shiro/link.cur'>",
            'keqing' => "<img src='{$CursorDir}/keqing/normal.cur'><img src='{$CursorDir}/keqing/link.cur'>",
            'quby' => "<img src='{$CursorDir}/quby/normal.cur'><img src='{$CursorDir}/quby/link.cur'>",
            'hura' => "<img src='{$CursorDir}/hura/normal.cur'><img src='{$CursorDir}/hura/link.cur'>"
        ];
        $CursorEffect = new Typecho_Widget_Helper_Form_Element_Radio('CursorEffect',$CursorOptions,'none',_t('选择鼠标样式'));
        $form->addInput($CursorEffect);

        //静态资源加速
        $Resources = new Typecho_Widget_Helper_Form_Element_Text('Resources',null,_t(''),_t('本地静态资源自定义CDN加速'),_t('静态资源默认为本地,如需加速请将本插件static目录上传到你的cdn服务器上<br/>比如CDN服务器的Comic目录里,在当前框中填入该地址,插件就会引用你搭建的cdn上面的资源,而不再引用当前服务器上的资源'));
        $form->addInput($Resources);
        // 加载本地CSS样式 插件页面效果
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".self::STATIC_DIR."/css/plugins1.3.1.css\" />";
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
        // if($Comic->jquery)
        // {
        //     echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
        // }
        // if($Comic->Resources)
        // {
        //     echo  $Comic->Resources;
        // }

        echo $arr['html'];
        echo $arr['js'];
        // 78A3F9
        echo "<script>console.log('%c Comic v1.3.1 - 二次元风格美化插件  www.starsei.com ','color:white;background-image:linear-gradient(90deg, #95B9FF 40%, #FFBBEC 97%);padding:6px;font-size:14px;border-radius:1px;text-shadow:0px 2px 2px rgba(0,0,0,.1);font-family:黑体;');// 你能留下我的信息, 我会很高兴的 ^_^</script>";
    }

    /**
     * @param $Comic
     * @return array
     */
    private static function handleBubbleType($Comic)
    {
        $bubbleType = $Comic->ClickEffect; //气泡类型
        $dir = self::STATIC_DIR; //文件目录
        if(!empty($Comic->Resources))
        {
            $dir = $Comic->Resources;
        }
        $js = '';
        $html = '';
        // 气泡类型
        switch($bubbleType){
            # 文字气泡
            case 'text':
                $js .= "<script type='text/javascript' src='{$dir}/js/text.js'></script>";
                break;
            # 烟花效果
            case 'fireworks':
                $html .='<canvas id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;z-index:99999;"></canvas>';
                $js .=<<<JS
                <script type="text/javascript" src="{$dir}/js/anime.min.js"></script>
                <script type='text/javascript' src="{$dir}/js/fireworks.js"></script>
                JS;
                // $js .= "<script type='text/javascript' src='{$dir}/js/fireworks.js'></script>";
                break;
            # 粒子气泡
            case 'blast':
                $js .= "<script type='text/javascript' src='{$dir}/js/blast.js'></script>";
                break;
            # 自定义文字气泡
            case 'othertext':
                $TextSetArr = preg_split('/[;]/',$Comic->TextSet);
                $js .= "<script>";
                $js .= <<<JS
                    var index =0;
                    jQuery(document).ready(function() {
                        $(window).click(function(e) {
                            var string = "{$TextSetArr[0]}";
                            var strings = string.split('');
                            var span = $("<span>").text(strings[index]);
                            var speed = 3;
                            index = (index + 1) % strings.length;
                            var x = e.pageX,
                            y = e.pageY;
                            var color = "{$TextSetArr[1]}";
                            if (color == "随机") {
                                var colorValue="0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f";
                                var colorArray = colorValue.split(",");
                                color="#";
                                for(var i=0;i<6;i++){
                                    color+=colorArray[Math.floor(Math.random()*16)];
                                }
                            }
                            span.css({
                                "z-index": 99999,
                                "top": y - 20,
                                "left": x,
                                "position": "absolute",
                                "font-weight": "bold",
                                "color": color
                            });
                            $("body").append(span);
                            var styles = {
                                "top": y - 160,
                                "opacity": 0
                            };
                            span.animate(styles, speed*1000, function() {
                                span.remove();
                            });
                        });
                    });
                JS;
                $js .= "</script>";
                break;
        }
        // 右键美化
        if($Comic->rightClick)
        {
            $rightClick = (int)$Comic->rightClick;
            $rihghtClickArr = preg_split('/[&]/',$Comic->rightClickText);
            $html .="<link rel='stylesheet' href='{$dir}/css/rightclick.css'/>";
            $html .=<<<HTML
                <div class="usercm" style="left: 199px; top: 5px; display: none;">
                    <ul>
                        <li><a href="{$rihghtClickArr[0]}"><i class="fontello fontello-home"></i><span>首页</span></a></li>
                        <li><a href="javascript:void(0);" onclick="getSelect();"><i class="fontello fontello-pencil"></i><span>复制</span></a></li>
                        <li><a href="javascript:void(0);" onclick="baiduSearch();"><i class="fontello fontello-search"></i><span>搜索</span></a></li>
                        <li><a href="javascript:history.go(1);"><i class="fontello fontello-chevron-right"></i><span>前进</span></a></li>
                        <li><a href="javascript:history.go(-1);"><i class="fontello fontello-chevron-left"></i><span>后退</span></a></li>
                        <li style="border-bottom:1px solid gray"><a href="javascript:window.location.reload();"><i class="fontello fontello-refresh"></i><span>重载网页</span></a></li>
                        <li><a href="{$rihghtClickArr[1]}"><i class="fontello fontello-emo-tongue"></i><span>和我当邻居</span></a></li>  
                        <li><a href="{$rihghtClickArr[2]}"><i class="fontello fontello-edit"></i><span>给我留言吧</span></a></li>
                    </ul>
                </div>
            HTML;
            $js .=<<<JS
            <script type="text/javascript" src="{$dir}/dist/layer.js"></script>
            <script type='text/javascript' src='{$dir}/js/rightclick.js'></script>
            JS;  
        }

        // 新年灯笼
        if($Comic->Lantern)
        {   
            $lanternLinkArr = preg_split('/[&]/',$Comic->lanternLink);
            $html .= "<link rel='stylesheet' href='{$dir}/css/lantern.css'/>";
            $html .= <<<HTML
            <div class="deng-box">              
                <div class="deng">
                <div class="xian"></div>
                    <div class="deng-a">
                        <div class="deng-b">
                            <div class="deng-t">新春
                                <img src='{$dir}/image/red.png' id="envelope"/> 
                                <div class="tc_dl1">
                                    <img src="{$lanternLinkArr[0]}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shuishui-a">
                        <div class="shui-c"></div>
                        <div class="shui-b"></div>
                    </div>     
                </div>   
            </div>
            <div class="deng-box1">   
                <div class="deng">  
                    <div class="xian"></div>
                    <div class="deng-a">    
                        <div class="deng-b">
                            <div class="deng-t">快乐 
                            <img src="{$dir}/image/red.png" id="envelope"/>
                            <div class="tc_dl2 ">
                                <img src="{$lanternLinkArr[1]}"/>
                            </div>
                            </div>
                        </div>       
                    </div>
                    <div class="shuishui-a">
                        <div class="shui-c"></div>
                        <div class="shui-b"></div>
                    </div>
                </div>
            </div>
            HTML;
        }        

        // 美化集合
        // 冗余代码未来更新
        if(!empty($Comic->CheckClick))
        {   
            if(in_array('GlobalStyle',$Comic->CheckClick))
            {
                $html .="<link rel='stylesheet' href='{$dir}/css/custom.css?v=1.2.020230721'/>";
            }
            if(in_array('GlobalJS',$Comic->CheckClick))
            {
                $js .="<script type='text/javascript' src='{$dir}/js/custom.js?v=1.2.020230721'></script>";
            }
            if(in_array('iconfont',$Comic->CheckClick))
            {
                $html .="<link rel='stylesheet' href='{$dir}/css/iconfonts.css?v=1.2.020230728'/>";
            }
            if(in_array('commentTyping',$Comic->CheckClick)){
                $js .= "<script type='text/javascript' src='{$dir}/js/commentTyping.js'></script>";
            }   
            // 看板娘
            if(in_array('live2D',$Comic->CheckClick)){
                $js .="<script type='text/javascript' src='{$dir}/js/live2d/load.js'></script>";    
            }
            if(in_array('sakura',$Comic->CheckClick))
            {
                $js .= "<script type='text/javascript' src='{$dir}/js/sakura.js'></script>";
            }
            // 返回顶部
            if(in_array('backTop',$Comic->CheckClick))
            {
                $html .='<a href="javascript:void(0);" class="back-to-top" target="_self"></a>';
                $html .= "<link rel='stylesheet' type='text/css' href='{$dir}/css/back-to-top.css'/>";
                $js .="<script type='text/javascript' src='{$dir}/js/BackTop.js'></script>";
            }
        }
        // 字体样式
        if($Comic->FontStyle != 'none')
        {   
            $html .= "<link rel='stylesheet' type='text/css' href='{$dir}/css/fonts.css'/>";
            switch ($Comic->FontStyle) {
                # 鸿蒙HarmonyOS
                case 'HarmonyOS':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","HarmonyOS_Sans_SC_Medium");
                    JS;
                    $js .= "</script>";
                    break;
                # 方正兰亭圆
                case 'fzlty':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","fzlty");
                    JS;
                    $js .= "</script>";
                    break;
                # 荆南麦圆体
                case 'jnmyt':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","jnmyt");
                    JS;
                    $js .= "</script>";
                    break;
                # 字集康康体
                case 'zjkkt':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","zjkkt");
                    JS;
                    $js .= "</script>";
                    break;
                # 云朵爱吃棉花糖
                case 'ydacmht':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","ydacmht");
                    JS;
                    $js .= "</script>";
                    break;
                # 汉仪粗圆简
                case 'hycyj':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","hycyj");
                    JS;
                    $js .= "</script>";
                    break;
                # 仓耳渔阳体
                case 'cryyt':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","cryyt");
                    JS;
                    $js .= "</script>";
                    break;
                # 仓耳渔阳体
                case 'xiaowei':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","xiaowei");
                    JS;
                    $js .= "</script>";
                    break;
                # 江西拙楷体
                case 'zhuokai':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","zhuokai");
                    JS;
                    $js .= "</script>";
                    break;
            }
        }
        // 鼠标指针
        $mouseType = $Comic->CursorEffect;
        $imageDir = $dir . '/image/cursor';    
        if($mouseType != 'none')
        {
            $js .='<script>';
            $js .= <<<JS
                $("body,html").css("cursor","url('{$imageDir}/{$mouseType}/normal.cur'),default" );
                $("a").css("cursor","url('{$imageDir}/{$mouseType}/link.cur'),pointer");
            JS;
            $js .= '</script>';
        }
        return compact('js','html');
    }
}
