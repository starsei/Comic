<?php
class PartialStyleHandler
{
    public static function handlePartialStyle($Comic, &$html, &$css)
    {
        if (!empty($Comic->PartialStyle)) {
            $partialStyles = [
                'topcenter' => function () use (&$css) {
                    $css.= <<<CSS
                        header.bg-light.lter.wrapper-md{
                            text-align: center;
                        }
                    CSS;
                },
                'titlecenter' => function () use (&$css) {
                    $css.= <<<CSS
                       .post_title_wrapper{
                            justify-content: center;
                        }
                    CSS;
                },
                'datecenter' => function () use (&$css) {
                    $css.= <<<CSS
                       .text-muted.post-item-foot-icon.text-ellipsis.list-inline {
                            text-align: center;
                        }
                    CSS;
                },
                'appreciate' => function () use (&$css) {
                    $css.= <<<CSS
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
                },
                'Avatar-rotation' => function () use (&$css) {
                    $css.= <<<CSS
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
                },
                'focus' => function () use (&$css) {
                    $css.= <<<CSS
                       .item-thumb {
                            cursor: pointer;
                            transition: all.6s;
                        }
                       .item-thumb:hover {
                            transform: scale(1.05);
                        }
                    CSS;
                },
                'articles-uspension' => function () use (&$css) {
                    $css.= <<<CSS
                        .blog-post .panel:not(article){transition:all .3s}
                        .blog-post .panel:not(article):hover{transform:translateY(-10px)}
                    CSS;
                },
                'title-focus' => function () use (&$css) {
                    $css.= <<<CSS
                       .index-post-title a:hover {color:#ff676c;}
                    CSS;
                }
            ];

            foreach ($Comic->PartialStyle as $style) {
                if (isset($partialStyles[$style])) {
                    $partialStyles[$style]();
                }
            }
        }
    }
}
