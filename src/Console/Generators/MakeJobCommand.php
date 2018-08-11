<?php

namespace Touge\Modules\Console\Generators;

use Touge\Modules\Console\GeneratorCommand;

class MakeJobCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module:job
    	{slug : The slug of the module.}
    	{name : The name of the job class.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建一个基于指定模块的任务类';

    /**
     * String to store the command type.
     *
     * @var string
     */
    protected $type = 'Module job';
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/job.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     * @throws \Caffeinated\Modules\Exceptions\ModuleNotFoundException
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->module_class($this->argument('slug'), 'Jobs');
    }
}
