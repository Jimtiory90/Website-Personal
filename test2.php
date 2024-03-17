<HTML>
 <HEAD>
 
 
 </HEAD>
<BODY>
<form method='post' action='test2.php' enctype='multipart/form-data'>
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

//The actions for your table:

$('#table-container').jtable({
    actions: {
                listAction:     'backoffice/catalogs/display',
                deleteAction:   'backoffice/catalogs/delete',
                createAction: function (postData) {
                    var formData = getVars(postData);

                    if($('#input-image').val() !== ""){
                        formData.append("userfile", $('#input-image').get(0).files[0]);
                    }

                    return $.Deferred(function ($dfd) {
                        $.ajax({
                            url: 'backoffice/catalogs/update',
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            processData: false, // Don't process the files
                            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                            success: function (data) {
                                $dfd.resolve(data);
                                $('#table-container').jtable('load');
                            },
                            error: function () {
                                $dfd.reject();
                            }
                        });
                    });
                },
                updateAction: function (postData) {
                    var formData = getVars(postData);

                    if($('#input-image').val() !== ""){
                        formData.append("userfile", $('#input-image').get(0).files[0]);
                    }

                    return $.Deferred(function ($dfd) {
                        $.ajax({
                            url: 'backoffice/catalogs/update',
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            processData: false, // Don't process the files
                            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                            success: function (data) {
                                $dfd.resolve(data);
                                $('#table-container').jtable('load');
                            },
                            error: function () {
                                $dfd.reject();
                            }
                        });
                    });
                },

// Now for the fields:

    fields: {
                id_catalog: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                thumb_url: {
                    title: 'Image',
                    type: 'file',
                    create: false,
                    edit: true,
                    list: true,
                    display: function(data){
                        return '<img src="' + data.record.thumb_url +  '" width="150" height="207" class="preview">';
                    },
                    input: function(data){
                        return '<img src="' + data.record.thumb_url +  '" width="150" height="207" class="preview">';

                    },
                    width: "150",
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
  </script>  
</form>	 
</BODY>

</HTML>