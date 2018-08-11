<?php

namespace Touge\Modules\Console;

use Illuminate\Console\GeneratorCommand as LaravelGeneratorCommand;
use Illuminate\Support\Str;

use Caffeinated\Modules\Exceptions\ModuleNotFoundException;
use Caffeinated\Modules\Facades\Module;

abstract class GeneratorCommand extends LaravelGeneratorCommand
{
    /**
     * Parse the name and format according to the root namespace.
     *
     * @param string $name
     *
     * @return string
     */
    protected function qualifyClass($name)
    {
        $rootNamespace = config('modules.namespace');

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }

    /**
     * @param string $name
     * @return string
     * @throws \Caffeinated\Modules\Exceptions\ModuleNotFoundException
     */
    protected function getPath($name)
    {
        $slug = $this->argument('slug');
        $module = Module::where('slug', $slug);

        // take everything after the module name in the given path (ignoring case)
        $key = array_search(strtolower($module['basename']), explode('\\', strtolower($name)));
        if ($key === false) {
            $newPath = str_replace('\\', '/', $name);
        } else {
            $newPath = implode('/', array_slice(explode('\\', $name), $key + 1));
        }

        return module_path($slug, "$newPath.php");
    }


    /**
     * @param $slug
     * @param $class
     * @return string
     * @throws ModuleNotFoundException
     */
    function module_class($slug, $class)
    {
        $module = Module::where('slug', $slug);

        if ( is_null($module) ) {
            throw new ModuleNotFoundException($slug);
        }

        $namespace = config('modules.namespace').$module['basename'];

        return "{$namespace}\\{$class}";
    }
}
