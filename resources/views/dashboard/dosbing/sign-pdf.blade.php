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

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src = "/js/jSignature.min.js"></script>
	<script src = "/js/modernizr.js"></script> 

</head>
<body>
	<input id="dokumen"  type="text" value="{{ $laporan[0]->id }}" hidden>
	<input id="dokumenName"  type="text" value="{{ $laporan[0]->dokumen_name }}" hidden>
<div class="toolbar">
	<div class="tool">
		<span>SIMBKM Signature</span>
	</div>

	<div class="tool">
		  <div class="tool-button d-flex ">
		  	<input type="text" id="txt" style="border-radius: 5px;" hidden>
			<small>signpad-></small>
		  </div>
	</div>

	<div class="tool">
		<button class="tool-button"><i class="fa fa-picture-o" title="Add an Image" onclick="addImage(event)"></i></button>
	</div>

	<div class="tool">
		<button class="btn btn-danger btn-sm" onclick="deleteSelectedObject(event)"><i class="fa fa-trash"></i></button>
	</div>

	<div class="tool">
		<button class="btn btn-info btn-sm" onclick="showPdfData()">{}</button>
	</div>

	{{-- <div class="tool">
		<button class="btn btn-danger btn-sm" onclick="clearPage()">Clear Page</button>
	</div> --}}

	<div class="tool">
		{{-- <form action="/dashboard/laporan/save-document" method="POST" enctype="multipart/form-data">
			@csrf
			<input id="dokumen" name="dokumen" type="text" value="{{ $laporan[0]->id }}" hidden>
			<button class="btn btn-light btn-sm"><i class="fa fa-save"></i> Save</button>
		</form> --}}
		<button id="saveFile" class="btn btn-light btn-sm"><i class="fa fa-save"></i> Save</button>
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
					 <input type="text" name="name" class="form-group" value="" hidden>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
<script src="/js/arrow.fabric.js"></script>
<script src="/js/sample_output.js"></script>
<script src="/js/sample_output_2.js"></script>
{{-- <script src="/js/pdfannotate.min.js"></script> --}}
<script src="/js/pdfannotate.js"></script>
<script src="/js/pdfscript.js"></script>
<script src="/js/sketch.js"></script>


<script>
	var pdf;
	var canvas;
	var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

	var dokValue = $("#dokumen").val();
	var dokName = $("#dokumenName").val();
	var appUrl = '{{ env('APP_URL') }}';
	// var source = window.document.getElementById('pdf-container')[0];
	var sourceBody = window.document.getElementsByTagName("body")[0];

	async function fetchAnnonate() {
	try {
		const response = await fetch('your-api-endpoint');
		const data = await response.json();
		
		// Process the fetched data
		
		return data; // Return the fetched data
		} catch (error) {
			console.error('Error:', error);
			throw error; // Throw the error to indicate failure
		}
	}

	async function performFetch() {
		try {
			const result = await fetchData();
			
			// Do something with the fetched data
			
			console.log('Fetch completed successfully');
			// Set the "done" state or trigger the next action
		} catch (error) {
			// Handle the error case
			console.error('Fetch failed:', error);
			// Set the "done" state or trigger an error handling action
		}
	}


	function downloadBase64File(base64Data, fileName) {		
			const linkSource = base64Data;
			const downloadLink = document.createElement("a");
			downloadLink.href = linkSource;
			downloadLink.download = fileName;
			downloadLink.click();
	}

	async function getData() {
  try {
    const response = await $.ajax({
      url: 'https://example.com/api/data',
      method: 'GET',
      dataType: 'json'
    });

    // Process the response data
    console.log(response);
    return response; // Return the response for further use
  } catch (error) {
    console.error('Error:', error);
    throw error; // Throw the error to indicate failure
  }
}

	async function getDataPdf(){
		try{
			const response = await $.ajax({
				url: "{{url('/api/fetch-dokumen')}}",
				type: "POST",
				data: {
				dokumen: dokValue,
				_token: '{{csrf_token()}}'
				},
				dataType: 'json',
			});
			return response;
		}catch(error){
			console.log('Error: ', error);
		}
	}

	$(document).ready(function () {

		getDataPdf();
		var dataAnnotate;

		function fetchSaveData(page, oldData, newData){
			if(dataAnnotate != undefined || dataAnnotate != null){
				var dynamicVariableName = "annotate";
				var variableValue = dataAnnotate;

				// Create a variable with a dynamic name
				window[dynamicVariableName] = variableValue;
				let lastIndex = annotate.pages.length - 1;
				annotate.pages[page - 1] = newData;
				annotate.pages[lastIndex] = oldData;

				let dataJson = JSON.stringify(annotate);
				$('#saveFile').click(function(){
					pdf.saveToServer('{{url('/laporan/dosbing/sign-pdf/save')}}', CSRF_TOKEN, dokName, dokValue, dataJson);
					window.location.href = '/laporan/dosbing';
				});
			}
			
			// pdf.saveToServer('{{url('/dashboard/laporan/save-document')}}', CSRF_TOKEN, dokName, dokValue, string);
			
			
		}		

		$.ajax({
			url: "{{url('/api/fetch-dokumen')}}",
			type: "POST",
			data: {
				dokumen: dokValue,
				_token: '{{csrf_token()}}'
			},
			dataType: 'json',
			success: function (result) {
				if(result.dokumen[0]['json_annotate'] != null){
					fetch(appUrl + '/storage/'  + result.dokumen[0]['json_annotate'])
								.then(response => response.json())
								.then(data => {
									console.log(data); // Process the retrieved JSON data
									

									dataAnnotate = data;

									// Access the dynamically created variable
									// console.log(window[dynamicVariableName]); // Output: 42
									// console.log(myVariable);
									// const jsonString = JSON.stringify(data, null, 4);
									// const test = JSON.stringify(data);
									// console.log(JSON.stringify(data, null, 4));
									// pdf.loadFromJSON(annotate);
									// pdf.savePdf();
								})
								.catch(error => {
									console.error('Error:', error);
							});
				}
				
				var basicData;
				pdf = new PDFAnnotate('pdf-container', appUrl + '/storage/'  + result.dokumen[0]['dokumen_path'], {
						onPageUpdated(page, oldData, newData) {
							console.log(page, oldData, newData);

							if(basicData == undefined){
								basicData = oldData	
							}
							// console.log($('.canvas-container'));

							fetchSaveData(page, basicData, newData);

							if(dataAnnotate == null || dataAnnotate == undefined){
								pdf.serializePdf(function(string){
									let json = JSON.parse(string);
									let lastIndex = json.pages.length - 1;
									json.pages[page - 1] = newData;
									json.pages[lastIndex] = oldData;

									let dataJson = JSON.stringify(json);
									// pdf.saveToServer('{{url('/dashboard/laporan/save-document')}}', CSRF_TOKEN, dokName, dokValue, dataJson);
									// pdf.saveToServer('{{url('/dashboard/laporan/save-document')}}', CSRF_TOKEN, dokName, dokValue, string);
								});
								$('#saveFile').click(function(){
									pdf.saveToServer('{{url('/laporan/dosbing/sign-pdf/save')}}', CSRF_TOKEN, dokName, dokValue, dataJson);
									window.location.href = '/laporan/dosbing';
								});
							}
							

							// $('#saveFile').click(function(){
								
							// 	// 
							// 	// pdf.saveToServer('{{url('/dashboard/laporan/save-document')}}', CSRF_TOKEN, dokName, dokValue);
							// 	// console.log(pdf.serializePdf());
							// 	// pdf.saveToServer('{{url('/dashboard/laporan/save-document')}}');
							// 	// var source = window.document.getElementById('pdf-container');
							// 	// var imgData = source.toDataURL("image/jpeg", 1.0);
							// 	// var pdfDoc = new jsPDF();

							// 	// pdfDoc.addImage(imgData, 'JPEG', 0, 0);
							// 	// pdfDoc.save("download.pdf");
							// 	// doc.fromHTML(
							// 	// 	$('.canvas-container'), 15, 15,
							// 	// 	{width: 170},
							// 	// 	function(){
							// 	// 		var blob = doc.output('blob');
							// 	// 		// var blob = doc.output('datauri');
							// 	// 		// var blob = doc.output('base64');
							// 	// 		var formData = new FormData();
							// 	// 		var blobPDF = new Blob([doc.output('blob')], {type : 'application/pdf'});
							// 	// 		var blobUrl = URL.createObjectURL(blobPDF);
							// 	// 		// formData.append('pdf', blob);
							// 	// 		formData.append('pdf', blobUrl);
							// 	// 		formData.append('_token', CSRF_TOKEN);
							// 	// 		formData.append('dokumen', dokValue);
							// 	// 		formData.append('dokumenName', dokName);
							// 	// 		// $.ajax({
							// 	// 		// 	url: "{{url('/dashboard/laporan/save-document')}}",
							// 	// 		// 	type: "POST",
							// 	// 		// 	data: formData,
							// 	// 		// 	processData: false,
							// 	// 		// 	contentType: false,
							// 	// 		// 	success: function(data){console.log(data)},
							// 	// 		// 	error: function(data){console.log(data)}
							// 	// 		// })
							// 	// 		console.log('clicked');
										
							// 	// 	}
							// 	// )
							// });
							// var doc = new jsPDF();
							
							// $('#saveFile').click(function(){
							// 	var canvas = $('.canvas-container');
							// 	var imgData = canvas.toDataURL("image/jpeg", 1.0);
							// 	var pdfDoc = new jsPDF();

							// 	pdfDoc.addImage(imgData, 'JPEG', 0, 0);
							// 	pdfDoc.save("download.pdf");
							// 	doc.fromHTML(
							// 		$('.canvas-container'), 15, 15,
							// 		{width: 170},
							// 		function(){
							// 			var blob = doc.output('blob');
							// 			// var blob = doc.output('datauri');
							// 			// var blob = doc.output('base64');
							// 			var formData = new FormData();
							// 			var blobPDF = new Blob([doc.output('blob')], {type : 'application/pdf'});
							// 			var blobUrl = URL.createObjectURL(blobPDF);
							// 			// formData.append('pdf', blob);
							// 			formData.append('pdf', blobUrl);
							// 			formData.append('_token', CSRF_TOKEN);
							// 			formData.append('dokumen', dokValue);
							// 			formData.append('dokumenName', dokName);
							// 			// $.ajax({
							// 			// 	url: "{{url('/dashboard/laporan/save-document')}}",
							// 			// 	type: "POST",
							// 			// 	data: formData,
							// 			// 	processData: false,
							// 			// 	contentType: false,
							// 			// 	success: function(data){console.log(data)},
							// 			// 	error: function(data){console.log(data)}
							// 			// })
							// 			console.log('clicked');
										
							// 		}
							// 	)
							// });
							
							
						},
						ready() {
							// let json;
							
							
							console.log('Plugin initialized successfully');
							if(dataAnnotate != undefined || dataAnnotate != null){
								var dynamicVariableName = "annotate";
								var variableValue = dataAnnotate;

								// Create a variable with a dynamic name
								window[dynamicVariableName] = variableValue;
								
								pdf.loadFromJSON(annotate);
							}
							
							
							// console.log(result.dokumen[0]['json_annotate']);
							// console.log(appUrl + '/storage/'  + result.dokumen[0]['json_annotate'])
							// var json = appUrl + '/storage/'  + result.dokumen[0]['json_annotate'];
							// console.log(json);
							// pdf.loadFromJSON(appUrl + '/storage/'  + result.dokumen[0]['json_annotate']);
							var doc = new jsPDF();
							
						},
						scale: 1.5,
						pageImageCompression: 'FAST', // FAST, MEDIUM, SLOW(Helps to control the new PDF file size)
						});
				// console.log("pdf: " + pdf);
				// pdf.forEach((element, index) => console.log(element));
				// for(const element in pdf){
				// 	console.log("test: " + element);
				// }
				// console.log("test: " + pdf.savePdf())
				
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

			// $('#savepdf').click(function(){
			// 	$.ajax({
			// 		url: "{{url('/dashboard/laporan/save-document')}}",
			// 		type: "POST",
			// 		data: {
			// 			_token: '{{csrf_token()}}'
			// 		},
			// 		dataType: 'json',
			// 		success: function(result){
			// 			console.log(result);
			// 			console.log(pdf);
			// 			var input = document.createElement('input');
			// 			input.name = 'dokumen_name';
			// 			input.value = pdf;
			// 		}
			// 	});
			// });
    });

	
	function showSignPad() {
  	pdf.serializePdf(function (string) {
    	$('#exampleModal .modal-body ')
    	//   .first()
    	//   .text(JSON.stringify(JSON.parse(string), null, 4));
    	// PR.prettyPrint();
    	$('#exampleModal').modal('show');
  });

  
  
  function saveFile(){
	console.log("Terpanggil");
	var doc = new jsPDF();
							$('#saveFile').click(function(){
								doc.fromHTML(
									$('.canvas-container'), 15, 15,
									{width: 170},
									function(){
										var blob = doc.output('blob');
										// var blob = doc.output('datauri');
										// var blob = doc.output('base64');
										var formData = new FormData();
										var blobPDF = new Blob([doc.output('blob')], {type : 'application/pdf'});
										var blobUrl = URL.createObjectURL(blobPDF);
										// formData.append('pdf', blob);
										formData.append('pdf', blobUrl);
										formData.append('_token', CSRF_TOKEN);
										formData.append('dokumen', dokValue);
										formData.append('dokumenName', dokName);
										// $.ajax({
										// 	url: "{{url('/dashboard/laporan/save-document')}}",
										// 	type: "POST",
										// 	data: formData,
										// 	processData: false,
										// 	contentType: false,
										// 	success: function(data){console.log(data)},
										// 	error: function(data){console.log(data)}
										// })
										console.log('clicked');
										doc.save();
									}
								)
								
								// console.log(doc);
								// console.log(source);
								
							});
  }


  
}

</script>
</body>
</html>

