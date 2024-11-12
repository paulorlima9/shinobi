<?php

namespace Caffeinated\Shinobi\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class GrumpyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_true()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function it_has_necessary_tables()
    {
        $this->assertTrue(Schema::hasTable('roles'));
        $this->assertTrue(Schema::hasTable('permissions'));
        $this->assertTrue(Schema::hasTable('role_user'));
        $this->assertTrue(Schema::hasTable('permission_role'));
        $this->assertTrue(Schema::hasTable('permission_user'));
    }
}
