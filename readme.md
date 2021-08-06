## Usage

```neon
extensions:
	form.factory: WebChemistry\FormFactory\DI\FormFactoryExtension

form.factory:
	factory: FormFactory
```

```php
use WebChemistry\FormFactory\FormFactoryInterface;

class FormService
{

	private FormFactoryInterface $formFactory;

	public function __construct(FormFactoryInterface $formFactory)
	{
		$this->formFactory = $formFactory;
	}

	public function createForm()
	{
		$form = $this->formFactory->create();

		// ...

		return $form;
	}

}
```
