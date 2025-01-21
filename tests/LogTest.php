<?php 

namespace MattYeend\Logging\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use MattYeend\Logging\Models\Log;
use Orchestra\Testbench\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            \MattYeend\Logging\LoggingServiceProvider::class,
        ];
    }

    public function it_can_create_a_log_entry()
    {
        $data = ['key' => 'value'];
        Log::log(Log::ACTION_LOGIN, $data);

        $this->assertDatabaseHas('logs', [
            'action_id' => Log::ACTION_LOGIN,
            'data' => json_encode($data),
        ]);
    }

    public function it_requires_data_to_be_array_or_null()
    {
        $this->expectException(\InvalidArgumentException::class);
        Log::log(Log::ACTION_LOGIN, 'invalid-data');
    }

    public function it_associates_logged_in_user_id_automatically()
    {
        $userId = 1; // Simulate a user ID
        $this->actingAs(factory(\App\Models\User::class)->create(['id' => $userId]));

        Log::log(Log::ACTION_LOGIN);

        $this->assertDatabaseHas('logs', [
            'logged_in_user_id' => $userId,
        ]);
    }
}