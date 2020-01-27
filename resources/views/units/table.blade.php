<table class="table responsive">
                        <thead>
                            <th>Property</th>
                            <th>Unit/House No.</th>
                            <th>Unit Type</th>
                            <th>Rent Charge</th>
                            <th>Ocupancy</th>
                            <th>Tenant Name</th>
                            <th><small><small>Add <br>Tenant</small></small></th>
                            <th><small>View</small></th>
                            <th><small>Edit</small></th>
                            <th><small>Delete</small></th>
                            
                        </thead>
                        <tbody>
                         @if (count($units) >=1 )
                        
                        @foreach ($units as $unit )
                        
                            <td>{{$unit->property->name}}</td>
                            <td>{{$unit->unit_house_number}}</td>
                            <td><b>{{$unit->unitType->unit_type_name}}</b>
                                <small>{{$unit->unitType->standard}}</small>
                            </td>
                            <td>{{$unit->rent_charge}}</td>
                            <td>{{$unit->occupancy}}</td>
                            <td><b>{{$unit->tenant['surname']." ".$unit->tenant['firstname'] }}</b></td>
                            
                            <td><small>
                                @if($unit->tenant_id < 1)
                                <a class="text-secondary" href="{{route('add-unit-tenant',['id'=>$unit->id])}}"><i class="fa fa-plus"></i>
                                @endif
                                
                            </a></small></td>
                            <td><small><a href="/units/{{$unit->id}}"><i class="fa fa-eye"></i></a></small></td>
                            <td><small><a class="text-success" href="/units/{{$unit->id}}/edit"><i class="fa fa-pencil"></i></a></small></td>
                            <td><small><a class="text-danger" href="#"><i class="fa fa-close"></i></a></small></td>
                        </tr>
                            
                        @endforeach
                        
                    @else
                        <tr>
                         <td colspan="5">No Units Entered</td>
                        </tr>
                    @endif
                    <tbody>
                    </table>