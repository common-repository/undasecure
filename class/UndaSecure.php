<?php

Class UndaSecure
{
    private $name = 'UndaSecure';
    private $htaccess = array();
    private $root_htaccess;
    private $uploads_htaccess;
    private $cleanup;

    public function __construct()
    {
        if (!is_writable(ABSPATH)) {
            die('ERROR: It looks like your ROOT folder is not writable. Change it and try again.');
        }

        if (!is_writable(WP_CONTENT_DIR . '/uploads')) {
            die('ERROR: It looks like your UPLOADS folder is not writable. Change it and try again.');
        }

        $this->root_htaccess = ABSPATH . '.htaccess';
        $this->uploads_htaccess = WP_CONTENT_DIR . '/uploads/.htaccess';

        $this->htaccess = array(
            'root' => array(
                'file' => $this->root_htaccess,
                'rules' => UNDASECURE_PLUGIN_PATH . '/includes/.root_rules',
            ),
            'optimizations' => array(
                'file' => $this->root_htaccess,
                'rules' => UNDASECURE_PLUGIN_PATH . '/includes/.optimizations',
            ),
            'uploads' => array(
                'file' => $this->uploads_htaccess,
                'rules' => UNDASECURE_PLUGIN_PATH . '/includes/.upload_rules',
            )
        );
        $this->cleanup = array(
            ABSPATH . 'readme.html',
            ABSPATH . 'wp-config-sample.php',
            ABSPATH . 'licencia.txt',
            ABSPATH . 'license.txt',
        );

    }

    public function activate()
    {
        $this->add_rules();
        $this->flush_rules();
    }

    public function deactivate()
    {
        $this->remove_rules();
        $this->flush_rules();
    }

    public function update($options, $this_plugin)
    {
        if ($options['action'] == 'update' && $options['type'] == 'plugin' && isset($options['plugins'])) {
            foreach ($options['plugins'] as $plugin) {
                if ($plugin == $this_plugin) {
                    $this->activate();
                }
            }
        }
        if ($options['action'] == 'update' && $options['type'] == 'core') {
            foreach ($this->cleanup as $clean) {
                unlink($clean);
            }
        }
    }

    private function add_rules()
    {
        foreach ($this->htaccess as $key => $element) {
            $this->modify_htaccess($key, $element['file'], file_get_contents($element['rules']));
        }
    }

    private function remove_rules()
    {
        foreach ($this->htaccess as $key => $element) {
            $this->modify_htaccess($key, $element['file'], "");
        }
    }

    private function modify_htaccess($marker, $file, $rules)
    {
        global $wp_rewrite;
        if ((!file_exists($file) && $wp_rewrite->using_mod_rewrite_permalinks()) || is_writable($file)) {
            if (got_mod_rewrite())
                return insert_with_markers($file, $this->name . strtoupper($marker), $rules);
        }
        return false;
    }

    private function flush_rules()
    {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }
}