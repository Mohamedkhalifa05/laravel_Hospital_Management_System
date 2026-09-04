<!-- Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('Services.add_Service') }}
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('Service.store') }}" method="POST" autocomplete="off">
                @csrf

                <div class="modal-body">

                    {{-- Name --}}
                    <div class="form-group">
                        <label for="name">
                            {{ trans('Services.name') }}
                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Price --}}
                    <div class="form-group">
                        <label for="price">
                            {{ trans('Services.price') }}
                        </label>

                        <input type="number"
                               name="price"
                               id="price"
                               value="{{ old('price') }}"
                               class="form-control @error('price') is-invalid @enderror">

                        @error('price')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Description --}}
                    <div class="form-group">
                        <label for="description">
                            {{ trans('Services.description') }}
                        </label>

                        <textarea name="description"
                                  id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="5">{{ old('description') }}</textarea>

                        @error('description')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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


{{-- Open Modal again when validation fails --}}
{{-- @section('js')

@if(session('open_service_modal'))
<script>
    $(document).ready(function () {
        $('#addServiceModal').modal('show');
    });
</script>
@endif

@endsection --}}
