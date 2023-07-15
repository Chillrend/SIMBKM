<script src = "/js/jSignature.min.js"></script>
<script src = "/js/modernizr.js"></script>  
<form action="" method="post" enctype="multipart/form-data">
    <div class="modal fade text-left" id="signpad" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Test</h4>
                    <button class="close" type="buton" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id = "signature" style = "border: 1px solid black; width: 100; height: 50">

                    </div>
                
                    <button class="btn" type = "button" id = "preview">Preview</button>
                
                    <img  src = "" id = "signaturePreview">
                
                    <a href = "" id = "download" download>Download</a>
                
                    {{-- <script src = "/js/jquery.js"></script> --}}
                     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
                    
                
                    {{-- <script type="text/javascript">
                      var signature = $("#signature").jSignature({'UndoButton':true});
                
                      $('#preview').click(function(){
                        var data = signature.jSignature('getData', 'image');
                        $('#signaturePreview').attr('src', "data:" + data);
                      });
                
                      $('#download').click(function(){
                        var image = $('#signaturePreview')[0];
                        this.href = image.src;
                      });
                    </script> --}}
                  
                </div>
            </div>
        </div>    
    </div>
</form>
    