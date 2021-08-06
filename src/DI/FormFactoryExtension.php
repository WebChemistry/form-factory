<?php declare(strict_types = 1);

namespace WebChemistry\FormFactory\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use WebChemistry\FormFactory\FormFactoryComposite;
use WebChemistry\FormFactory\FormFactoryDecorator;
use WebChemistry\FormFactory\FormFactoryInterface;

final class FormFactoryExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'factory' => Expect::string()->required(),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig();

		$factory = $builder->addDefinition($this->prefix('formFactory'))
			->setType(FormFactoryInterface::class)
			->setFactory($config->factory)
			->setAutowired(false);

		$builder->addDefinition($this->prefix('decorator'))
			->setType(FormFactoryInterface::class)
			->setFactory(FormFactoryDecorator::class, [$factory]);
	}

}
