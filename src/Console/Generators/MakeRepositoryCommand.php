<?php

namespace Touge\Modules\Console\Generators;

use Touge\Modules\Console\GeneratorCommand;

class MakeRepositoryCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:repository
    	{slug : The slug of the module.}
    	{name : The name of the repository class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建一个基于指定模块的数据仓库类';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Module repository';
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/repository.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     * @throws \Caffeinated\Modules\Exceptions\ModuleNotFoundException
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->module_class($this->argument('slug'), 'Repositories');
    }
}
