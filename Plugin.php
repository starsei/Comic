<?php
/**
 * <strong style="color:#00acff;">二次元风格美化插件</strong><br/>
 * 更新时间: <code style="padding: 2px 4px; font-size: 90%; color: #c7254e; background-color: #f9f2f4; border-radius: 4px;">2024-04-28</code><br/>
 * @package Comic
 * @author starsei
 * @version 2.0.1
 * @link https://starsei.com
 */
class Comic_Plugin implements Typecho_Plugin_Interface
{   
    const STATIC_DIR = '/usr/plugins/Comic/static';
    /**
     * 激活插件方法，如果激活失败，直接抛出异常
     * 
     * @access public
     * @return void
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->footer= array('Comic_Plugin','render');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     */
    public static function deactivate()
    {    
    }

    /**
     * 获取插件配置面板
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $dir = self::STATIC_DIR;
        $html = <<<HTML
            <div class="left_side">
                <span class="left_side_span">
                    <div class="left_side_style">全局样式鸭</div>
                    <button class="left_side_button" id="global_style" onclick="showContent('typecho-option-item-CheckClick-0','global_style','typecho-option-item-FontStyle-8')">
                    <svg t="1713492750972" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="63706" width="22" height="22"><path d="M511.980135 81.384362c120.417728 0 220.561042 36.86257 306.205079 112.63563 83.637075 73.97089 124.349735 160.55697 124.349736 264.796126a202.006882 202.006882 0 0 1-63.280745 150.604076 208.396394 208.396394 0 0 1-152.57008 62.666369h-96.948559a136.432466 136.432466 0 0 0-134.712213 135.654257c0 47.552715 19.660037 77.124688 36.125318 93.630927a18.513202 18.513202 0 0 1 6.840055 14.581194c0 11.304521-3.276673 16.178572-6.676221 19.57812a24.779839 24.779839 0 0 1-19.700996 6.840055c-120.827312 0-220.642959-40.958411-305.099202-125.537529-84.374326-84.53816-125.455612-184.27189-125.455612-304.976327s40.958411-220.642959 125.455612-305.058244C291.050467 122.465648 390.98899 81.384362 511.980135 81.384362M511.980135 0C370.1002 0 248.617554 50.01022 149.334366 149.252449 50.01022 248.535637 0 370.141159 0 512.021094c0 141.838977 49.805428 263.280665 149.170532 362.850561 99.406063 99.528938 220.765834 149.047657 362.809603 149.047657a104.689698 104.689698 0 0 0 107.515829-107.802537c0-27.196385-11.099729-53.245934-30.718809-72.004887-8.109765-8.068807-12.36944-19.741954-12.36944-36.534902a55.130021 55.130021 0 0 1 53.327851-53.942227h96.579933a289.330214 289.330214 0 0 0 209.625147-86.012663 282.98166 282.98166 0 0 0 87.978666-208.642144c0-127.462574-51.198014-236.657698-151.832829-325.7832S651.525441 0.081917 511.980135 0.081917V0z" p-id="63707"></path><path d="M161.949556 496.497856a81.589154 81.589154 0 0 0 163.178309 0 81.589154 81.589154 0 0 0-163.178309 0zM304.157159 260.249742a81.589154 81.589154 0 0 0 163.178308 0 81.589154 81.589154 0 0 0-163.178308 0zM569.239993 233.217191a81.589154 81.589154 0 0 0 163.219268 0 81.589154 81.589154 0 0 0-163.219268 0zM718.82011 460.536371a81.589154 81.589154 0 0 0 163.219267 0 81.589154 81.589154 0 0 0-163.178309 0z" p-id="63708"></path></svg>
                    </button>
                </span>
                <span class="left_side_span">
                    <div class="left_side_style">局部样式鸭</div>
                    <button class="left_side_button" id="local_style" onclick="showContent('typecho-option-item-PartialStyle-1','local_style')">
                        <svg t="1713500900062" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="89020" width="22" height="22"><path d="M951.9 450.2l-98.1-131.5 52.7-155.4c4.4-13 1.1-27.3-8.6-37s-24-13-37-8.6l-155.4 52.7L574 72.3c-11-8.2-25.7-9.4-37.9-3.2s-19.8 18.8-19.7 32.5l2.1 164-133.9 94.7c-11.2 7.9-16.9 21.5-14.8 35 2.1 13.5 11.8 24.7 24.9 28.7l117.8 36.6L74.6 897.8c-14.1 14-14.1 36.8 0 50.9 7 7 16.3 10.6 25.5 10.6s18.4-3.5 25.4-10.5l437.9-437.1L600 629.5c4.1 13.1 15.2 22.7 28.7 24.9 1.9 0.3 3.8 0.4 5.6 0.4 11.6 0 22.6-5.6 29.4-15.2l94.7-133.9 164 2.1c13.7 0.2 26.3-7.4 32.5-19.7 6.5-12.2 5.2-26.9-3-37.9z m-211.4-16.8c-11.8-0.1-23 5.5-29.9 15.2l-63.5 89.8-32.7-105.1c-3.5-11.3-12.4-20.2-23.7-23.7l-105-32.6 89.8-63.5c9.7-6.8 15.4-18 15.2-29.9l-1.4-110 88.2 65.8c9.5 7.1 21.9 9 33.1 5.2l104.2-35.3-35.3 104.2c-3.8 11.2-1.8 23.6 5.2 33.1l65.8 88.2-110-1.4z" p-id="89021"></path></svg>
                    </button>
                </span>
                <span class="left_side_span">
                    <div class="left_side_style">点击气泡+鼠标样式</div>
                    <button class="left_side_button" id="Fonts_Mouse_Bubble" onclick="showContent('typecho-option-item-ClickEffect-6','Fonts_Mouse_Bubble','typecho-option-item-TextSet-7','typecho-option-item-CursorEffect-9')">
                        <svg t="1713495454600" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="72927" width="24" height="24"><path d="M228.8 193.92C283.392 105.984 374.464 53.376 512 53.376s228.608 52.608 283.2 140.672C848 279.04 864 393.152 864 512c0 118.784-16 232.896-68.8 318.08-54.592 88-145.664 140.608-283.2 140.608s-228.608-52.608-283.2-140.672C176 744.96 160 630.784 160 512c0-118.784 16-232.832 68.8-317.952z m54.4 33.792C240 297.344 224 396.544 224 512c0 115.392 16 214.656 59.2 284.288 41.408 66.752 110.336 110.4 228.8 110.4 118.464 0 187.392-43.648 228.8-110.4 43.2-69.632 59.2-168.896 59.2-284.288 0-115.456-16-214.656-59.2-284.288C703.36 167.232 643.2 125.696 544 118.4v106.624c5.76 0.768 11.776 2.048 17.92 4.608 18.304 7.552 32.832 22.08 40.384 40.384 3.52 8.512 4.672 16.832 5.248 24.384 0.448 7.04 0.448 15.488 0.448 24.576v87.232c0 9.152 0 17.536-0.512 24.576a75.968 75.968 0 0 1-5.12 24.384 74.688 74.688 0 0 1-40.448 40.448 76.032 76.032 0 0 1-24.384 5.12c-7.04 0.512-15.488 0.512-24.576 0.512h-1.92c-9.088 0-17.536 0-24.576-0.448a76.032 76.032 0 0 1-24.32-5.184 74.688 74.688 0 0 1-40.448-40.448 75.968 75.968 0 0 1-5.248-24.32C416 423.744 416 415.36 416 406.208V319.104c0-9.152 0-17.6 0.512-24.64 0.512-7.552 1.664-15.872 5.12-24.32 7.68-18.368 22.144-32.896 40.448-40.448 6.144-2.56 12.16-3.84 17.92-4.608V118.464c-99.2 7.232-159.296 48.768-196.8 109.248z m203.264 61.184a10.688 10.688 0 0 0-5.568 5.568 27.264 27.264 0 0 0-0.576 4.352A353.92 353.92 0 0 0 480 320v85.312c0 10.368 0 16.64 0.32 21.184a27.264 27.264 0 0 0 0.576 4.352c1.024 2.56 3.072 4.48 5.568 5.632a27.392 27.392 0 0 0 4.352 0.512c4.608 0.32 10.816 0.32 21.184 0.32s16.576 0 21.12-0.32a27.392 27.392 0 0 0 4.48-0.512 10.688 10.688 0 0 0 5.504-5.632 27.392 27.392 0 0 0 0.576-4.352 353.92 353.92 0 0 0 0.32-21.12V320c0-10.368 0-16.576-0.32-21.12a27.392 27.392 0 0 0-0.576-4.48 10.688 10.688 0 0 0-5.568-5.504 27.264 27.264 0 0 0-4.352-0.576A353.92 353.92 0 0 0 512 288c-10.368 0-16.576 0-21.12 0.32a27.264 27.264 0 0 0-4.48 0.576z" p-id="72928"></path></svg>
                    </button>
                </span>
                <span class="left_side_span">
                    <div class="left_side_style">右键美化+新年灯笼</div>
                    <button class="left_side_button" onclick="showContent('typecho-option-item-rightClick-2','SpecialStyle','typecho-option-item-rightClickText-3','typecho-option-item-Lantern-4','typecho-option-item-lanternLink-5')" id="SpecialStyle">
                        <svg t="1713495374336" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="66194" width="22" height="22"><path d="M509.568 53.333333h4.864c98.517333 0 175.701333 0 235.946667 8.106667 61.610667 8.277333 110.250667 25.6 148.437333 63.744 38.186667 38.186667 55.466667 86.826667 63.744 148.48 8.106667 60.202667 8.106667 137.386667 8.106667 235.904v4.864c0 98.517333 0 175.701333-8.106667 235.946667-8.277333 61.610667-25.6 110.250667-63.744 148.437333-38.186667 38.186667-86.826667 55.466667-148.48 63.744-60.202667 8.106667-137.386667 8.106667-235.904 8.106667h-4.864c-98.517333 0-175.701333 0-235.946667-8.106667-61.610667-8.277333-110.250667-25.6-148.437333-63.744-38.186667-38.186667-55.466667-86.826667-63.744-148.48-8.106667-60.202667-8.106667-137.386667-8.106667-235.904v-4.864c0-98.517333 0-175.701333 8.106667-235.946667 8.277333-61.610667 25.6-110.250667 63.744-148.437333 38.186667-38.186667 86.826667-55.466667 148.48-63.744 60.202667-8.106667 137.386667-8.106667 235.904-8.106667z m-227.413333 71.509334c-54.528 7.338667-87.424 21.333333-111.701334 45.610666-24.32 24.32-38.272 57.173333-45.610666 111.744-7.424 55.466667-7.509333 128.341333-7.509334 229.802667s0.085333 174.336 7.509334 229.802667c7.338667 54.570667 21.333333 87.466667 45.610666 111.786666 24.32 24.277333 57.173333 38.229333 111.744 45.568 55.466667 7.424 128.341333 7.509333 229.802667 7.509334s174.336-0.085333 229.802667-7.509334c54.570667-7.338667 87.466667-21.333333 111.786666-45.610666 24.277333-24.32 38.229333-57.173333 45.568-111.744 7.424-55.466667 7.509333-128.341333 7.509334-229.802667s-0.085333-174.336-7.509334-229.802667c-7.338667-54.570667-21.333333-87.466667-45.610666-111.786666-24.32-24.277333-57.173333-38.229333-111.744-45.568-55.466667-7.424-128.341333-7.509333-229.802667-7.509334s-174.336 0.085333-229.802667 7.509334zM492.8 315.733333a32 32 0 0 1 44.8 6.4l102.4 136.533334 102.4-136.533334a32 32 0 1 1 51.2 38.4L679.978667 512l113.621333 151.466667a32 32 0 1 1-51.2 38.4l-102.4-136.533334-102.4 136.533334a32 32 0 1 1-51.2-38.4L599.978667 512 486.4 360.533333a32 32 0 0 1 6.4-44.8z m-268.8 25.6A32 32 0 0 1 256 309.333333h170.666667a32 32 0 0 1 0 64H288v106.666667H426.666667a32 32 0 0 1 0 64H288V682.666667a32 32 0 0 1-64 0V341.333333z" p-id="66195"></path></svg>
                    </button>
                </span>
                <span class="left_side_span">
                    <div class="left_side_style">CDN加速</div>
                    <button class="left_side_button" id="cdn" onclick="showContent('typecho-option-item-Resources-10','cdn')">
                    <svg t="1713496023385" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="86666" id="mx_n_1713496023386" width="28" height="28"><path d="M851.6 661.5l-3.1-306.7c-0.1-6-0.9-11.8-2.3-17.4l-0.1-8.7c-0.1-8.9-4.9-17.1-12.7-21.5l-7.6-4.3c-4.2-4-9-7.5-14.1-10.4L544.5 141.8c-5.2-2.9-10.6-5.2-16.3-6.7l-8.4-4.7c-7.8-4.4-17.3-4.3-25 0.3l-10 5.9c-4.4 1.6-8.7 3.5-12.9 6L208 298.5c-4.1 2.4-7.9 5.2-11.4 8.4l-11.5 6.8c-7.7 4.5-12.4 12.8-12.3 21.8l0.2 16.5c-0.4 3.2-0.6 6.4-0.6 9.6l3.1 306.7c0 3.2 0.3 6.5 0.7 9.6l0.2 17.4c0.1 8.9 4.9 17.1 12.7 21.5l15.1 8.5c2.6 1.9 5.3 3.7 8.1 5.3l267.1 150.7c2.8 1.6 5.8 3 8.7 4.2l14.4 8.1c3.8 2.2 8 3.2 12.3 3.2 4.4 0 8.8-1.2 12.7-3.5l11.5-6.8c4.4-1.6 8.8-3.5 12.9-6l264.1-156c4.1-2.4 8-5.3 11.5-8.4l9.9-5.9c7.7-4.5 12.4-12.8 12.3-21.8l-0.1-9.6c1.4-5.5 2.1-11.3 2-17.3z m-55 14.9L519.1 840.3c-3.3 0.6-6.8 0.4-10.1-0.5L232.6 684c-3.1-2.9-5.4-6.7-6.4-10.9L223 355.8c0.8-3.3 2.3-6.5 4.5-9.1l277.4-163.9c1.3-0.2 2.7-0.4 4-0.4 0.5 0 1.1 0 1.6 0.1l283.8 160.1c0.7 1 1.4 2.1 1.9 3.2l3.3 325.8c-0.7 1.7-1.8 3.3-2.9 4.8z" p-id="86667"></path><path d="M681.7 426.2c-0.1-8.9-4.9-17.1-12.7-21.5L472.4 293.8c-12-6.8-27.3-2.5-34.1 9.5s-2.5 27.3 9.5 34.1l184 103.8 2.1 211.2c0.1 13.7 11.3 24.7 25 24.7h0.3c13.8-0.1 24.9-11.4 24.7-25.2l-2.2-225.7z" p-id="86668"></path><path d="M565.9 493.6c-0.1-8.9-4.9-17.1-12.7-21.5L360.8 363.6c-4.4-3.7-10.1-5.9-16.3-5.8-13.8 0.1-24.9 11.4-24.7 25.2l2.3 225.7c0.1 8.9 4.9 17.1 12.7 21.5L531.2 741c0.1 0 0.1 0.1 0.2 0.1 3.9 2.2 8.1 3.2 12.3 3.2 8.7 0 17.2-4.6 21.8-12.7 3.1-5.5 3.9-11.7 2.7-17.4l-2.3-220.6z m-195.7-67.3L516 508.5l1.7 167.5-145.8-82.2-1.7-167.5z"p-id="86669"></path></svg>
                    </button>
                </span>
            </div>
            <!-- 关于我 -->
            <div class="about_me">
                <img src="{$dir}/image/favicon.ico"/>
                <p>Comic <span>v2.0.1</span><br/><span>本插件由<a href="https://starsei.com" target="_blank">starsei</a>开发<span/></p>
                <div class="about_me_a">
                    <a href="https://alist.starsei.com/TencentCloud/handsome/Comic" target="_blank"><svg t="1713664256526" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="10484" width="22" height="22"><path d="M343.797232 455.997905c40.893277-45.039913 78.217091-77.08526 111.961208-96.126832 33.744117-19.039525 62.4697-28.560823 86.194146-28.560823 17.051146 0.858595 42.007711-1.751984 40.490075 31.939942 0 11.881155-13.272918 62.247632-39.816707 151.098408-43.285882 145.370688-64.927799 233.004695-64.927799 262.889739 0 5.737953 1.430651 10.545676 4.299116 14.43238 2.859255 3.89796 5.931367 5.836195 9.214291 5.836195 13.100994 0 124.688678-52.821506 124.688678-52.821506-56.106477 52.821506-97.046828 86.604511-122.847662 101.346967-25.797763 14.741433-46.892186 22.111638-63.264847 22.111638-14.337208 0-25.701568-4.51095-34.087965-13.512383-8.398677-9.00348-12.592387-21.497624-12.592387-37.46913 0-51.182091 30.711915-176.282158 92.1337-375.290991 2.859255-9.414869 13.956519-41.077481-6.757215-37.468107C460.287811 404.403402 343.797232 455.997905 343.797232 455.997905zM578.606102 111.750397c16.412572 0 29.920862 5.437087 40.525893 16.289769 10.590704 10.862916 15.889638 24.768268 15.889638 41.716055 0 23.316127-8.080413 43.838494-24.233053 61.580404-16.166967 17.754191-34.306963 26.618494-54.431244 26.618494-15.892708 0-29.137995-5.561936-39.728699-16.686831-10.605031-11.123872-15.892708-25.688264-15.892708-43.702387 0-23.838038 7.672095-44.100473 23.041868-60.787304C539.137335 120.093813 557.414461 111.750397 578.606102 111.750397z" p-id="10485"></path></svg>ReadMe</a>
                    <a href="https://alist.starsei.com/TencentCloud/handsome/Comic/plugins" target="_blank"><svg t="1713664470714" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="15523" width="22" height="22"><path d="M505.7 661c3.2 4.1 9.4 4.1 12.6 0l112-141.7c4.1-5.2 0.4-12.9-6.3-12.9h-74.1V168c0-4.4-3.6-8-8-8h-60c-4.4 0-8 3.6-8 8v338.3H400c-6.7 0-10.4 7.7-6.3 12.9l112 141.8z" p-id="15524"></path><path d="M878 626h-60c-4.4 0-8 3.6-8 8v154H214V634c0-4.4-3.6-8-8-8h-60c-4.4 0-8 3.6-8 8v198c0 17.7 14.3 32 32 32h684c17.7 0 32-14.3 32-32V634c0-4.4-3.6-8-8-8z" p-id="15525"></path></svg>DownLoad</a>
                </div>
            </div>
            <!-- x -->
            <button id="close" onclick="Close()">
                <svg t="1713661721808" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="15444" width="20" height="20"><path d="M720.298667 768c-12.714667 0-23.850667-4.778667-33.408-14.293333L270.293333 337.066667c-19.072-19.114667-19.072-49.322667 0-66.816 19.114667-19.072 49.322667-19.072 66.816 0l416.597334 415.018666c19.072 19.072 19.072 49.28 0 66.773334-9.557333 11.136-22.272 15.914667-33.408 15.914666z" p-id="15445"></path><path d="M303.701333 768c-12.714667 0-23.850667-4.778667-33.408-14.293333-19.072-19.114667-19.072-49.322667 0-66.816l415.018667-416.597334c19.072-19.072 49.28-19.072 66.773333 0 19.114667 19.114667 19.114667 49.322667 0 66.816l-414.976 416.597334a45.781333 45.781333 0 0 1-33.408 14.293333z" p-id="15446"></path></svg>
            </button>
            <script type="text/javascript">
                function showContent(currentId,buttonId,showElements,showElements1,showElements2)
                {
                    var CheckClick = document.getElementById(currentId);
                    var elements = document.getElementsByTagName('ul');
                    for (var i = 0; i < elements.length; i++) {
                        if (elements[i].id && elements[i].id !== currentId) {
                            elements[i].style.display = 'none';
                        }
                    } 
                    CheckClick.style.display = "block";
                    document.getElementById("close").style.display = 'block';

                    if(showElements !== undefined)
                    {
                        document.getElementById(showElements).style.display="block";
                    }

                    if(showElements1 !== undefined)
                    {
                        document.getElementById(showElements1).style.display="block";
                    }

                    if(showElements2 !== undefined)
                    {
                        document.getElementById(showElements2).style.display="block";
                    }
                    // 获取按钮，添加样式
                    var ButtonStyle = document.getElementById(buttonId);

                    var buttons = document.getElementsByTagName('button');
                    for (var i = 0; i < buttons.length; i++) {
                        if (buttons[i].id && buttons[i].id !== buttonId) {
                            // console.log(buttons[i]);
                            buttons[i].classList.remove("active");
                        }
                    } 
                    ButtonStyle.classList.add("active");

                    // 保存设置按钮
                    document.getElementById("typecho-option-item--11").style.display="block";
                }

                function Close()
                {  
                    var elements = document.getElementsByTagName('ul');
                    console.log(elements);
                    for (var i = 0; i < elements.length; i++) {
                        if (elements[i].id && elements[i].id !== "typecho-nav-list") {
                            elements[i].style.display = 'none';
                        }
                    } 
                    document.getElementById("close").style.display = 'none';
                    document.getElementById("typecho-option-item--11").style.display = 'block';

                    var buttons = document.getElementsByTagName('button');
                    for (var i = 0; i < buttons.length; i++) {
                        buttons[i].classList.remove("active");
                    } 
                }
            </script>
        HTML;

        echo $html;
        // $jquery = new Typecho_Widget_Helper_Form_Element_Radio('jquery',['0'=>_t('不加载'),'1'=>_t('加载')],'0',_t('是否加载外部jQuery v3.6.0库'),_t('插件需要加载jQuery库文件的支持，如果已加载就无需开启，jQuery源来源官网https://releases.jquery.com/'));
        // $form->addInput($jquery);
        // 全局美化鸭
        $CheckClick = new Typecho_Widget_Helper_Form_Element_Checkbox('CheckClick', 
        [
            'GlobalStyle'=>_t('页面全局白色+字体黑色'),
            'CountdowntoLifeJS'=>_t('<span style="color:red;">人生倒计时+图标多彩js</span>'),
            'CountdowntoLifeCSS'=>_t('<span style="color:red;">人生倒计时CSS</span>'),
            'iconfont'=>_t('<span style="color:red;">icon样式</span>'),
            'live2D'=> _t('看板娘'),
            'commentTyping'=> _t('评论打字烟花特效'),
            'sakura'=>_t('樱花飘落'),
            'backTop'=>_t('返回顶部'),
            'scrollbar'=>_t('滚动条美化'),
            'gray'=> _t('页面全灰')
        ],
        [
            
        ],
        _t('全局美化鸭&nbsp;<span style="color:#10101070;">(多选)</span>'),
        _t('说明：人生倒计时+图标多彩JS 和 人生倒计时CSS仅修改页面代码后开启，<span style="color:red;">未使用请勿开启。</span><br/>icon样式为博主站点底部徽章，目前仅设置3种，<span style="color:red;">无需开启。</span>'));
        $form->addInput($CheckClick->multiMode());

        // 局部美化鸭
        $PartialStyle = new Typecho_Widget_Helper_Form_Element_Checkbox('PartialStyle',
        [
            'topcenter' => _t('文章顶部内容居中'),
            'titlecenter'=>_t('首页文章标题居中'),
            'datecenter'=>_t('首页文章日期居中'),
            'focus'=>_t('文章图片获取焦点放大'),
            'Article-suspension'=>_t('首页文章悬浮'),
            'title-focus'=>_t('首页文章标题悬停'),
            'appreciate'=>_t('赞赏按钮跳动'),
            'Avatar-rotation'=>_t('头像悬浮旋转')
        ],
        [],
        _t('局部美化鸭&nbsp;<span style="color:#10101070;">(多选)</span>'),
        _t('<span style="color:red;">说明：局部样式可全部开启，也可单独勾选。</span>'));
        $form->addInput($PartialStyle->multiMode());

        // 右键美化
        $rightClick = new Typecho_Widget_Helper_Form_Element_Radio("rightClick",['0'=>_t('关闭'),'1'=>_t('开启')],'0',_t('是否开启右键美化'));
        $form->addInput($rightClick);

        //输入跳转链接
        $rightClickText = new Typecho_Widget_Helper_Form_Element_Text('rightClickText',null,_t(''),_t('右键美化跳转链接'),_t('开启右键美化后请按照"主页链接&友链&留言/评论"填写<br/>示例：https://starsei.com&https://starsei.com/links.html&https://starsei.com/msg.html'));
        $form->addInput($rightClickText);

        // // 控制台输出文字
        // $ConsoleText = new Typecho_Widget_Helper_Form_Element_Text('ConsoleText',null,_t('控制台输出文字'),_t('请填写文字'),_t('自定义控制台输出内容，如未修改默认为域名'));
        // $form->addInput($ConsoleText);

        // 新年灯笼
        $Lantern = new Typecho_Widget_Helper_Form_Element_Radio("Lantern",['0'=>_t('关闭'),'1'=>_t('开启')],'0',_t('是否开启新年灯笼'));
        $form->addInput($Lantern);

        // 新年灯笼左侧图片 + 右侧图片
        $lanternLink = new Typecho_Widget_Helper_Form_Element_Text('lanternLink',null,_t(''),_t('灯笼左侧图片+右侧图片'),_t('开启新年灯笼后请按照"灯笼左侧图片链接&灯笼右侧图片链接"填写'));
        $form->addInput($lanternLink);
        //气泡类型
        $BubbleOptions = [
            'none'=> _t('无'),
            'text' => _t('文字气泡'),
            'fireworks'=> _t('烟花特效'),
            'blast'=> _t('粒子气泡'),
            'othertext'=> _t('自定义文字气泡')
        ];
        $ClickEffect = new Typecho_Widget_Helper_Form_Element_Radio('ClickEffect',$BubbleOptions,'none',_t('设置点击气泡'));
        $form->addInput($ClickEffect);
        
        //自定义文字气泡内容
        $TextSet = new Typecho_Widget_Helper_Form_Element_Text('TextSet',null,_t('欢迎来到我的小站!;随机'),_t('请填写文字内容'),_t('如果选择设置自定义文字气泡类型, 请按照"文字内容;颜色"填写<br/>气泡颜色可填入"随机"或十六进制颜色值 如#2db4d8,无需填写符号`#`'));
        $form->addInput($TextSet);

        //字体样式
        $FontOptions  = [
            'none'=>_t('无'),
            'HarmonyOS'=> _t('鸿蒙HarmonyOS'),
            'fzlty'=>_t('<span style="font-family:fzlty;">方正兰亭圆</span>'),
            'jnmyt'=>_t('<span style="font-family:jnmyt;">荆南麦圆体</span>'),
            'zjkkt'=>_t('<span style="font-family:zjkkt;">字集康康体</span>'),
            'ydacmht'=>_t('<span style="font-family:ydacmht;">云朵爱吃棉花糖</span>'),
            'hycyj'=>_t('<span style="font-family:hycyj;">汉仪粗圆简</span>'),
            'cryyt'=>_t('<span style="font-family:cryyt;">站酷-仓耳渔阳体</span>'),
            'xiaowei'=>_t('<span style="font-family:xiaowei;">站酷-小薇LOGO体</span>'),
            'zhuokai'=>_t('<span style="font-family:zhuokai;">江西拙楷体</span>'),
            'jiaotang'=>_t('<span style="font-family:jiaotang;">焦糖玛奇朵</span>')
        ];
        $FontStyle = new Typecho_Widget_Helper_Form_Element_Radio('FontStyle',$FontOptions,'none',_t('设置页面字体样式'));
        $form->addInput($FontStyle);

        //鼠标样式
        $CursorDir = $dir . '/image/cursor';
        $CursorOptions = [
            'none' => _t('系统默认'),
            'vision' => "<img src='{$CursorDir}/vision/normal.cur'><img src='{$CursorDir}/vision/link.cur'>",
            'dew' => "<img src='{$CursorDir}/dew/normal.cur'><img src='{$CursorDir}/dew/link.cur'>",
            'comix' => "<img src='{$CursorDir}/comix/normal.cur'><img src='{$CursorDir}/comix/link.cur'>",
            'mayhem' => "<img src='{$CursorDir}/mayhem/normal.cur'><img src='{$CursorDir}/mayhem/link.cur'>",
            'League' => "<img src='{$CursorDir}/League/normal.cur'><img src='{$CursorDir}/League/link.cur'>",
            'eren' => "<img src='{$CursorDir}/eren/normal.cur'><img src='{$CursorDir}/eren/link.cur'>",
            'other' => "<img src='{$CursorDir}/other/normal.cur' style='
            width:42px;'><img src='{$CursorDir}/other/link.cur' style='width:42px;'>",
            // 'shiro' => "<img src='{$CursorDir}/shiro/normal.cur'><img src='{$CursorDir}/shiro/link.cur'>",
            'keqing' => "<img src='{$CursorDir}/keqing/normal.cur'><img src='{$CursorDir}/keqing/link.cur'>",
            'quby' => "<img src='{$CursorDir}/quby/normal.cur'><img src='{$CursorDir}/quby/link.cur'>",
            'hura' => "<img src='{$CursorDir}/hura/normal.cur'><img src='{$CursorDir}/hura/link.cur'>"
        ];
        $CursorEffect = new Typecho_Widget_Helper_Form_Element_Radio('CursorEffect',$CursorOptions,'none',_t('选择鼠标样式'));
        $form->addInput($CursorEffect);

        //静态资源加速
        $Resources = new Typecho_Widget_Helper_Form_Element_Text('Resources',null,_t(''),_t('本地静态资源自定义CDN加速'),_t('静态资源默认为本地,如需加速请将本插件static目录上传到你的cdn服务器上<br/>比如CDN服务器的Comic目录里,在当前框中填入该地址,插件就会引用你搭建的cdn上面的资源,而不再引用当前服务器上的资源'));
        $form->addInput($Resources);
        // 加载本地CSS样式 插件页面效果
        echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".self::STATIC_DIR."/css/plugins2.0.1.css\" />";
    }

     /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 插件实现方法
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function render()
    {
        $Comic = Helper::options()->plugin('Comic');
        $arr = self::handleBubbleType($Comic);
        // if($Comic->jquery)
        // {
        //     echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
        // }
        // if($Comic->Resources)
        // {
        //     echo  $Comic->Resources;
        // }

        echo $arr['html'];
        echo $arr['js'];
        echo "<style type='text/css'/>".$arr['css']."</style>";
        // 78A3F9
        echo "<script>console.log('%c Comic v2.0.1 - 二次元风格美化插件  www.starsei.com ','color:white;background-image:linear-gradient(90deg, #95B9FF 40%, #FFBBEC 97%);padding:6px;font-size:14px;border-radius:1px;text-shadow:0px 2px 2px rgba(0,0,0,.1);font-family:黑体;');// 你能留下我的信息, 我会很高兴的 ^_^</script>";
    }

    /**
     * @param $Comic
     * @return array
     */
    private static function handleBubbleType($Comic)
    {
        $bubbleType = $Comic->ClickEffect; //气泡类型
        $dir = self::STATIC_DIR; //文件目录
        if(!empty($Comic->Resources))
        {
            $dir = $Comic->Resources;
        }
        $js = '';
        $html = '';
        // 气泡类型
        switch($bubbleType){
            # 文字气泡
            case 'text':
                $js .= "<script type='text/javascript' src='{$dir}/js/text.js'></script>";
                break;
            # 烟花效果
            case 'fireworks':
                $html .='<canvas id="fireworks" style="position:fixed;left:0;top:0;pointer-events:none;z-index:99999;"></canvas>';
                $js .=<<<JS
                <script type="text/javascript" src="{$dir}/js/anime.min.js"></script>
                <script type='text/javascript' src="{$dir}/js/fireworks.js"></script>
                JS;
                // $js .= "<script type='text/javascript' src='{$dir}/js/fireworks.js'></script>";
                break;
            # 粒子气泡
            case 'blast':
                $js .= "<script type='text/javascript' src='{$dir}/js/blast.js'></script>";
                break;
            # 自定义文字气泡
            case 'othertext':
                $TextSetArr = preg_split('/[;]/',$Comic->TextSet);
                $js .= "<script>";
                $js .= <<<JS
                    var index =0;
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
                                var colorValue="0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f";
                                var colorArray = colorValue.split(",");
                                color="#";
                                for(var i=0;i<6;i++){
                                    color+=colorArray[Math.floor(Math.random()*16)];
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
                            span.animate(styles, speed*1000, function() {
                                span.remove();
                            });
                        });
                    });
                JS;
                $js .= "</script>";
                break;
        }
        // 右键美化
        if($Comic->rightClick)
        {
            $rightClick = (int)$Comic->rightClick;
            $rihghtClickArr = preg_split('/[&]/',$Comic->rightClickText);
            $html .="<link rel='stylesheet' href='{$dir}/css/rightclick.css'/>";
            $html .=<<<HTML
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
            $js .=<<<JS
            <script type="text/javascript" src="{$dir}/dist/layer.js"></script>
            <script type='text/javascript' src='{$dir}/js/rightclick.js'></script>
            JS;  
        }

        // 新年灯笼
        if($Comic->Lantern)
        {   
            $lanternLinkArr = preg_split('/[&]/',$Comic->lanternLink);
            $html .= "<link rel='stylesheet' href='{$dir}/css/lantern.css'/>";
            $html .= <<<HTML
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

        // 全局美化鸭
        // 冗余代码未来更新
        if(!empty($Comic->CheckClick))
        {   
            if(in_array('GlobalStyle',$Comic->CheckClick))
            {
                $html .="<link rel='stylesheet' href='{$dir}/css/white.css?v=2.0.120240424'/>";
            }
            if(in_array('CountdowntoLifeJS',$Comic->CheckClick))
            {
                $js .="<script type='text/javascript' src='{$dir}/js/custom.js?v=1.2.120240424'></script>";
            }
            if(in_array('CountdowntoLifeCSS',$Comic->CheckClick))
            {
                $html .="<link rel='stylesheet' href='{$dir}/css/custom.css?v=2.0.120240424'/>";
            }
            if(in_array('iconfont',$Comic->CheckClick))
            {
                $html .="<link rel='stylesheet' href='{$dir}/css/iconfonts.css?v=1.2.120240424'/>";
            }
            if(in_array('commentTyping',$Comic->CheckClick)){
                $js .= "<script type='text/javascript' src='{$dir}/js/commentTyping.js'></script>";
            }   
            // 看板娘
            if(in_array('live2D',$Comic->CheckClick)){
                $js .="<script type='text/javascript' src='{$dir}/js/live2d/load.js'></script>";    
            }
            // 樱花飘落
            if(in_array('sakura',$Comic->CheckClick))
            {
                $js .= "<script type='text/javascript' src='{$dir}/js/sakura.js'></script>";
            }
            // 返回顶部
            if(in_array('backTop',$Comic->CheckClick))
            {
                $html .='<a href="javascript:void(0);" class="back-to-top" target="_self"></a>';
                $html .= "<link rel='stylesheet' type='text/css' href='{$dir}/css/back-to-top.css'/>";
                $js .="<script type='text/javascript' src='{$dir}/js/BackTop.js'></script>";
            }
            // 滚动条美化
            if(in_array('scrollbar',$Comic->CheckClick))
            {
                $css .=<<<CSS
                    /*滚动条效果*/
                    /*定义滚动条高宽及背景 高宽分别对应横竖滚动条的尺寸*/ 
                    ::-webkit-scrollbar {
                        width:7px;
                        height:6px;
                    }
                    /*定义滚动条轨道*/ 
                    ::-webkit-scrollbar-track {
                        background-color:white;
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
            }
            // 页面全灰
            if(in_array('gray',$Comic->CheckClick))
            {
                $html .= <<<HTML
                    <style type="text/css">
                        html{filter:grayscale(1);}
                    </style>
                HTML;
            }
        }

        // 局部美化鸭
        if(!empty($Comic->PartialStyle))
        {   
            // 文章顶部内容居中
            if(in_array('topcenter',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    header.bg-light.lter.wrapper-md{
                        text-align: center;
                    }
                CSS;
            }
            // 首页文章标题居中
            if(in_array('titlecenter',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    .post_title_wrapper{
                        justify-content: center;
                    }
                CSS;
            }
            // 首页文章日期居中
            if(in_array('datecenter',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    .text-muted.post-item-foot-icon.text-ellipsis.list-inline {
                        text-align: center;
                    }
                CSS;
            }
            // 赞赏按钮跳动
            if(in_array('appreciate',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    .btn-pay {
                        animation: star 0.5s ease-in-out infinite alternate;
                    }
                    @keyframes star{
                        from {
                            transform: scale(1);
                        }
                        to {
                            transform: scale(1.1);
                        }
                    }
                CSS;
            }
            // 头像悬浮旋转
            if(in_array('Avatar-rotation',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    img.img-full.img-circle {
                        transition: 0.5s;
                    } 
                    span.thumb-lg.w-auto-folded.avatar.m-t-sm {
                        animation: light 4s ease-in-out infinite;
                    }
                    
                    .thumb-lg {
                        width: 68px
                    }
                    
                    .img-full:hover {
                        transform: scale(1.1) rotate(360deg);
                    }
                    
                    @keyframes light {
                        0% {
                            box-shadow: 0 0 4px red
                        }
                    
                        25% {
                            box-shadow: 0 0 16px #0f0
                        }
                    
                        50% {
                            box-shadow: 0 0 4px #00f
                        }
                    
                        75% {
                            box-shadow: 0 0 16px #0f0
                        }
                    
                        100% {
                            box-shadow: 0 0 4px green
                        }
                    }
                CSS;
            }

            // 文章图片获取焦点放大
            if(in_array('focus',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    .item-thumb {
                        cursor: pointer;
                        transition: all .6s;
                    }
                    .item-thumb:hover {
                        transform: scale(1.05);
                    }
                CSS;
            }

            // 首页文章悬浮
            if(in_array('Article-suspension',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    .blog-post .panel:not(article){transition:all .3s}
                    .blog-post .panel:not(article):hover{transform:translateY(-10px)}
                CSS;
            }

            // title-focus 首页文章标题悬停
            if(in_array('title-focus',$Comic->PartialStyle))
            {
                $css .= <<<CSS
                    .index-post-title a:hover {color:#ff676c;}
                CSS;
            }
            
        }
        // 字体样式
        if($Comic->FontStyle != 'none')
        {   
            $html .= "<link rel='stylesheet' type='text/css' href='{$dir}/css/fonts.css'/>";
            switch ($Comic->FontStyle) {
                # 鸿蒙HarmonyOS
                case 'HarmonyOS':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","HarmonyOS_Sans_SC_Medium");
                    JS;
                    $js .= "</script>";
                    break;
                # 方正兰亭圆
                case 'fzlty':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","fzlty");
                    JS;
                    $js .= "</script>";
                    break;
                # 荆南麦圆体
                case 'jnmyt':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","jnmyt");
                    JS;
                    $js .= "</script>";
                    break;
                # 字集康康体
                case 'zjkkt':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","zjkkt");
                    JS;
                    $js .= "</script>";
                    break;
                # 云朵爱吃棉花糖
                case 'ydacmht':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","ydacmht");
                    JS;
                    $js .= "</script>";
                    break;
                # 汉仪粗圆简
                case 'hycyj':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","hycyj");
                    JS;
                    $js .= "</script>";
                    break;
                # 仓耳渔阳体
                case 'cryyt':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","cryyt");
                    JS;
                    $js .= "</script>";
                    break;
                # 仓耳渔阳体
                case 'xiaowei':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","xiaowei");
                    JS;
                    $js .= "</script>";
                    break;
                # 江西拙楷体
                case 'zhuokai':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","zhuokai");
                    JS;
                    $js .= "</script>";
                    break;
                # 焦糖玛奇朵
                case 'jiaotang':
                    $js .= "<script>";
                    $js .= <<<JS
                        $("body,html").css("font-family","jiaotang");
                    JS;
                    $js .= "</script>";
                    break;
            }
        }
        // 鼠标指针
        $mouseType = $Comic->CursorEffect;
        $imageDir = $dir . '/image/cursor';    
        if($mouseType != 'none')
        {
            $js .='<script>';
            $js .= <<<JS
                $("body,html").css("cursor","url('{$imageDir}/{$mouseType}/normal.cur'),default" );
                $("a").css("cursor","url('{$imageDir}/{$mouseType}/link.cur'),pointer");
            JS;
            $js .= '</script>';
        }
        return compact('js','html','css');
    }
}
