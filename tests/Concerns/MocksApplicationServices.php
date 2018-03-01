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

use Illuminate\Contracts\Events\Dispatcher;
use Mockery;

/**
 * Trait MocksApplicationServices
 *
 * @package Tenancy\Tests\Concerns
 *
 * @info This trait has been overloaded in order to allow us to catch the "until" methods
 *       of the event dispatcher as well.
 */
trait MocksApplicationServices
{
    /**
     * All of the fired events.
     *
     * @var array
     */
    protected $firedEvents = [];
    /**
     * Mock the event dispatcher so all events are silenced and collected.
     *
     * @return $this
     */
    protected function withoutEvents()
    {
        $mock = Mockery::mock(Dispatcher::class)->shouldIgnoreMissing();
dump("-- before should receive: " . get_class($this));
        $mock->shouldReceive('fire', 'dispatch', 'until')->andReturnUsing(function ($called) {
            $this->firedEvents[] = $called;
            dump("-- return should receive: " . get_class($this) . " (event: ".get_class($called).")");
        });

        $this->swap('events', $mock);

        return $this;
    }
}
