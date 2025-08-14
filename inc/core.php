<?php
    define("TEMPLATE_DIR", get_bloginfo('template_directory'));
  
    function assets($path)
    {
        if (!$path) {
            return;
        }

        echo get_template_directory_uri() . '/assets/dist/' . $path;
    }

    function starts_with($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle != '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }
        return false;
    }
    
    function mix($path, $manifestDirectory = '')
    {
        if (!$manifestDirectory) {
            $manifestDirectory = "assets/dist/";
        }

        static $manifest;
        if (!starts_with($path, '/')) {
            $path = "/{$path}";
        }
        if ($manifestDirectory && !starts_with($manifestDirectory, '/')) {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        $rootDir = dirname(__FILE__, 2);
        if (!$manifest) {
            $manifestPath =  $rootDir . $manifestDirectory . 'mix-manifest.json';
            if (!file_exists($manifestPath)) {
                throw new Exception('The Mix manifest does not exist.');
            }
            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (starts_with($manifest[$path], '/')) {
            $manifest[$path] = ltrim($manifest[$path], '/');
        }

        $path = $manifestDirectory . $manifest[$path];

        return get_template_directory_uri() . $path;
    }



 