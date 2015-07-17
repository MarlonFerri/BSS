$(function(){
    $('body').ready(function(){
        //        $("#add_conteudo").hide();
        $("#edit_conteudo").hide();
        $("#del_conteudo").hide();
    });
    
    $('.b_add_conteudo').live("click", function(){
        $("#edit_conteudo").show();
        $("#f_id").val('new');
        $("#f_pag").val('home');// <---- inserção da página fixo
        $(".t_esq").val('');
        $(".t_cen").val('');
        $(".t_dir").val('');
        $('input[type=text], .imgfile ').val('');        
        $('.img_preview').attr("src",'...');
        
    });
    
    $('.b_edit_conteudo').live("click", function(){
        id = $(this).attr('id');
        mid = id.search("_");
        
        id = id.slice(mid+1);        
        $.post('admin/request/',{
            id: id,
            acao: "editar"
        },function(data){
            $("#edit_conteudo").html(data).show();
            
            tinymce.init({
                selector: "textarea",
                theme: "modern",
                plugins: [
                //        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                //        "searchreplace wordcount visualblocks visualchars code fullscreen",
                //        "insertdatetime media nonbreaking save table contextmenu directionality",
                //        "emoticons template paste textcolor moxiemanager"
                " autolink lists link charmap preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime nonbreaking directionality",
                "emoticons template paste textcolor moxiemanager"

                ],
                toolbar1: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                toolbar2: "preview | forecolor backcolor emoticons",
                image_advtab: true,
                templates: [
                {
                    title: 'Test template 1', 
                    content: 'Test 1'
                },

                {
                    title: 'Test template 2', 
                    content: 'Test 2'
                }
                ]
            });
            evtI();
        });
    });
    
    $('.b_delete_conteudo').live("click", function(){
        id = $(this).attr('id');
        mid = id.search("_");        
        id = id.slice(mid+1);
        
        $.post('admin/request/',{
            id: id,
            acao: "excluir"
        },function(data){
            $("#del_conteudo").html(data);
            $("#del_conteudo").show(300);
            $(this).parent('tr').removeClass("blue").addClass("red");
        });
        
        
    });
    
    
    $('.b_edit_imagem').live("click", function(){
        id = $(this).attr('id');
        mid = id.search("_");        
        id = id.slice(mid+1);
        alert("nome eh" + id);
    //        $.post('admin/request/',{
    //                id: $(this).attr('id'),
    //                acao: "editar"
    //            },function(data){
    //                $("#edit_conteudo").html(data).show();
    //            });
    });
   
    $('.fechar_campos').live("click", function(){
        $(this).parent().hide();
    });
   
    $('.s_models').live("change", function(){
        value = $(this).val();
        id = $(this).parent('#id_hide').value;
        
        $.post('admin/request/',{
            id: id,
            acao: "editar_function",
            value: value,
            class2: class2
        },function(data){
            $('#img_esq').removeClass(function() {
                return $('#edit_modelo').attr('class');
            }).addClass("ie_"+data);
            
            $('#img_dir').removeClass(function() {
                return $('#edit_modelo').attr('class');
            }).addClass("id_"+data);
            
            $('#t1_esq').removeClass(function() {
                return $('#edit_modelo').attr('class');
            }).addClass("t1e_"+data);
            
            $('#t2_esq').removeClass(function() {
                return $('#edit_modelo').attr('class');
            }).addClass("t2e_"+data);
            
            $('#t1_cen').removeClass(function() {
                return $('#edit_modelo').attr('class');
            }).addClass("t1c_"+data);
            
            $('#t1_dir').removeClass(function() {
                return $('#edit_modelo').attr('class');
            }).addClass("t1d_"+data);
            
            $('#t2_dir').removeClass(function() {
                return $('#edit_modelo').attr('class');
            }).addClass("t2d_"+data);
        });
    });
    
    $('.img_preview').live("click",function(){
        $(this).parent('div').children('input[type=file]').click();
    });
    

   
    //função pronta para carregar imagem dinamicamente com fileReader api
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        var tid = evt.target.id;
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Retirado parte do render thumbnail pois estou usando img pronto como target
                    // Render thumbnail.
                    //          var span = document.createElement('span');
                    //          
                    //          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                    //                            '" title="', escape(theFile.name), '"/>'].join('');

                    //                    $('#image1').attr('src', e.target.result);
                    //                    document.getElementById(t.id).parent('div').children('.img_preview').attr('src', e.target.result);
                    $('#'+tid+'_image').attr('src', e.target.result);

                //          document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
    function evtI(){
        document.getElementById('files1').addEventListener('change', handleFileSelect, false);
        document.getElementById('files2').addEventListener('change', handleFileSelect, false);
        document.getElementById('files3').addEventListener('change', handleFileSelect, false);
        document.getElementById('filesref').addEventListener('change', handleFileSelect, false);
    }
    document.getElementById('files1').addEventListener('change', handleFileSelect, false);
    document.getElementById('files2').addEventListener('change', handleFileSelect, false);
    document.getElementById('files3').addEventListener('change', handleFileSelect, false);
    document.getElementById('filesref').addEventListener('change', handleFileSelect, false);
    
    
});
