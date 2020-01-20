<div class="form-group row">
                            <label for="in_property" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" name="in_property" id="in_property" class="form-control @error('in_property') is-invalid @enderror">
                                 @foreach ($properties as $property )
                                     <option value="{{$property->id}}">{{$property->name}}</option>
                                 @endforeach
                                  </select>

                                @error('in_property')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>