
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="table-th-wrapper" scope="col">Monday</th>
                                    <th class="table-th-wrapper" scope="col">Tuesday</th>
                                    <th class="table-th-wrapper" scope="col">Wednesday</th>
                                    <th class="table-th-wrapper" scope="col">Thursday</th>
                                    <th class="table-th-wrapper" scope="col">Friday</th>
                                    <th class="table-th-wrapper" scope="col">Saturday</th>
                                    <th class="table-th-wrapper" scope="col">Sunday</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                             @foreach($shedule as $key=>$shedule1)
                             <tr>
                             <?php for ($i=0; $i <=6 ; $i++) {?> 
                                @if($i<=4)
                                @if(isset($shedule1->day_id)&& ($key==$i)) 
                                <td><input type="checkbox" class="form-control" value="1" onchange="toggleCheckbox({{$shedule1->id}},{{$shedule1->day_id}},{{$shedule1->zone_id}})" name="saleable[]" data-size="xs" data-toggle="toggle" checked></td>
                                @else
                                <td><input type="checkbox" class="form-control" value="0" onchange="toggleCheckbox({{$shedule1->id}},{{$shedule1->day_id}},{{$shedule1->zone_id}})"" name="saleable[]" data-size="xs" data-toggle="toggle"></td>
                                @endif
                                @else
                                <td><input type="checkbox" class="form-control" value="1" name="saleable[]" data-size="xs" data-toggle="toggle" checked disabled></td>
                                @endif
                            <?php } ?>
                            </tr>
                             @endforeach
                            
                            </tbody>
                        </table>
    
    
