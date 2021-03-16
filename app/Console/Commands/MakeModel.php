<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeModel extends GeneratorCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
    protected $name = 'make:model';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a custom model with version';

	/**
	 * The type of class being generated.
	 *
	 * @var string
	 */
	protected $type = 'Model';

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('StubModel', $this->argument('name'), $stub);
    }

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return  app_path() . '/Console/Commands/Stubs/make-model.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . "/Models". "/" .  $this->argument('version') ."/" . $this->argument('type');
	}

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Nome da Model'],
            ['version', InputArgument::REQUIRED, 'Versão da Model'],
            ['type', InputArgument::REQUIRED, 'Tipo da Model']
        ];
    }
}
