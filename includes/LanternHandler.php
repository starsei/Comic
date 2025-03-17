<?php
class LanternHandler
{
    public static function handleLantern($Comic, $dir, &$html)
    {
        if ($Comic->Lantern) {
            $lanternLinkArr = preg_split('/[&]/', $Comic->lanternLink);
            $html.= "<link rel='stylesheet' href='{$dir}/css/lantern.min.css'/>";
            $html.= <<<HTML
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
    }
}