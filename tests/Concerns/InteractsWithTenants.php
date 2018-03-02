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

namespace Tenancy\Tests\Concerns;

use Tenancy\Tests\Mocks\Tenant;

trait InteractsWithTenants
{
    protected function tenant(): Tenant
    {
        return factory(Tenant::class)->create();
    }
}
