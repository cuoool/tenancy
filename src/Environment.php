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

namespace Tenancy;

use Illuminate\Contracts\Foundation\Application;
use Tenancy\Contracts\IdentifiableAsTenant;

class Environment
{
    /**
     * @var IdentifiableAsTenant
     */
    protected $tenant;

    protected $identified = false;

    /**
     * @var Application
     */
    private $app;

    protected static $identificationResolver;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function setTenant(IdentifiableAsTenant $tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(bool $refresh = false): ?IdentifiableAsTenant
    {
        if (! $refresh || ! $this->identified) {
            $this->setTenant(
                $this->app->call(static::getIdentificationResolver())
            );

            $this->identified = true;
        }

        return $this->tenant;
    }

    public static function getIdentificationResolver()
    {
        if (! static::$identificationResolver) {
            static::$identificationResolver = resolve(Identification\TenantResolver::class);
        }

        return static::$identificationResolver;
    }

    public static function setIdentificationResolver($resolver)
    {
        static::$identificationResolver = $resolver;
    }
}