<div class="modal fade"
     id="edit{{ $section->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editLabel{{ $section->id }}"
     aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="editLabel{{ $section->id }}">
                    {{ trans('Dashboard/sections_trans.edit_sections') }}
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('Sections.update', $section->id)  }}" method="POST">

                @csrf
                @method('PATCH')

                <div class="modal-body">

                    <label>
                        {{ trans('Dashboard/sections_trans.name_sections') }}
                    </label>

                    <input type="hidden"
                           name="id"
                           value="{{ $section->id }}">

                    <input type="text"
                           name="name"
                           value="{{ $section->name }}"
                           class="form-control">

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        {{ trans('Dashboard/sections_trans.Close') }}
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        {{ trans('Dashboard/sections_trans.submit') }}
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
