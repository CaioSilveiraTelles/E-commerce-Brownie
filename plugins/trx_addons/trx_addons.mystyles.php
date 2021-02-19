<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('chocorocco_trx_addons_get_mycss')) {
    add_filter('chocorocco_filter_get_css', 'chocorocco_trx_addons_get_mycss', 10, 4);
    function chocorocco_trx_addons_get_mycss($css, $colors, $fonts, $scheme = '')
    {
        if (isset($css['fonts']) && $fonts) {
            $css['fonts'] .= <<<CSS
            .breadcrumbs,
            .sc_icons .sc_icons_item_title,
            .sc_price_decimals,
            .logo_slogan,
            .sc_services_default .sc_services_item.with_icon .sc_services_item_button .sc_button,
            .mejs-container .mejs-controls .mejs-time *,
.sc_layouts_row_type_compact .sc_layouts_item_details_line1,
.sc_layouts_item_details_line1  {
	{$fonts['p_font-family']}
}
.comments_list_wrap .comment_reply a,
div.esg-pagination .esg-pagination-button, .page_links > span:not(.page_links_title), .page_links > a, .comments_pagination .page-numbers, .nav-links .page-numbers,
.trx_addons_accent_phone,
.sc_layouts_row_type_compact .sc_layouts_login .sc_layouts_item_details_line1 {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.comment_date,
.post_meta_item.post_categories a,
.post_meta_item.post_date a {
    {$fonts['menu_font-family']}
}
.sc_skills_pie.sc_skills_compact_off .sc_skills_item_title,
.sc_testimonials [class*="column"] .sc_testimonials_item_content,
.sc_services_default .sc_services_item_title,
.sc_team_short .sc_team_item_title {
    {$fonts['h5_font-family']}
}
CSS;


        }

        if (isset($css['colors']) && $colors) {
            $css['colors'] .= <<<CSS
    .trx_addons_accent_hovered {
        color: {$colors['text_hover']};
    }
    .trx_addons_accent_bg {
        color: {$colors['alter_link']};
    }
    h5, h5 a, h6, h6 a{
         color: {$colors['text']};
    }
    .trx_addons_accent_hovered ,
     .trx_addons_accent,
     .trx_addons_accent>a,
     .trx_addons_accent>* {
          color: {$colors['text_link']};
     }
     .trx_addons_accent_bg{
         color: {$colors['text']};
            background-color: {$colors['text_light']};
     }
     strong,em,
     .trx_addons_tooltip{
          color: {$colors['text']};
          border-color: {$colors['text']};
     }
      .trx_addons_tooltip:after{
         border-top-color: {$colors['text_hover']};
      }
       .trx_addons_tooltip:before{
          background-color: {$colors['text_hover']};
     }
     blockquote.trx_addons_blockquote_style_1 a:hover,
      blockquote a:hover{
        color: {$colors['text']};
      }
      blockquote.trx_addons_blockquote_style_1 cite,
      blockquote.trx_addons_blockquote_style_1 a,
      blockquote p a,
     blockquote p{
        color: {$colors['alter_dark']};
     }
     .trx_addons_dropcap_style_2,
      blockquote {
        background-color: {$colors['bg_color_0']};
      }
      .trx_addons_dropcap_style_1 {
        color: {$colors['alter_dark']};
        background-color: {$colors['text_light']};
      }
      figure figcaption,
      .wp-caption .wp-caption-text,
      .wp-caption .wp-caption-dd,
      .wp-caption-overlay .wp-caption .wp-caption-text,
       .wp-caption-overlay .wp-caption .wp-caption-dd {
            color: {$colors['inverse_text']};
            background-color: {$colors['inverse_dark_05']};
       }
       ul[class*="trx_addons_list_custom"] > li:before{
             background-color: {$colors['text']};
       }
       ol>li::before{
             color: {$colors['alter_dark']};
       }
        table>tbody>tr:nth-child(2n)>td,
        table>tbody>tr:nth-child(2n+1)>td{
             background-color: {$colors['bd_color']};
             color: {$colors['text']};
        }
        table th {
             background-color: {$colors['text_light']};
             color: {$colors['alter_dark']};
         }
          table th,
          table th + th,
          table td + th,
          table td,
          table th + td,
          table td + td{
            border-color: {$colors['text']}
           }

         .sc_layouts_row_type_normal .sc_layouts_item a,
         .sc_layouts_row_type_normal .sc_layouts_item a{
            color: {$colors['alter_dark']};
         }
          .sc_layouts_menu_nav>li>a:hover,
          .sc_layouts_menu_nav>li.sfHover>a,
          .sc_layouts_menu_nav>li.current-menu-item>a,
          .sc_layouts_menu_nav>li.current-menu-parent>a,
          .sc_layouts_menu_nav>li.current-menu-ancestor>a{
            color: {$colors['text_hover2']}!important;
          }
          .footer_wrap .widget p{
            color: {$colors['text_link2']};
          }
          .footer_wrap a:hover, .footer_wrap
          .vc_row a:hover{
            color: {$colors['text_link']};
          }
          .sidebar ul>li:before{
             background-color: {$colors['text']};
          }
          .sidebar li>a,
          .sidebar .post_title>a{
            color: {$colors['text']};
          }
          .sidebar li>a:hover,
          .sidebar .post_title>a:hover{
            color: {$colors['text_light']};
          }
          .widget .widget_title, .widget .widgettitle {
            color: {$colors['text']};
          }
          .post_info_item.post_info_posted_by{
            color: {$colors['text']};
          }
          .post_info_item a:hover{
            color: {$colors['text']}!important;
           }
           .post_info_item a{
            color: {$colors['text_link']}!important;
           }
           .widget.widget_recent_comments,
           .widget.widget_recent_comments span {
                color: {$colors['text_link']};
           }
           .sidebar .widget_calendar tbody td ,
           .sidebar .widget_calendar caption,
           .sidebar .widget_calendar tbody td a,
           .sidebar .widget_calendar th{
                color: {$colors['text']}!important;
           }
            .sidebar .widget_calendar td#today:before {
                 background-color: {$colors['text_light']};
            }
            .widget_calendar td#today {
                color: {$colors['text']}!important;
            }
            .sidebar .widget_calendar #prev a,
            .sidebar .widget_calendar #next a {
                color: {$colors['text']};
            }
            .sidebar .widget_calendar #prev a:hover,
            .sidebar .widget_calendar #next a:hover {
                color: {$colors['text_light']};
            }
            .sidebar .widget_product_tag_cloud a,
            .sidebar .widget_tag_cloud a {
                color: {$colors['text']};
                 background-color: {$colors['inverse_text']};
                 border-color:{$colors['inverse_text']};
            }
             .sidebar .widget_product_tag_cloud a:hover,
            .sidebar .widget_tag_cloud a:hover {
                color: {$colors['text']}!important;
                 background-color: {$colors['bg_color_0']};
                 border-color:{$colors['text']};
            }
            .widget_search form:hover:after,
            .woocommerce.widget_product_search form:hover:after,
            .widget_display_search form:hover:after,
            #bbpress-forums #bbp-search-form:hover:after {
                  color: {$colors['text_light']};
            }
            .sidebar .widget + .widget{
                border-color: {$colors['text']};
            }
            body .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title>a .vc_tta-controls-icon,
            body .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title>a:hover .vc_tta-controls-icon{
                  color: {$colors['text']};
                 background-color: {$colors['bg_color_0']}!important;
                 border-color:{$colors['text_hover']};
            }
             body .vc_tta.vc_tta-accordion .vc_tta-panel-heading .vc_tta-controls-icon {
                 color: {$colors['text']};
                 background-color: {$colors['bg_color_0']}!important;
                 border-color:{$colors['text_hover']};
             }
             .wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel:hover,
             .wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active,
             .wpb-js-composer .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-body{
                 background-color: {$colors['bd_color']};
             }
             .vc_tta.vc_tta-accordion .vc_tta-panel-title .vc_tta-title-text ,
             .wpb-js-composer .vc_tta.vc_general .vc_tta-panel-body>:last-child{
                color: {$colors['text']};
             }
              body .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab>a:hover,
              body .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab.vc_active>a{
                 color: {$colors['text']};
                 background-color: {$colors['bg_color_0']};
                 border-color:{$colors['text_hover']};
              }
              body .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tabs-list .vc_tta-tab>a {
                 color: {$colors['text']};
                 background-color: {$colors['bd_color']};
                 border-color:{$colors['bd_color']};

              }
              body .vc_progress_bar.vc_progress_bar.vc_progress-bar-color-white  .vc_single_bar .vc_label .vc_label_units,
              body .vc_progress_bar.vc_progress_bar.vc_progress-bar-color-white  .vc_single_bar .vc_label {
                 color: {$colors['inverse_text']};
              }
              body .vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label .vc_label_units,
              body .vc_progress_bar.vc_progress_bar_narrow .vc_single_bar .vc_label {
                color: {$colors['text']};
              }
              .sc_countdown_default .sc_countdown_digits span{
                 color: {$colors['text_link']};
                 background-color: {$colors['bg_color_0']};
              }
              .sc_countdown .sc_countdown_label{
                 color: {$colors['inverse_text']};
              }
              .sc_skills_pie.sc_skills_compact_off .sc_skills_total{
                 color: {$colors['text_dark']};
              }
               .sc_skills .sc_skills_item_title,
               .sc_skills .sc_skills_legend_title,
               .sc_skills .sc_skills_legend_value {
                  color: {$colors['text']};
               }

              .vc_color-grey.vc_message_box_closeable:after{
                  border-color: {$colors['text']};
               }
               .vc_color-grey.vc_message_box.vc_message_box_closeable:after {
                  color: {$colors['text']};
               }
               .vc_color-grey.vc_message_box-solid{
                  color: {$colors['text']};
                  background-color: {$colors['bd_color']};
               }

               .vc_color-orange.vc_message_box{
                  color: {$colors['text_dark']};
                  background-color: {$colors['text_light']};
               }
               .vc_message_box_closeable:after{
                  border-color: {$colors['alter_text']};
               }

               .vc_message_box .vc_message_box-icon i{
                  color: {$colors['text_dark_07']};
               }

               .vc_color-sky.vc_message_box{
                  color: {$colors['text_dark']};
                  background-color: {$colors['text_link3']};
               }
               .vc_color-sky.vc_message_box.vc_message_box_closeable:after {
                  color: {$colors['text_dark']};
               }
              .vc_color-success.vc_message_box{
                  color: {$colors['text_dark']};
                  background-color: {$colors['text_hover3']};
               }
               .vc_color-success.vc_message_box.vc_message_box_closeable:after {
                  color: {$colors['text_dark']};
               }
               .vc_progress_bar .vc_single_bar .vc_label{
                    color: {$colors['text_dark']};
               }
               .sc_layouts_item_details_line1 {
                     color: {$colors['text']};
               }
               .wpb-js-composer .vc_progress_bar .vc_single_bar{
                    background-color: {$colors['inverse_text_02']};
               }
               .trx_addons_audio_player.without_cover{
                     background-color: {$colors['bd_color']};
                     border-color: {$colors['bd_color']};
                 }
                 .trx_addons_audio_player .mejs-container .mejs-controls .mejs-time,
                 .trx_addons_audio_player.without_cover .audio_author{
                    color: {$colors['text']};
                 }
                .mejs-controls .mejs-button, 
                .mejs-controls .mejs-time-rail .mejs-time-current,
               .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{
                     background-color: {$colors['text']};
                     color: {$colors['inverse_text']};
               }
               
               .mejs-controls .mejs-time-rail .mejs-time-total, 
               .mejs-controls .mejs-time-rail .mejs-time-loaded, 
               .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total{
                     background-color: {$colors['inverse_text']};
               }
               
               .trx_addons_audio_player .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total:before,
               .trx_addons_audio_player .mejs-controls .mejs-time-rail .mejs-time-total:before{
                     background-color: {$colors['inverse_text']};
               }
               .mejs-controls .mejs-button:hover{
                    background-color: {$colors['text_link']};
                    color: {$colors['inverse_text']};
               }
                .trx_addons_video_player.with_cover .video_hover,
                .format-video .post_featured.with_thumb .post_video_hover{
                    border-color: {$colors['inverse_text']};
                    color: {$colors['inverse_text']};
                    background-color: {$colors['bg_color_0']};
                }
                .trx_addons_video_player.with_cover .video_hover:hover,
                .format-video .post_featured.with_thumb .post_video_hover:hover{
                    border-color: {$colors['text_link']};
                    color: {$colors['text_link']};
                    background-color: {$colors['bg_color_0']};
                }
                .sc_price{
                    background-color: {$colors['bg_color_0']};
                }
                .sc_price_info .sc_price_price{
                     color: {$colors['text_link']};
                }
                .sc_price_decimals{
                    color: {$colors['text']};
                }
                .sc_price:hover .sc_price_info .sc_price_title, 
                .sc_price:hover .sc_price_info .sc_price_title a{
                    color: {$colors['text']};
                }
                .sc_price_info .sc_price_title, 
                .sc_price_info .sc_price_title a{
                    color: {$colors['text']};
                }
                .sc_price_info .sc_price_description, 
               .sc_price_info .sc_price_details {
                    color: {$colors['text']};
                }
                .sc_price:hover{
                    color: {$colors['bg_color_0']};
                    background-color: {$colors['bg_color_0']};
                }
                .sc_layouts_item_details_line2 {
                    color: {$colors['text_link']};
                }
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_nav>li ul,
               .sc_layouts_menu_popup .sc_layouts_menu_nav, 
               .sc_layouts_menu_nav>li ul {
                    background-color: {$colors['alter_dark']};
               }
               .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a, 
               .sc_layouts_menu_nav>li li>a{
                    color: {$colors['inverse_link']} !important;
               }
             
               .sc_layouts_menu_nav>li li.current-menu-item>a, 
               .sc_layouts_menu_nav>li li.current-menu-parent>a, 
               .sc_layouts_menu_nav>li li.current-menu-ancestor>a,
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_nav>li li.current-menu-item>a, 
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_nav>li li.current-menu-parent>a, 
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_nav>li li.current-menu-ancestor>a{
                    color: {$colors['text_link']}!important; 
                    border-color: {$colors['text_link']};
              
               }
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a:hover, 
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_popup .sc_layouts_menu_nav>li.sfHover>a, 
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_nav>li li>a:hover, 
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_nav>li li.sfHover>a,
               .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a:hover, 
               .sc_layouts_menu_popup .sc_layouts_menu_nav>li.sfHover>a, 
               .sc_layouts_menu_nav>li li>a:hover, 
               .sc_layouts_menu_nav>li li.sfHover>a{
                    color: {$colors['text_link']}!important; 
                    background-color: {$colors['bg_color_0']};
                    border-color: {$colors['text_link']};
                }
                
               .scheme_dark.sc_layouts_row_type_compact .sc_layouts_menu_nav>li>ul:before,
               .sc_layouts_menu_nav>li>ul:before{
                     background-color: {$colors['alter_dark']};
               }
               
               .sc_layouts_title_breadcrumbs a,
               .sc_layouts_title_breadcrumbs,
               .sc_layouts_title_caption{
                    color: {$colors['text_dark']}; 
                }    
              .sc_layouts_title_breadcrumbs a:hover{
                    color: {$colors['text_link']} !important; 
              }
              .sc_layouts_title_caption:after {
                background-color: {$colors['text_dark']};
              }
              
              
              .sc_layouts_row_type_compact .sc_layouts_item_details_line2 {
                color: {$colors['text_link']}; 
              }
              .sc_layouts_row_type_compact .sc_layouts_cart .sc_layouts_item_details_line2 {
                color: {$colors['text']};
              }
              .breadcrumbs_item.current,
              .sc_layouts_row_type_compact .sc_layouts_login:hover .sc_layouts_item_details_line1,
              .sc_layouts_row_type_compact .sc_layouts_cart:hover .sc_layouts_item_details_line2 {
                color: {$colors['text_link']};
              }
              .sc_layouts_column_align_right .sc_layouts_item + .sc_layouts_item:before {
                background-color: {$colors['text']};
              }
              .slider_swiper_outer .swiper-pagination-bullet:after, .slider_swiper .swiper-pagination-bullet:after {
                background-color: {$colors['inverse_link_04']};
              }
              .sc_item_slider.slider_outer_pagination .swiper-pagination-bullet.swiper-pagination-bullet-active:after,
                .sc_item_slider.slider_outer_pagination .swiper-pagination-bullet:hover:after,
              .slider_swiper_outer .swiper-pagination-bullet-active:after,
              .slider_swiper .swiper-pagination-bullet:hover:after {
                background-color: {$colors['inverse_link']};
              }
              .sc_price_link {
                color: {$colors['text']};
                background-color: {$colors['bd_color']};
              }
              .woocommerce button.button,
              .woocommerce table.cart td.actions .button,
              .comments_wrap .form-submit input[type="submit"],
              .sc_price:hover .sc_price_link,
              .sc_price_link:hover {
                color: {$colors['alter_dark']};
                background-color: {$colors['text_light']};
              }
              .sc_team_default .sc_team_item_socials .social_item .social_icon,
              .trx_addons_popup button.mfp-close,
              .trx_addons_popup_form_field_submit .submit_button,
              .scheme_dark.footer_wrap .socials_wrap .social_item .social_icon,
              #sb_instagram .sbi_photo:before,
              .team_member_page .team_member_socials .social_item .social_icon,
              .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item .social_icon,
              .scheme_dark .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item .social_icon,
              .socials_wrap .social_item .social_icon {
                color: {$colors['alter_dark']};
                background-color: {$colors['text_light']};
              }
              .sc_team_default .sc_team_item_socials .social_item:hover .social_icon,
              .trx_addons_popup button.mfp-close:hover,
              .trx_addons_popup_form_field_submit .submit_button:hover,
              .scheme_dark.footer_wrap .socials_wrap .social_item:hover .social_icon,
              .team_member_page .team_member_socials .social_item:hover .social_icon,
              .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item:hover .social_icon,
              .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item .social_icon:hover,
              .scheme_dark .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item:hover .social_icon,
              .scheme_dark .sc_team .sc_team_item_thumb .sc_team_item_socials .social_item .social_icon:hover,
              .woocommerce button.button:hover,
              .woocommerce table.cart td.actions .button:hover,
              .comments_wrap .form-submit input[type="submit"]:hover,
              .socials_wrap .social_item:hover .social_icon {
                color: {$colors['bg_color']};
                background-color: {$colors['text']};
              }
              .sc_services_default .sc_services_item.with_icon .sc_services_item_button .sc_button:hover {
                color: {$colors['text_link']} !important;
              }
              .trx_addons_popup_form_field_forgot_password:hover,
              .sc_services_default .sc_services_item_title a:hover,
              .comments_list_wrap .comment_reply a:hover,
              .comment_date,
              .trx_addons_accent_phone {
                color: {$colors['text_link']};
              }
              .trx_addons_popup_form_field_forgot_password,
              .sc_team_short .sc_team_item_title,
              .sc_services_default .sc_services_item.with_icon .sc_services_item_button .sc_button,
              .sc_services_default .sc_services_item,
              .sc_services_default .sc_services_item_title a,
              .comments_list_wrap .comment_reply a,
              .without_thumb .mejs-controls .mejs-time *,
              .format-audio .post_featured.without_thumb .post_audio_title,
              .format-audio .post_featured .post_audio_author,
              .sc_item_subtitle {
                color: {$colors['text']};
              }
              .sc_team_short .slider_swiper .swiper-slide:not(.swiper-slide-active):before,
              .sc_layouts_540 .sc_services_default div[class*="trx_addons_column-"] + div[class*="trx_addons_column-"]:before,
              .sc_layouts_522 .sc_services_default div[class*="trx_addons_column-"] + div[class*="trx_addons_column-"]:before {
                background: {$colors['text']};
              }
              .sc_team .slider_swiper_outer .swiper-pagination-bullet,
              .slider_swiper_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-bullet{  
                	border-color: {$colors['bg_color_0']};
	                background-color: {$colors['bg_color_0']};
              }
             .sc_team .slider_swiper_outer .swiper-pagination-bullet:hover,
             .sc_team .slider_swiper_outer .swiper-pagination-bullet.swiper-pagination-bullet-active,
             .slider_swiper_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-bullet.swiper-pagination-bullet-active,
             .slider_swiper_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-bullet:hover {
                	border-color: {$colors['text']};
	                background-color: {$colors['bg_color_0']};
             }
             .sc_team .slider_swiper_outer .swiper-pagination-bullet:after,
             .slider_swiper_outer.slider_outer_pagination_pos_bottom_outside  .swiper-pagination-bullet:after {
                background-color: {$colors['text_link2_04']};
             }
             .sc_team .slider_swiper_outer .swiper-pagination-bullet:hover:after,
             .sc_team .slider_swiper_outer .swiper-pagination-bullet.swiper-pagination-bullet-active:after,
             .slider_swiper_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-bullet.swiper-pagination-bullet-active:after,
             .slider_swiper_outer.slider_outer_pagination_pos_bottom_outside .swiper-pagination-bullet:hover:after{
                background-color: {$colors['text']};
             }
                          .sc_testimonials .slider_swiper_outer .swiper-pagination-bullet:after {
                            background-color: {$colors['alter_text_04']};
                          }
            .sc_testimonials .slider_swiper_outer .swiper-pagination-bullet:hover,
             .sc_testimonials .slider_swiper_outer .swiper-pagination-bullet.swiper-pagination-bullet-active {
             border-color: {$colors['text_dark']};
             }
             
             .sc_testimonials .slider_swiper_outer .swiper-pagination-bullet:hover:after,
             .sc_testimonials .slider_swiper_outer .swiper-pagination-bullet.swiper-pagination-bullet-active:after {
                background-color: {$colors['text_dark']};
             }
            
            .scheme_dark .sc_team .slider_swiper_outer .swiper-pagination-bullet:after {
                background-color: {$colors['inverse_link_04']};
            }
            .scheme_dark .sc_team .slider_swiper_outer .swiper-pagination-bullet:hover,
            .scheme_dark .sc_team .slider_swiper_outer .swiper-pagination-bullet.swiper-pagination-bullet-active {
                    border-color: {$colors['inverse_link']};
	                background-color: {$colors['bg_color_0']};
            }
            .scheme_dark .sc_team_short .slider_swiper .swiper-slide:not(.swiper-slide-active):before, 
            .scheme_dark .sc_layouts_522 .sc_services_default div[class*="trx_addons_column-"] + div[class*="trx_addons_column-"]:before,
            .scheme_dark .sc_team .slider_swiper_outer .swiper-pagination-bullet:hover:after,
            .scheme_dark .sc_team .slider_swiper_outer .swiper-pagination-bullet.swiper-pagination-bullet-active:after {
                 background-color: {$colors['inverse_link']};
            }
            .sc_testimonials [class*="column"] .sc_testimonials_item_content:after,
            h2.sc_item_title.sc_item_title_style_default:not(.sc_item_title_tag):before {
                background-color: {$colors['text_dark']};
            }
            .scheme_dark .sc_team_default .sc_team_item_subtitle, 
            .scheme_dark .sc_team_short .sc_team_item_subtitle, 
            .scheme_dark .sc_team_featured .sc_team_item_subtitle,
            .scheme_dark .sc_item_subtitle {
                color: {$colors['inverse_link']};
            }
            .sc_testimonials_item_author_title,
            .sc_testimonials [class*="column"] .sc_testimonials_item_content,
            .sc_icons .sc_icons_item_title,
            .sc_icons .sc_icons_icon,
            blockquote.sc_promo_text .sc_item_subtitle {
                color: {$colors['text_dark']};
            }
            .sc_blogger_item {
                background-color: {$colors['bg_color_0']};
            }
            .sc_layouts_323 .sc_icons .sc_icons_icon,
            .sc_layouts_323 .sc_icons .sc_icons_item_title,
            .sc_blogger_item_title a {
                color: {$colors['text']} !important;
            }
            .accented,
            .sc_blogger_item_title a:hover {
                color: {$colors['text_link']} !important;
            }
            .custom .tp-bullet {
                 background-color: {$colors['bg_color_04']};
            }
            .custom .tp-bullet.selected,
            .custom .tp-bullet:hover{
                background-color: {$colors['bg_color']};
            }
            .custom .tp-bullet.selected:after,
            .custom .tp-bullet:hover:after{
                border-color: {$colors['bg_color']};
            }
            .vc_row div[data-vc-full-width="true"] .woocommerce ul.products li.product-category .post_header a {
                color: {$colors['inverse_link']};
            }
            .vc_row div[data-vc-full-width="true"] .woocommerce ul.products li.product-category .post_header a:hover {
                color: {$colors['text_link']};
            }
            .sc_layouts_row_type_normal .sc_layouts_cart {
                background-color: {$colors['text_link3']};
            }
            .sc_layouts_row_type_normal .sc_layouts_cart:hover {
                background-color: {$colors['text_link']};
            }
            .sc_layouts_row_type_normal  .sc_layouts_cart .sc_layouts_item_details_line2,
            .sc_layouts_row_type_normal .sc_layouts_cart .sc_layouts_item_icon {
                color: {$colors['text_dark']};
            }
            .scheme_self.footer_wrap .mc4wp-form .mc4wp-form-fields input[type="submit"] {
                color: {$colors['inverse_link']};
                border-color: {$colors['text_link2']} !important;
            } 
            .scheme_self.footer_wrap .mc4wp-form .mc4wp-form-fields input[type="submit"]:focus,
            .scheme_self.footer_wrap .mc4wp-form .mc4wp-form-fields input[type="submit"]:hover {
                color: {$colors['inverse_dark']};
                border-color: {$colors['text_link']} !important;
                background-color: {$colors['text_link']} !important;
            }
            .scheme_self.footer_wrap .mc4wp-form .mc4wp-form-fields input[type="email"] {
                color: {$colors['text_link2']};
                border-color: {$colors['text_link2']};
            }
            .scheme_self.footer_wrap .mc4wp-form .mc4wp-form-fields input[type="email"]:focus,
            .scheme_self.footer_wrap .mc4wp-form .mc4wp-form-fields input[type="email"]:hover {
                border-color: {$colors['text_link']} !important;
            }
            .scheme_self.footer_wrap .mc4wp-form .mc4wp-form-fields input[type="email"]::-webkit-input-placeholder {
                color: {$colors['text_link2']};
            }
            .sc_team_default .sc_team_item_subtitle,
            .scheme_dark .sc_layouts_menu_mobile_button .sc_layouts_item_icon,
            .scheme_dark .sc_layouts_menu_nav>li>a:hover, 
            .scheme_dark .sc_layouts_menu_nav>li.sfHover>a,
            .scheme_dark .sc_layouts_menu_nav>li.current-menu-item>a,
            .scheme_dark .sc_layouts_menu_nav>li.current-menu-parent>a,
            .scheme_dark .sc_layouts_menu_nav>li.current-menu-ancestor>a {
                color: {$colors['text_link']} !important;
            }
            .scheme_dark .menu_mobile_inner .search_mobile .search_submit,
            .scheme_dark.sc_layouts_row_type_compact .sc_layouts_item a:not(.sc_button):not(.button),
            .vc_row.scheme_self.sc_layouts_row_type_compact .sc_layouts_cart .sc_layouts_item_details_line2 {
                color: {$colors['inverse_link']};
            }
            .scheme_dark .sc_layouts_column_align_right .sc_layouts_item + .sc_layouts_item:before {
                background-color: {$colors['inverse_link']};
            }
            .scheme_dark .select_container select,
            .menu_mobile .search_mobile .search_field::-webkit-input-placeholder {
                color: {$colors['inverse_link']};
            }
            .scheme_self.sc_layouts_row_fixed_on {
                background-color: {$colors['bg_color']};
            }
            .sc_services_default .sc_services_item {
                background-color: {$colors['bg_color_0']};
            }
            .sc_layouts_menu_mobile_button .sc_layouts_item_icon {
                color: {$colors['text']};
            }
            .scheme_dark .widget_calendar td#prev a:before, .scheme_dark .widget_calendar td#next a:before,
            .scheme_dark .menu_side_inner, .scheme_dark .menu_mobile_inner {
                background-color: {$colors['text_dark']};
            }
            

CSS;
        }

        return $css;
    }
}
?>