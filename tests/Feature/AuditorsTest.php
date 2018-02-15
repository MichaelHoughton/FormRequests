<?php

namespace Tests\Feature;

use App\Auditor;
use Tests\TestCase;

class AuditorsTest extends TestCase
{
    /** @test */
    public function a_user_can_access_the_auditors_page()
    {
        $this->get('/auditors')
            ->assertStatus(200)
            ->assertSee('Manage Auditors');
    }

    /** @test */
    public function a_user_can_see_the_create_auditor_page()
    {
        $this->get('/auditors/create')
            ->assertStatus(200)
            ->assertSee('Add an Auditor');
    }

    /** @test */
    public function a_user_leaves_required_fields_blank_when_creating_an_auditor()
    {
        $requiredFields = [
            'name',
            'company'
        ];

        $attributes = $this->attributes('Auditor');
        foreach ($requiredFields as $requiredField) {
            $attributes[$requiredField] = null;
        }

        $this->withExceptionHandling()
            ->post('/auditors', $attributes)
            ->assertStatus(302)
            ->assertSessionHasErrors($requiredFields);
    }

    /** @test */
    public function a_user_creates_an_auditor()
    {
        $attributes = $this->attributes('Auditor');

        $this->post('/auditors', $attributes)
            ->assertStatus(302)
            ->assertSessionHas('success')
            ->assertRedirect('/auditors');

        $auditor = Auditor::latest('id')->first();

        $this->assertEquals($attributes['name'], $auditor->name);
        $this->assertEquals($attributes['company'], $auditor->company);

        // lets check that we can now see this auditor on the auditors page
        $this->get('/auditors')
            ->assertStatus(200)
            ->assertSee(e($attributes['name']));
    }

    /** @test */
    public function a_user_creates_an_auditor_with_an_address()
    {
        $attributes = $this->attributes('Auditor');
        $attributes['address'] = $this->attributes('Address');

        $this->post('/auditors', $attributes)
            ->assertStatus(302)
            ->assertSessionHas('success')
            ->assertRedirect('/auditors');

        $auditor = Auditor::latest('id')->first();
        $this->assertNotNull($auditor->address);
        $this->assertEquals($attributes['address']['address_1'], $auditor->address->address_1);
    }

    /** @test */
    public function a_user_can_view_an_auditor()
    {
        $auditor = $this->create('Auditor');

        $this->get('/auditors/'.$auditor->id)
            ->assertStatus(200)
            ->assertSee(e($auditor->name));
    }

    /** @test */
    public function a_user_can_edit_an_auditor()
    {
        $auditor = $this->create('Auditor');

        $this->get('/auditors/'.$auditor->id.'/edit')
            ->assertStatus(200)
            ->assertSee(e($auditor->name));
    }

    /** @test */
    public function a_user_updates_an_auditor()
    {
        $auditor = $this->create('Auditor');

        $attributes = $this->attributes('Auditor');

        $this->patch('/auditors/'.$auditor->id, $attributes)
            ->assertStatus(302)
            ->assertSessionHas('success')
            ->assertRedirect('/auditors');

        $auditor = Auditor::find($auditor->id);
        $this->assertEquals($attributes['name'], $auditor->name);
        $this->assertEquals($attributes['company'], $auditor->company);

        // lets check that we can now see this auditor on the auditors page
        $this->get('/auditors')
            ->assertStatus(200)
            ->assertSee(e($attributes['name']));
    }

    /** @test */
    public function a_user_updates_an_auditor_an_adds_an_address()
    {
        $auditor = $this->create('Auditor');

        $attributes = $this->attributes('Auditor');
        $attributes['address'] = $this->attributes('Address');

        $this->patch('/auditors/'.$auditor->id, $attributes)
            ->assertStatus(302)
            ->assertSessionHas('success')
            ->assertRedirect('/auditors');

        $auditor = Auditor::find($auditor->id);
        $this->assertNotNull($auditor->address);
        $this->assertEquals($attributes['address']['address_1'], $auditor->address->address_1);
    }

    /** @test */
    public function a_user_updates_an_auditor_an_removes_an_address()
    {
        $auditor = $this->create('Auditor');
        $auditor = $this->create('Address', [
            'auditor_id' => $auditor->id,
        ]);

        $attributes = $this->attributes('Auditor');
        $attributes['address'] = $this->attributes('Address', ['address_1' => null]);

        $this->patch('/auditors/'.$auditor->id, $attributes)
            ->assertStatus(302)
            ->assertSessionHas('success')
            ->assertRedirect('/auditors');

        $auditor = Auditor::find($auditor->id);
        $this->assertNull($auditor->address);
    }

    /** @test */
    public function a_user_deletes_an_auditor()
    {
        $auditor = $this->create('Auditor');

        $this->delete('/auditors/'.$auditor->id)
            ->assertStatus(302)
            ->assertSessionHas('success')
            ->assertRedirect('/auditors');

        $deleted = Auditor::find($auditor->id);
        $this->assertNull($deleted);

        // lets check that we cannot see this auditor on the auditors page
        $this->get('/auditors')
            ->assertStatus(200)
            ->assertDontSee(e($auditor->name));

        // lets check that the auditor was soft deleted
        $auditor = Auditor::withTrashed()->find($auditor->id);
        $this->assertNotNull($auditor);
    }
}
