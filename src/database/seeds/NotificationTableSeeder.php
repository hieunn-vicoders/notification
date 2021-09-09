<?php

use Illuminate\Database\Seeder;
use VCComponent\Laravel\Notification\Entities\Notification;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::insert([
            [
                'name' => 'Thông báo có người dùng quên mật khẩu',
                'slug' => 'thong-bao-co-nguoi-dung-quen-mat-khau',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Người dùng yêu cầu đổi mật khẩu.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có người mới đăng ký',
                'slug' => 'thong-bao-co-nguoi-moi-dang-ky',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Người dùng tạo mới tài khoản.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin gửi yêu cầu đặt lại mật khẩu cho người dùng',
                'slug' => 'thong-bao-co-admin-gui-yeu-cau-dat-lai-mat-khau-cho-nguoi-dung',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Admin vừa tạo yêu cầu đặt lại mật khẩu cho người dùng.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin tạo mới bài viết',
                'slug' => 'thong-bao-co-admin-tao-moi-bai-viet',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Admin vừa tạo mới mới bài viết.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin cập nhật bài viết',
                'slug' => 'thong-bao-co-admin-cap-nhat-bai-viet',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Admin vừa cập nhật bài viết.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin cập nhật trạng thái sản phẩm',
                'slug' => 'thong-bao-co-admin-cap-nhat-trang-thai-san-pham',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Admin vừa cập nhật trạng thái sản phẩm.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin tạo mới sản phẩm',
                'slug' => 'thong-bao-co-admin-tao-moi-san-pham',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Admin vừa tạo mới sản phẩm.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin cập nhật sản phẩm',
                'slug' => 'thong-bao-co-admin-cap-nhat-san-pham',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Admin vừa cập nhật sản phẩm.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin cập nhật trạng thái bài viết',
                'slug' => 'thong-bao-co-admin-cap-nhat-trang-thai-bai-viet',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Admin vừa cập nhật trạng thái bài viết.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo tạo đơn hàng thành công',
                'slug' => 'thong-bao-tao-don-hang-thanh-cong',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:10px;word-break:break-word;width:100%;">
                                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:28px;font-weight:500;line-height:1;text-align:center;color:#000000;">
                                                                        Xin chào *|USERNAME|*
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width:350px;">
                                                                                    <img alt="divider" height="auto" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/20/divider.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="350"/>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-top:10px;padding-bottom:0px;word-break:break-word;">
                                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                                        Bạn đã tạo thành công đơn hàng.
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" vertical-align="middle" style="font-size:0px;padding:30px 10px 30px 10px;word-break:break-word;">
                                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" bgcolor="#A8BF6F" role="presentation" style="border:none;border-radius:5px;cursor:auto;height:65px;mso-padding-alt:10px 25px;background:#A8BF6F;" valign="middle">
                                                                                    <a href="*|HOME_URL|*" style="display:inline-block;background:#A8BF6F;color:#ffffff;font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:5px;" target="_blank">
                                                                                        <span style="text-transform: uppercase;">Quay lại trang chủ</span>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có người dùng tạo đơn hàng mới',
                'slug' => 'thong-bao-co-nguoi-dung-tao-don-hang-moi',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Tài khoản *|USERNAME|* vừa tạo đơn hàng mới.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin tạo đơn hàng mới',
                'slug' => 'thong-bao-co-admin-tao-don-hang-moi',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Tài khoản *|ADMIN_ACCOUNT|* vừa tạo đơn hàng mới.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin cập nhật trạng thái đơn hàng',
                'slug' => 'thong-bao-co-admin-cap-nhat-trang-thai-don-hang',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Tài khoản *|ADMIN_ACCOUNT|* vừa cập nhật trạng thái đơn hàng.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin tạo mới review',
                'slug' => 'thong-bao-co-admin-tao-moi-review',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Tài khoản *|ADMIN_ACCOUNT|* vừa tạo mới review.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo gửi liên hệ thành công',
                'slug' => 'thong-bao-gui-lien-he-thanh-cong',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:10px;word-break:break-word;width:100%;">
                                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:28px;font-weight:500;line-height:1;text-align:center;color:#000000;">
                                                                        Xin chào *|USERNAME|*
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width:350px;">
                                                                                    <img alt="divider" height="auto" src="https://d1oco4z2z1fhwp.cloudfront.net/templates/default/20/divider.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="350"/>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-top:10px;padding-bottom:0px;word-break:break-word;">
                                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                                        Cảm ơn bạn đã liên hệ với chung tôi.
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" vertical-align="middle" style="font-size:0px;padding:30px 10px 30px 10px;word-break:break-word;">
                                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center" bgcolor="#A8BF6F" role="presentation" style="border:none;border-radius:5px;cursor:auto;height:65px;mso-padding-alt:10px 25px;background:#A8BF6F;" valign="middle">
                                                                                    <a href="*|HOME_URL|*" style="display:inline-block;background:#A8BF6F;color:#ffffff;font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:normal;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:5px;" target="_blank">
                                                                                        <span style="text-transform: uppercase;">Quay lại trang chủ</span>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có người dùng liên hệ',
                'slug' => 'thong-bao-co-nguoi-dung-lien-he',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Tài khoản *|ADMIN_ACCOUNT|* vừa tạo mới liên hệ.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin cập nhật trạng thái liên hệ',
                'slug' => 'thong-bao-co-admin-cap-nhat-trang-thai-lien-he',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Tài khoản *|ADMIN_ACCOUNT|* thay đổi trạng thái liên hệ.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
            [
                'name' => 'Thông báo có admin tạo mới form liên hệ',
                'slug' => 'thong-bao-co-admin-tao-moi-form-lien-he',
                'email_template' => '<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:250px;">
                                                                    <img alt="logo" height="auto" src="*|LOGO_URL|*" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:14px;" width="250" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                                    <div style="font-family:Montserrat, Arial, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555555;">
                                                        Tài khoản *|ADMIN_ACCOUNT|* tạo mới form liên hệ.
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>',
                'mobile_template' => '',
                'web_template'  => ''
            ],
        ]);
    }
}
