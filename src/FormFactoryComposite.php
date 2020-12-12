<?php declare(strict_types = 1);

namespace WebChemistry\FormFactory;

use LogicException;
use Nette\Application\Application;
use Nette\Application\Helpers;
use Nette\Application\UI\Form;

class FormFactoryComposite implements FormFactoryInterface
{

	private Application $application;

	private string $default;

	private FormFactoryInterface $factory;

	/** @var FormFactoryInterface[] */
	private array $factories = [];

	public function __construct(string $default, Application $application)
	{
		$this->default = $default;
		$this->application = $application;
	}

	public function addFactory(string $module, FormFactoryInterface $factory): void
	{
		$this->factories[$module] = $factory;
	}

	protected function getModule(): ?string
	{
		$requests = $this->application->getRequests();

		$request = $requests[array_key_last($requests)];

		$module = strtolower(Helpers::splitName($request->getPresenterName())[0]);

		return $module ?: $this->default;
	}

	protected function getFactory(): FormFactoryInterface
	{
		if (!isset($this->factory)) {
			$module = $this->getModule();
			if (!isset($this->factories[$module])) {
				$module = $this->default;
			}

			if (!isset($this->factories[$module])) {
				throw new LogicException(sprintf('Factory for module %s not exists', $module));
			}

			$this->factory = $this->factories[$module];
		}

		return $this->factory;
	}

	public function create(): Form
	{
		return $this->getFactory()->create();
	}

}
