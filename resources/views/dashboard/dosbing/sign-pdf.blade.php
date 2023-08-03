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
	
	<div class="tool">
		<button  class="tool-button"><i class="fa fa-picture-o" title="Add an Image" onclick="addImage(event)"></i></button>
	</div>
	<div class="tool">
		<button class="btn btn-danger btn-sm" onclick="deleteSelectedObject(event)"><i class="fa fa-trash"></i></button>
	</div>
	
	<div class="tool">
		<button class="btn btn-info btn-sm" onclick="showPdfData()">{}</button>
	</div>

  <div class="tool" id="loadBtn">
		<button class="btn btn-primary btn-sm" onclick="loadPdfData()">LOAD DATA SIGNATURE</button>
	</div>

  <div class="tool" id="syncBtn">
		<button class="btn btn-info btn-sm" onclick="synchroneAnnonate()" data-toggle="modal" data-target="#popSuccess">SYNC</button>
	</div>

	<div class="tool">
        <form action="/laporan/dosbing/sign-pdf/save" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="dokumen" name="dokumen"  type="text" value="{{ $laporan[0]->id }}" hidden>
            <input id="annotateJson" name="annotateJson" type="text" hidden>
            <input id="signature_kedua" name="signature_kedua" type="text" hidden>
            <input id="bgImage" name="bgImage" type="file" hidden>
            <input id="bgJson" name="bgJson" type="text" hidden>
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
    var signature = {!! json_encode($signature[0]) !!};
    var inputJson = document.getElementById("annotateJson");
    var inputSignaturePertama = document.getElementById("signature_kedua");
    var inputBgJson = document.getElementById("bgJson");
    var inputBgImage = document.getElementById("bgImage");

    var annotateFromDb = [];

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

  async function fetchDataJson(url) {
    try {
      const response = await fetch(url);

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error while fetching data:', error);
      throw error;
    }
  }

  async function fetchDataText(url) {
    try {
      const response = await fetch(url);

      if (!response.ok) {
        throw new Error('Network response was not ok');
      }

      const data = await response.text();
      return data;
    } catch (error) {
      console.error('Error while fetching data:', error);
      throw error;
    }
  }

  async function fetchDataAndHandle(data) {
    try {
      
      const signPertama = await fetchDataJson(appUrl + '/storage/' + signature.json_sign_pertama);
      // console.log('DataSign: ', signPertama);
      
      const dataBgJsonPertama = await fetchDataJson(appUrl + '/storage/' + signature.json_background_pertama);
      // console.log('DataJsonBg: ', dataBgJsonPertama);

      const dataBgBase64Pertama = await fetchDataText(appUrl + '/storage/' + signature.file_background_pertama);
      // console.log('DataBase64Bg: ', dataBgBase64Pertama);

      const dataAnnonate = await fetchDataJson(appUrl + '/storage/'  + dokumen.json_annotate);
      // console.log('DataAnnonate: ', dataAnnonate);

      var jsonBgPertama = dataBgJsonPertama;
      jsonBgPertama['src'] = dataBgBase64Pertama;

      let valueSignPertama = signPertama;
      valueSignPertama['backgroundImage'] = jsonBgPertama;

      var dataSignPertama = dataAnnonate;
      let listPages = dataSignPertama['pages'];

      let dataDefault = JSON.parse(data);
      for(let i = 0 ; i < listPages.length ; i++){
        listPages[i] = {
          backgroundImage: dataDefault.src[i]
        }
      }
      
      listPages[signPertama['page'] - 1] = valueSignPertama;
      
      // console.log(dataSignPertama);
      console.log(dataSignPertama);
      console.log('---Finish---');
      pdf.loadFromJSON(dataSignPertama);
      // Do more operations with the fetched data
    } catch (error) {
      // Handle errors, if any
    }
  }

  function fileListFrom (files) {
    const b = new ClipboardEvent("").clipboardData || new DataTransfer()
    for (const file of files) b.items.add(file)
    return b.files
  }

    function synchroneAnnonate(status){
      pdf.serializePdf(function (string, defaultValue){
            var oldValue = {
              // version: defaultValue[0].version,
              // objects: []
            }
            
            var data = JSON.parse(string);
            var ttdPertama;
            let dataJsonBg = pageContent;

            if(status == "Baru"){
              // data = JSON.parse(string);
              ttdPertama = data.pages[data.pages.length - 1];
              ttdPertama['page'] = syncPageBaru;
              data.pages[data.pages.length - 1] = oldValue;

              let dataBg = pageContent;
              let baseBgImage = dataBg['src'];

              const blob = new Blob([baseBgImage], { type: 'text/plain' });
              const fileList = fileListFrom([
                new File([blob], 'data.txt', { type: 'text/plain' })
              ]);
              inputBgImage.files = fileList;
            }else{
              // data = JSON.parse(string);
              var dataSync = data.pages[data.pages.length - 2];
              ttdPertama = dataSync;
              ttdPertama['page'] = syncPageBaru;
              data.pages[data.pages.length - 1] = oldValue;
              console.log(ttdPertama);
            }
            var dynamicVariableName = "annotate";
				    var variableValue = data;

            dataJsonBg['src'] = ""; 
            // Create a variable with a dynamic name
            window[dynamicVariableName] = variableValue;
            inputJson.value = JSON.stringify(annotate);
            inputSignaturePertama.value = JSON.stringify(ttdPertama);
            inputBgJson.value = JSON.stringify(dataJsonBg);
            });
      }


  var buttonImage = $('#syncBtn').click(function(){
    $(this).hide();
  });

  var buttonLoad = $('#loadBtn').click(function(){
    $(this).hide();
  });
  

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
        // fetchDataAndHandle();
		
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
  pdf.serializePdf(function (string, defaultValue, defaultBg) {
    console.log(JSON.parse(string));
    console.log(JSON.parse(defaultBg));
    $('#dataModal .modal-body pre')
      .first()
      .text(JSON.stringify(JSON.parse(string), null, 4));
    PR.prettyPrint();
    $('#dataModal').modal('show');
  });
}

function loadPdfData(){
  pdf.serializePdf(function(string, defaultValue, defaultBg){
    let bgImage = defaultBg;
    fetchDataAndHandle(defaultBg);
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
