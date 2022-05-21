# viewi-ui
Viewi UI - Library with Material Components for Viewi. Inspired by Vuetify and Bootstrap.

Usage
--------

Include `ViewiUI` package:

```php
use Viewi\App;

$config = require 'config.php';
$publicConfig = require 'publicConfig.php';
include __DIR__ . '/routes.php';
App::init($config, $publicConfig);
App::use(ViewiUI\Package::class); // here
```

Add `<ViewiUI />` somewhere in your layout:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        $title | Viewi UI
    </title>
...
    <ViewiUI />
...
```

Support
--------

We all have full-time jobs and dedicate our free time to this project, and we would appreciate Your help of any kind. If you like what we are creating here and want us to spend more time on this, please consider supporting:

 - Give us a star⭐.
 - Follow us on [Twitter](https://twitter.com/viewiphp).
 - Contribute by sending pull requests.
 - Any other ideas or proposals? Please mail me voitovych.ivan.v@gmail.com.
 - Feel welcome to share this project with your friends.


License
--------

MIT License

Copyright (c) 2022-present Ivan Voitovych

Please see [LICENSE](/LICENSE) for license text


Legal
------

By submitting a Pull Request, you disallow any rights or claims to any changes submitted to the Viewi project and assign the copyright of those changes to Ivan Voitovych.

If you cannot or do not want to reassign those rights (your employment contract for your employer may not allow this), you should not submit a PR. Open an issue, and someone else can do the work.

This is a legal way of saying, "If you submit a PR to us, that code becomes ours." 99.9% of the time, that's what you intend anyways; we hope it doesn't scare you away from contributing.