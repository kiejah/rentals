                        <div class="form-group row">
                            <label for="in_property_id" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" name="in_property_id" id="in_property_id" class="form-control @error('in_property_id') is-invalid @enderror" onChange="withProperty()">
                                 @foreach ($properties as $property )
                                     <option value="{{$property->id}}">{{$property->name}}</option>
                                 @endforeach
                                  </select>

                                @error('in_property_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="in_unit_id" class="col-md-4 col-form-label text-md-left">{{ __('In Unit') }}</label>

                            <div class="col-md-8" id="inUnitContent">
                                

                               
                            </div>
                        </div>