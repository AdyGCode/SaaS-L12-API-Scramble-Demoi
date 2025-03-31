<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

pest()
    ->extend(TestCase::class)
    ->extend(RefreshDatabase::class)
    ->in('Feature');


