## Usage

```neon
extensions:
	form.factories: WebChemistry\FormFactory\DI\FormFactoryExtension

form.factories:
	default: front
	factories:
		front: WebChemistry\FormFactory\DefaultFormFactory
		back: App\FormFactory
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
