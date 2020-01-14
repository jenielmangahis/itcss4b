<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Notes</div>
    <div class="pull-right">
      @if( UserHelper::checkUserRolePermission(Auth::user()->group_id, 'notes', 'add') )
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddNote">
            <i class="fa fa-plus"></i> Add Note
        </a>    
      @endif      
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<ul class="timeline timeline-inverse">

  @if(!$contact_notes->isEmpty())

    @foreach($contact_notes as $contact_note)
      <!-- timeline item -->
      <li>
        <i class="fa fa-file-text bg-blue"></i>

        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> {{ date("F j, Y, g:i a", strtotime($contact_note->created_at)) }} </span>
          <?php $note_type_name = isset($contact_note->note_type->name) ? $contact_note->note_type->name : 'NA'; ?>
          <h3 class="timeline-header">
            <?php 
              $notify_user = isset($contact_note->notify_user->firstname) ? $contact_note->notify_user->firstname . " " . $contact_note->notify_user->lastname : 'NA'; 
              $created_by  = isset($contact_note->user->firstname) ? 'Created By: ' . $contact_note->user->firstname . ' ' . $contact_note->user->lastname : 'Created By: NA';
            ?>
            <a href="javascript:void(0);"><?php echo $created_by; ?></a> | <strong>{{ $note_type_name }}</strong>
            <?php echo " | " . $contact_note->note_title; ?>
          </h3>

          <div class="timeline-body" style="overflow: auto; min-height: 40px; max-height: 120px;">
              <?php echo $contact_note->note_content; ?>
          </div>
          
          <div class="timeline-footer">
            <!-- <a class="btn btn-primary btn-xs">Read more</a> -->
            @if( UserHelper::checkUserRolePermission(Auth::user()->group_id, 'notes', 'delete') )
            <a href="javascript:void(0);" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modalDeleteNote-<?= $contact_note->id; ?>">
                Delete
            </a>    
            @endif        
          </div>
        </div>
      </li>
      <!-- END timeline item -->

      <div id="modalDeleteNote-<?= $contact_note->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
          <div class="modal-dialog modal-md">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Delete</h4>
              </div>
              <div class="modal-body">
                Are you sure you want to delete selected note?
              </div>
              <div class="modal-footer">
                {{ Form::open(array('url' => 'contact_note/destroy')) }}
                  <?php echo Form::hidden('id', Hashids::encode($contact_note->id) ,[]); ?>
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-danger">Yes</button>
                {!! Form::close() !!}
              </div>

            </div>
          </div>
      </div>  

    @endforeach

    <li>
      <i class="fa fa-clock-o bg-gray"></i>
    </li>

  @else
    <li>
      <i class="fa fa-file-text bg-blue"></i>
      <div class="timeline-item"><h3 class="timeline-header"><strong>Note is empty</strong></h3></div>  
    </li>
  @endif

</ul>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $contact_notes->links() }}
</div>

<div id="modalAddNote" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_note/store', 'class' => '', 'id' => 'add-note-form')) }}
      <input type="hidden" name="contact_id" id="contact_id" value="{{ $contact_id }}">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Note</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputNoteType">Note Type</label>
                  <select name="note_type_id" id="note_type_id" class="form-control">
                    @if( !empty($note_types->toArray()) )
                      @foreach($note_types as $nt)   
                        <option value="{{ $nt->id }}">{{ $nt->name }}</option>
                      @endforeach
                    @else
                      <select name="note_type_id" id="note_type_id" class="form-control">
                        <option value="">No event type available</option>
                      </select>
                    @endif
                  </select>  
                </div>                
              </div>
              <div class="col-xs-6">
                <!-- <div class="form-group">
                  <label for="inputNotifyUser">Notify User</label>
                  <select name="notify_user_id" id="notify_user_id" class="form-control">
                    @if( !empty($company_users->toArray()) )
                      @foreach($company_users as $company_user)   
                        @if(isset($company_user->user->firstname) && isset($company_user->user->lastname))
                          <option value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
                        @else
                          <option value="">-</option>
                        @endif
                        
                      @endforeach
                    @else
                      <select name="notify_user_id" id="notify_user_id" class="form-control">
                        <option value="">No company users available</option>
                      </select>
                    @endif
                  </select>                   
                </div> -->                
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                <!-- <div class="form-group">
                  <label for="inputNoteTemplate">Note Template</label>
                  <select name="note_template" id="note_template" class="form-control"> 
                    <option value="">Blank</option>
                  </select>  
                </div> -->                
              </div>
              <div class="col-xs-6">
                <!-- <div class="form-group">
                  <label for="inputccEmail">CC Email</label>
                  <input type="text" class="form-control cc_emails" id="cc_emails" name="cc_emails" placeholder="" value="{{old('cc_emails')}}">
                </div>  -->               
              </div>
            </div>            

            <div class="form-group">
              <label for="inputTitle">Title</label>
              <input type="text" class="form-control" id="note_title" name="note_title" placeholder="Enter Title" value="{{old('note_title')}}" required="">
            </div>            

            <div class="form-group">
              <textarea rows="4" cols="50" class="form-control" id="note_content" name="note_content" required="">{{ old('note_content') }}</textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Add</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

