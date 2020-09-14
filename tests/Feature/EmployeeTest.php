<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Model\User;
use App\Model\Employee;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $loggedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->loggedUser = factory(User::class)->create();
    }

    // CREATE
    public function testUserCannotCreateEmployeeIfNotLoggedIn()
    {
        $employee = factory(Employee::class)->make()->toArray();
        $response = $this->post('employees', $employee);
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('employees', $employee);
    }

    public function testUserCanCreateEmployeeIfLoggedIn()
    {
        $employee = factory(Employee::class)->make()->toArray();
        $response = $this->actingAs($this->loggedUser)
            ->post('employees', $employee);
        $response->assertRedirect('employees');
        $this->assertDatabaseHas('employees', $employee);
    }

    // LIST
    public function testUserCannotAccessEmployeesIfNotLoggedIn()
    {
        $employees = factory(Employee::class, 3)->create();
        $response = $this->get('employees');
        $response->assertRedirect('login');
    }

    public function testUserCanAccessEmployeesIfLoggedIn()
    {
        $employees = factory(Employee::class, 3)->create();
        $response = $this->actingAs($this->loggedUser)
            ->get('employees');
        $response->assertSuccessful();
    }    
    
    // VIEW
    public function testUserCannotSeeEmployeesIfNotLoggedIn()
    {
        $employee = factory(Employee::class)->create();

        $response = $this->get('employees/' . $employee->id);
        $response->assertRedirect('login');
    }

    public function testUserCanSeeEmployeeDetails()
    {
        $employee = factory(Employee::class)->create();

        $response = $this->actingAs($this->loggedUser)
            ->get('employees/' . $employee->id);
        $response->assertSuccessful();
    }

    // UPDATE
    public function testUserCannotUpdateEmployeeIfNotLoggedIn()
    {
        $employee_master = $employee = factory(Employee::class)->create();
        $employee->first_name = $employee->first_name . '_updated';
        
        $response = $this->put('employees/' . $employee->id, 
            [
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'company_id' => $employee->company_id,
                'email' => $employee->email,
                'phone' => $employee->phone
            ]);
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('employees', ['first_name' => $employee->first_name]);
    }

    public function testUserCanUpdateEmployeeIfLoggedIn()
    {
        $employee = factory(Employee::class)->create();
        $employee->first_name = $employee->first_name . '_updated';
        
        $response = $this->actingAs($this->loggedUser)
            ->put('employees/' . $employee->id, 
            [
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'company_id' => $employee->company_id,
                'email' => $employee->email,
                'phone' => $employee->phone
            ]);
        $response->assertRedirect('employees');
        $this->assertDatabaseHas('employees', ['first_name' => $employee->first_name]);
    }

    // DELETE
    public function testUserCannotDeleteEmployeeIfNotLoggedIn()
    {
        $employee = factory(Employee::class)->create();
        $response = $this->delete('employees/' . $employee->id);
        $response->assertRedirect('login');
        $this->assertDatabaseHas('employees', ['id' => $employee->id]);
    }

    public function testUserCanDeleteEmployeeIfLoggedIn()
    {
        $employee = factory(Employee::class)->create();
        $response = $this->actingAs($this->loggedUser)
            ->delete('employees/' . $employee->id);
        $response->assertRedirect('employees');
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}