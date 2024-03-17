<html>
  <head>

    <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
   <form name='data' method='POST' enctype='multipart/form-data'>
	<div id="PeopleTableContainer" style="width: 1360px;"></div>
	<script type="text/javascript">
     function getVars(url)
{
    var formData = new FormData();
    var split;
    $.each(url.split("&"), function(key, value) {
        split = value.split("=");
        formData.append(split[0], decodeURIComponent(split[1].replace(/\+/g, " ")));
    });

    return formData;
}

// Variable to store your files
var files;

$( document ).delegate('#input-image','change', prepareUpload);

// Grab the files and set them to our variable
function prepareUpload(event)
{
    files = event.target.files;
}


		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Data Barang',
				paging: true,
				pageSize: 2,
				sorting: true,
				defaultSorting: 'Name ASC',
				actions: {
					listAction: 'PersonActionsPagedSorted.php?action=list',
					createAction: 'PersonActionsPagedSorted.php?action=create',
					updateAction: 'PersonActionsPagedSorted.php?action=update',
					deleteAction: 'PersonActionsPagedSorted.php?action=delete'
				},
				fields: {
					kd_brg: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					kd_jenis: {
						title: 'Jenis Barang',
						width: '12%',
						edit: true,
						list: true
					},
					kd_merek: {
						title: 'Merek',
						width: '10%',
						edit: true,
						list: true
					},
					nm_brg: {
						title: 'Nama Barang',
						width: '30%',
						create: true,
					    edit: true,
						list: true
					},
					stok: {
						title: 'Stok',
						width: '4%',
						create: true,
					    edit: true,
						list: true
					},
					hrg_beli: {
						title: 'Harga Beli',
						width: '8%',
						create: true,
						edit: true,
						list : true
					},
					hrg_jual: {
						title: 'Harga Jual',
						width: '8%',
						create: true,
						edit: true,
						list : true
					},
					thumb_url: {
                    title: 'Image',
                    type: 'file',
                    create: false,
					width : '6%',
                    edit: true,
                    list: true,
                    display: function(data){
                        return '<img src="' + data.record.thumb_url +  '" width="60" height="50" class="preview">';
                    },
                    input: function(data){
                        return '<img src="' + data.record.thumb_url +  '" width="60" height="50" class="preview">';

                    },
                    listClass: "class-row-center"
                },
                image: {
                    title: 'Select File',
                    list: false,
                    create: true,
                    input: function(data) {
                        html = '<input type ="file" id="input-image" name="userfile" accept="image/*" />';
                        return html;
                    }
                }
					
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
   </form>
  </body>
</html>
