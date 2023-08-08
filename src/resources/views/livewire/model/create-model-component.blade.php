@php use Sindor\LaravelGii\helpers\Data; @endphp
<form wire:submit="check" action="{{ route('generate-model') }}" method="POST"
      xmlns:wire="http://www.w3.org/1999/xhtml">
    @csrf

    <div class="mt-3 model">
        <span class="h4 text-white bg-danger px-2 py-1 rounded">Model</span>
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="model_namespace" class="form-label text-white">Model namespace</label>
                            <input type="text"
                                   name="model_namespace"
                                   class="form-control form-control-lg"
                                   id="model_namespace"
                                   wire:model="model_namespace"
                                   pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                            @error('model_namespace')<span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="model_path" class="form-label text-white">Model path</label>
                            <input type="text"
                                   name="model_path"
                                   class="form-control form-control-lg"
                                   id="model_path"
                                   wire:model="model_path"
                                   pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                            @error('model_path')<span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="table" class="form-label text-white">Select table for model</label>
                            <select wire:model="table_name"
                                    wire:click="generateModelName"
                                    name="table_name"
                                    id="table"
                                    class="form-select form-select-lg">
                                @if($tableNames = Data::getAllTableNames())
                                    <option value="" disabled>-- select --</option>
                                    @foreach($tableNames as $name)
                                        <option value="{{ $name }}">{{ $name }}</option>
                                    @endforeach
                                @else
                                    <option disabled>no tables</option>
                                @endif
                            </select>
                            <input type="hidden" name="table" value="{{ $table_name }}">
                            @error('table_name')<span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="model_name" class="form-label text-white">Model name</label>
                            <input type="text"
                                   value="{{ $model_name }}"
                                   name="model_name"
                                   class="form-control form-control-lg"
                                   id="model_name"
                                   @readonly(!is_null($model_name))
                                   placeholder="Model">
                            @error('model_name')<span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="model_parent_class" class="form-label text-white">Model parent class</label>
                            <input type="text"
                                   name="model_parent_class"
                                   class="form-control form-control-lg"
                                   id="model_parent_class"
                                   wire:model="model_parent_class"
                                   pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                            @error('model_parent_class')<span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 d-flex justify-content-around flex-column">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           name="overwrite_"
                           type="checkbox"
                           role="switch"
                           wire:model="model_overwrite"
                           @checked($model_overwrite)
                           id="model_overwrite">
                    <label class="form-check-label text-white" for="model_overwrite">
                        Overwrite model if exists
                    </label>
                    <input type="hidden" name="model_overwrite" value="{{ $model_overwrite }}">
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           name="model_create_fillable"
                           type="checkbox"
                           role="switch"
                           wire:model="model_create_fillable"
                           @checked($model_create_fillable)
                           id="model_create_fillable">
                    <label class="form-check-label text-white" for="model_create_fillable">
                        Add <span class="bg-light text-black px-2 py-1">$fillable</span> property</label>
                    <input type="hidden" name="model_is_fillable" value="{{ $model_create_fillable }}">
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           name="model_create_casts"
                           type="checkbox"
                           wire:model="model_create_casts"
                           role="switch"
                           @checked($model_create_casts)
                           id="model_create_casts">
                    <label class="form-check-label text-white" for="model_create_casts">
                        Add
                        <span class="bg-light text-black px-2 py-1">$casts</span>
                        property
                    </label>
                    <input type="hidden" name="model_has_casts" value="{{ $model_create_casts }}">
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           name="model_create_relations"
                           type="checkbox"
                           role="switch"
                           wire:model="model_create_relations"
                           @checked($model_create_relations)
                           id="model_create_relations">
                    <label class="form-check-label text-white" for="model_create_relations">
                        Add relational methods if has
                    </label>
                    <input type="hidden" name="model_has_relations" value="{{ $model_create_relations }}">
                </div>
            </div>
        </div>
    </div>

    <div class="controller mt-5">
        <span class="h4 text-white bg-danger px-2 py-1 rounded">
            Resource Controller for model
        </span>
        <span class="mt-2 form-check form-switch">
            <input class="form-check-input"
                   name="add_resource_controller"
                   type="checkbox"
                   role="switch"
                   wire:model="add_resource_controller"
                   wire:click="generateControllerName"
                   @checked($add_resource_controller)
                   id="add_resource_controller">
                <label class="form-check-label text-white" for="add_resource_controller">
                    Add resource controller
                </label>
            <input type="hidden" name="add_resource_controller" value="{{ $add_resource_controller }}">
        </span>
        <div class="row mt-2">
            @if($add_resource_controller)
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="controller_namespace" class="form-label text-white">Controller namespace</label>
                                <input type="text"
                                       name="controller_namespace"
                                       class="form-control form-control-lg"
                                       id="controller_namespace"
                                       wire:model="controller_namespace"
                                       pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)">
                                @error('controller_namespace')<span
                                        class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="controller_name" class="form-label text-white">Controller name</label>
                                <input type="text"
                                       name="controller_name"
                                       class="form-control form-control-lg"
                                       id="controller_name"
                                       wire:model="controller_name">
                                @error('controller_name')<span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="controller_path" class="form-label text-white">Controller path</label>
                                <input type="text"
                                       name="controller_path"
                                       class="form-control form-control-lg"
                                       id="controller_path"
                                       wire:model="controller_path"
                                       pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                                       value="{{ $controller_path }}">
                                @error('controller_path')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="controller_parent_class" class="form-label text-white">Controller parent class</label>
                                <input type="text"
                                       name="controller_parent_class"
                                       class="form-control form-control-lg"
                                       id="controller_parent_class"
                                       wire:model="controller_parent_class"
                                       pattern="((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)"
                                       value="{{ $controller_parent_class }}">
                                @error('controller_parent_class')
                                <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 d-flex justify-content-between flex-column">
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               name="controller_overwrite_"
                               type="checkbox"
                               role="switch"
                               wire:model="controller_overwrite"
                               @checked($controller_overwrite)
                               id="controller_overwrite">
                        <label class="form-check-label text-white" for="controller_overwrite">
                            Overwrite resource controller if exists
                        </label>
                        <input type="hidden" name="controller_overwrite" value="{{ $controller_overwrite }}">
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="offset-sm-8 col-sm-4">
            <button type="button" wire:click="check" class="btn btn-info">Check form</button>
            @if($hasError)
                <button type="submit" class="btn btn-light" disabled>Generate model</button>
            @else
                <button type="submit" class="btn btn-success">Generate model</button>
            @endif
        </div>
    </div>

</form>
