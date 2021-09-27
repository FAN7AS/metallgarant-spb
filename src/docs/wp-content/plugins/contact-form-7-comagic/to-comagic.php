<?php
/**
 * Plugin Name: Contact Form 7 to CoMagic
 * Description: Передача данных из форм Contact Form 7 в CoMagic / UIS
 * Version: 2.0 Beta
 * Author: Danil Podchufarov
 * Author URI: comagic.ru
 * License: GPL2
 * Text Domain: wpcf7-to-comagic
 */

defined('ABSPATH') or die('You cannot be here.');
global $wpdb;
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

class WPCF7TCM
{

    public static function register()
    {

        $class = new self();
        $class->action_hooks();
        $class->filter_hooks();

    }

    public function admin_panel()
    {
        $is_checked = '';
        $is_disabled = 'disabled';
        $fields_data = [
            'name_field' => '',
            'phone_field' => '',
            'email_field' => '',
            'text_field' => '',
        ];
        //check enabled form in db
        $current_form = wpcf7_get_current_contact_form();
        $current_form_id = $current_form->id();
        $current_form_data = $this->get_form_from_db($current_form_id);
        if ($current_form_data) {
            $is_checked = 'checked';
            $is_disabled = '';
            $fields_data = $current_form_data;
        }

        $string_html = "
            <h2>Передача данных из формы в CoMagic</h2>
            <fieldset>
                <legend>
                <p>
                    Здесь вы можете настроить передачу данных из формы в личный кабинет CoMagic или UIS.
                    </br>
                    В полях настройки вы можете использовать теги указанные ниже (они используются в письме).
                    </br>
                    В поля можно добавить любой текст, а так же любые поля внутри этого текста.
                    </p>
                    <p class=\"notice notice-warning notice-alt\">
                    Внимание! Любой другой текст, кроме названий полей в квадратных скобках будет передан \"как есть\".
                    </p>
                    <div class=\"tags\"></div>
                </legend>
                <table class=\"form-table wpcf7tc_settings_table\">
                    <tbody>
                        <tr>
                            <th scope=\"row\">Включить</th>
                            <td>
                                <label><input type=\"checkbox\" $is_checked name=\"wpcf7tcm-enable-comagic\">Активация передачи данных из формы в CoMagic</label>
                            </td>
                        </tr>

                        <tr>
                            <th scope=\"row\">
                                <label for=\"wpcf7-mail-recipient\">Имя</label>
                            </th>
                            <td>
                                <input $is_disabled type=\"text\" id=\"wpcf7tcm-comagic-field-name\" name=\"wpcf7tcm-field-name\" class=\"large-text code\" size=\"70\" value=\"{$fields_data['name_field']}\">
                            </td>
                        </tr>

                        <tr>
                            <th scope=\"row\">
                                <label for=\"wpcf7-mail-sender\">Телефон</label>
                            </th>
                            <td>
                                <input $is_disabled type=\"text\" id=\"wpcf7tcm-field-phone\" name=\"wpcf7tcm-field-phone\" class=\"large-text code\" size=\"70\" value=\"{$fields_data['phone_field']}\">
                            </td>
                        </tr>

                        <tr>
                            <th scope=\"row\">
                                <label for=\"wpcf7-mail-subject\">Email</label>
                            </th>
                            <td>
                                <input $is_disabled type=\"text\" id=\"wpcf7tcm-field-email\" name=\"wpcf7tcm-field-email\" class=\"large-text code\" size=\"70\" value=\"{$fields_data['email_field']}\">
                            </td>
                        </tr>

                        <tr>
                            <th scope=\"row\">
                                <label for=\"wpcf7-mail-additional-headers\">Сообщение</label>
                            </th>
                            <td>
                            <textarea $is_disabled id=\"wpcf7tcm-field-text\" name=\"wpcf7tcm-field-text\" cols=\"100\" rows=\"4\" class=\"large-text code\">{$fields_data['text_field']}</textarea>
                            </td>
                         </tr>
                    </tbody>
                </table>
            </fieldset>
            <script>
                for (const key in wpcf7tcmTags) {
                    if (wpcf7tcmTags.hasOwnProperty(key)) {
                        let span = document.createElement('span');
                        span.className = 'comagictag code';
                        span.innerText = '[' + wpcf7tcmTags[key] + ']';
                        document.querySelector('#comagic-panel legend div.tags').appendChild(span);
                    }
                }
                document.querySelector('#comagic-panel input[name=wpcf7tcm-enable-comagic]').addEventListener('change', function (e) {
                    let fields = document.querySelectorAll('#comagic-panel input[type=text], #comagic-panel textarea');
                    if (this.checked) {
                        for (const key in fields) {
                        if (fields.hasOwnProperty(key) && fields[key].hasAttribute('disabled')) {
                            fields[key].removeAttribute('disabled');
                        }
                    }
                }
                if (!this.checked) {
                    for (const key in fields) {
                        if (fields.hasOwnProperty(key) && !fields[key].hasAttribute('disabled')) {
                            fields[key].setAttribute('disabled', '');
                        }
                    }
                }
            });
        </script>";

        echo $string_html;

    }

    public function add_editor_panels($panels)
    {
        $panels['comagic-panel'] = [
            'title' => 'CoMagic',
            'callback' => [$this, 'admin_panel'],
        ];
        return $panels;
    }

    private function get_table_name()
    {
        global $wpdb;
        return $wpdb->get_blog_prefix() . 'wpcf7tcm_plugin_settings';
    }

    private function get_form_from_db($id)
    {
        global $wpdb;
        $table_name = $this->get_table_name();
        return $wpdb->get_row('SELECT * FROM ' . $table_name . ' WHERE form_id = ' . $id, ARRAY_A);
    }

    private function add_form_from_db($id, $data)
    {
        global $wpdb;
        $table_name = $this->get_table_name();
        if (!isset($data['name_field']) or !isset($data['phone_field']) or !isset($data['email_field']) or !isset($data['text_field'])) {
            return;
        }
        $data['form_id'] = $id;
        return $wpdb->insert(
            $table_name,
            $data,
            ['%s', '%s', '%s', '%s', '%d']
        );
    }

    private function update_form_from_db($id, $data)
    {
        global $wpdb;
        $table_name = $this->get_table_name();
        if (!isset($data['name_field']) or !isset($data['phone_field']) or !isset($data['email_field']) or !isset($data['text_field'])) {
            return;
        }
        return $wpdb->update(
            $table_name,
            $data,
            ['form_id' => $id],
            ['%s', '%s', '%s', '%s', '%d'],
            $where_format = null
        );
    }

    private function remove_form_from_db($id)
    {
        global $wpdb;
        $table_name = $this->get_table_name();
        return $wpdb->delete(
            $table_name,
            ['form_id' => $id]
        );
    }

    public function get_mail_tags($mailtags)
    {
        $tags = json_encode($mailtags, 16);
        echo "<script> window.wpcf7tcmTags = JSON.parse('$tags'); </script>";
        return $mailtags;
    }

    public function add_hidden_fields($hidden_fields)
    {

        $current_form = wpcf7_get_current_contact_form();
        $current_form_id = $current_form->id();
        return array_merge($hidden_fields, array(
            '_wpcf7tc_site_key' => '',
            '_wpcf7tc_visitor_id' => '',
            '_wpcf7tc_session_id' => '',
            '_wpcf7tc_hit_id' => '',
            '_wpcf7tc_consultant_server_url' => '',
        ));
    }

    public function save_settings($contact_form, $args, $context)
    {
        $data = [];
        $is_empty = true;
        $current_form = wpcf7_get_current_contact_form();
        $current_form_id = $current_form->id();
        if (isset($args['wpcf7tcm-enable-comagic'])) {
            isset($args['wpcf7tcm-field-name']) ? $data['name_field'] = $args['wpcf7tcm-field-name'] : $data['name_field'] = '';
            isset($args['wpcf7tcm-field-phone']) ? $data['phone_field'] = $args['wpcf7tcm-field-phone'] : $data['phone_field'] = '';
            isset($args['wpcf7tcm-field-email']) ? $data['email_field'] = $args['wpcf7tcm-field-email'] : $data['email_field'] = '';
            isset($args['wpcf7tcm-field-text']) ? $data['text_field'] = $args['wpcf7tcm-field-text'] : $data['text_field'] = '';
            foreach ($data as $key => $value) {
                if ($value != '') {
                    $is_empty = false;
                }
            }
            if ($is_empty) {
                return;
            }
            //var_dump($data);
            //check form in db
            if ($this->get_form_from_db($current_form_id)) {
                $this->update_form_from_db($current_form_id, $data);
            } else {
                $this->add_form_from_db($current_form_id, $data);
            }
        } else {
            $this->remove_form_from_db($current_form_id);
        }
    }

    public function enqueue_script()
    {
        wp_enqueue_script(
            'wpcf7tcm-fill-comagic-fields',
            plugin_dir_url(__FILE__) . '/includes/js/script.js',
            ['jquery'],
            2.0,
            true
        );
    }

    public function send_form($contact_form)
    {
        if (!isset($_REQUEST["_wpcf7"])) {
            return;
        }
        $form_data = $this->get_form_from_db((int) $_REQUEST["_wpcf7"]);
        if (!$form_data) {
            return;
        }
        $meta_data = [];
        $main_data = $form_data;
        isset($_REQUEST["_wpcf7tc_site_key"]) ? $meta_data['site_key'] = $_REQUEST["_wpcf7tc_site_key"] : $meta_data['site_key'] = null;
        isset($_REQUEST["_wpcf7tc_visitor_id"]) ? $meta_data['visitor_id'] = $_REQUEST["_wpcf7tc_visitor_id"] : $meta_data['visitor_id'] = null;
        isset($_REQUEST["_wpcf7tc_session_id"]) ? $meta_data['session_id'] = $_REQUEST["_wpcf7tc_session_id"] : $meta_data['session_id'] = null;
        isset($_REQUEST["_wpcf7tc_hit_id"]) ? $meta_data['hit_id'] = $_REQUEST["_wpcf7tc_hit_id"] : $meta_data['hit_id'] = null;
        isset($_REQUEST["_wpcf7tc_consultant_server_url"]) ? $meta_data['consultant_server_url'] = $_REQUEST["_wpcf7tc_consultant_server_url"] : $meta_data['consultant_server_url'] = null;
        foreach ($meta_data as $key => $value) {
            if (!$value) {
                return;
            }
        }
        foreach ($_REQUEST as $key => $value) {
            $main_data['name_field'] = str_ireplace('[' . $key . ']', $value, $main_data['name_field']);
            $main_data['phone_field'] = str_ireplace('[' . $key . ']', $value, $main_data['phone_field']);
            $main_data['email_field'] = str_ireplace('[' . $key . ']', $value, $main_data['email_field']);
            $main_data['text_field'] = str_ireplace('[' . $key . ']', $value, $main_data['text_field']);
        }

        foreach ($main_data as $key => $value) {
            if ($key != 'name_field' && $key != 'text_field' && $main_data[$key] == $form_data[$key]) {
                $main_data[$key] = '';
            }
        }
        $this->send_data($meta_data, $main_data);
    }

    private function send_data($meta_data, $main_data)
    {
        if ($main_data['name_field'] == '' and $main_data['phone_field'] == '' and $main_data['email_field'] == '' and $main_data['text_field'] == '') {
            return;
        }

        $url = $meta_data['consultant_server_url'] . 'api/add_offline_message/';
        $data = array(
            'site_key' => $meta_data['site_key'], //Значение без изменений из служебного поля site_key
            'visitor_id' => $meta_data['visitor_id'], //Значение без изменений из служебного поля visitor_id
            'hit_id' => $meta_data['hit_id'], //Значение без изменений из служебного поля hit_id
            'session_id' => $meta_data['session_id'], //Значение без изменений из служебного поля session_id
            'name' => $main_data['name_field'], //Имя клиента
            'phone' => $main_data['phone_field'], //Номер телефона
            'email' => $main_data['email_field'], //E-mail
            'text' => $main_data['text_field'], //Текст заявки
        );
        $options = array('http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded; charset=UTF-8",
            'method' => "POST",
            'content' => http_build_query($data),
        ),
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultArray = json_decode($result, true);
        //print_r($resultArray);
        if ($result === false or $resultArray['success' === false]) {
            /* Здесь могут быть действия на тот случай, если отправка заявки завершилась ошибкой. */
        }

    }

    /**
     * Add action hooks
     *
     * @return void
     */
    private function action_hooks()
    {

        add_action('wpcf7_save_contact_form', [$this, 'save_settings'], 10, 3);
        add_action('wpcf7_enqueue_scripts', [$this, 'enqueue_script'], 10, 0);
        add_action('wpcf7_before_send_mail', [$this, 'send_form'], 10, 1);

    }

    /**
     * Add filter hooks
     *
     * @return void
     */
    private function filter_hooks()
    {
        add_filter('wpcf7_editor_panels', [$this, 'add_editor_panels'], 10, 1);
        add_filter('wpcf7_collect_mail_tags', [$this, 'get_mail_tags'], 10, 1);
        add_filter('wpcf7_form_hidden_fields', [$this, 'add_hidden_fields'], 10, 1);

    }

}

/**
 * Initialize Class
 *
 * @return void
 */
function WPCF7TCM_init()
{

    if (class_exists('WPCF7')) {
        WPCF7TCM::register();
    }

}
add_action('plugins_loaded', 'WPCF7TCM_init');

/**
 * Register Plugin (Create db table)
 *
 * @return void
 */
function wpcf7tcm_activate()
{
    global $wpdb;
    $table_name = $wpdb->get_blog_prefix() . 'wpcf7tcm_plugin_settings';
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
    $sql = "CREATE TABLE {$table_name} (
	id  bigint(20) unsigned NOT NULL auto_increment,
	form_id varchar(255) NOT NULL default '',
	name_field varchar(255) NOT NULL default '',
    phone_field varchar(255) NOT NULL default '',
    email_field varchar(255) NOT NULL default '',
    text_field varchar(255) NOT NULL default '',
	PRIMARY KEY  (id)
	)
    {$charset_collate};";
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'wpcf7tcm_activate');