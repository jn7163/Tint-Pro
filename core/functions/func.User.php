<?php
/**
 * Copyright (c) 2014-2016, WebApproach.net
 * All right reserved.
 *
 * @since 2.0.0
 * @package Tint
 * @author Zhiyan
 * @date 2016/10/24 21:19
 * @license GPL v3 LICENSE
 * @license uri http://www.gnu.org/licenses/gpl-3.0.html
 * @link https://www.webapproach.net/tint.html
 */
?>
<?php

/**
 * 获取用户权限描述字符
 *
 * @since 2.0.0
 * @param $user_id
 * @return string
 */
function tt_get_user_cap_string ($user_id) {
    if(user_can($user_id,'install_plugins')) {
        return __('Site Manager', 'tt');
    }
    if(user_can($user_id,'edit_others_posts')) {
        return __('Editor', 'tt');
    }
    if(user_can($user_id,'publish_posts')) {
        return __('Author', 'tt');
    }
    if(user_can($user_id,'edit_posts')) {
        return __('Contributor', 'tt');
    }
    return __('Reader', 'tt');
}


/**
 * 获取用户的封面
 *
 * @since 2.0.0
 * @param $user_id
 * @param $size
 * @param $default
 * @return string
 */
function tt_get_user_cover ($user_id, $size = 'full', $default = '') {
    if(!in_array($size, ['full', 'mini'])) {
        $size = 'full';
    }
    if($cover = get_user_meta($user_id, 'tt_user_cover', true)) {
        return $cover; // TODO size
    }
    return $default ? $default : THEME_ASSET . '/img/user-default-cover-' . $size . '.jpg';
}


/**
 * 获取用户正在关注的人数
 *
 * @since 2.0.0
 * @param $user_id
 * @return int
 */
function tt_count_user_following ($user_id) {
    return tt_count_following($user_id);
}

/**
 * 获取用户的粉丝数量
 *
 * @since 2.0.0
 * @param $user_id
 * @return int
 */
function tt_count_user_followers ($user_id) {
    return tt_count_followers($user_id);
}


/**
 * 获取作者的文章被浏览总数
 *
 * @since 2.0.0
 * @param $user_id
 * @param $view_key
 * @return int
 */
function tt_count_author_posts_views ($user_id, $view_key = 'views') {
    global $wpdb;
    $sql = $wpdb->prepare("SELECT SUM(meta_value) FROM $wpdb->postmeta RIGHT JOIN $wpdb->posts ON $wpdb->postmeta.meta_key='%s' AND $wpdb->posts.post_author=%d AND $wpdb->postmeta.post_id=$wpdb->posts.ID", $view_key, $user_id);
    $count = $wpdb->get_var($sql);

    return $count;
}


/**
 * 统计某个作者的文章被赞的总次数
 *
 * @since 2.0.0
 * @param $user_id
 * @return null|string
 */
function tt_count_author_posts_stars ($user_id) {
    global $wpdb;
    $sql = $wpdb->prepare("SELECT COUNT(*) FROM $wpdb->postmeta  WHERE meta_key='%s' AND post_id IN (SELECT ID FROM $wpdb->posts WHERE post_author=%d)", 'tt_post_star_users', $user_id);
    $count = $wpdb->get_var($sql);

    return $count;
}


/**
 * 获取用户点赞的所有文章ID
 *
 * @since 2.0.0
 * @param $user_id
 * @return array
 */
function tt_get_user_star_post_ids ($user_id) {
    global $wpdb;
    $sql = $wpdb->prepare("SELECT `post_id` FROM $wpdb->postmeta  WHERE `meta_key`='%s' AND `meta_value`=%d", 'tt_post_star_users', $user_id);
    $results = $wpdb->get_results($sql);
    //ARRAY_A -> array(3) { [0]=> array(1) { [0]=> string(4) "1420" } [1]=> array(1) { [0]=> string(3) "242" } [2]=> array(1) { [0]=> string(4) "1545" } }
    //OBJECT -> array(3) { [0]=> object(stdClass)#3862 (1) { ["post_id"]=> string(4) "1420" } [1]=> object(stdClass)#3863 (1) { ["post_id"]=> string(3) "242" } [2]=> object(stdClass)#3864 (1) { ["post_id"]=> string(4) "1545" } }
    $ids = array();
    foreach ($results as $result) {
        $ids[] = intval($result->post_id);
    }
    $ids = array_unique($ids);
    rsort($ids); //从大到小排序
    return $ids;
}


/**
 * 获取一定数量特定角色用户
 *
 * @since 2.0.0
 * @param $role
 * @param $offset
 * @param $limit
 * @return array
 */
function tt_get_users_with_role ($role, $offset = 0, $limit = 20) {
    // TODO $role 过滤
    $user_query = new WP_User_Query(
        array(
            'role' => $role,
            'orderby' => 'ID',
            'order' => 'ASC',
            'number' => $limit,
            'offset' => $offset
        )
    );
    $users = $user_query->get_results();
    if (!empty($users)) {
        return $users;
    }
    return [];
}


/**
 * 获取管理员用户的ID
 *
 * @since 2.0.0
 * @return array
 */
function tt_get_administrator_ids () {
    $ids = [];
    $administrators = tt_get_users_with_role('Administrator');
    foreach ($administrators as $administrator) {
        $ids[] = $administrator->ID;
    }
    return $ids;
}


/**
 * 获取用户私信对话地址
 *
 * @since 2.0.0
 * @param $user_id
 * @return string
 */
function tt_get_user_chat_url($user_id) {
    return get_author_posts_url($user_id) . '/chat';
}