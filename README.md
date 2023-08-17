## `Comic`一款Typecho二次元风格插件 
![](https://img.shields.io/badge/types-Markdown-informational?logo=markdown&link=https://markdown.com.cn/)
![](https://img.shields.io/badge/Theme%20By-Handsome-blueviolet)
### 说明
> 本插件部分功能仅支持`Handsome 9.0.2Pro`使用
### 版本更新
* v1.0.0
    - 新增引入jQuery v3.6.0库文件
    - 新增看板娘Live2D`（PioModify）`
    - 新增鼠标点击气泡
    - 新增樱花飘落特效
    - 新增页面字体样式
    - 新增鼠标样式
    - 新增鱼儿跳动效果
* v1.1.0
    - 移除鱼儿跳动效果（仅全局透明样式使用）
* v1.2.0
    - 新增评论打字烟花特效
    - 新增鼠标右键美化
    - 移除jQuery v3.6.0库文件
    - 新增美化特效集合（合并单独特效选项）
    - 新增页面字体样式（字集康康体、云朵爱吃棉花糖、汉仪粗圆简、站酷-仓耳渔阳体、站酷-小薇LOGO体、江西拙楷体）
    - 新增本地静态资源自定义cdn加速
    - 新增右侧返回顶部
    - 修复`fireworks`鼠标点击效果

### 文件目录说明
```
|   README.md（自述文件）
|   Plugin.php（插件运行文件）
└───data(未开发)
└───page（未开发）
└───static（静态资源）
|   └───css（样式表）
|   |   custom.css（自定义全局CSS样式）
|   |   plugins.css（插件样式）
|   |   rightclick.css(右键美化样式)
|   |   fonts.css（字体样式）
|   |   iconfont.css(iconfont样式)
|   └───dist(layei弹窗样式)
|   └───fonts(字体文件)
|   |   -fzlty.woff2(方正兰亭圆)
|   |   -fzlty_z.woff2(方正兰亭圆_中)
|   |   -HarmonyOS_Sans_SC_Medium.subset.woff2（鸿蒙HarmonyOS）
|   |   -jnmyt.woff2(荆南麦圆体)
|   |   -kangkang.woff/woff2(字集康康体)
|   |   -ydacmht.woff2(云朵爱吃棉花糖)
|   |   -hycyj.woff2(汉仪粗圆简)
|   |   -cryyt.woff/woff2(站酷-仓耳渔阳体)
|   |   -zhuokai.woff/woff2(江西拙楷体)
|   |   └───iconfont
|   |
|   └───image
|   └───js
|   |   └───live2d（看板娘）
|   |   blast.js（粒子气泡）
|   |   commentTyping.js（评论打字烟花特效）
|   |   fireworks.js & anime.min.js（烟花效果）
|   |   fireworks(已作废).js
|   |   rightclick.js(右键美化)
|   |   sakura.js（樱花飘落）
|   |   text.js(文字气泡)
|   |   custom.js(自定义全局JS)
|   |   BackTop.js(返回顶部)
|   └───
```

### 食用方法
- 下载插件，解压到`usr/plugins/`目录中
- 修改文件夹名改为`Comic`
- 进入后台设置激活插件

### 静态资源加速
- 静态资源默认为本地`/static`目录下<br/>
  如需加速请将本插件`static`目录上传到你的cdn服务器上，比如CDN服务器的Comic目录里,在当前框中填入该地址,插件就会引用你搭建的cdn上面的资源,而不再引用当前服务器上的资源

### 联系作者
- Email：`mrwen0827@163.com`
- 欢迎访问[https://starsei.com](https://starsei.com)一起学习讨论

## Star History

[![Star History Chart](https://api.star-history.com/svg?repos=starsei/Comic&type=Timeline)](https://star-history.com/#starsei/Comic&Timeline)


