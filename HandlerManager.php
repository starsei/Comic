<?php
class HandlerManager
{
    const STATIC_DIR = '/typecho/usr/plugins/Comic';
    public static function handle($Comic, &$js, &$html, &$css, $dir)
    {
        $handlers = [
            'BubbleHandler' => ['handleBubble', [$dir, &$js, &$html, $Comic]],
            'RightClickHandler' => ['handleRightClick', [$Comic, $dir, &$html, &$js]],
            'LanternHandler' => ['handleLantern', [$Comic, $dir, &$html]],
            'GlobalStyleHandler' => ['handleGlobalStyle', [$Comic, $dir, &$html, &$js, &$css]],
            'PartialStyleHandler' => ['handlePartialStyle', [$Comic, &$html, &$css]],
            'FontStyleHandler' => ['handleFontStyle', [$Comic, $dir, &$html, &$js]],
            'MouseFollowHandler' => ['handleMouseFollow', [$Comic, $dir, &$html, &$js, &$css]],
            'MouseHandler'=>['handleMousePointer',[$Comic,$dir,&$html]],
            'BackTopHandler'=>['handlerBackTop',[$Comic,$dir,&$html,&$js]]
        ];

        foreach ($handlers as $handlerClassName => $handlerData) {
            list($methodName, $params) = $handlerData;
            try {
                require_once "includes/{$handlerClassName}.php";
                $handler = new $handlerClassName();
                call_user_func_array([$handler, $methodName], $params);
            } catch (\Exception $e) {
                error_log("Error in {$handlerClassName}: ". $e->getMessage());
            }
        }
    }
}
function addCss($href, &$html) {
    $html.= "<link rel='stylesheet' href='$href'/>";
}
function addJs($src, &$js) {
    $js.= "<script type='text/javascript' src='$src'></script>";
}