<?php

namespace muyilongh\LaravelGii\providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use muyilongh\LaravelGii\livewire\controller\CreateControllerComponent;
use muyilongh\LaravelGii\livewire\dto\CreateDTOComponent;
use muyilongh\LaravelGii\livewire\model\CreateModelComponent;
use muyilongh\LaravelGii\livewire\model\CreateModelsSameNamespace;
use muyilongh\LaravelGii\livewire\model\GenerateModelPage;
use muyilongh\LaravelGii\livewire\request\CreateFormRequest;

class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views','gii');
        Livewire::component('generate-model-page',GenerateModelPage ::class);
        Livewire::component('create-model',CreateModelComponent::class);
        Livewire::component('create-controller',CreateControllerComponent::class);
        Livewire::component('create-request',CreateFormRequest::class);
        Livewire::component('create-dto',CreateDTOComponent::class);
        Livewire::component('create-models-same-namespace',CreateModelsSameNamespace::class);
    }
}
