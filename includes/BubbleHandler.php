<?php
class BubbleHandler
{
    public static function handleBubble($dir, &$js, &$html,$Comic)
    {
        $bubbleActions = [
            // 文字气泡
            'text' => function() use ($dir, &$js) {
                addJs("$dir/js/text.js", $js);
            },
            // 烟花特效
            'fireworks' => function () use ($dir, &$html, &$js) {
               $html.= '<canvas id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;z-index:99999;"></canvas>';
               addJs("$dir/js/anime.min.js", $js);
               addJs("$dir/js/fireworks.min.js", $js);
           },
            // 粒子效果    
           'blast' => function () use ($dir, &$js) {
               addJs("$dir/js/blast.min.js", $js);
           },
            // 自定义文字气泡   
           'othertext' => function () use ($Comic, &$js) {
               $TextSetArr = preg_split('/[;]/', $Comic->TextSet);
               $js.= "<script>";
               $js.= <<<JS
                   var index = 0;
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
                               var colorValue = "0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f";
                               var colorArray = colorValue.split(",");
                               color = "#";
                               for (var i = 0; i < 6; i++) {
                                   color += colorArray[Math.floor(Math.random() * 16)];
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
                           span.animate(styles, speed * 1000, function() {
                               span.remove();
                           });
                       });
                   });
               JS;
               $js.= "</script>";
           }
        ];

        if (isset($bubbleActions[$Comic->ClickEffect])) {
            $bubbleActions[$Comic->ClickEffect]();
        }
    }
}