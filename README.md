# Read Time Bundle for Sculpin

This [Sculpin](https://sculpin.io/) bundle calculates an estimated read time for posts accessible via a post attribute.

## Installation

Add `mdwheele/sculpin-readtime` as a requirement to your `sculpin.json` (if using Sculpin as a phar) or `composer.json` (if using Sculpin via Composer).

Then, add the bundle to your `SculpinKernel`. For example:

``` php
<?php

use Blog\Sculpin\Bundle\ReadTimeBundle\BlogSculpinReadTimeBundle;
use Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel;

class SculpinKernel extends AbstractKernel
{
    protected function getAdditionalSculpinBundles()
    {
        return [
            MdwheeleSculpinReadTimeBundle::class
        ];
    }
}
```

## Usage

Read time is available as a property called `read_time` on the `page` object.

```
{{ page.read_time }}
```

For more information, see the Sculpin [Configuration](https://sculpin.io/documentation/extending-sculpin/configuration/) documentation.
