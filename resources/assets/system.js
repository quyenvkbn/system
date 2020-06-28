(function(){
	CKFinder.config( { connectorPath: '/ckfinder/connector'} );
	$('.ckeditor-description').each(function(){
		CKEDITOR.replace( this.id ) ;
	});
})();

function openPopup(type = 1, id_input = '', id_img = '') {
    let check_type = type;
    CKFinder.popup( {
        chooseFiles: true,
        resourceType:  'Images',
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                if (check_type == 1) {
                    let file = evt.data.files.first();
                    let output = document.getElementById( id_input );
					output.value = file.getUrl();
					if (id_img.length > 0) {
						let output = document.getElementById( id_img );
						output.src = file.getUrl();
					}
                }
                else if (check_type == 2) {
                    let files = evt.data.files.forEach();
                    files.forEach(function(file){
                      /*app.album.push({
                        image: file.getUrl(),
                        title: '',
                        description: '',
                      });*/
                    })
                }else{

                }
            } );
            finder.on( 'file:choose:resizedImage', function( evt ) {
                if (check_type == 1) {
                    
                }else if(check_type == 2){
                    evt.data.file.collection.models.forEach(function(file){
                      /*app.album.push({
                        image: file.getUrl(),
                        title: '',
                        description: '',
                      });*/
                    })
                }else{

                }
            } );
        }
    } );
}