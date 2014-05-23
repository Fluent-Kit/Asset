<?php

namespace FluentKit\Asset;

use Illuminate\Support\Facades\Facade;

class Asset extends Facade{

	protected static function getFacadeAccessor() { return 'fluentkit.asset'; }

}