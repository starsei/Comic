<?php
class RightClickHandler
{
    public static function handleRightClick($Comic, $dir, &$html, &$js)
    {
        if ($Comic->rightClick) {
            $rightClick = (int)$Comic->rightClick;
            $rihghtClickArr = preg_split('/[&]/', $Comic->rightClickText);
            $html.= "<link rel='stylesheet' href='{$dir}/css/rightclick.css'/>";
            $html.= <<<HTML
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
            $js.= <<<JS
                <script type="text/javascript" src="{$dir}/dist/layer.js"></script>
                <script type='text/javascript' src='{$dir}/js/rightclick.js'></script>
            JS;  
        }
    }
}