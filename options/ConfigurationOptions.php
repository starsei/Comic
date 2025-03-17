<?php
class ConfigurationOptions
{
    public static function addOptions(Typecho_Widget_Helper_Form $form)
    {
        // 全局美化鸭
        $CheckClick = new Typecho_Widget_Helper_Form_Element_Checkbox('CheckClick', 
            [
                'GlobalStyle'=>_t('页面全局白色+字体黑色'),
                'CountdowntoLifeJS'=>_t('<span style="color:red;">人生倒计时+图标多彩js</span>'),
                'CountdowntoLifeCSS'=>_t('<span style="color:red;">人生倒计时CSS</span>'),
                'iconfont'=>_t('icon图标集'),
                'live2D'=> _t('看板娘'),
                'commentTyping'=> _t('评论打字烟花特效'),
                'sakura'=>_t('樱花飘落'),
                'scrollbar'=>_t('滚动条美化'),
                'gray'=> _t('页面全灰')
            ],
            [
            ],
            _t('全局美化&nbsp;<span style="color:#10101070;">(多选)</span>'),
            _t('说明：人生倒计时+图标多彩JS 和 人生倒计时CSS仅修改页面代码后开启，<span style="color:red;">未使用请勿开启。</span><br/>icon图标集已加载多种，开启后可参考文档使用<span style="color:red;">点我阅读</span>'));
        $form->addInput($CheckClick->multiMode());

        // 局部美化鸭
        $PartialStyle = new Typecho_Widget_Helper_Form_Element_Checkbox('PartialStyle',
            [
                'topcenter' => _t('文章顶部内容居中'),
                'titlecenter'=>_t('首页文章标题居中'),
                'datecenter'=>_t('首页文章日期居中'),
                'focus'=>_t('文章图片获取焦点放大'),
                'articles-uspension'=>_t('首页文章悬浮'),
                'title-focus'=>_t('首页文章标题悬停'),
                'appreciate'=>_t('赞赏按钮跳动'),
                'Avatar-rotation'=>_t('头像悬浮旋转')
            ],
            [],
            _t('局部美化&nbsp;<span style="color:#10101070;">(多选)</span>'),
            _t('<span style="color:red;">说明：局部样式可全部开启，也可单独勾选。</span>'));
        $form->addInput($PartialStyle->multiMode());

        // 右键美化
        $rightClick = new Typecho_Widget_Helper_Form_Element_Radio("rightClick",['0'=>_t('关闭'),'1'=>_t('开启')],'0',_t('是否开启右键美化'));
        $form->addInput($rightClick);

        $rightClickText = new Typecho_Widget_Helper_Form_Element_Text('rightClickText',null,_t(''),_t('右键美化跳转链接'),_t('开启右键美化后请按照"主页链接&友链&留言/评论"填写<br/>示例：https://starsei.com&https://starsei.com/links.html&https://starsei.com/msg.html'));
        $form->addInput($rightClickText);

        // 新年灯笼
        $Lantern = new Typecho_Widget_Helper_Form_Element_Radio("Lantern",['0'=>_t('关闭'),'1'=>_t('开启')],'0',_t('是否开启新年灯笼'));
        $form->addInput($Lantern);

        $lanternLink = new Typecho_Widget_Helper_Form_Element_Text('lanternLink',null,_t(''),_t('灯笼左侧图片+右侧图片'),_t('开启新年灯笼后请按照"灯笼左侧图片链接&灯笼右侧图片链接"填写'));
        $form->addInput($lanternLink);

        // 气泡类型
        $BubbleOptions = [
            'none'=> _t('无'),
            'text' => _t('文字气泡'),
            'fireworks'=> _t('烟花特效'),
            'blast'=> _t('粒子气泡'),
            'othertext'=> _t('自定义文字气泡')
        ];
        $ClickEffect = new Typecho_Widget_Helper_Form_Element_Radio('ClickEffect',$BubbleOptions,'none',_t('设置点击气泡'));
        $form->addInput($ClickEffect);

        // 自定义文字气泡内容
        $TextSet = new Typecho_Widget_Helper_Form_Element_Text('TextSet',null,_t('欢迎来到我的小站!;随机'),_t('请填写文字内容'),_t('如果选择设置自定义文字气泡类型, 请按照"文字内容;颜色"填写<br/>气泡颜色可填入"随机"或十六进制颜色值 如#2db4d8,无需填写符号`#`'));
        $form->addInput($TextSet);

        // 字体样式
        $FontOptions  = [
            'none'=>_t('无'),
            'HarmonyOS'=> _t('鸿蒙HarmonyOS'),
            'jnmyt'=>_t('荆南麦圆体'),
            'cryyt'=>_t('站酷-仓耳渔阳体'),
            'jiaotang'=>_t('焦糖玛奇朵'),
            'ZhuZiAWan'=>_t('筑紫A丸'),
            'moonbridge'=>_t('造字工房悦圆')
        ];
        $FontStyle = new Typecho_Widget_Helper_Form_Element_Radio('FontStyle',$FontOptions,'none',_t('设置页面字体样式'));
        $form->addInput($FontStyle);

        // 鼠标样式
        $CursorDir = Comic_Plugin::STATIC_DIR. '/image/cursor';
        $CursorOptions = [
            'none' => _t('系统默认'),
            'vision' => "<img src='{$CursorDir}/vision/normal.cur'><img src='{$CursorDir}/vision/link.cur'>",
            'dew' => "<img src='{$CursorDir}/dew/normal.cur'><img src='{$CursorDir}/dew/link.cur'>",
            'comix' => "<img src='{$CursorDir}/comix/normal.cur'><img src='{$CursorDir}/comix/link.cur'>",
            'mayhem' => "<img src='{$CursorDir}/mayhem/normal.cur'><img src='{$CursorDir}/mayhem/link.cur'>",
            'League' => "<img src='{$CursorDir}/League/normal.cur'><img src='{$CursorDir}/League/link.cur'>",
            'eren' => "<img src='{$CursorDir}/eren/normal.cur'><img src='{$CursorDir}/eren/link.cur'>",
            'other' => "<img src='{$CursorDir}/other/normal.cur' style='width:42px;'><img src='{$CursorDir}/other/link.cur' style='width:42px;'>",
            // 'shiro' => "<img src='{$CursorDir}/shiro/normal.cur'><img src='{$CursorDir}/shiro/link.cur'>",
            // 'keqing' => "<img src='{$CursorDir}/keqing/normal.cur'><img src='{$CursorDir}/keqing/link.cur'>",
            'quby' => "<img src='{$CursorDir}/quby/normal.cur'><img src='{$CursorDir}/quby/link.cur'>",
            'hura' => "<img src='{$CursorDir}/hura/normal.cur'><img src='{$CursorDir}/hura/link.cur'>",
            'umaru' => "<img src='{$CursorDir}/umaru/normal.cur'><img src='{$CursorDir}/umaru/link.cur'>"
        ];
        $CursorEffect = new Typecho_Widget_Helper_Form_Element_Radio('CursorEffect',$CursorOptions,'none',_t('选择鼠标样式'));
        $form->addInput($CursorEffect);

        // 静态资源加速
        $Resources = new Typecho_Widget_Helper_Form_Element_Text('Resources',NULL,'https://cdn.jsdelivr.net/gh/starsei/Comic@master/static',_t('本地静态资源自定义CDN加速'),_t('静态资源默认为本地,如需加速请将本插件static目录上传到你的cdn服务器上<br/>比如CDN服务器的Comic目录里,在当前框中填入该地址,插件就会引用你搭建的cdn上面的资源,而不再引用当前服务器上的资源'));
        $form->addInput($Resources);

        // 鼠标跟随
        $MouseCursor = new Typecho_Widget_Helper_Form_Element_Radio("MouseCursor",['0'=>_t('关闭'),'1'=>_t('开启')],'0',_t('是否开启鼠标跟随效果'));
        $form->addInput($MouseCursor);

        $MouseCursorType = new Typecho_Widget_Helper_Form_Element_Select(
            'MouseCursorType',
            ['无','动彩拖尾','烟雾渐显','粒子烟雾','全屏粒子','粒子旋转','空间碎裂','中心聚合','动彩雪花屏','点散雪花屏','向上冒泡','环球粒子','粒子线条'],
            0,
            '请选择鼠标跟随效果',
            '<span style="color:red;">请开启鼠标跟随效果后选择</span>'
        );
        $form->addInput($MouseCursorType);

        // 返回顶部
        $BackTopOptions  = [
            'none'=>_t('无'),
            'backTop'=> _t('1111'),
            'kangna'=> _t('悬浮的康娜')
        ];
        $BackTopStyle = new Typecho_Widget_Helper_Form_Element_Radio('BackTopStyle',$BackTopOptions,'none',_t('选择返回顶部样式'));
        $form->addInput($BackTopStyle);
    }
}