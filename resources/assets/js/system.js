(function(){
    CKFinder.config( { connectorPath: '/ckfinder/connector'} );
    $('.ckeditor-description').each(function(){
        CKEDITOR.replace( this.id ) ;
    });
    $('.select2').select2();
})();

/*type = {1,2,3}
1 one img
2 multi img
3 edit one img*/
function openPopup(type = 1, id = '', id_img = '', funcNameMultiImg = 'multiImg') {
    let check_type = type;
    CKFinder.popup( {
        chooseFiles: true,
        resourceType:  'Images',
        onInit: function( finder ) {
            finder.on( 'files:choose', function( evt ) {
                if (check_type == 1) {
                    let file = evt.data.files.first();
                    let output = document.getElementById( id );
                    output.value = file.getUrl();
                    if (id_img.length > 0) {
                        let output = document.getElementById( id_img );
                        output.src = file.getUrl();
                    }
                }
                else if (check_type == 2) {
                    let files = evt.data.files.forEach();
                    let album = [];
                    files.forEach(function(file){
                        album.push({
                            image: file.getUrl(),
                        });
                    });
                    window[funcNameMultiImg](album, id);
                }else if(check_type == 3){
                    let file = evt.data.files.first();
                    id.querySelector('img').src = file.getUrl();
                    id.querySelector('[name="album[image][]"]').value = file.getUrl();
                }else{
                    let file = evt.data.files.first();
                    $(id).parents('div.col-md-3').find('img').attr('src', file.getUrl());
                    $(id).parents('div.col-md-3').find('[name="slides[image][]"]').val(file.getUrl());
                }
            } );
            finder.on( 'file:choose:resizedImage', function( evt ) {
                if (check_type == 1) {
                    let output = document.getElementById( id );
                    output.value = evt.data.resizedUrl;
                    if (id_img.length > 0) {
                        let output = document.getElementById( id_img );
                        output.src = evt.data.resizedUrl;
                    }
                }else if(check_type == 2){
                    let album = [];
                    evt.data.file.collection.models.forEach(function(file){
                        album.push({
                            image: file.getUrl(),
                        });
                    });
                    console.log(funcNameMultiImg);
                    window[funcNameMultiImg](album, id);
                }else if(check_type == 3){
                    id.querySelector('img').src = evt.data.resizedUrl;
                    id.querySelector('[name="album[image][]"]').value = evt.data.resizedUrl;
                }else{
                    $(id).parents('div.col-md-3').find('img').attr('src', evt.data.resizedUrl);
                    $(id).parents('div.col-md-3').find('[name="slides[image][]"]').val(evt.data.resizedUrl);
                }
            } );
        }
    } );
}

function multiImg(album, id){
    let html = ''
    let title = $('#lang_title').val();
    let description = $('#lang_description').val();
    album.forEach(function(file){
        html += `
            <div class="col-md-3">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-danger" onclick="removeImageInAlbum(this.parentElement.parentElement)"><i class="fas fa-fw fa-trash "></i></button>
                    <button type="button" class="btn btn-primary" onclick="openPopup(3, this.parentElement.parentElement)"><i class="fas fa-fw fa-edit "></i></button>
                </div>
                <img src="${file.image}" />
                <input type="hidden" name="album[image][]" value="${file.image}" />
                <input type="text" placeholder="${title}" name="album[title][]" value="" class="form-control" />
                <textarea name="album[description][]" placeholder="${description}" class="form-control"></textarea>
            </div>
        `;
    });
    let output = document.getElementById( id );
    output.insertAdjacentHTML('beforeend', html);
}

function addSlide(slides, id){
    let html = '';
    let title = $('#lang_title').val();
    let description = $('#lang_description').val();
    let edit_photo_details = $('#lang_edit_photo_details').val();
    let link_img = $('#lang_link_img').val();
    let url = $('#lang_url').val();
    let publish = $('#lang_publish').val();
    let submit = $('#lang_submit').val();
    let publish_data = jQuery.parseJSON($('#lang_publish_data').val());
    let publish_data_html = '';
    for(publish_status in publish_data){
        publish_data_html += `<option value="${publish_status}">${publish_data[publish_status]}</option>`;
    }

    let slides_length = $('#box-slide > div').length;
    slides.forEach(function(slide, i){
        let key = i + slides_length;
        html += `
            <div class="col-md-3">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-danger" onclick="removeSlide(this.parentElement.parentElement)"><i class="fas fa-fw fa-trash "></i></button>
                    <button type="button" data-toggle="modal" data-target="#exampleModal${key}" class="btn btn-primary"><i class="fas fa-fw fa-edit "></i></button>
                </div>
                <img src="${slide.image}" />
                <div class="modal fade" id="exampleModal${key}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel${key}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel${key}">${edit_photo_details}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img src="${slide.image}" />
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>${link_img}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="slides[image][]" placeholder="${link_img}" value="${slide.image}" onclick="openPopup(4, this)" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>${url}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="slides[url][]" placeholder="${url}" value="" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>${publish}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <select name="slides[publish][]" class="form-control">
                                            ${publish_data_html}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>${title}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="slides[title][]" placeholder="${title}" value="" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>${description}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <textarea name="slides[description][]" placeholder="${description}" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary"data-dismiss="modal" aria-label="Close">${submit}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    let output = document.getElementById( id );
    output.insertAdjacentHTML('beforeend', html);
}

function removeImageInAlbum(id){
    id.remove();
}

function removeSlide(id){
    id.remove();
    let slides = $('#box-slide > div');
    for (var i = 0; i < slides.length; i++) {
        $(slides[i]).find('button[data-toggle="modal"]').attr('data-target', '#exampleModal'+i);
        $(slides[i]).find('> div.modal').attr('id', 'exampleModal'+i);
    }
}

$('.order_index_ajax').change(function(){
    console.log(1);
});