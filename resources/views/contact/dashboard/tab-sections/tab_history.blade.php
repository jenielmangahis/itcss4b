<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">History</div>
    <div class="pull-right">       
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<ul class="timeline timeline-inverse">

      <!-- timeline item -->
      @foreach($contact_history as $ch)
        <li>
          <i class="fa fa-history bg-blue"></i>

          <div class="timeline-item"> 
            <h3 class="timeline-header">
              <a class="btn btn-primary btn-sm" href="javascript:void(0);">{{$ch->module}}</a> | 
              {{ date("F j, Y, g:i a", strtotime($ch->created_at)) }}
              | <strong style="color: #367fa9;">{{$ch->title}}</strong>
              | {{$ch->user->firstname}} {{$ch->user->lastname}}
              @if( UserHelper::checkUserRolePermission(Auth::user()->group_id, 'history', 'delete') )
                <a style="float: right;" href="javascript:void(0);" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDelete-<?= $ch->id; ?>">
                  <i class="fa fa-trash"></i>
                </a>
              @endif
            </h3>

            <!-- <div class="timeline-body" style="overflow: auto; min-height: 40px; max-height: 120px;">
              description here
            </div> -->

          </div>
        </li>

        <div id="modalDelete-<?= $ch->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
            <div class="modal-dialog modal-md">
              <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete selected history?
                </div>
                <div class="modal-footer">
                  {{ Form::open(array('url' => 'contact_history/destroy')) }}
                    <?php echo Form::hidden('id', Hashids::encode($ch->id) ,[]); ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                  {!! Form::close() !!}
                </div>

              </div>
            </div>
        </div>  

      @endforeach

      <!-- END timeline item -->

    <li>
      <i class="fa fa-clock-o bg-gray"></i>
    </li>


    <!-- <li>
      <i class="fa fa-file-text bg-blue"></i>
      <div class="timeline-item"><h3 class="timeline-header"><strong>History is empty</strong></h3></div>  
    </li> -->


</ul>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $contact_history->links() }}
</div>

