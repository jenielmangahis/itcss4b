<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Notes</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddNote">
            <i class="fa fa-plus"></i> Add Note
        </a>          
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
          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

          <div class="timeline-body">
            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
            weebly ning heekya handango imeem plugg dopplr jibjab, movity
            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
            quora plaxo ideeli hulu weebly balihoo...
          </div>
          <div class="timeline-footer">
            <a class="btn btn-primary btn-xs">Read more</a>
            <a class="btn btn-danger btn-xs">Delete</a>
          </div>
        </div>
      </li>
      <!-- END timeline item -->
    @endforeach

    <li>
      <i class="fa fa-clock-o bg-gray"></i>
    </li>

  @else
    <li>Notes is empty</li>
  @endif

</ul>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $contact_notes->links() }}
</div>

<div id="modalAddNote" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => '', 'class' => '', 'id' => 'add-note-form')) }}
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
                    @if( !empty($event_types->toArray()) )
                      @foreach($event_types as $et)   
                        <option value="{{ $et->id }}">{{ $et->name }}</option>
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
                <div class="form-group">
                  <label for="inputNotifyUser">Notify User</label>
                  <select name="notify_user_id" id="notify_user_id" class="form-control">
                    @if( !empty($company_users->toArray()) )
                      @foreach($company_users as $company_user)   
                        <option value="{{ $company_user->user_id }}">{{ $company_user->user->firstname }} {{ $company_user->user->lastname }}</option>
                      @endforeach
                    @else
                      <select name="notify_user_id" id="notify_user_id" class="form-control">
                        <option value="">No company users available</option>
                      </select>
                    @endif
                  </select>                   
                </div>                
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputNoteTemplate">Note Template</label>
                  <select name="note_template" id="note_template" class="form-control"> 
                    <option value="">Blank</option>
                  </select>  
                </div>                
              </div>
              <div class="col-xs-6">
                <div class="form-group">
                  <label for="inputccEmail">CC Email</label>
                  <input type="text" class="form-control cc_emails" id="cc_emails" name="cc_emails" placeholder="" value="{{old('cc_emails')}}" required="">
                </div>                
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

