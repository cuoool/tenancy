<?php

/*
 * This file is part of the tenancy/tenancy package.
 *
 * (c) Daniël Klabbers <daniel@klabbers.email>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see http://laravel-tenancy.com
 * @see https://github.com/tenancy
 */

namespace Tenancy\Tests\Unit\Identification\Events;

use Tenancy\Identification\Events\Configuring;
use Tenancy\Tests\TestCase;

class ConfiguringTest extends TestCase
{
    /**
     * @test
     */
    public function dispatches_event()
    {
        $this->expectsEvents(Configuring::class);

        $this->environment->getTenant();
    }
}
