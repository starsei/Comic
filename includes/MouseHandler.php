<?php
class MouseHandler
{
    public static function handleMousePointer($Comic, $dir,&$html)
    {   
        $jsCode = '';
        $mouseType = $Comic->CursorEffect;
        $imageDir = $dir . '/image/cursor';    

        if($mouseType != 'none')
        {
            $html .= <<<HTML
                <script type='text/javascript'>
                    $(document).ready(function(){
                        $("body,html").css("cursor","url('{$imageDir}/{$mouseType}/normal.cur'),default" );
                        $("a").css("cursor","url('{$imageDir}/{$mouseType}/link.cur'),pointer");
                    })
                </script>
            HTML;
        }
    }
}
