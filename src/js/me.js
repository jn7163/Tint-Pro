/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/09/12 21:30
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://www.webapproach.net/tint.html
 */

'use strict';


import {handleLineLoading} from './modules/loading';
import {popMsgbox} from './modules/msgbox';
import {} from './modules/bootstrap-flat';
import ScrollHandler from './modules/scroll';
//import FollowKit from './modules/follow';
//import Pmkit from './modules/pm';
import ModalSignBox from './modules/modalSignBox';
import {} from 'lazyload/jquery.lazyload';
import SignHelp from './modules/signHelp';
import FixFooter from './modules/fixFooter';
import UnstarKit from './modules/unstar';
//import Bankit from './modules/ban';
import Referral from './modules/referral';
import ImageUploader from './modules/imageUploader';


// DOM Ready
jQuery(document).ready(function ($) {
    // 隐藏加载条
    handleLineLoading();
    
    // 初始化popMsgbox
    popMsgbox.init();
    
    // 滚动顶部底部
    ScrollHandler.initScrollTo();
    
    // 粉丝和关注
    //FollowKit.init();
    
    // 私信
    //Pmkit.initModalPm();
    //Pmkit.initNormalPm();
    
    // 登录弹窗
    ModalSignBox.init();
    
    // 登录界面显示方式
    SignHelp.init();
    
    // 延迟加载图片
    $('img.lazy').lazyload({
        effect: "fadeIn",
        threshold: 50
    });
    
    // 修正Footer位置
    FixFooter();
    
    // 取消收藏
    UnstarKit.init();
    
    // 微信等二维码弹出
    $('.popover-qr').popover({
        html: true
    });
    
    // 封禁/解锁账户操作
    //Bankit.initModalBan();
    
    // 设置推广信息cookie, 便于后面使用
    Referral.init();
    
    // 初始化头像上传
    ImageUploader.initAvatarUpload();
});