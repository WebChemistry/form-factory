<?php declare(strict_types = 1);

namespace WebChemistry\FormFactory;

use Nette\Application\UI\Form;

interface FormFactoryModuleAwareInterface extends FormFactoryInterface
{

	public function create(?string $module = null): Form;

}
