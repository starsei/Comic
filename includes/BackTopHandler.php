<?php
class BackTopHandler
{
    public static function handlerBackTop($Comic,$dir,&$html,&$js)
    {
        // f返回顶部
        if (!empty($Comic->BackTopStyle)) {
            $BackTopStyles = [
                'backTop' => function () use ($dir, &$html, &$js) {
                    $html.= '<a href="javascript:void(0);" class="back-to-top" target="_self"></a>';
                    addCss("$dir/css/back-to-top.css", $html);
                    addJs("$dir/js/BackTop.min.js", $js);
                },
                'kangna' => function () use ($dir , &$html , &$js){
                    $html.= '<div class="back-to-top cd-top faa-float animated cd-is-visible" style="top: -999px;"></div>';
                    addCss("$dir/css/kangna-top.css",$html);
                    addJs("$dir/js/kangna.js",$js);
                }
            ];
            if (isset($BackTopStyles[$Comic->BackTopStyle])) {
                $BackTopStyles[$Comic->BackTopStyle]();
            }
        }
    }
}