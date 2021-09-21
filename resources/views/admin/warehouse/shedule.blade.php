
<table class="table table1 table-bordered mb-0">
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
        <tr>
            <?php for ($i=1; $i <=7 ; $i++) {
                if(isset($days[$i]))
                {
                    $day = $days[$i];
                } 
                if(isset($id[$i-1]))
                $id = $id[$i-1];
            ?> 
            @if($i<=5)
                @if(isset($day) && ($day==$i)) 
                    <td>
                        <input type="checkbox" class="form-control xyz" value="1" onchange="toggleCheckbox({{$id}},{{$zone}},{{$i}})" name="saleable[]" data-size="sm" data-toggle="toggle" checked>
                    </td>
                @else
                    <td>
                        <input type="checkbox" class="form-control xyz" value="0" onchange="toggleCheckbox({{$id}},{{$zone}},{{$i}})" name="saleable[]" data-size="sm" data-toggle="toggle">
                    </td>
                @endif
            @else
                <td>
                    <input type="checkbox" class="form-control xyz" value="1" name="saleable[]" data-size="xs" data-toggle="toggle" disabled>
                </td>
            @endif
            <?php } ?>
        </tr>
    </tbody>
</table>
    
    
