

      
 <div class="modal fade" id="message{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="message{{$message->id}}" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
        	
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Message</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
            	
                <p>{{$message->message}}</p>                
            </div>
            
            <div class="modal-footer">
                <a  href="mailto:{{$message->email}}" class="btn btn-primary">Reply</a>
            </div>
            
        </div>
    </div>
</div>

  </div>