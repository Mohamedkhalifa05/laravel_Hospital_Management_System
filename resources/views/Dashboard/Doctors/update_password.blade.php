<!-- Modal -->
<div class="modal fade"
     id="update_password{{ $doctor->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('doctors.update_password') }}
                    {{ $doctor->name }}
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            <form action="{{ route('update_password') }}"
                  method="POST"
                  autocomplete="off">

                @csrf

                <div class="modal-body">

                    {{-- Password --}}
                    <div class="form-group">

                        <label for="password{{ $doctor->id }}">
                            {{ trans('doctors.new_password') }}
                        </label>

                        <input type="password"
                               class="form-control"
                               id="password{{ $doctor->id }}"
                               name="password">
                @if(
               session('open_password_modal') == $doctor->id &&
                session('password_validation_errors.password')
                 )
                 <span class="text-danger password-error">
                    {{ session('password_validation_errors.password')[0] }}
              </span>
                 @endif

                    </div>


                    {{-- Confirm Password --}}
                    <div class="form-group">

                        <label for="password_confirmation{{ $doctor->id }}">
                            {{ trans('doctors.confirm_password') }}
                        </label>

                        <input type="password"
                               class="form-control"
                               id="password_confirmation{{ $doctor->id }}"
                               name="password_confirmation">

                      @if(
    session('open_password_modal') == $doctor->id &&
    session('password_validation_errors.password_confirmation')
)
    <span class="text-danger password-error">
        {{ session('password_validation_errors.password_confirmation')[0] }}
    </span>
@endif

                    </div>


                    <input type="hidden"
                           name="id"
                           value="{{ $doctor->id }}">

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
