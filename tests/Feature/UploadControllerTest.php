<?php

namespace Tests\Feature;

use App\Models\Sale;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UploadControllerTest extends TestCase
{
    /**
     * The upload file must be successful.
     *
     * @return void
     */
    public function test_upload_file_must_be_successful()
    {
        DB::beginTransaction();

        $databaseBefore = Sale::all()->count();

        $filename = 'exampleData.txt';
        $data = file_get_contents(__DIR__ . "/../$filename", 'r');

        $file = UploadedFile::fake()->createWithContent($filename, $data);

        // Without errors.
        $this->post('/upload', [
            'file' => $file
        ])
        ->assertRedirect(route('main'))
        ->assertSessionHasNoErrors(['file', 'error']);

        // Stored data.
        $databaseAfter = Sale::all()->count();

        $this->isTrue($databaseBefore < $databaseAfter);

        $this->assertDatabaseCount('sales', count(explode("\n", trim($data))) - 1);

        DB::rollBack();
    }

    /**
     * The upload bad file must be rejected.
     *
     * @return void
     */
    public function test_upload_bad_file_must_be_rejected()
    {
        DB::beginTransaction();

        $databaseBefore = Sale::all()->count();

        $filename = 'exampleBadData.txt';
        $data = file_get_contents(__DIR__ . "/../$filename", 'r');

        $file = UploadedFile::fake()->createWithContent($filename, $data);

        // With error.
        $this->post('/upload', [
            'file' => $file
        ])
        ->assertRedirect(route('main'))
        ->assertSessionHasErrors(['error']);

        // Unsaved data.
        $databaseAfter = Sale::all()->count();

        $this->isTrue($databaseBefore === $databaseAfter);

        $this->assertDatabaseCount('sales', 0);

        DB::rollBack();
    }

    /**
     * The upload without file must be rejected.
     *
     * @return void
     */
    public function test_upload_without_file_must_be_rejected()
    {
        DB::beginTransaction();

        $databaseBefore = Sale::all()->count();

        // With error.
        $this->post('/upload')
        ->assertRedirect(route('main'))
        ->assertSessionHasErrors(['file']);

        // Unsaved data.
        $databaseAfter = Sale::all()->count();

        $this->isTrue($databaseBefore === $databaseAfter);

        $this->assertDatabaseCount('sales', 0);

        DB::rollBack();
    }
}
