<?php

namespace muyilongh\LaravelGii\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use muyilongh\LaravelGii\DTOs\GenerateControllerDTO;
use muyilongh\LaravelGii\DTOs\GenerateDTO;
use muyilongh\LaravelGii\DTOs\GenerateFormRequestDTO;
use muyilongh\LaravelGii\DTOs\GenerateModelDTO;
use muyilongh\LaravelGii\DTOs\GenerateSameModelsDTO;
use muyilongh\LaravelGii\helpers\Data;
use muyilongh\LaravelGii\services\controller\GenerateControllerService;
use muyilongh\LaravelGii\services\dto\GenerateDTOService;
use muyilongh\LaravelGii\services\model\GenerateModelService;
use muyilongh\LaravelGii\services\model\GenerateSameModelsService;
use muyilongh\LaravelGii\services\request\GenerateFormRequestService;

class ModelController extends Controller
{
    public function __construct(
        public GenerateModelService       $modelService,
        public GenerateControllerService  $controllerService,
        public GenerateFormRequestService $formRequestService,
        public GenerateDTOService         $dtoService,
    )
    {
    }

    public function createModel(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view("gii::model.create-model");
    }

    public function generateModel(Request $request): RedirectResponse
    {
        $this->modelService->data = GenerateModelDTO::fromRequest($request);
        $this->modelService->generateModel();
        if ($request->input('addResourceController')) {
            $this->controllerService->data = GenerateControllerDTO::fromRequest($request);
            $this->controllerService->data->setAsResourceController($this->modelService->data);
            $this->controllerService->generateController();
        }
        if ($request->input('addRequest')) {
            $this->formRequestService->data = GenerateFormRequestDTO::fromRequest($request);
            $this->formRequestService->data->table_name = $this->modelService->data->table_name;
            $this->formRequestService->generateFormRequest();
        }
        if ($request->input('addDTO')) {
            $this->dtoService->data = GenerateDTO::fromRequest($request);
            $this->dtoService->data->table_name = $this->modelService->data->table_name;
            $this->dtoService->data->model_namespace = $this->modelService->data->namespace;
            $this->dtoService->data->model_name = $this->modelService->data->name;
            $this->dtoService->generateDTO();
        }
        return redirect()->route('create-model');
    }

    public function createModelsSameNamespace(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view("gii::model.create-models-same-namespace");
    }

    public function generateModelsSameNamespace(Request $request): RedirectResponse
    {
        $service = new GenerateSameModelsService(GenerateSameModelsDTO::fromRequest($request));
        $service->generateModels();
        return redirect()->route('create-models-same-namespace');
    }
}
