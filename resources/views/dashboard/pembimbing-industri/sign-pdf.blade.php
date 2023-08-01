<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
	<link rel="stylesheet" href="/css/pdfstyles.css">
	<link rel="stylesheet" href="/css/pdfannotate.css">

</head>
<body>
<div class="toolbar">
	<div class="tool">
		<span>SIMBKM PNJ</span>
	</div>

    <div class="tool">
        <div class="tool-button d-flex ">
            <input type="text" id="txt" style="border-radius: 5px;" hidden>
          <small>signpad-></small>
        </div>
    </div>
	
	<div class="tool" id="imageButton">
		<button  class="tool-button"><i class="fa fa-picture-o" title="Add an Image" onclick="addImage(event)"></i></button>
	</div>
	<div class="tool">
		<button class="btn btn-danger btn-sm" onclick="deleteSelectedObject(event)"><i class="fa fa-trash"></i></button>
	</div>
	
	{{-- <div class="tool">
		<button class="btn btn-info btn-sm" onclick="showPdfData()">{}</button>
	</div> --}}

  <div class="tool">
		<button class="btn btn-info btn-sm" onclick="synchroneAnnonate()" data-toggle="modal" data-target="#popSuccess">SYNC</button>
	</div>

	<div class="tool">
        <form action="/laporan/pi/detail/sign-pdf/save" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="dokumen" name="dokumen"  type="text" value="{{ $laporan[0]->id }}" hidden>
            <input id="annotateJson" name="annotateJson" type="text" hidden>
            <input id="dokumen" name="fileId" type="text" value="{{ $laporan[0]->id }}" hidden>
            <input id="dokumenName" name="dokumenName"  type="text" value="{{ $laporan[0]->dokumen_name }}" hidden>
            <input name="dokumenPath"  type="text" value="{{ $laporan[0]->dokumen_path }}" hidden>
            <button class="btn btn-light btn-sm" type="submit" ><i class="fa fa-save"></i> Save</button>    
        </form>
	</div>
</div>
<div id="pdf-container"></div>

<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="dataModalLabel">PDF annotation data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<pre class="prettyprint lang-json linenums">
				</pre>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="popSuccess" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Sinkronisasi Berhasil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{-- <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div> --}}
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
<script>pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
<script src="/js/arrow.fabric.js"></script>
<script src="/js/sample_output.js"></script>
{{-- <script src="/js/pdfannotate.min.js"></script> --}}
<script src="/js/pdfannotate.js"></script>
<script src="/js/script.js"></script>
<script src = "/js/jSignature.min.js"></script>
<script src = "/js/modernizr.js"></script>  
<script src="/js/sketch.js"></script>
<script>
    var appUrl = '{{ env('APP_URL') }}';
    var dokumen = {!! json_encode($laporan[0]) !!};
    var inputJson = document.getElementById("annotateJson");

    var syncDataBaru = "";
    var syncPageBaru = 0;
    var pageContent = "";

    function downloadBase64File(base64Data, fileName) {		
			const linkSource = base64Data;
			const downloadLink = document.createElement("a");
			downloadLink.href = linkSource;
			downloadLink.download = fileName;
			downloadLink.click();
	}

    function synchroneAnnonate(status){
      pdf.serializePdf(function (string, defaultValue){
            var oldValue = {
              // version: defaultValue[0].version,
              // objects: []
            }
            var data = JSON.parse(string);
            // for(let i = 0; i < data.pages.length; i++ ){
            //   var pagesDefault = data.pages[i];
            //   pagesDefault['backgroundImage'] = pageContent;
            //   console.log(pagesDefault);
            // }

            if(status == "Baru"){
              data = JSON.parse(string);
              data.pages[data.pages.length - 1] = oldValue;
              data.pages[syncPageBaru-1] = syncDataBaru;
              
            }else{
              data = JSON.parse(string);
              var dataSync = data.pages[data.pages.length - 1];
              dataSync['backgroundImage'] = pageContent;
              data.pages[data.pages.length - 1] = oldValue;
              data.pages[syncPageBaru-1] = dataSync;  
              
            }
            
            var dynamicVariableName = "annotate";
				    var variableValue = data;

            // Create a variable with a dynamic name
            window[dynamicVariableName] = variableValue;
            inputJson.value = JSON.stringify(annotate);
            // let dataJson = JSON.stringify(annotate);
            });
      }


//   var buttonImage = $('#imageButton').click(function(){
//     $(this).hide();
//   });


    var pdf = new PDFAnnotate('pdf-container', appUrl + '/storage/'  + dokumen.dokumen_path, {
    onPageUpdated(page, oldData, newData) {
    console.log(page, oldData, newData);
    // console.log(oldData['backgroundImage']);
      syncDataBaru = newData;
      syncPageBaru = page;
      pageContent = oldData['backgroundImage'];
      synchroneAnnonate("Baru");
    },
    ready() {
        console.log('Plugin initialized successfully');
		console.log(dokumen.json_annotate);
		if(dokumen.json_annotate !== null && dokumen.json_annotate !== undefined && dokumen.json_annotate !== ''){
			fetch(appUrl + '/storage/'  + dokumen.json_annotate)
			.then(response => response.json())
			.then(data =>{
				pdf.loadFromJSON(data);
			});
		}
    // pdf.loadFromJSON(sampleOutput)
		
    },
    scale: 1.5,
    pageImageCompression: 'MEDIUM', // FAST, MEDIUM, SLOW(Helps to control the new PDF file size)
    });

function changeActiveTool(event) {
  var element = $(event.target).hasClass('tool-button')
    ? $(event.target)
    : $(event.target).parents('.tool-button').first();
  $('.tool-button.active').removeClass('active');
  $(element).addClass('active');
}

function enableSelector(event) {
  event.preventDefault();
  changeActiveTool(event);
  pdf.enableSelector();
}

function enablePencil(event) {
  event.preventDefault();
  changeActiveTool(event);
  pdf.enablePencil();
}

function enableAddText(event) {
  event.preventDefault();
  changeActiveTool(event);
  pdf.enableAddText();
}

function enableAddArrow(event) {
  event.preventDefault();
  changeActiveTool(event);
  pdf.enableAddArrow(function () {
    $('.tool-button').first().find('i').click();
  });
}

function addImage(event) {
  event.preventDefault();
  pdf.addImageToCanvas();
}

function enableRectangle(event) {
  event.preventDefault();
  changeActiveTool(event);
  pdf.setColor('rgba(255, 0, 0, 0.3)');
  pdf.setBorderColor('blue');
  pdf.enableRectangle();
}

function deleteSelectedObject(event) {
  event.preventDefault();
  pdf.deleteSelectedObject();
}

function savePDF() {
  // pdf.savePdf();
  pdf.savePdf('output.pdf'); // save with given file name
}

function clearPage() {
  pdf.clearActivePage();
}

function showPdfData() {
  pdf.serializePdf(function (string) {
    $('#dataModal .modal-body pre')
      .first()
      .text(JSON.stringify(JSON.parse(string), null, 4));
    PR.prettyPrint();
    $('#dataModal').modal('show');
  });
}

$(function () {
  $('.color-tool').click(function () {
    $('.color-tool.active').removeClass('active');
    $(this).addClass('active');
    color = $(this).get(0).style.backgroundColor;
    pdf.setColor(color);
  });

  $('#brush-size').change(function () {
    var width = $(this).val();
    pdf.setBrushSize(width);
  });

  $('#font-size').change(function () {
    var font_size = $(this).val();
    pdf.setFontSize(font_size);
  });
});


$('#txt').SignaturePad({
                allowToSign: true,
                img64: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
                border: '1px solid #c7c8c9',
                width: '40px',
                height: '20px',
                callback: function (data, action) {
                    console.log(action);
                    if(action === 'clear'){

                    }else{
                        downloadBase64File(data, 'SIMBKM-signature.png');					
					    pdf.addImageToCanvas();
                    }
                }
            });

</script>
</body>
</html>
