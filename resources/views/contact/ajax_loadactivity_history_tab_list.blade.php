
<table class="table table-bordered table-hover">
  <tr>
    <th style="width: 1%;" >#</th>
    <th>Calls</th>
    <th>Call Type</th>
    <!-- <th style="width:10%;">Action</th> -->
  </tr>
    <?php $inc = 1; ?>
    @foreach($call_log_activity_history as $ah_key => $ah)
    <tr>
      <td>{{$inc}}</td>
      <td>{{ $ah->contact->firstname }} {{ $ah->contact->lastname }} on <?php echo date('F j, Y, g:i a', strtotime($ah->created_at)) ?></td>
      <td>{{ $ah->call_type }}</td>
      <!-- <td>
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalEditEvent">
            <i class="fa fa-edit"></i>
        </a>                                                     
      </td> -->
    </tr>  
    <?php $inc++; ?>
    @endforeach
</table>