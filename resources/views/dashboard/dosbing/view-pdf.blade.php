<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
	<link rel="stylesheet" href="/css/pdfstyles.css">
	<link rel="stylesheet" href="/css/pdfannotate.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src = "/js/jSignature.min.js"></script>
	<script src = "/js/modernizr.js"></script> 

</head>
<body>
	<input id="dokumen" type="text" value="{{ $laporan[0]->id }}" hidden>
<div class="toolbar">
	<div class="tool">
		<span>SIMBKM Signature</span>
	</div>

	<div class="tool d-flex justify-content-between">
		<form action="/laporan/dosbing/view-pdf/approve/{{ $laporan[0]->id }}" method="post" >
			@csrf
			<button class="btn btn-success btn-sm" ><i class="fa fa-check"></i> Terima</button>
		</form>
		<button  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#canceledModal" ><i class="fa fa-minus"></i>Tolak</button>

		{{-- <form action="">
			@csrf
			<button class="btn btn-danger btn-sm" ><i class="fa fa-minus"></i> Tolak</button>
		</form> --}}
	</div>
</div>
<div id="pdf-container"></div>

{{-- Modal Pdf annotation data --}}
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

{{-- Modal Canceled Document --}}
<div class="modal fade" id="canceledModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Comment Laporan</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  <form action="/laporan/dosbing/view-pdf/canceled/{{  $laporan[0]->id  }}" method="post" id="canceled">
			@csrf
			<div class="form-group">
			  <label for="body" class="col-form-label">Pesan:</label>
			  <textarea class="form-control" id="body" name="body" autofocus required></textarea>
			</div>
		  </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  <button type="submit" class="btn btn-primary" form="canceled">Send message</button>
		</div>
	  </div>
	</div>
  </div>

{{-- Modal Sign Pad --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
		</div>
		<div class="modal-body">
			<form method="POST" >
				@csrf
				<div class="col-md-12">
					 <label class="" for="">Name:</label>
					 <input type="text" name="name" class="form-group" value="">
				</div>        
				<div class="col-md-12">
					<label>Signature:</label>
					<br/>
					<div id="sig"></div>
					<br/><br/>
					<button id="clear" class="btn btn-danger btn-sm">Clear</button>
					<textarea id="signature" name="signed" style="display: none"></textarea>
				</div>
				<br/>
				<button class="btn btn-primary">Save</button>
			</form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		</div>
	  </div>
	</div>
  </div>

  @include('dashboard.signpad')

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
<script src="/js/pdfannotate.min.js"></script>
<script src="/js/pdfscript.js"></script>
<script src="/js/sketch.js"></script>


<script>
	var pdf;
	function downloadBase64File(base64Data, fileName) {
			const linkSource = base64Data;
			const downloadLink = document.createElement("a");
			downloadLink.href = linkSource;
			downloadLink.download = fileName;
			downloadLink.click();
	}
	$(document).ready(function () {
		
		var dokValue = $("#dokumen").val();
		console.log(dokValue);
		var appUrl = '{{ env('APP_URL') }}';

		$.ajax({
			url: "{{url('/api/fetch-dokumen')}}",
			type: "POST",
			data: {
				dokumen: dokValue,
				_token: '{{csrf_token()}}'
			},
			dataType: 'json',
			success: function (result) {
				console.log(result.dokumen[0]['dokumen_path']);
				pdf = new PDFAnnotate('pdf-container', appUrl + '/storage/'  + result.dokumen[0]['dokumen_path'], {
						onPageUpdated(page, oldData, newData) {
							console.log(page, oldData, newData);
						},
						ready() {
							console.log('Plugin initialized successfully');
							// pdf.loadFromJSON(sampleOutput);
						},
						scale: 1.5,
						pageImageCompression: 'MEDIUM', // FAST, MEDIUM, SLOW(Helps to control the new PDF file size)
						});
						
			}
		});

		var sign = $('#txt').SignaturePad({
                allowToSign: true,
                img64: 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7',
                border: '1px solid #c7c8c9',
                width: '40px',
                height: '20px',
                callback: function (data, action) {
                    console.log(data);
					downloadBase64File(data, 'SIMBKM-signature.png');					
					pdf.addImageToCanvas();
                }
            });

			
		
 
    });

	function showSignPad() {
  pdf.serializePdf(function (string) {
    $('#exampleModal .modal-body ')
    //   .first()
    //   .text(JSON.stringify(JSON.parse(string), null, 4));
    // PR.prettyPrint();
    $('#exampleModal').modal('show');
  });
}

</script>
</body>
</html>

