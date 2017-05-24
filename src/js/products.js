/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/09/12 21:29
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://webapproach.net/tint.html
 */

'use strict';

import {handleLineLoading} from './modules/loading';
import {popMsgbox} from './modules/msgbox';
import {} from './modules/bootstrap-flat';
import loadNext from  './modules/loadNextPage';
import ScrollHandler from './modules/scroll';
import ModalSignBox from './modules/modalSignBox';
import SignHelp from './modules/signHelp';
import FixFooter from './modules/fixFooter';
import Toggle from './modules/toggle';
import Referral from './modules/referral';

// DOM Ready
jQuery(document).ready(function ($) {
    // 隐藏加载条
    handleLineLoading();
    
    // 初始化popMsgbox
    popMsgbox.init();
    
    // 加载下一页
    loadNext.init();
    
    // 滚动顶部底部
    ScrollHandler.initScrollTo();
    
    // 登录弹窗
    ModalSignBox.init();
    
    // 登录界面显示方式
    SignHelp.init();
    
    // 修正Footer位置
    FixFooter();
    
    // 根据滚动方向折叠或显示二级菜单
    ScrollHandler.initShopSubNavCollapse();
    
    // 折叠左菜单
    Toggle.initShopLeftMenuToggle();
    
    // 设置推广信息cookie, 便于后面使用
    Referral.init();
});