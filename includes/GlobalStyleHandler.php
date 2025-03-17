<?php    
class GlobalStyleHandler
{   
    // const COMIC_ICON = "//at.alicdn.com/t/c/font_4186999_ipqkbdakvbt.cs";

    public static function handleGlobalStyle($Comic, $dir, &$html, &$js, &$css)
    {
        // 全局美化鸭
        if (!empty($Comic->CheckClick)) {
            $globalStyles = [
                'GlobalStyle' => function () use ($dir, &$html) {
                    addCss("$dir/css/white.css?v=2.0.120240424", $html);
                },
                'CountdowntoLifeJS' => function () use ($dir, &$js) {
                    addJs("$dir/js/custom.js?v=1.2.120240424", $js);
                },
                'CountdowntoLifeCSS' => function () use ($dir, &$html) {
                    addCss("$dir/css/custom.css?v=2.0.120240424", $html);
                },
                'iconfont' => function () use ($dir,&$html) {
                    addCss("//at.alicdn.com/t/c/font_4186999_ipqkbdakvbt.css",$html);
                },
                'commentTyping' => function () use ($dir, &$js) {
                    addJs("$dir/js/commentTyping.min.js", $js);
                },
                'live2D' => function () use ($dir, &$js) {
                    addJs("$dir/js/live2d/load.js", $js);
                },
                'sakura' => function () use ($dir, &$js) {
                    addJs("$dir/js/sakura.js", $js);
                },
                'scrollbar' => function () use (&$css) {
                    $css.= <<<CSS
                        /*滚动条效果*/
                        /*定义滚动条高宽及背景 高宽分别对应横竖滚动条的尺寸*/ 
                        ::-webkit-scrollbar {
                            width: 7px;
                            height: 6px;
                        }
                        /*定义滚动条轨道*/ 
                        ::-webkit-scrollbar-track {
                            background-color: white;
                            -webkit-border-radius: 0em;
                            -moz-border-radius: 0em;
                            border-radius: 0em;
                        }
                        /*定义滑块 内阴影+圆角*/ 
                        ::-webkit-scrollbar-thumb {
                            background-color: #ff676c;
                            background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.4) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.4) 50%,rgba(255,255,255,.4) 75%,transparent 75%,transparent);
                            -webkit-border-radius: 2em;
                            -moz-border-radius: 2em;
                            border-radius: 2em;
                            cursor: pointer;
                        }
                    CSS;
                },
                'gray' => function () use (&$html) {
                    $html.= <<<HTML
                        <style type="text/css">
                            html{filter:grayscale(1);}
                        </style>
                    HTML;
                }
            ];

            foreach ($Comic->CheckClick as $style) {
                if (isset($globalStyles[$style])) {
                    $globalStyles[$style]();
                }
            }
        }
    }
}