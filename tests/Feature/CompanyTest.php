<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Model\User;
use App\Model\Company;

class CompanyTest extends TestCase
{
    use DatabaseMigrations;
    
    protected $loggedUser;

    public function setUp(): void
    {
        parent::setUp();
        $this->loggedUser = factory(User::class)->create();
    }

    // CREATE
    public function testUserCannotCreateCompanyIfNotLoggedIn()
    {
        $company = factory(Company::class)->make()->toArray();
        $response = $this->post('companies', $company);
        $response->assertRedirect('login');
        
        $this->assertDatabaseMissing('companies', $company);
    }

    public function testUserCanCreateCompanyIfLoggedIn()
    {
        $company = factory(Company::class)->make()->toArray();
        $response = $this->actingAs($this->loggedUser)
            ->post('companies', $company);
        $response->assertRedirect('/');
    }

    public function testUserCanCreateCompanyIfLoggedInWithProperImage()
    {
        Storage::fake('public');

        $company = factory(Company::class)->make()->toArray();
        $logo = UploadedFile::fake()->image('image.jpg', 200, 200)->size(1024);       
        $response = $this->actingAs($this->loggedUser)
            ->json('POST', '/companies', array_merge(
                $company,
                ['logo' => $logo]
            ));
        $response->assertRedirect('companies');
    }

    // LIST
    public function testUserCannotAccessCompaniesIfNotLoggedIn()
    {
        $companies = factory(Company::class, 3)->create();
        $response = $this->get('companies');
        $response->assertRedirect('login');
    }

    public function testUserCanAccessCompaniesIfLoggedIn()
    {
        $companies = factory(Company::class, 3)->create();
        $response = $this->actingAs($this->loggedUser)
            ->get('companies');
        $response->assertSuccessful();
    }    
    
    // VIEW
    public function testUserCannotSeeCompaniesIfNotLoggedIn()
    {
        $company = factory(Company::class)->create();

        $response = $this->get('companies/' . $company->id);
        $response->assertRedirect('login');
    }

    public function testUserCanSeeCompanyDetails()
    {
        $company = factory(Company::class)->create();

        $response = $this->actingAs($this->loggedUser)
            ->get('companies/' . $company->id);
        $response->assertSuccessful();
    }

    // UPDATE
    public function testUserCannotUpdateCompanyIfNotLoggedIn()
    {
        $company = factory(Company::class)->create();
        $company->name = $company->name . '_updated';
        
        $response = $this->put('companies/' . $company->id, 
            [
                'name' => $company->name,
                'email' => $company->email,
                'logo' => $company->logo,
                'website' => $company->website
            ]);
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('companies', ['name' => $company->name]);
    }

    public function testUserCanUpdateCompanyIfLoggedIn()
    {
        $company = factory(Company::class)->create();
        $updaed_company_name = $company->name . '_updated';
        
        $response = $this->actingAs($this->loggedUser)
            ->put('companies/' . $company->id, 
            [
                'name' => $updaed_company_name,
                'email' => $company->email,
                'logo' => $company->logo,
                'website' => $company->website
            ]);
        $response->assertRedirect('/');
    }

    // DELETE
    public function testUserCannotDeleteCompanyIfNotLoggedIn()
    {
        $company = factory(Company::class)->create();
        $response = $this->delete('companies/' . $company->id);
        $response->assertRedirect('login');
        $this->assertDatabaseHas('companies', ['id' => $company->id]);
    }

    public function testUserCanDeleteCompanyIfLoggedIn()
    {
        $company = factory(Company::class)->create();
        $response = $this->actingAs($this->loggedUser)
            ->delete('companies/' . $company->id);
        $response->assertRedirect('companies');
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}