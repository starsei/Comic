<?php
class FontStyleHandler
{
    public static function handleFontStyle($Comic, $dir, &$html, &$js)
    {
        if ($Comic->FontStyle!== 'none') {
            $fontsCssPath = "{$dir}/css/fonts.css";
            // 使用 addCss 函数添加 CSS 文件引用
            addCss($fontsCssPath, $html);

            $fontFamilyMap = [
                'HarmonyOS' => 'HarmonyOS_Sans_SC_Medium',
                'jnmyt' => 'jnmyt',
                'cryyt' => 'cryyt',
                'jiaotang' => 'jiaotang',
                'ZhuZiAWan' => 'ZhuZiAWan',
                'moonbridge'=> 'moonbridge'
            ];

            if (isset($fontFamilyMap[$Comic->FontStyle])) {
                $fontFamily = $fontFamilyMap[$Comic->FontStyle];
                // 使用 addJs 函数添加 JavaScript 代码
                self::addJs("<script>$(document).ready(function() { $('body,html').css('font-family', '$fontFamily'); });</script>", $js);
            }
        }
    }

    public static function addJs($jsCode, &$js)
    {
        $js.= $jsCode;
    }
}