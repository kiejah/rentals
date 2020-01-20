                        <div class="form-group row">
                            <label for="in_property_id" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>


                            <div class="col-md-8">
                                    <label  class="col-form-label text-md-left">{{ __($property->name) }}</label>
                                    <input id="in_property_id" type="hidden" class="form-control" name="in_property_id" value="{{ $property->id}}" required  readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="in_unit_id" class="col-md-4 col-form-label text-md-left">{{ __('In Unit') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" name="in_unit_id" id="in_unit_id" class="form-control @error('in_unit_id') is-invalid @enderror" required>
                                <option value="">Select Unit/House No </option>
                                 @foreach ($units as $unit)
                                     <option value="{{$unit->id}}">{{$unit->unit_house_number}}</option>
                                 @endforeach
                                  </select>

                                @error('in_unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>