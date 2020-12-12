<?php declare(strict_types = 1);

namespace WebChemistry\FormFactory;

use Nette\Application\UI\Form;

final class DefaultFormFactory implements FormFactoryInterface
{

	public function create(): Form
	{
		return new Form();
	}

}
