<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class NormalizeTest extends TestCase
{
    /**
     * Checks if type is array.
     *
     * @return void
     */
    public function test_if_type_is_array(): void
    {
        $data = file_get_contents(__DIR__ . '/../exampleData.txt');
        $storageController = new \App\Http\Controllers\StorageController;

        $result = $storageController->normalize($data);

        $this->assertIsArray($result, 'The type must be array');
    }

    /**
     * Checks if the number of result indexes and file lines are the same.
     *
     * @return void
     */
    public function test_the_number_of_indexes_and_lines_is_the_same(): void
    {
        $data = file_get_contents(__DIR__ . '/../exampleData.txt');
        $storageController = new \App\Http\Controllers\StorageController;

        $result = $storageController->normalize($data);

        $this->assertCount(5, $result, 'The array must have 5 indexes equal to the file');
    }
}
