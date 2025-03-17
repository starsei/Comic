<?php
class MouseFollowHandler
{
    public static function handleMouseFollow($Comic, $dir, &$html, &$js)
    {
        if (!empty($Comic->MouseCursor)) {
            self::addHtml( <<<HTML
                <div class="mouse-cursor cursor-outer"></div>
                <div class="mouse-cursor cursor-inner"></div>
            HTML,$html);
            addCss($dir. '/css/mouse-follow.min.css', $html);
            addJs($dir. '/js/mouse/mouse-cursor.js', $js);
            addJs($dir. '/js/mouse/cursor-effects.js', $js);
            addJs($dir. '/js/mouse/mouse.min.js', $js);
        }

        if ($Comic->MouseCursorType) {
            self::addJs("<script type=\"text/javascript\">$.shuicheMouse({type:$Comic->MouseCursorType,color:false})</script>", $js);
        }
    }

    public static function addHtml($content, &$html)
    {
        $html.= $content;
    }

    public static function addJs($jsCode, &$js)
    {
        $js.= $jsCode;
    }
}