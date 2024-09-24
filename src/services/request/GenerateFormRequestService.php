<?php

namespace muyilongh\LaravelGii\services\request;

use muyilongh\LaravelGii\DTOs\GenerateFormRequestDTO;
use muyilongh\LaravelGii\helpers\Request;
use muyilongh\LaravelGii\helpers\Universal;

class GenerateFormRequestService
{

    public function __construct(public GenerateFormRequestDTO $data)
    {
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->data->namespace,
            'CLASS_NAME' => $this->data->name,
            'PARENT_CLASS' => $this->data->parent_class,
            'AUTH' => $this->getAuth(),
            'VALIDATION' => $this->getValidations(),
        ];
    }

    private function getContents(): array|bool|string
    {
        return Universal::getReadyContent(
            Universal::getStubPath('request','form-request'),
            $this->getStubVariables()
        );
    }

    public function generateFormRequest(): void
    {
        $path = Universal::makeFileWithDirectory($this->data->path, $this->data->name);
        Universal::putContent($path, $this->getContents(), $this->data->overwrite);
    }

    private function getAuth(): string
    {
        return Request::authorization($this->data->is_authorization);
    }

    private function getValidations(): string
    {
        if ($this->data->is_generation_validation)
            return Request::getValidation($this->data->table_name);
        return "";
    }
}
