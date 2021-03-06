/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/10/27 23:07
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://www.webapproach.net/tint.html
 */

'use strict';
 
var AnimateAnchor = function () {
    var body = $('body');
    body.on('click', 'a[href^="#"]', function (e) {
        e.preventDefault();
        var sel = $(this).attr('href');
        var target = $(sel);
        if(target) {
            body.animate({
                scrollTop: target.offset().top
            }, 'slow');
            window.location.hash = sel.substr(1);
        }
    });
};

export default AnimateAnchor;