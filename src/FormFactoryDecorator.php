<?php declare(strict_types = 1);

namespace WebChemistry\FormFactory;

use Nette\Application\Application;
use Nette\Application\Helpers;
use Nette\Application\UI\Form;

final class FormFactoryDecorator implements FormFactoryInterface
{

	private string|null|false $module = false;

	public function __construct(
		private FormFactoryInterface $decorate,
		private Application $application,
	)
	{
	}

	private function getModule(): ?string
	{
		if ($this->module === false) {
			if ($this->decorate instanceof FormFactoryModuleAwareInterface) {
				$requests = $this->application->getRequests();
				$request = $requests[array_key_last($requests)];

				$module = Helpers::splitName($request->getPresenterName())[0];
				$this->module = $module ?: null;
			} else {
				$this->module = null;
			}
		}

		return $this->module;
	}

	public function create(): Form
	{
		if ($module = $this->getModule()) {
			return $this->decorate->create($module);
		}

		return $this->decorate->create();
	}

}
