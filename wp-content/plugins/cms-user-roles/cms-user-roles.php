<?php
/**
 * Plugin Name: CMS User Roles & Permissions
 * Plugin URI:  https://github.com/AQuyGib/NguyenAnhQuy_CMS
 * Description: Quản lý và phân quyền người dùng theo yêu cầu bài học CMS: cms_read, cms_write, cms_admin.
 * Version:     1.0.0
 * Author:      Nguyễn Anh Quý
 * Author URI:  https://github.com/AQuyGib
 * License:     GPL-2.0+
 * Text Domain: cms-user-roles
 */

// Ngăn chặn truy cập trực tiếp vào file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CMS_User_Roles_Manager {

    /**
     * Khởi tạo các hook của WordPress
     */
    public static function init() {
        register_activation_hook( __FILE__, [ __CLASS__, 'activate' ] );
        register_deactivation_hook( __FILE__, [ __CLASS__, 'deactivate' ] );

        // Đảm bảo các role và user demo luôn tồn tại
        add_action( 'init', [ __CLASS__, 'register_roles' ] );
        add_action( 'init', [ __CLASS__, 'ensure_demo_users' ] );
    }

    /**
     * Định nghĩa danh sách các roles và capabilities
     */
    public static function get_role_definitions() {
        // 1. cms_read: Chỉ có quyền đọc
        $read_caps = [
            'read' => true,
        ];

        // 2. cms_write: Quyền đọc và viết/chỉnh sửa nội dung
        $write_caps = [
            'read'                   => true,
            'edit_posts'             => true,
            'publish_posts'          => true,
            'delete_posts'           => true,
            'edit_published_posts'   => true,
            'delete_published_posts' => true,
            'upload_files'           => true,
        ];

        // 3. cms_admin: Quản trị viên đầy đủ, đặc biệt là quyền cài plugin và cài theme
        $admin_caps = [
            // Quyền cơ bản & đọc
            'read'                   => true,
            'upload_files'           => true,
            'manage_options'         => true,
            'unfiltered_html'        => true,

            // Quyền quản lý Plugin (Cài plugin)
            'activate_plugins'       => true,
            'install_plugins'        => true,
            'update_plugins'         => true,
            'delete_plugins'         => true,
            'edit_plugins'           => true,

            // Quyền quản lý Theme (Cài theme)
            'switch_themes'          => true,
            'edit_theme_options'     => true,
            'install_themes'         => true,
            'update_themes'          => true,
            'delete_themes'          => true,
            'edit_themes'            => true,

            // Quyền bài viết (Posts)
            'edit_posts'             => true,
            'edit_others_posts'      => true,
            'edit_published_posts'   => true,
            'publish_posts'          => true,
            'delete_posts'           => true,
            'delete_others_posts'    => true,
            'delete_published_posts' => true,
            'delete_private_posts'   => true,
            'edit_private_posts'     => true,
            'read_private_posts'     => true,

            // Quyền trang (Pages)
            'edit_pages'             => true,
            'edit_others_pages'      => true,
            'edit_published_pages'   => true,
            'publish_pages'          => true,
            'delete_pages'           => true,
            'delete_others_pages'    => true,
            'delete_published_pages' => true,

            // Quyền chuyên mục & người dùng
            'manage_categories'      => true,
            'moderate_comments'      => true,
            'list_users'             => true,
            'create_users'           => true,
            'edit_users'             => true,
            'delete_users'           => true,
            'promote_users'          => true,
            'export'                 => true,
            'import'                 => true,
        ];

        return [
            'cms_read' => [
                'display_name' => 'CMS Read',
                'caps'         => $read_caps,
            ],
            'cms_write' => [
                'display_name' => 'CMS Write',
                'caps'         => $write_caps,
            ],
            'cms_admin' => [
                'display_name' => 'CMS Admin',
                'caps'         => $admin_caps,
            ],
        ];
    }

    /**
     * Đăng ký các roles vào hệ thống WordPress
     */
    public static function register_roles() {
        $roles = self::get_role_definitions();

        foreach ( $roles as $role_key => $role_info ) {
            $role = get_role( $role_key );
            if ( null === $role ) {
                add_role( $role_key, $role_info['display_name'], $role_info['caps'] );
            } else {
                // Đảm bảo capabilities luôn khớp với định nghĩa
                foreach ( $role_info['caps'] as $cap => $grant ) {
                    $role->add_cap( $cap, $grant );
                }
            }
        }
    }

    /**
     * Tạo sẵn các tài khoản demo kiểm thử phân quyền nếu chưa tồn tại
     */
    public static function ensure_demo_users() {
        $demo_accounts = [
            [
                'user_login' => 'cms_read',
                'user_pass'  => 'Cms@123456',
                'user_email' => 'cms_read@example.com',
                'role'       => 'cms_read',
                'first_name' => 'CMS',
                'last_name'  => 'Read User',
            ],
            [
                'user_login' => 'cms_write',
                'user_pass'  => 'Cms@123456',
                'user_email' => 'cms_write@example.com',
                'role'       => 'cms_write',
                'first_name' => 'CMS',
                'last_name'  => 'Write User',
            ],
            [
                'user_login' => 'cms_admin',
                'user_pass'  => 'Cms@123456',
                'user_email' => 'cms_admin@example.com',
                'role'       => 'cms_admin',
                'first_name' => 'CMS',
                'last_name'  => 'Admin User',
            ],
        ];

        foreach ( $demo_accounts as $account ) {
            if ( ! username_exists( $account['user_login'] ) && ! email_exists( $account['user_email'] ) ) {
                wp_insert_user( $account );
            } else {
                $user = get_user_by( 'login', $account['user_login'] );
                if ( $user && ! in_array( $account['role'], $user->roles, true ) ) {
                    $user->set_role( $account['role'] );
                }
            }
        }
    }

    /**
     * Xử lý khi kích hoạt plugin
     */
    public static function activate() {
        self::register_roles();
        self::ensure_demo_users();
    }

    /**
     * Xử lý khi hủy kích hoạt plugin
     */
    public static function deactivate() {
        // Giữ lại vai trò và dữ liệu người dùng để không làm gián đoạn hệ thống
    }
}

CMS_User_Roles_Manager::init();
