<?php
namespace Tests\Support;

use Tests\Support\Migrations\CreateLogTables;

trait HasLogTables
{
    protected function setUp(): void
    {
        parent::setUp();

        (new CreateLogTables())->up();
    }

    protected function tearDown(): void
    {
        (new CreateLogTables())->down();

        parent::tearDown();
    }
}
