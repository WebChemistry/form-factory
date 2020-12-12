<?php declare(strict_types = 1);

namespace WebChemistry\FormFactory;

use Nette\Application\UI\Form;

interface FormFactoryInterface
{

	public function create(): Form;

}
