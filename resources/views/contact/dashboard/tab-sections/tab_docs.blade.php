<div class="row">
  <div class="col-xs-12 calendar-events-header">
    <div class="pull-left calendar-events-title">Docs</div>
    <div class="pull-right">
        <a href="javascript:void(0);" class="btn btn-primary" id="" data-toggle="modal" data-target="#modalAddDocs">
            <i class="fa fa-plus"></i> Add Docs
        </a>          
        <a href="javascript:location.reload();" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </a>
    </div>
  </div>
</div>

<div class="row">
  <?php if( $group_id == 3 ){ ?>
    {{ Form::open(array('url' => 'dashboard/', 'class' => '', 'method' => 'get')) }}
  <?php }else{ ?>
    {{ Form::open(array('url' => 'contact_dashboard/'.$contact_id, 'class' => '', 'method' => 'get')) }}
  <?php } ?>
  

    <div class="col-xs-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Search By: </label><br />
            <select name="search_by_documents" class="form-control select2" style="width: 30%; float: left;">
              <option value="document_title" selected="selected">Document Title</option>              
            </select>            
            <input class="form-control" type="text" value="<?php echo $search_field_documents; ?>" name="search_field_documents" placeholder="Default Search" style="width: 70%; float: right;">
          </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="form-group">
            <label>&nbsp;</label><br />
            <button type="submit" class="btn btn-primary">Filter</button>
            <?php if( $group_id == 3 ){ ?>
              <a class="btn btn-success" href="{{url('dashboard')}}">Refresh</a>
            <?php }else{ ?>
              <a class="btn btn-success" href="{{url('contact_dashboard/'.$contact_id)}}">Refresh</a>
            <?php } ?>            
          </div>
          <!-- /.form-group -->
        </div>
      </div>                

    </div>                      
  {!! Form::close() !!}         
</div>

<table class="table table-bordered table-hover">
  <tr>    
    <th>Document Title</th>
    <th>Date Created</th>
    <th>Created By</th>
    <th style="width:10%;">Action</th>
  </tr>
    @foreach($contactDocs as $doc)
    <tr>
      <td>{{ $doc->document_title }}</td>
      <td>{{ $doc->created_at }}</td>
      @if(isset($doc->user->firstname) && isset($doc->user->lastname))
        <td>{{ $doc->user->firstname }} {{ $doc->user->lastname }}</td>
      @else
        <td>-</td>
      @endif
      <td>  
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalViewDoc-<?php echo $doc->id; ?>">
            <i class="fa fa-search-plus"></i>
        </a>
        <a href="{{ URL::asset('uploads/contact_docs/' . $doc->filename) }}" class="btn btn-xs btn-primary" id="">
            <i class="fa fa-download"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-xs btn-primary" id="" data-toggle="modal" data-target="#modalDeleteDoc-<?php echo $doc->id; ?>">
            <i class="fa fa-trash"></i>
        </a> 

        <div id="modalViewDoc-<?php echo $doc->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
          <div class="modal-dialog modal-lg" style="width: 400px !important;">
            <div class="modal-content">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">View Doc</h4>
                </div>

                <div class="modal-body">
                  <table class="table table-bordered">
                    <tr>
                      <td>Document Title</td>
                      <td>: <b>{{ $doc->document_title }}</b></td>
                    </tr>                    
                    <tr>
                      <td>Document Type</td>
                      <td>: <?= $documentTypes[$doc->document_type]; ?></td>
                    </tr>
                    <tr>
                      <td>Description</td>
                      <td>: {{ $doc->description }}</td>
                    </tr>
                  </table> 
                </div>

                <div class="modal-footer"> 
                  <a href="{{ URL::asset('uploads/contact_docs/' . $doc->filename) }}" class="btn btn-primary" id="">
                      <i class="fa fa-download"></i> Download
                  </a>                 
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>            
          </div>
        </div>

        <div id="modalDeleteDoc-<?= $doc->id; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
          <div class="modal-dialog modal-md">
            <div class="modal-content">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Delete</h4>
              </div>
              <div class="modal-body">
                Are you sure you want to delete selected document?
              </div>
              <div class="modal-footer">
                {{ Form::open(array('url' => 'contact_docs/destroy')) }}
                  <?php echo Form::hidden('id', Hashids::encode($doc->id) ,[]); ?>
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-danger">Yes</button>
                {!! Form::close() !!}
              </div>

            </div>
          </div>
      </div>  

      </td>
    </tr> 
    @endforeach 

</table>

<div style="text-align: center;" class="box-footer clearfix">
    {{ $contactDocs->links() }}
</div>

<div style="text-align: center;" class="box-footer clearfix">

</div>


<div id="modalAddDocs" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="text-align: left">
    {{ Form::open(array('url' => 'contact_docs/store', 'class' => '', 'id' => 'add-call-log-form', 'enctype' => 'multipart/form-data')) }}
      <input type="hidden" id="" name="contact_id" value="<?php echo $contact_id; ?>">
      <div class="modal-dialog modal-lg" style="width: 800px !important;">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Add Docs</h4>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="inputTime">Filename</label>
                  <input type="file" class="form-control" id="filename" name="filename" placeholder="Click to Select File" required="">
                </div>                
              </div>
              <div class="col-xs-3">
                <div class="form-group">
                  <label for="inputCallType">Document Type</label>
                  <select name="document_type" id="document_type" class="form-control">
                    <?php foreach($documentTypes as $key => $value){ ?>
                      <option value="<?= $key; ?>"><?= $value; ?></option>
                    <?php } ?>
                  </select>  
                </div>                
              </div>
              <div class="col-xs-5">
                <div class="form-group">
                  <label for="inputTime">Description</label>
                  <input type="text" class="form-control" name="description" required="">
                </div>                
              </div>           

            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-default">Upload</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    {!! Form::close() !!}        
</div>

