<?php

namespace muyilongh\LaravelGii\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use muyilongh\LaravelGii\helpers\Data;

class GenerateModelDTO
{
    public string|array $table_name;

    public array $columns;

    public string $name;
    public string $parent_class;
    public string $namespace;
    public string $path;
    public string $traits;
    public string $interfaces;

    public bool $overwrite;
    public bool $has_fillable;
    public bool $has_casts;
    public bool $has_relations;
    public bool $has_traits;
    public bool $has_interfaces;

    public static function fromRequest(Request $request): GenerateModelDTO
    {
        $self = new self();
        foreach ($request->get('model') as $key => $value){
            $self->$key = $value ?: "";
        }
        $self->getColumns();
        return $self;
    }

    private function getColumns(): void
    {
        if ($this->table_name) $this->columns = Data::getColumns($this->table_name);
    }
}
