<!-- Modal -->
<div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    {{ trans('Services.edit_Service') }}
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('Service.update', 'test') }}" method="post">

                @method('PATCH')
                @csrf

                <div class="modal-body">

                    <label for="name{{ $service->id }}">
                        {{ trans('Services.name') }}
                    </label>

                    <input type="text"
                           name="name"
                           id="name{{ $service->id }}"
                           value="{{ old('name', $service->name) }}"
                           class="form-control">

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="hidden"
                           name="id"
                           value="{{ $service->id }}">

                    <label for="price{{ $service->id }}">
                        {{ trans('Services.price') }}
                    </label>

                    <input type="number"
                           name="price"
                           id="price{{ $service->id }}"
                           value="{{ old('price', $service->price) }}"
                           class="form-control">

                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="description{{ $service->id }}">
                        {{ trans('Services.description') }}
                    </label>

                    <textarea class="form-control"
                              name="description"
                              id="description{{ $service->id }}"
                              rows="5">{{ old('description', $service->description) }}</textarea>

                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="status{{ $service->id }}">
                            {{ trans('doctors.Status') }}
                        </label>

                        <select class="form-control"
                                id="status{{ $service->id }}"
                                name="status">

                            <option value="1" {{ old('status', $service->status) == 1 ? 'selected' : '' }}>
                                {{ trans('doctors.Enabled') }}
                            </option>

                            <option value="0" {{ old('status', $service->status) == 0 ? 'selected' : '' }}>
                                {{ trans('doctors.Not_enabled') }}
                            </option>

                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        {{ trans('Dashboard/sections_trans.Close') }}
                    </button>

                    <button type="submit" class="btn btn-primary">
                        {{ trans('Dashboard/sections_trans.submit') }}
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
