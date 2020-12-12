<?php declare(strict_types = 1);

namespace WebChemistry\FormFactory\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use WebChemistry\FormFactory\FormFactoryComposite;

final class FormFactoryExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'default' => Expect::string()->required(),
			'factories' => Expect::arrayOf(Expect::anyOf(Expect::string(), Expect::type(Statement::class))),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		$composite = $builder->addDefinition($this->prefix('formFactoryComposite'))
			->setFactory(FormFactoryComposite::class, [$config->default]);

		foreach ($config->factories as $name => $factory) {
			$def = $builder->addDefinition($this->prefix('factory.' . $name))
				->setFactory($factory)
				->setAutowired(false);

			$composite->addSetup('addFactory', [$name, $def]);
		}
	}

}
