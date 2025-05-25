<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Configure SQLite for testing
        Config::set('database.default', 'sqlite');
        Config::set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Run migrations
        Artisan::call('migrate:fresh');
        
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        
        // Create an admin user for testing
        $this->admin = User::create([
            'username' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password')
        ]);
        $this->admin->assignRole('admin');
    }

    public function test_admin_can_access_categories_page()
    {
        $response = $this->actingAs($this->admin)
            ->get('/categories');

        $response->assertStatus(200);
        $response->assertViewIs('pages.category.index');
    }

    public function test_admin_can_create_new_category()
    {
        $categoryData = [
            'name' => 'Test Category'
        ];

        $response = $this->actingAs($this->admin)
            ->post('/categories/store', $categoryData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', $categoryData);
    }

    public function test_cannot_create_duplicate_category()
    {
        // First create a category
        Category::create(['name' => 'Test Category']);

        // Try to create the same category again
        $response = $this->actingAs($this->admin)
            ->post('/categories/store', [
                'name' => 'Test Category'
            ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_category_without_name()
    {
        $response = $this->actingAs($this->admin)
            ->post('/categories/store', [
                'name' => ''
            ]);

        $response->assertStatus(422);
    }
} 